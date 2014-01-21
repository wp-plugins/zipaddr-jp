=== zipaddr-jp ===
Contributors: ta_terunuma
Donate link: http://zipaddr2.com/wordpress/
Tags: zipaddr, zip, address, plugin, ajax, cross-domain
Requires at least: 2.0.2
Tested up to: 3.5.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The input convert an address from a zip code automatically.
It works only in Japanese.

== Description ==

Firstly zipaddr has two sites of zipaddr.com and zipaddr2.com in a service provider.
In zipaddr.com, free site, the other are pay sites.

This plugin only generates javascript sentence to cooperate with wordpress between zipaddr.
Therefore load does one following javascript.
http://zipaddr.com/js/zipaddr7.js or http://zipaddr2.com/js/zipaddr3.js
SSL:(https://zipaddr-com.ssl-xserver.jp/js/zipaddr7.js or https://zipaddr2-com.ssl-xserver.jp/js/zipaddr3.js)

It do the following movement.
1.Wordpress send zip code data as a request and receive an address.
2.zipaddr search DB from a zip code and return jsonp form for prefecture, a city, an address.
3.A pop screen searching to wordpress screen is output.
4.Wordpress bury each data in an address column on the Wordpress side.

== Installation ==

1. Upload `zipaddr-jp` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==



== Screenshots ==

1. http://zipaddr2.com/wordpress/popup.png

== Changelog ==

= 1.0.5 =
We revised an SSL-related bug.

= 1.0.4 =
We enlarged target coverage.

= 1.0.3 =
We changed the storage place of the configuration file.

= 1.0.2 =
It added a setting function of the operation environment.

= 1.0.1 =
It register an initial version.

== Upgrade notice ==



== Arbitrary section 1 ==



== A brief Markdown Example ==
