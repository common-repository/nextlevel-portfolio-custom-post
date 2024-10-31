<?php
/**
 *
 * Plugin Name:       Nextlevel Portfolio Custom Post
 * Plugin URI:        http://themenextlevel.com/portfolio/
 * Description:       This plugin registers portfolio custom post type
 * Version:           1.0.2
 * Author:            Kudrat E Khuda
 * Author URI:        http://themenextlevel.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nextlevel-portfolio-custom-post
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

/**
 * Set up and initialize
 */
class NPCP_Custom_Post {

	private static $_instance;

	/**
	 * Actions setup
	 */
	public function __construct() {

		$this->init_hooks();
	}
	
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'constants' ), 2 );
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 3 );
		add_action( 'plugins_loaded', array( $this, 'includes' ), 4 );
		
	}

	/**
	 * Constants
	 */
	function constants() {

		define( 'NPCP_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'NPCP_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}

	/**
	 * Includes
	 */
	function includes() {

		//Post types
		
		require_once( NPCP_DIR . 'inc/portfolio.php' );
		
	
	}

	/**
	 * Translations
	 */
	function i18n() {
		load_plugin_textdomain( 'nextlevel-portfolio-custom-post', false, 'nextlevel-portfolio-custom-post/languages' );
	}

	
	
	
	/**
	 * Returns the instance.
	 */

	
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

function npcp_custom_post_plugin() {
	
		return NPCP_Custom_Post::get_instance();
}
add_action('plugins_loaded', 'npcp_custom_post_plugin', 1);