<?php
/*
Plugin Name:  Popx
Plugin URI:   https://wpmobo.com/popx
Description:  
Version:      1.0.0
Author:       WPMobo
Author URI:   https://wpmobo.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  popx
Domain Path:  /languages
*/


// Block Direct access
if( !defined( 'ABSPATH' ) ){ die( 'You should not access this file directly!.' ); }

// Define Constants for direct access alert message.
if( !defined( 'POPX_ALERT_MSG' ) )
	define( 'POPX_ALERT_MSG', esc_html__( 'You should not access this file directly.!', 'popx' ) );

// Define constants for plugin directory path.
if( !defined( 'POPX_DIR_PATH' ) )
	define( 'POPX_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Define constants for plugin dirname.
if( !defined( 'POPX_DIR_NAME' ) )
	define( 'POPX_DIR_NAME', dirname( __FILE__ ) );

// Define constants for plugin directory path.
if( !defined( 'POPX_DIR_URL' ) )
	define( 'POPX_DIR_URL', plugin_dir_url( __FILE__ ) );

// Define constants for plugin basenam.
if( !defined( 'POPX_BASENAME' ) )
	define( 'POPX_BASENAME', plugin_basename( __FILE__ ) );


final class Popx {

	private static $instance = null;

	private function __construct() {
		$this->includeFiles();
		$this->init();
	}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init() {
		
		//
		add_filter( 'plugin_action_links', [ $this, 'add_plugin_link' ], 10, 2 );
		add_filter( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_ajax_render_popx_popup', [__CLASS__, 'render_popx_popup' ] );
        add_action( 'wp_ajax_nopriv_render_popx_popup', [ __CLASS__, 'render_popx_popup' ] );

	}

	public static function render_popx_popup() {

        \Popx\Popx_Base::modal_html_one();

        wp_die();
    }

	private function includeFiles() {		
		require_once POPX_DIR_PATH . 'inc/Helper.php';
		require_once POPX_DIR_PATH . 'inc/WP_Hooks.php';
		require_once POPX_DIR_PATH . 'classes/Post_Type_Base.php';
		require_once POPX_DIR_PATH . 'classes/Meta_Base.php';
		require_once POPX_DIR_PATH . 'classes/Popx_Base.php';
	}
	public function enqueue_scripts() {
		wp_enqueue_style( 'popx-main', POPX_DIR_URL.'assets/css/main.css' );
		wp_enqueue_script( 'popx-main', POPX_DIR_URL.'assets/js/main.js', ['jquery'], '1.0.0', true );

		wp_localize_script(
			'popx-main', 
			'popxScript',
			[

				'ajaxUrl' => admin_url( 'admin-ajax.php' )
			]

		);


	}

	// Plugin page settings link add
	public function add_plugin_link( $plugin_actions, $plugin_file ) {

	    $plugin_actions['popx_settings'] = sprintf( esc_html__( '%sSettings%s', 'popx' ), '<a href="'.esc_url( admin_url( 'admin.php?page=reviewbucket-setting-admin' ) ).'">', '</a>' );
	    return $plugin_actions;
	}


}

Popx::getInstance();
