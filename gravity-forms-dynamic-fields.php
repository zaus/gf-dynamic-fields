<?php
/*

Plugin Name: Gravity Forms Dynamic Fields
Plugin URI: https://github.com/zaus/gf-dynamic-fields
Description: Dynamically fill fields with session, cookie, or other values, based on 'Forms: 3rdparty Dynamic Fields'
Author: zaus
Version: 0.3
Author URI: http://drzaus.com
Changelog:
	0.1	initial
	0.2 url without domain
	0.3 url just domain, other parity with F3P Dynamic Fields
*/

class GravityFormsDynamicFields {

	const VERSION = '0.2';

	// TODO: via setting
	const SESSION_PREFIX = 'session';
	const COOKIE_PREFIX = 'cookie';
	const PAGE_PREFIX = 'page';
	const PARAM_PREFIX = 'param';

	const TIMESTAMP = 'time';
	const DATE = 'date';
	const DATE_I18N = 'date_local';
	const TIME_I18N = 'time_local';
	const SITENAME = 'sitename';

	const PAGE_URL = 'url';
	const PAGE_URL_NODOMAIN = 'url_nodomain';
	const PAGE_DOMAIN = 'url_domain';
	const PAGE_NETWORK_URL = 'url_network';
	const PAGE_REFERER = 'referer';
	const PAGE_REQUESTURL = 'request';
	const PAGE_IP = 'ip';

	/**
	 * @var string What to report as the validation failure message
	 */
	var $err_msg;

	public function __construct() {
		// see https://docs.gravityforms.com/gform_field_value_parameter_name/
		// and https://docs.gravityforms.com/using-dynamic-population/#hooks
		// hook super late to apply after other processing
		add_filter('gform_field_value', array(&$this, 'get_values'), 30, 3);

		// must start the session before being able to access later, so might as well here
		add_filter('init', array(&$this, 'init'));
	}

	public function init() {
		if(!session_id()) session_start();
	}

	public function get_values($value, $field, $name) {
		## _log(__CLASS__, $value, $name);

		switch($name) {
			case self::TIMESTAMP:
				return time();
			case self::DATE:
				return date('c'); // ISO 8601 = Y-m-d\TH:i:sP (PHP5)
			case self::DATE_I18N:
				return date_i18n( get_option('date_format'), time() );
			case self::TIME_I18N:
				return date_i18n( get_option('time_format'), time() );
			case self::SITENAME:
				return get_bloginfo('name');

		}

		$prefix = self::PAGE_PREFIX;
		if(strpos($name, $prefix) === 0) {
			$key = substr($name, strlen($prefix)+1);

			switch($key) {	
				case self::PAGE_URL: return get_permalink();
				case self::PAGE_DOMAIN: return get_site_url();
				case self::PAGE_NETWORK_URL: return network_site_url();
				case self::PAGE_URL_NODOMAIN: return str_replace(get_site_url(), '', get_permalink());
				case self::PAGE_REFERER: return wp_get_referer();
				case self::PAGE_REQUESTURL:
					return sprintf('http%s://', is_ssl() ? 's' : '') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				case self::PAGE_IP:
					// http://www.wpbeginner.com/wp-tutorials/how-to-display-a-users-ip-address-in-wordpress/
					if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
						//check ip from share internet
						return $_SERVER['HTTP_CLIENT_IP'];
					} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
						//to check ip is pass from proxy
						return $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
						return $_SERVER['REMOTE_ADDR'];
					}
					break;
			}

			return $value;
		}

		$prefix = self::SESSION_PREFIX;
		if(strpos($name, $prefix) === 0) {
			$key = substr($name, strlen($prefix)+1);

			return isset($_SESSION[ $key ]) ? $_SESSION[ $key ] : $value;
		}

		$prefix = self::COOKIE_PREFIX;
		if(strpos($name, $prefix) === 0) {
			$key = substr($name, strlen($prefix)+1);

			return isset($_COOKIE[ $key ]) ? $_COOKIE[ $key ] : $value;
		}

		$prefix = self::PARAM_PREFIX;
		if(strpos($name, $prefix) === 0) {
			$key = substr($name, strlen($prefix)+1);

			return isset($_REQUEST[ $key ]) ? $_REQUEST[ $key ] : $value;
		}

		return $value;
	}
}   //--	class

new GravityFormsDynamicFields();