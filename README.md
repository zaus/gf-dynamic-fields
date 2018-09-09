# Gravity Forms Dynamic Fields #
Contributors: zaus
Donate link: http://drzaus.com/donate
Tags: contact form, form, Gravity Forms, gravityforms, session, cookies
Requires at least: 3.0
Tested up to: 4.9.8
Stable tag: trunk
License: GPLv2 or later

Dynamically fill fields with session, cookie, or other values, based on 'Forms: 3rdparty Dynamic Fields'.

## Description ##

Insert cookie, session, page, or other kinds of values dynamically into Gravity Forms fields.

Similar to how [Forms: 3rdparty Dynamic Fields](https://wordpress.org/plugins/forms-3rdparty-dynamic-fields/) can insert dynamic values into the 3rdparty submission.

## Installation ##

1. Unzip, upload plugin folder to your plugins directory (`/wp-content/plugins/`)
2. Make sure Gravity Forms is installed
3. Activate plugin
4. Create or edit a Gravity Form -- under the 'Advanced' tab of a field, check "allow this field to be populated dynamically".
5. Set the ensuing 'Parameter Name' field to one of the registered placeholders:
	* `session_desiredkey` where 'session_' is a prefix indicating you want a Session value and 'desiredkey' is the index of which Session value to retrieve
	* `cookie_desiredkey` where 'cookie_' is a prefix indicating you want a Cookie value and 'desiredkey' is the index of which Cookie value to retrieve
	* `page_url` gets the current WP page url
	* `page_url_nodomain` gets the current WP page url without the site domain (i.e. relative path)
	* `page_referer` attempts to get the current referring url
	* `page_request` gets the server-generated page url (which may/not be the same as `page_url`)
	* `page_ip` attempts to get the client's ip address


## Frequently Asked Questions ##

### How do I get a session value? ###

See the installation instructions and use `session_yourdesiredkey` as the Parameter Name, where `yourdesiredkey` is the Session index you want.

### How do I get a cookie value? ###

See the installation instructions and use `cookie_yourdesiredkey` as the Parameter Name, where `yourdesiredkey` is the Cookie index you want.

### It doesn't work right... ###

Drop an issue at https://github.com/zaus/gf-dynamic-fields or in the Support forum.

## Screenshots ##

N/A.

## Changelog ##

### 0.2 ###

- added URL without domain

### 0.1 ###

IT HAS BEGUN.  Supports session, cookie, and a couple page values.

## Upgrade Notice ##

N/A.