<?php

// Initializing the main functions of the plugin

function diff_home_function(){
  $logged_in_page = get_option('page_for_logged_in');

  if ($logged_in_page != 1){
    if ( !current_user_can( 'manage_options' ) ) {
      add_filter( 'pre_option_page_on_front', function($p) use ($logged_in_page) {
        if ( is_user_logged_in() ) {
          $page = get_page_by_path( $logged_in_page );
          return $page->ID ;
        } else {
          return $p;
        }
      });
    
      add_filter( 'pre_option_show_on_front', function($p) use ($logged_in_page) {
        if ( is_user_logged_in() ) {
          return 'page';
        } else {
          return $p;
        }
      });
    }

  }

}

add_action('init', 'diff_home_function');