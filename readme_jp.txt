=== zipaddr-jp ===
Contributors: ta_terunuma
Donate link: http://zipaddr2.com/wordpress/
Tags: zipaddr, zip, address, plugin, ajax, cross-domain
Requires at least: 3.7
Tested up to: 4.3.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



== Description ==
****************************************
  zipaddr-jp for Wordpress の概説
****************************************

zipaddr(ジップアダー)日本語版は以下の環境で動作します。
Wordpress 3.3 以上
PHP 5.x
MySQL 未使用
文字コード UTF-8

はじめにzipaddrはサービス・プロバイダで、無料のhttp://zipaddr.com/と有償版のhttp://zipaddr2.com/があります。

当プラグインはWordpressとzipaddrをアプリケーション連携させるためのjavascript文を、1行生成します。
具体的には、
<script src="http://zipaddr.com/js/zipaddr7.js" charset="UTF-8"></script> or
<script src="http://zipaddr2.com/js/zipaddr3.js" charset="UTF-8"></script>
SSL環境では、
<script src="https://zipaddr-com.ssl-xserver.jp/js/zipaddr7.js" charset="UTF-8"></script> or
<script src="https://zipaddr2-com.ssl-xserver.jp/js/zipaddr3.js" charset="UTF-8"></script>

そして次のような動作をします。
1.Wordpressから郵便番号データの検索リクエストをzipaddr側に送ります。
2.zipaddrでは郵便番号からDBを検索して都道府県、市区町村、地域、データをjsonp形式で返します。
3.Wordpress側にはポップアップで検索の途中データが表示されます。
4.最終的にWordpress側画面の都道府県、市区町村、地域、の各欄にデータが埋め込まれます。
詳細は、http://zipaddr2.com/wordpress/ を参照して下さい。

[重要]
zipaddr-jpを使用中に起こった如何なる損害も自己責任となります。



== Installation ==
【インストール】

解凍して得られたフォルダ「zipaddr-jp」を、Wordpressの`/wp-content/plugins/`フォルダに設置する。
アップデートする場合は「zipaddr-jp」を上書きします。
一旦zipaddr-jpを停止してからアップデートし、有効化を行ってください。



== Changelog ==
【更新履歴】

= 1.14 =
[2015/8/22]
・郵便番号区切り文字の指定を可能にしました。

= 1.13 =
[2015/6/20]
・スピードアップ版の提供とガイダンス出力を7桁標準に変更しました。

= 1.12 =
[2015/4/29]
・Trust Formの標準サポートとバグ修正をしました。

= 1.11 =
[2015/3/16]
・HELPのリンク先を充実させました。

= 1.10 =
[2015/1/1]
・システム拡張用の識別子を設定する機能を追加しました。

= 1.9 =
[2014/12/7]
・郵便番号入力後のフォーカス機能を追加しました。

= 1.8 =
[2014/9/6]
・ガイダンス画面の文字サイズ変更機能を追加しました。

= 1.7 =
[2014/3/30]
・御社サイト内で郵便番号簿を管理するモードを追加しました。

= 1.0.6 =
[2014/1/25]
・ガイダンス画面の表示位置変更機能を追加しました。

= 1.0.5 =
[2014/1/21]
・SSL関連のバグを修正しました。

= 1.0.4 =
[2014/1/7]
・対象の適用範囲を拡大しました。

= 1.0.3 =
[2014/1/6]
・設定ファイルの格納場所を変更しました。

= 1.0.2 =
[2014/1/5]
・稼働環境の設定機能を追加しました。

= 1.0.1 =
[2013/12/6]
・初期バージョンとして公開しました。
