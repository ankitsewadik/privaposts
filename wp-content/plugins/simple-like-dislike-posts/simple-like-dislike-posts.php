<?php
/*
Plugin Name: Simple Like Dislike Posts
Description: A simple plugin to appy AJAX like and dislike feature in your posts
Version: 1.0
Author: Piyush Rawat
Text Domain: simple-like-dislike-posts
License: GPLv2 or later
*/
?>
<?php
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( PLUGIN_DIR . 'functions.php' );
require_once( PLUGIN_DIR . 'widget.php' );


function sal_user_scripts_and_styles(){
    wp_enqueue_script( 'utilities', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', array('jquery'), null, false );
	wp_localize_script( 'utilities', 'count_ajax', array( 'ajaxurl' => admin_url(  'admin-ajax.php' ) ) );
	wp_enqueue_script('utilities');
	wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css');
	wp_enqueue_style( 'plugin-likecounter', plugin_dir_url( __FILE__ ) . 'assets/css/plugin.css');
}
add_action( 'wp_enqueue_scripts', 'sal_user_scripts_and_styles' );

function sal_admin_scripts_and_styles(){
    wp_enqueue_script( 'utilities', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', array('jquery'), null, false );
	wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css');
	wp_enqueue_style( 'plugin-likecounter', plugin_dir_url( __FILE__ ) . 'assets/css/plugin.css');
}
add_action( 'admin_enqueue_scripts', 'sal_admin_scripts_and_styles' );

function sal_add_plugin_pages(){
	add_menu_page( 'Like/Dislike Posts', 'Like/Dislike Posts', 'administrator', 'simple-like-dislike-posts', 'sal_mainPage');
}
add_action('admin_menu', 'sal_add_plugin_pages');

function sal_plugin_activation(){
	global $wpdb;
	$table_name = $wpdb->prefix . "simplelikecounter"; 
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		user_id varchar(255) DEFAULT '0' NOT NULL,
		user_ip_address varchar(255) DEFAULT '0' NOT NULL,
		post_id mediumint(9) NOT NULL,
		like_count mediumint(4) DEFAULT '0' NOT NULL,
		dislike_count mediumint(4) DEFAULT '0' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );	
}
register_activation_hook(__FILE__, 'sal_plugin_activation');

function sal_register_plugin_settings() {
	register_setting( 'like-plugin-settings-group', 'display_in_template' );
	register_setting( 'like-plugin-settings-group', 'after_before_content' );
	register_setting( 'like-plugin-settings-group', 'only_logged_in_users' );
}
add_action( 'admin_init', 'sal_register_plugin_settings' );
