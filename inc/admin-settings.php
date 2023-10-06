<?php

// Displaying the Admin Settings

function diff_home_admin(){
    ?>

    <!-- Starting Admin Page Header -->
    <div class="wrap">
    <h1><?php echo esc_html( "Select Page" ); ?></h1>
    </div>

    <!-- Displaying the Warning Message -->
    <div class="diff-home-warning">
      <p class="diff-home-warning-text"><strong>Disclaimer:</strong> As you logged in as an Administrator of this website, you will always see the page that you selected from the "Settings > General > Reading > Homepage" as your Homepage while logged in. You will need to create a test account of Subscriber, or of any other User Role to test if the page set for the Logged In user is working correctly. We disabled our plugin's functionality for the users of Administrators role, to avoid any conflicts with some page builders, like Elementor, WP Bakery, etc. </p>
    </div>

    <!-- The Style of the Warning Banner -->
    <style>
    .diff-home-warning {
        background-color: #ffb900;
        padding: 0.5em;
        border-radius: 5px;
        text-align: center;
        margin: 20px 0;
        padding-right: 20px;
        max-width: 95%;
    }
    .diff-home-warning-text{
      padding-left: 8px;
    }
    </style>
    </br>

    <!-- Section for dropdown of Logged In User -->

    <?php
    print(
        __( 'Homepage for Logged IN user: ', 'diff-home' ));
    ?>
    </br>
    </br>

    <form method=post>
    <div class="header-right">
      <?php
      $pages = get_pages(
        array(
            'post_status' => 'publish',
        )
      );
      
      ?>

      <!-- Updating Value in the DB on input for logged in page -->

      <?php
      if(empty($_POST['page_for_logged_in'])) {
          
        } else {
          $admin_selected_in=sanitize_text_field( $_POST['page_for_logged_in'] );
          update_option('page_for_logged_in', $admin_selected_in, $autoload = 'yes');
        }
        ?>

        <!-- The dropdown for logged in page -->

      <select name="page_for_logged_in" id="page_for_logged_in">
        <option value="" disabled selected>Choose one</option>
        <?php
        foreach ( $pages as $page ) {
            ?>
        <option value="<?php echo esc_attr( $page->post_name ); ?>" <?php echo ( get_option('page_for_logged_in') == $page->post_name ? 'selected' : '' ); ?>><?php echo esc_html( $page->post_title ); ?></option>
            <?php
        }
        ?>
      </select>

      <!-- Starting section for Logged OUT user -->

      </br>
      </br>
      <?php
      print(
          __( 'Homepage for Logged OUT user: ', 'diff-home' ));
      ?>
      </br>
      </br>
      <?php echo __( '<b>Please choose the Homepage for the Logged-out users/visitors by navigating under Settings > Reading > Your homepage displays > A static page (select below) </b>', 'diff-home' );?>

    <!-- Submit Button -->
    <?php submit_button(); ?>
    </form>

    <?php
}