<?php

/** Trigger this file when plugin is Uninstalled

*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'WP_UNINSTALL_PLUGIN' )){
	die;
}

global $wpdb; 
$diff_home_uninstall_sql1 = 'DELETE FROM ' . $wpdb->options . ' WHERE option_name LIKE "page_for_logged_in"'; 
$wpdb->query($diff_home_uninstall_sql1);

global $wpdb; 
$diff_home_uninstall_sql2 = 'DELETE FROM ' . $wpdb->options . ' WHERE option_name LIKE "page_for_logged_out"'; 
$wpdb->query($diff_home_uninstall_sql2);
