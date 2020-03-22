<div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
  <h2>Created by <a style="color:#f80759;" href="https://getshifter.io" rel="noopener nofollow" target="_blank">Shifter</a></h2>
  <p>Helper plugin for sending form submissions to HTML endpoints.</p>
  <div class="card">
    <h2 class="title">HTTP Endpoint</h2>
    <p>Replace WordPress Plugin form action with providers such as <a target="_blank" rel="noopener nofollow" href="https://usebasin.com">Basin</a>, <a target="_blank" rel="noopener nofollow" href="https://formkeep.com">FormKeep</a>, <a target="_blank" rel="noopener nofollow" href="https://formspree.io/">Formspree</a> and more to begin using WP Serverless Forms.</p>
    <form method="post" action="options.php">
      <?php settings_fields('wp-sls-forms-settings-group'); ?>
      <?php do_settings_sections('wp-sls-forms-settings-group'); ?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row">Endpoint:</th>
          <td>
            <input name="wp_sls_forms_endpoint" type="url" aria-describedby="serverless-forms-endpoint-url" value="<?php echo get_option('wp_sls_forms_endpoint'); ?>" class="regular-text code">
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Redirect:</th>
          <td>
            <input name="wp_sls_forms_redirect" type="text" aria-describedby="serverless-forms-redirect" value="<?php echo get_option('wp_sls_forms_redirect'); ?>" class="regular-text code">
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
</div>