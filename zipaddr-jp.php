<?php
/*
Plugin Name: zipaddr-jp
Plugin URI: http://zipaddr2.com/wordpress/
Description: The input convert an address from a zip code automatically.
Version: 1.0.1
Author: Tatsuro, Terunuma
Author URI: http://pierre-soft.com/
*/
define('ZipAddr_VERSION', '1.0.1');

function zipaddr_jp_change($output){
	if( strstr($output,'zip') == false ) {return $output;}
$pn = explode('/', plugin_basename(__FILE__));
$plugin_name = $pn[0];
$ac = '1';
$ul = 'http://zipaddr.com/js/zipaddr7.js';
$u2 ='http://zipaddr2.com/js/zipaddr3.js';
$uls= 'https://zipaddr-com.ssl-xserver.jp/js/zipaddr7.js';
$u2s='https://zipaddr2-com.ssl-xserver.jp/js/zipaddr3.js';
if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) $ssl= "1";
else $ssl= "";
	 if( $ac == "2" && $ssl == "1" ) $uls= $u2s;
else if( $ac == "2" )                $uls= $u2;
else if( $ssl == "1" ) $uls= $uls;
else                   $uls= $ul;
$js = '<script src="'. $uls .'" charset="UTF-8"></script>';
$ky = '<form';
	return str_ireplace($ky, $js.$ky, $output);
}

add_filter( 'the_content', 'zipaddr_jp_change', 99999);
?>
