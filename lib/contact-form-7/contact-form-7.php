<?php

/*
 * Conditionally Load CF7 Scripts
 */

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
  wpcf7_enqueue_scripts();
}

if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
  wpcf7_enqueue_styles();
}

require_once WP_CONTENT_DIR . '/plugins/contact-form-7/wp-contact-form-7.php';

class SLS_FORMS_CF7_BASIN extends WPCF7_Service {

  const BASE_PLUGIN_URL = WP_CONTENT_DIR;

	private static $instance;
	private $sitekeys;

	public static function get_instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		$this->sitekeys = WPCF7::get_option( 'sls_forms_cf7' );
	}

	public function get_title() {
		return __( 'SLS Forms — Basin', 'contact-form-7' );
	}

	public function is_active() {
		$sitekey = $this->get_sitekey();
		return $sitekey;
	}

	public function get_categories() {
		return array( 'sls_forms_cf7_basin' );
	}

	public function icon() {
		$icon = sprintf(
			'<img src="%1$s" alt="%2$s" width="%3$d" height="%4$d" class="icon" />',
			plugins_url('shifter-sls-forms/assets/images/shifter-icon.png'),
			esc_attr( __( 'Shifter Logo', 'contact-form-7' ) ),
			36, 36 );
		echo $icon;
	}

	public function link() {
		echo sprintf( '<a href="%1$s">%2$s</a>',
			'https://getshifter.io',
			'getshifter.io' );
	}

	public function get_sitekey() {
		if ( empty( $this->sitekeys ) || ! is_array( $this->sitekeys ) ) {
			return false;
		}

		$sitekeys = array_keys( $this->sitekeys );

		return $sitekeys[0];
	}

	private function menu_page_url( $args = '' ) {
		$args = wp_parse_args( $args, array() );

		$url = menu_page_url( 'wpcf7-integration', false );
		$url = add_query_arg( array( 'service' => 'sls_forms_cf7' ), $url );

		if ( ! empty( $args) ) {
			$url = add_query_arg( $args, $url );
		}

		return $url;
	}

	public function load( $action = '' ) {
		if ( 'setup' == $action ) {
			if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
				check_admin_referer( 'wpcf7-recaptcha-setup' );

				$sitekey = isset( $_POST['sitekey'] ) ? trim( $_POST['sitekey'] ) : '';

				if ( $sitekey ) {
					WPCF7::update_option( 'sls_forms_cf7', array('basin_endpoint' => $sitekey) );
					$redirect_to = $this->menu_page_url( array(
						'message' => 'success' ) );
				} elseif ( '' === $sitekey ) {
					WPCF7::update_option( 'sls_forms_cf7', null );
					$redirect_to = $this->menu_page_url( array(
						'message' => 'success' ) );
				} else {
					$redirect_to = $this->menu_page_url( array(
						'action' => 'setup',
						'message' => 'invalid' ) );
				}

				wp_safe_redirect( $redirect_to );
				exit();
			}
		}
	}

	public function admin_notice( $message = '' ) {
		if ( 'invalid' == $message ) {
			echo sprintf(
				'<div class="error notice notice-error is-dismissible"><p><strong>%1$s</strong>: %2$s</p></div>',
				esc_html( __( "ERROR", 'contact-form-7' ) ),
				esc_html( __( "Invalid key values.", 'contact-form-7' ) ) );
		}

		if ( 'success' == $message ) {
			echo sprintf( '<div class="updated notice notice-success is-dismissible"><p>%s</p></div>',
				esc_html( __( 'Settings saved.', 'contact-form-7' ) ) );
		}
	}

	public function display( $action = '' ) {
?>
<p><?php echo esc_html( __( "Serverless form with Shifter, CF7 and Basin", 'contact-form-7' ) ); ?></p>

<?php
		if ( 'setup' == $action ) {
			$this->display_setup();
			return;
		}

		if ( $this->is_active() ) {
			$sitekey = $this->get_sitekey();
?>
<table class="form-table">
<tbody>
<tr>
	<th scope="row"><?php echo esc_html( __( 'Endpoint', 'contact-form-7' ) ); ?></th>
	<td class="code"><?php echo esc_html( WPCF7::get_option( 'sls_forms_cf7' )['basin_endpoint'] ); ?></td>
</tr>
</tbody>
</table>

<p><a href="<?php echo esc_url( $this->menu_page_url( 'action=setup' ) ); ?>" class="button"><?php echo esc_html( __( "Modify Endpoint", 'contact-form-7' ) ); ?></a></p>

<?php
		} else {
?>
<p><?php echo esc_html( __( "Add your basin endpoint URL to begin using Basin with CF7.", 'contact-form-7' ) ); ?></p>

<p><a href="<?php echo esc_url( $this->menu_page_url( 'action=setup' ) ); ?>" class="button"><?php echo esc_html( __( "Configure Endpoint", 'contact-form-7' ) ); ?></a></p>

<p><?php echo sprintf( esc_html( __( "For more details, see %s.", 'contact-form-7' ) ), wpcf7_link( __( 'https://usebasin.com/', 'contact-form-7' ), __( 'Basin', 'contact-form-7' ) ) ); ?></p>
<?php
		}
	}

	public function display_setup() {
?>
<form method="post" action="<?php echo esc_url( $this->menu_page_url( 'action=setup' ) ); ?>">
<?php wp_nonce_field( 'wpcf7-recaptcha-setup' ); ?>
<table class="form-table">
<tbody>
<tr>
	<th scope="row"><label for="sitekey"><?php echo esc_html( __( 'Endpoint', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" aria-required="true" value="" id="sitekey" name="sitekey" class="regular-text code" /></td>
</tr>
</tbody>
</table>

<p class="submit"><input type="submit" class="button button-primary" value="<?php echo esc_attr( __( 'Save', 'contact-form-7' ) ); ?>" name="submit" /></p>
</form>
<?php
	}
}

add_action( 'wpcf7_init', 'wpcf7_recaptcha_register_service_jawn' );

function wpcf7_recaptcha_register_service_jawn() {
	$integration = WPCF7_Integration::get_instance();

	$categories = array(
		'sls_forms_cf7_basin' => __( 'FORMS', 'contact-form-7' ) );

	foreach ( $categories as $name => $category ) {
		$integration->add_category( $name, $category );
	}

	$services = array(
		'sls_forms_cf7' => SLS_FORMS_CF7_BASIN::get_instance() );

	foreach ( $services as $name => $service ) {
		$integration->add_service( $name, $service );
	}
}


/**
* SLS Forms — CF7 to Basin Endpoint
*/

function sls_forms_basin_endpoint() {

  if (WPCF7::get_option( 'sls_forms_cf7' )) {
    add_filter('wpcf7_form_action_url', 'wpcf7_custom_form_action_url');
  }

  function wpcf7_custom_form_action_url() {
    $endpoint = WPCF7::get_option( 'sls_forms_cf7' );
    $endpoint = $endpoint['basin_endpoint'];
    return $endpoint;
  }
}

sls_forms_basin_endpoint();
