=== zipaddr-jp ===
Contributors: ta_terunuma
Donate link: http://zipaddr2.com/wordpress/
Tags: zipaddr, zip, address, plugin, ajax, cross-domain
Requires at least: 3.7
Tested up to: 4.3.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The input convert an address from a zip code automatically.
It works only in Japanese.

== Description ==

= In Japanese: =
当プラグインはWordpressと住所自動入力のZipAddrをグローバル連携させるもので、日本語環境のみ動作します。
主な動作手順は次のようになります。
1.起動設定後に郵便番号の入力を待ちます。
2.Wordpress側から郵便番号データの検索リクエストをzipaddr側に送ります。
3.zipaddrでは郵便番号からDBを検索して都道府県、市区町村、地域、データをjsonp形式で返します。
4.Wordpress側にはポップアップで検索の途中データが表示されます。
5.最終的にWordpress側画面の都道府県、市区町村、地域、の各欄にデータが埋め込まれます。
zipaddr-jpの詳細説明は、[http://zipaddr2.com/wordpress/](http://zipaddr2.com/wordpress/)を参照して下さい。

= In English: =
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

= 1.14 =
We enabled the designation of the zip code delimiter.

= 1.13 =
We changed offer for speedup and guidance output seven columns to the standard

= 1.12 =
We supported Trust Form and Bug fixed.

= 1.11 =
We expanded a link of HELP.

= 1.10 =
We added the function to set an identifier for system expansion.

= 1.9 =
We added the focus function after the zip code input.

= 1.8 =
We added the font-size change function of the guidance screen.

= 1.7 =
We added the mode which managed the zip code book in your company site.

= 1.0.6 =
We added the indication point change function of the guidance screen.

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
