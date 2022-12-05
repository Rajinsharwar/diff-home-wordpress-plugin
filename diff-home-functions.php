<?php

// Initializing the main functions of the plugin

function diff_home_function(){
 
  $logged_in_page = get_option('page_for_logged_in');
  $logged_out_page = get_option('page_for_logged_out');

  if ($logged_in_page != 1){

    if( is_user_logged_in() ) {
    $page = get_page_by_path( $logged_in_page); 
    update_option( 'page_on_front', $page->ID );
    update_option( 'show_on_front', 'page' );
    }

  }

  if ($logged_out_page != 1){

    if( is_user_logged_in() ) {

    } 
    else {
    $page = get_page_by_path( $logged_out_page );
    update_option( 'page_on_front', $page->ID );
    update_option( 'show_on_front', 'page' );
    }

  }

}

add_action('init', 'diff_home_function');