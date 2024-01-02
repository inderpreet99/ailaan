<?php
/*
Plugin Name: Ailaan
Plugin URI: https://wordpress.org/plugins/ailaan/
Description: Save announcements in the Options to allow REST API retrieval.
Version: 0.1
Author: Inderpreet Singh
Author URI: https://inderpreetsingh.com
*/

define( 'AILAAN_VERSION', '0.1' );

$GLOBALS['ailaan'] = new Ailaan();

add_action( 'admin_init', array( $GLOBALS['ailaan'], 'register_settings' ) );
add_action( 'admin_menu', array( $GLOBALS['ailaan'], 'setup_menu' ) );
add_action( 'admin_enqueue_scripts', array( $GLOBALS['ailaan'], 'admin_enqueue_scripts' ) );
add_action( 'rest_api_init', array( $GLOBALS['ailaan'], 'setup_rest_api' ) );

class Ailaan {
    public array $rest_options = array( 'siteurl' );
	public string $datetime;

	function __construct() {
		$this->datetime = date(DATE_ATOM);
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
	}

	function plugin_activation() {

		if( ! get_role( 'sevadar' ) ) {
			add_role( 'sevadar', 'Sevadar', array(
				'read'		 => true,  // true allows this capability
			) );
		}

		$supported_roles = array( 'administrator', 'author', 'editor', 'sevadar' );
		foreach( $supported_roles as $role_name ) {
			$role = get_role( $role_name );
			$role->add_cap( 'ailaan' );
		}
	}

	function setup_menu() {
		add_menu_page( 'Ailaan', 'Ailaan', 'ailaan', 'ailaan', array( $this, 'settings_page' ) );
	}

	static function admin_enqueue_scripts() {
		global $hook_suffix;

		if ( in_array( $hook_suffix, array(
			'toplevel_page_ailaan',
		) ) ) {
			wp_register_style( 'ailaan-settings.css', plugins_url( 'css/settings.css', __FILE__ ), array(), AILAAN_VERSION );
			wp_enqueue_style( 'ailaan-settings.css');
		}
	}

	function register_settings() {
		global $hook_suffix;
		register_setting( 'ailaan-settings', 'ailaan_message', [
			'sanitize_callback' => [$this, 'save_ailaan'],
			'show_in_rest' => true,  // only works with administrator cap, so useless
		] );
		add_filter('option_page_capability_ailaan-settings', function() { return "ailaan"; });
		add_filter('option_page_capability_ailaan', function() { return "ailaan"; });
	}

	function save_ailaan( $input ) {
		$new_message = $input;
		$old_message = get_option('ailaan_message');

		if ( $new_message && $new_message != $old_message ) {
			update_option( 'ailaan_update', current_time( 'timestamp' ) );
			update_option( 'ailaan_user', get_current_user_id() );
		}

		return $input;
	}

	public function settings_page() {
		include_once dirname(__FILE__) . '/interface/settings-page.php';
	}

    public function setup_rest_api() {
        register_rest_route( 'ailaan/v1', '/get/', array(
            'methods'  => 'GET',
            'callback' => array( $GLOBALS['ailaan'], 'rest_get' ),
        ) );
    }

    public function rest_get( $data ) {
		$message = get_option( 'ailaan_message' );
		if ( $message ) {
			return array(
				'message' => $message,
				'updated_at' => get_option( 'ailaan_update' ),
				'user_id' => get_option( 'ailaan_user' ),
			);
		} else {
			return array();
		}
    }
}
