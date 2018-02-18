<div class="wrap">
<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<h2>Created by <a style="color:#bc4e9c;" href="https://getshifter.io" target="_blank">Shifter</a></h2>
<p>Helper tools for Form Plugins while using Serverless Static WordPress Sites.</p>
<div class="card">
	<h2 class="title">HTTP Endpoint</h2>
  <p>Add your HTTP endpoint from providers such as <a href="https://usebasin.com">Basin</a>, <a href="https://formkeep.com">FormKeep</a>, <a href="https://formspree.io/">Formspree </a> and more to begin using SLS Forms.</p>
  <form method="post" action="options.php">
      <?php settings_fields( 'wp-sls-forms-settings-group' ); ?>
      <?php do_settings_sections( 'wp-sls-forms-settings-group' ); ?>
      <table class="form-table">
        <tr valign="top">
        <th scope="row">Endpoint:</th>
        <td>
          <input name="wp_sls_forms_endpoint" type="url" aria-describedby="serverless-forms-endpoint-url" value="<?php echo get_option( 'wp_sls_forms_endpoint' ); ?>" class="regular-text code">
        </td>
        </tr>
      </table>
  <?php submit_button(); ?>
  </form>
</div>
</div>
