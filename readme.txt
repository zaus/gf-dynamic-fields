=== Gravity Forms Dynamic Fields ===
Contributors: zaus
Donate link: http://drzaus.com/donate
Tags: contact form, form, Gravity Forms, gravityforms, session, cookies
Requires at least: 3.0
Tested up to: 4.9.8
Stable tag: trunk
License: GPLv2 or later

Dynamically fill fields with session, cookie, or other values, based on 'Forms: 3rdparty Dynamic Fields'.

== Description ==

Insert cookie, session, page, or other kinds of values dynamically into Gravity Forms fields.

Similar to how [Forms: 3rdparty Dynamic Fields](https://wordpress.org/plugins/forms-3rdparty-dynamic-fields/) can insert dynamic values into the 3rdparty submission.

== Installation ==

1. Unzip, upload plugin folder to your plugins directory (`/wp-content/plugins/`)
2. Make sure Gravity Forms is installed
3. Activate plugin
4. Create or edit a Gravity Form -- under the 'Advanced' tab of a field, check "allow this field to be populated dynamically".
5. Set the ensuing 'Parameter Name' field to one of the registered placeholders:
	* `session_desiredkey` where 'session_' is a prefix indicating you want a Session value and 'desiredkey' is the index of which Session value to retrieve
	* `cookie_desiredkey` where 'cookie_' is a prefix indicating you want a Cookie value and 'desiredkey' is the index of which Cookie value to retrieve
	* `param_desiredkey` where 'param_' is a prefix indicating that you want a URL query parameter (or form POST) and 'desiredkey' is the index of the request parameter to retrieve.  Gravity Forms actually already does this, but it's included for consistency and this `param` will also check for POST parameters.
	* `page_url` gets the current WP page url
	* `page_url_nodomain` gets the current WP page url without the site domain (i.e. relative path)
	* `page_url_domain` gets the domain of the current WP page url without the relative path
	* `page_url_network` gets the network domain of the current WP page (useful with multisite); may be the same as `page_url_domain`
	* `page_referer` attempts to get the current referring url
	* `page_request` gets the server-generated page url (which may/not be the same as `page_url`, such as containing the querystring)
	* `page_ip` attempts to get the client's ip address
	* `time` gets the current timestamp
	* `date` gets the current ISO formatted date
	* `time_local` gets the current timestamp formatted to your local settings
	* `date_local` gets the current date formatted to your local settings
	* `sitename` gets the blog's name as configured in your admin settings


== Frequently Asked Questions ==

= How does Gravity Forms dynamically populate normally? =

See their wiki page for it -- https://docs.gravityforms.com/using-dynamic-population/

= How do I get a session value? =

See the installation instructions and use `session_yourdesiredkey` as the Parameter Name, where `yourdesiredkey` is the Session index you want.

= How do I get a cookie value? =

See the installation instructions and use `cookie_yourdesiredkey` as the Parameter Name, where `yourdesiredkey` is the Cookie index you want.

### How do I get a url querystring value? ###

Use native GF functionality, or see the installation instructions and use `param_yourdesiredkey` as the Parameter Name, where `yourdesiredkey` is the querystring index you want.

= It doesn't work right... =

Drop an issue at https://github.com/zaus/gf-dynamic-fields or in the Support forum.

== Screenshots ==

1. Configuring Gravity Forms advanced field setting 'allow field to be populated dynamically'

== Changelog ==

= 0.3 =

- added URL just domain
- added time and date
- added sitename
- added querystring parameters
- added other stuff, see installation
- basically almost parity with [Forms 3rdparty Dynamic Fields](https://wordpress.org/plugins/forms-3rdparty-dynamic-fields/) plugin.

= 0.2 =

- added URL without domain

= 0.1 =

IT HAS BEGUN.  Supports session, cookie, and a couple page values

== Upgrade Notice ==

N/A.