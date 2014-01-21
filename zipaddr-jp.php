<?php
/*
Plugin Name: zipaddr-jp
Plugin URI: http://zipaddr2.com/wordpress/
Description: The input convert an address from a zip code automatically.
Version: 1.0.5
Author: Tatsuro, Terunuma
Author URI: http://pierre-soft.com/
*/
define( 'zipaddr_VERSION', '1.0.5');
define( 'zipaddr_PATH', dirname( __FILE__ ) );
define( 'zipaddr_FILE1',ABSPATH."wp-content/plugins/zipaddr_define.txt" );

if( is_admin() )
	require_once zipaddr_PATH.'/admin.php';


function zipaddr_jp_change($output, $opt=""){
	if( strstr($output,'zip') == false ) {return $output;}

$ac = '1';  // 1:無償,2:有償
$kt = '5';  // 5-7:ガイダンス表示桁数
$fname= zipaddr_FILE1;
if( file_exists($fname) ) { // ファイルの確認
	$data= trim( file_get_contents($fname) );
	$prm= explode(",", $data);
	if( count($prm) >= 2 ) {$ac=$prm[0]; $kt=$prm[1];}
}
if( $kt < "5" || "7" < $kt ) $kt= "5";
$ul = 'http://zipaddr.com/js/zipaddr7.js';
$u2 ='http://zipaddr2.com/js/zipaddr3.js';
$uls= 'https://zipaddr-com.ssl-xserver.jp/js/zipaddr7.js?v='.zipaddr_VERSION;
$u2s='https://zipaddr2-com.ssl-xserver.jp/js/zipaddr3.js?v='.zipaddr_VERSION;
if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) $ssl= "1";
else $ssl= "";
	$ssl= '1';
	 if( $ac == "2" && $ssl == "1" ) $uls= $u2s;
else if( $ac == "2" )                $uls= $u2;
else if( $ssl == "1" ) $uls= $uls;
else                   $uls= $ul;
$js = '<script type="text/javascript" src="'. $uls .'" charset="UTF-8"></script>';
$js.= '<script type="text/javascript" charset="UTF-8">function zipaddr_own(){ZP.min='.$kt.';}</script>';
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
