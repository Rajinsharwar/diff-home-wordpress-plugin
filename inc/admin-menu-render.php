<?php

// Rendering the admin menu

add_action( 'admin_menu', 'diff_home_top_lvl_menu' );

 
function diff_home_top_lvl_menu(){
 
    add_menu_page(
        'Set Different Page for Logged IN and Logged OUT User', // page <title>Title</title>
        'Diff Home', // link text
        'manage_options', // user capabilities
        'diff_home', // page slug
        'diff_home_admin', // Function to print the page content
        'dashicons-shortcode', // icon (from Dashicons)
        75 // menu position
    );
}
