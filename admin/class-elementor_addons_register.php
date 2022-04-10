<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sohilchamadia8.wordpress.com/
 * @since      1.0.0
 *
 * @package    Elementor_addons_Register
 * @subpackage Elementor_addons_Register/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elementor_addons_Register
 * @subpackage Elementor_addons_Register/admin
 * @author    Sohil Chamadia <sohilchamadia8@gmail.com>
 */
namespace Elementor_addons_Register;
    
 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }
     
    /**
     * Elementor_addons_Register class.
     *
     * The main class that initiates and runs the addon.
     *
     * @since 1.0.0
     */
    final class Elementor_addons_Register {
     
        /**
         * Addon Version
         *
         * @since 1.0.0
         * @var string The addon version.
         */
        const VERSION = '1.0.0';
     
        /**
         * Instance
         *
         * @since 1.0.0
         * @access private
         * @static
         * @var \Elementor_Addon\Elementor_addons_Register The single instance of the class.
         */
        private static $_instance = null;
     
        /**
         * Instance
         *
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @since 1.0.0
         * @access public
         * @static
         * @return \Elementor_Addon\Elementor_addons_Register An instance of the class.
         */
        public static function instance() {
     
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
     
        }
     
        /**
         * Constructor
         *
         * Perform some compatibility checks to make sure basic requirements are meet.
         * If all compatibility checks pass, initialize the functionality.
         *
         * @since 1.0.0
         * @access public
         */
        public function __construct() {
     
            if ( $this->is_compatible() ) {
                add_action( 'elementor/init', [ $this, 'init' ] );
            }
     
        }
     
        /**
         * Compatibility Checks
         *
         * Checks whether the site meets the addon requirement.
         *
         * @since 1.0.0
         * @access public
         */
        public function is_compatible() {
     
            // Check if Elementor installed and activated
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
                return false;
            }

            return true;
     
        }
     
        /**
         * Admin notice
         *
         * Warning when the site doesn't have Elementor installed or activated.
         *
         * @since 1.0.0
         * @access public
         */
        public function admin_notice_missing_main_plugin() {
     
            if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
     
            $message = sprintf(
                /* translators: 1: Plugin name 2: Elementor */
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'get-post-data-elementor-addon' ),
                '<strong>' . esc_html__( 'Get Post Elementor Addon', 'get-post-data-elementor-addon' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'get-post-data-elementor-addon' ) . '</strong>'
            );
     
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
     
        }
     
       
        /**
         * Initialize
         *
         * Load the addons functionality only after Elementor is initialized.
         *
         * Fired by `elementor/init` action hook.
         *
         * @since 1.0.0
         * @access public
         */
        public function init() {
     
            add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
            add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
        }
     
        /**
         * Register Widgets
         *
         * Load widgets files and register new Elementor widgets.
         *
         * Fired by `elementor/widgets/register` action hook.
         *
         * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
         */
        public function register_widgets( $widgets_manager ) {
     
            require_once( __DIR__ . '/class-get_post_data_widgets.php' );
     
            $widgets_manager->register( new \Get_Post_Data_Widgets() );
     
        }
     
        /**
         * Register Controls
         *
         * Load controls files and register new Elementor controls.
         *
         * Fired by `elementor/controls/register` action hook.
         *
         * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
         */
        public function register_controls( $controls_manager ) {
        }
    }