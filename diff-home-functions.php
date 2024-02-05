<?php

// Initializing the main functions of the plugin

function diff_home_function($home_page_diff_home)
{
    $page_src = get_option('logged_in_page_source');

    if ($page_src && $page_src == 1) {

        $diff_home_logged_in_page = get_option('page_for_logged_in');
        $all_post_types = ['page'];

    } elseif ($page_src && $page_src == 2) {

        $diff_home_logged_in_page = get_option('url_for_logged_in');

        if (!get_transient('diff_home_all_post_types')) {

            $args = array(
                'public' => true
            );
            $output = 'names';
            $operator = 'and';

            $all_post_types = get_post_types($args, $output, $operator);

            set_transient('diff_home_all_post_types', $all_post_types, DAY_IN_SECONDS);
        }

        $all_post_types = get_transient('diff_home_all_post_types');
    }

    if (!current_user_can('manage_options')) {
        if (is_user_logged_in()) {

            if ($diff_home_logged_in_page != 0) {
                $diff_home_page = get_page_by_path($diff_home_logged_in_page, OBJECT, $all_post_types);
                if ($diff_home_page) {
                    $home_page_diff_home = $diff_home_page->ID;
                }
            }
        }
    }

    return $home_page_diff_home;
}

add_filter('option_page_on_front', 'diff_home_function', 10, 1);
add_filter('option_show_on_front', function () {
    return 'page';
});
