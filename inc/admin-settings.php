<?php

// Displaying the Admin Settings

function diff_home_admin()
{
  ?>

  <!-- Starting Admin Page Header -->
  <div class="wrap">
    <h1>
      <?php echo esc_html("Select Page"); ?>
    </h1>
  </div>

  <!-- Displaying the Warning Message -->
  <div class="diff-home-warning">
    <p class="diff-home-warning-text"><strong>Disclaimer:</strong> As you logged in as an Administrator of this website,
      you will always see the page that you selected from the "Settings > General > Reading > Homepage" as your Homepage
      while logged in. You will need to create a test account of Subscriber, or of any other User Role to test if the page
      set for the Logged In user is working correctly. We disabled our plugin's functionality for the users of
      Administrators role, to avoid any conflicts with some page builders, like Elementor, WP Bakery, etc. </p>
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

    .diff-home-warning-text {
      padding-left: 8px;
    }
  </style>
  </br>

  <!-- Section for dropdown of Logged In User -->

  <form method="post">
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
      if (!empty($_POST['page_for_logged_in'])) {
        $admin_selected_in = sanitize_text_field($_POST['page_for_logged_in']);
        update_option('page_for_logged_in', $admin_selected_in);
      }

      if (!empty($_POST['page_for_logged_in']) || !empty($_POST['url_for_logged_in'])) {
        // Save the selected radio button value as 1 or 2 based on the selected option
        $logged_in_page_source = ($_POST['logged_in_page_source'] == 'pages') ? 1 : 2;
        update_option('logged_in_page_source', $logged_in_page_source);

        $args = array(
          'public' => true
        );
        $output = 'names';
        $operator = 'and';

        $all_post_types = get_post_types($args, $output, $operator);

        set_transient('diff_home_all_post_types', $all_post_types, DAY_IN_SECONDS);
      }

      // Save the URL for logged in page.
      if (!empty($_POST['url_for_logged_in'])) {
        $logged_in_page_url = sanitize_text_field($_POST['url_for_logged_in']) ? sanitize_text_field($_POST['url_for_logged_in']) : '';
        update_option('url_for_logged_in', $logged_in_page_url);
      }

      ?>

      <!-- Radio buttons for selecting logged-in page source -->
      <p>
        <input type="radio" id="select_from_pages" name="logged_in_page_source" value="pages" <?php echo (get_option('logged_in_page_source', 1) == 1 ? 'checked' : ''); ?>>
        <label for="select_from_pages">Select Logged-in page from Pages</label>
      </p>
      <p>
        <input type="radio" id="select_from_url" name="logged_in_page_source" value="url" <?php echo (get_option('logged_in_page_source') == 2 ? 'checked' : ''); ?>>
        <label for="select_from_url">Select Logged-in page from URL</label>
      </p>
      </br>

      <!-- Homepage for Logged IN user: based on radio button selection -->
      <div id="logged_in_page_from_pages"
        style="display: <?php echo (get_option('logged_in_page_source', 1) == 1 ? 'block' : 'none'); ?>">
        <b>
          <?php print(__('Homepage for Logged IN user from Pages: ', 'diff-home')); ?>
        </b>
        <select name="page_for_logged_in" id="page_for_logged_in">
          <option value="" disabled selected>Choose one</option>
          <?php
          foreach ($pages as $page) {
            ?>
            <option value="<?php echo esc_attr($page->post_name); ?>" <?php echo (get_option('page_for_logged_in') == $page->post_name ? 'selected' : ''); ?>>
              <?php echo esc_html($page->post_title); ?>
            </option>
            <?php
          }
          ?>
        </select>
      </div>

      <div id="logged_in_page_from_url"
        style="display: <?php echo (get_option('logged_in_page_source') == 2 ? 'block' : 'none'); ?>; margin-top: -10px;">
        <p><i><b>
              <?php print(__('Enter the slug of the page/post/any custom post type you wish to set. The remaining URl will be automatically populated. No slashes needed. Example: for the URl of "https://example.com/2024/04/hello-world", simply enter "hello-world"', 'diff-home')); ?>
            </b></i></p>
        <p>
          <?php
          $structure = get_option('permalink_structure') ? get_option('permalink_structure') : '/';
          if ($structure != '/') {
            $regex = '/%postname%\//i';
            $structure = preg_replace($regex, '', $structure);
          }

          if ($structure == '/archives/%post_id%') {
            $structure = '<b style="color: red;"> [THIS PLUGIN DOES\'NT YET WORK WITH THE NUMERIC PERMALINK STRUCTURE] </b>';
            $hide = 1;
          }

          print(__(get_site_url(), 'diff-home')) . $structure;
          if (!isset($hide)) {
            ?>
            <input type="text" name="url_for_logged_in" id="url_for_logged_in"
              value="<?php echo esc_attr(get_option('url_for_logged_in')); ?>">
            <?php
          } ?>
        </p>
      </div>

      <!-- Starting section for Logged OUT user -->
      </br>
      <b>
        <?php
        print(__('Homepage for Logged OUT user: ', 'diff-home'));
        ?>
      </b>
      </br>
      <?php echo __('Please choose the Homepage for the Logged-out users/visitors by navigating under Settings > Reading > Your homepage displays > A static page (select below)', 'diff-home'); ?>

      <!-- Submit Button -->
      <?php submit_button(); ?>
    </div>
  </form>

  <script>
    // Add event listener to radio buttons
    var selectFromPages = document.getElementById('select_from_pages');
    var selectFromUrl = document.getElementById('select_from_url');
    var logged_in_page_from_pages = document.getElementById('logged_in_page_from_pages');
    var logged_in_page_from_url = document.getElementById('logged_in_page_from_url');

    selectFromPages.addEventListener('change', function () {
      if (this.checked) {
        logged_in_page_from_pages.style.display = 'block';
        logged_in_page_from_url.style.display = 'none';
      }
    });

    selectFromUrl.addEventListener('change', function () {
      if (this.checked) {
        logged_in_page_from_pages.style.display = 'none';
        logged_in_page_from_url.style.display = 'block';
      }
    });
  </script>


  <?php
}