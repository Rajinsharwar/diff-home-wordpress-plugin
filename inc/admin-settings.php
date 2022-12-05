<?php

// Displaying the Admin Settings

function diff_home_admin(){
    ?>
    
    <!-- Starting Admin Page Header -->
    <div class="wrap">
    <h1><?php echo esc_html( "Select Page" ); ?></h1>
    </div>
    </br>
    </br>

    <!-- Section for dropdown of Logged In User -->

    <?php
    print(
        __( 'Homepage for Logged IN user: ' ));
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
          $admin_selected_in=$_POST['page_for_logged_in'];
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
          __( 'Homepage for Logged OUT user: ' ));
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
        if(empty($_POST['page_for_logged_out'])) {
            
          } else {
            $admin_selected_out=$_POST['page_for_logged_out'];
            update_option('page_for_logged_out', $admin_selected_out, $autoload = 'yes');
          }
          ?>

          <!-- The dropdown for Logged OUT user -->

        <select name="page_for_logged_out" id="page_for_logged_out">
          <option value="" disabled selected>Choose one</option>
          <?php
          foreach ( $pages as $page ) {
              ?>
          <option value="<?php echo esc_attr( $page->post_name ); ?>" <?php echo ( get_option('page_for_logged_out') == $page->post_name ? 'selected' : '' ); ?>><?php echo esc_html( $page->post_title ); ?></option>
              <?php
          }
          ?>
        </select>



    <!-- Submit Button -->
    <?php submit_button(); ?>
    </form>

    <?php
}