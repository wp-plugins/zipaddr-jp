<?php
/*
Plugin Name: zipaddr-jp
Plugin URI: http://zipaddr2.com/wordpress/
Description: The input convert an address from a zip code automatically.
Version: 1.9
Author: Tatsuro, Terunuma
Author URI: http://pierre-soft.com/
*/
define( 'zipaddr_VERS', '1.9');
define( 'zipaddr_PATH', dirname( __FILE__ ) );
define( 'zipaddr_FILE1',ABSPATH."wp-content/plugins/zipaddr_define.txt" );

if( is_admin() )
	require_once zipaddr_PATH.'/admin.php';

function zipaddr_jp_change($output, $opt=""){
	if( strstr($output,'zip') == false ) {return $output;}

$ac = '1'; // 1:無償,2:有償,3:御社
$kt = '5'; // 5-7:ガイダンス表示桁数
$ta = "";  // 縦
$yo = "";  // 横
$pf = "";  // pc-fsize
$sf = "";  // sp-fsize
$fo = "";  // focus
$fname= zipaddr_FILE1;
if( file_exists($fname) ) { // ファイルの確認
	$data= trim( file_get_contents($fname) );
	$prm= explode(",", $data);
	while( count($prm) < 7 ) {$prm[]="";}
	$ac= $prm[0];
	$kt= $prm[1];
	$ta= $prm[2];
	$yo= $prm[3];
	$pf= $prm[4];
	$sf= $prm[5];
	$fo= $prm[6];
}
if( $kt < "5" || "7" < $kt ) $kt= "5";
if( $pf < 12  || 20  < $pf ) $pf= "12";
if( $sf < 12  || 20  < $sf ) $sf= "20";
if( isset($_SERVER['HTTPS']) ) {
	$http= (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS']=='off' ) ?  'http' : 'https';
}
else $http= 'http';
$svr= isset($_SERVER['SERVER_NAME']) ?  $_SERVER['SERVER_NAME'] : "";
$pth= $http.'://'.$svr; // 実働環境
$ul = 'http://zipaddr.com/js/zipaddr7.js';
$u2 ='http://zipaddr2.com/js/zipaddr3.js';
$uls= 'https://zipaddr-com.ssl-xserver.jp/js/zipaddr7.js';
$u2s='https://zipaddr2-com.ssl-sixcore.jp/js/zipaddr3.js';
$ph2='https://zipaddr2-com.ssl-sixcore.jp/css/zipaddr.css';
$u3= $pth.'/js/zipaddr.js';
	 if( $ac == "3" ) $lpath= $pth.'/js/zipaddr.css';
else if( $ac == "2" ) {
	$lpath= $pth.'/css/zipaddr.css';
	$wk= @file_get_contents($lpath);
	$wk2=strstr($wk,"autozip");
	if( empty($wk) || empty($wk2) ) $lpath= $ph2; // 定義がなければ補う
}
else $lpath= '';
	$ssl= '1';
	$wp_version= get_bloginfo('version');
	 if( $ac == "3" )  $uls= $u3;
else if( $ac == "2" && $ssl == "1" ) $uls= $u2s;
else if( $ac == "2" )                $uls= $u2;
else if( $ssl == "1" ) $uls= $uls;
else                   $uls= $ul;
$js = '<script type="text/javascript" src="'.$uls.'?v='.zipaddr_VERS.'" charset="UTF-8"></script>';
$js.= '<script type="text/javascript" charset="UTF-8">function zipaddr_ownb(){';
if( !empty($ta) ) $js.= 'ZP.top='. $ta.';';
if( !empty($yo) ) $js.= 'ZP.left='.$yo.';';
if( !empty($pf) ) $js.= 'ZP.pfon='.$pf.';';
if( !empty($sf) ) $js.= 'ZP.sfon='.$sf.';';
if( !empty($fo) ) $js.= "ZP.focus='".$fo."';";
$js.= 'ZP.min='.$kt.';ZP.uver=\''.$wp_version.'\';}</script>';
if( $ac=="2" || $ac=="3" ) $js.= '<link rel="stylesheet" href="'.$lpath.'" />';
$ky = '<form';
	$ans= empty($opt) ? str_ireplace($ky, $js.$ky, $output) : $output.$js;
	return $ans;
}
add_filter( 'the_content', 'zipaddr_jp_change', 99999);

function zipaddr_jp_usces($formtag, $type, $data){
	return zipaddr_jp_change($formtag, "1");
}
add_filter( 'usces_filter_apply_addressform', 'zipaddr_jp_usces', 99999, 3);
?>
