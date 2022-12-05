<?php
/**
 * Plugin Name: Different Home for Logged IN & Logged OUT
 * Description: Set different Homepage for your Logged IN and Logged OUT users. Increase your engagement, and let your users see what they should be seeing.
 * Author: Rajin Sharwar
 * Author URI: https://linkedin.com/in/rajinsharwar
 * Version: 1.0.0
 * Text Domain: diff_home
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Adding values in the DB
if ( !isset( get_option( 'page_for_logged_in' )['1'] ) ) {
    add_option ('page_for_logged_in', '1');
}
if ( !isset( get_option( 'page_for_logged_out' )['1'] ) ) {
    add_option ('page_for_logged_out', '1');
}


require (plugin_dir_path(__FILE__). 'inc/admin-menu-render.php');
require (plugin_dir_path(__FILE__). 'inc/admin-settings.php');
require (plugin_dir_path(__FILE__). 'diff-home-functions.php');





