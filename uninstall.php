<?php

/** Trigger this file when plugin is Uninstalled

*/

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$diff_home_uninstall_sql1 = 'DELETE FROM ' . $wpdb->options . ' WHERE option_name IN ("page_for_logged_in", "url_for_logged_in", "logged_in_page_source")';
$wpdb->query($diff_home_uninstall_sql1);

