<?php
/*
Plugin Name:  Poper
Plugin URI:   http://wpbucket.net/plugins/poper
Description:  
Version:      1.0.0
Author:       WPBucket
Author URI:   http://wpbucket.net
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  poper
Domain Path:  /languages
*/


// Block Direct access
if( !defined( 'ABSPATH' ) ){ die( 'You should not access this file directly!.' ); }

// Define Constants for direct access alert message.
if( !defined( 'POPER_ALERT_MSG' ) )
	define( 'POPER_ALERT_MSG', esc_html__( 'You should not access this file directly.!', 'poper' ) );

// Define constants for plugin directory path.
if( !defined( 'POPER_DIR_PATH' ) )
	define( 'POPER_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Define constants for plugin dirname.
if( !defined( 'POPER_DIR_NAME' ) )
	define( 'POPER_DIR_NAME', dirname( __FILE__ ) );

// Define constants for plugin directory path.
if( !defined( 'POPER_DIR_URL' ) )
	define( 'POPER_DIR_URL', plugin_dir_url( __FILE__ ) );

// Define constants for plugin basenam.
if( !defined( 'POPER_BASENAME' ) )
	define( 'POPER_BASENAME', plugin_basename( __FILE__ ) );


final class Poper {

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
		
		//if( Poper\Inc\License::licenseActive() ){
		//
		add_filter( 'plugin_action_links', [ $this, 'add_plugin_link' ], 10, 2 );
		add_filter( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		//}

	}

	private function includeFiles() {

		// Script enqueue class include
		//require_once POPER_DIR_PATH . 'inc/class-enqueue.php';
		
		// Admin file include 
		//require_once POPER_DIR_PATH . 'inc/License.php';
		//require_once POPER_DIR_PATH . 'admin/admin-functions.php';
		//require_once POPER_DIR_PATH . 'admin/admin.php';


		//if( Poper\Inc\License::licenseActive() ){
		

		//}
		
		require_once POPER_DIR_PATH . 'inc/Helper.php';
		require_once POPER_DIR_PATH . 'classes/Post_Type_Base.php';
		require_once POPER_DIR_PATH . 'classes/Meta_Base.php';
		require_once POPER_DIR_PATH . 'classes/Poper_Base.php';

	}
	public function enqueue_scripts() {
		wp_enqueue_style( 'poper-main', POPER_DIR_URL.'assets/css/main.css' );
	}

	// Plugin page settings link add
	public function add_plugin_link( $plugin_actions, $plugin_file ) {

	    $plugin_actions['poper_settings'] = sprintf( esc_html__( '%sSettings%s', 'poper' ), '<a href="'.esc_url( admin_url( 'admin.php?page=reviewbucket-setting-admin' ) ).'">', '</a>' );
	    return $plugin_actions;
	}


}

Poper::getInstance();
