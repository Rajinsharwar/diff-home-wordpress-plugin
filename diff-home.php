<?php
/**
 * Plugin Name: Different Home for Logged IN & Logged OUT
 * Description: Set different Homepage for your Logged IN and Logged OUT users. Increase your engagement, and let your users see what they should be seeing.
 * Author: Rajin Sharwar
 * Author URI: https://linkedin.com/in/rajinsharwar
 * Version: 1.2.0
 * Text Domain: diff_home
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'diff_home' ) ) {
    // Create a helper function for easy SDK access.
    function diff_home() {
        global $diff_home;

        if ( ! isset( $diff_home ) ) {
            require_once dirname(__FILE__) . '/inc/vendor/start.php';

            $diff_home = fs_dynamic_init( array(
                'id'                  => '11612',
                'slug'                => 'different-home-for-logged-in-logged-out',
                'type'                => 'plugin',
                'public_key'          => 'pk_32e692f072ceb119eb7671c7db1a3',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'diff_home',
                    'first-path'     => 'admin.php?page=diff_home',
                    'account'        => false,
                    'support'        => false,
                ),
            ) );
        }

        return $diff_home;
    }

    diff_home();
    do_action( 'diff_home_loaded' );
}

// Adding values in the DB
if ( !isset( get_option( 'page_for_logged_in' )['1'] ) ) {
    add_option ('page_for_logged_in', '1');
}

//Redirect Amdin on plugin Activation
function diff_home_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=diff_home' ) ) );
    }
}

add_action( 'activated_plugin', 'diff_home_activation_redirect' );

require (plugin_dir_path(__FILE__). 'inc/admin-menu-render.php');
require (plugin_dir_path(__FILE__). 'inc/admin-settings.php');
require (plugin_dir_path(__FILE__). 'diff-home-functions.php');





