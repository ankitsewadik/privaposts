<?php
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
global $wpdb;
$table_name = $wpdb->prefix . "simplelikecounter"; 
$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
delete_option('display_in_template');
delete_option('after_before_content');
delete_option('only_logged_in_users');
?>