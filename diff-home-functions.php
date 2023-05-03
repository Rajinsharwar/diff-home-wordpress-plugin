<?php

// Initializing the main functions of the plugin

function diff_home_function( $home_page_diff_home ) {
    $diff_home_logged_in_page = get_option('page_for_logged_in');

    if ( !current_user_can( 'manage_options' ) ) {
        if ( is_user_logged_in() ) {
            if ( $diff_home_logged_in_page != 0 ) {
                $diff_home_page = get_page_by_path( $diff_home_logged_in_page );
                $home_page_diff_home = $diff_home_page->ID;
            }
        }
    }
    
    return $home_page_diff_home;
}

add_filter( 'option_page_on_front', 'diff_home_function', 10, 1 );
add_filter( 'option_show_on_front', function() { return 'page'; } );
