<?php
/*
Plugin Name: zipaddr-jp
Plugin URI: http://zipaddr2.com/wordpress/
Description: The input convert an address from a zip code automatically.
Version: 1.14
Author: Tatsuro, Terunuma
Author URI: http://pierre-soft.com/
*/
define( 'zipaddr_VERS', '1.14');
define( 'zipaddr_KEYS', 'zipaddr-key-config');
define( 'zipaddr_PATH', dirname( __FILE__ ) );
define( 'zipaddr_FILE1',ABSPATH."wp-content/plugins/zipaddr_define.txt" );

if( is_admin() ){
	require_once zipaddr_PATH.'/admin.php';
	add_filter('plugin_action_links', 'zipaddr_plugin_action_links', 10, 2 );  // admin
	add_action('admin_menu', 'zipaddr_admin_pages');
}
else {
	require_once zipaddr_PATH.'/zipaddr.php';
	add_filter('usces_filter_apply_addressform', 'zipaddr_jp_usces', 99999, 3);// welcart
	add_filter('the_content', 'zipaddr_jp_change', 99999); // html change
}
?>
