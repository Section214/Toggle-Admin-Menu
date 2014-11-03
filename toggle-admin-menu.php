<?php
/**
 * Plugin Name:     Toggle Admin Menu
 * Plugin URI:      http://section214.com
 * Description:     Hide or show the dashboard admin menu with a click!
 * Version:         1.0.0
 * Author:          Daniel J Griffiths
 * Author URI:      http://ghost1227.com
 * Text Domain:     toggle-admin-menu
 *
 * @package         ToggleAdminMenu
 * @author          Daniel J Griffiths <dgriffiths@section214.com>
 * @copyright       Copyright (c) 2014, Daniel J Griffiths
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


if( ! class_exists( 'ToggleAdminMenu' ) ) {


    /**
     * Main ToggleAdminMenu class
     *
     * @since       1.0.0
     */
    class ToggleAdminMenu {

        /**
         * @var         ToggleAdminMenu $instance The one true ToggleAdminMenu
         * @since       1.0.0
         */
        private static $instance;


        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      self::$instance The one true ToggleAdminMenu
         */
        public static function instance() {
            if( ! self::$instance ) {
                self::$instance = new ToggleAdminMenu();
                self::$instance->setup_constants();
                self::$instance->includes();
                self::$instance->load_textdomain();
                self::$instance->hooks();
            }

            return self::$instance;
        }


        /**
         * Setup plugin constants
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function setup_constants() {
            // Plugin path
            define( 'TOGGLEADMINMENU_DIR', plugin_dir_path( __FILE__ ) );

            // Plugin URL
            define( 'TOGGLEADMINMENU_URL', plugin_dir_url( __FILE__ ) );
        }


        /**
         * Include required files
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function includes() {
            if( is_admin() ) {
                require_once TOGGLEADMINMENU_DIR . 'includes/scripts.php';
                require_once TOGGLEADMINMENU_DIR . 'includes/actions.php';
            }
        }


        /**
         * Run action and filter hooks
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function hooks() {
            // Add our new link to the Admin Bar
            add_action( 'admin_bar_menu', array( $this, 'admin_bar' ), 999 );
        }


        /**
         * Internationalization
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function load_textdomain() {
            // Set filter for language directory
            $lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
            $lang_dir = apply_filters( 'toggleadminmenu_language_directory', $lang_dir );

            // Traditional WordPress plugin locale filter
            $locale = apply_filters( 'plugin_locale', get_locale(), '' );
            $mofile = sprintf( '%1$s-%2$s.mo', 'toggle-admin-menu', $locale );

            // Setup paths to current locale file
            $mofile_local   = $lang_dir . $mofile;
            $mofile_global  = WP_LANG_DIR . '/toggle-admin-menu/' . $mofile;

            if( file_exists( $mofile_global ) ) {
                // Look in global /wp-content/languages/toggle-admin-menu/ folder
                load_textdomain( 'toggle-admin-menu', $mofile_global );
            } elseif( file_exists( $mofile_local ) ) {
                // Look in local /wp-content/plugins/toggle-admin-menu/languages/ folder
                load_textdomain( 'toggle-admin-menu', $mofile_local );
            } else {
                // Load the default language files
                load_plugin_textdomain( 'toggle-admin-menu', false, $lang_dir );
            }
        }


        /**
         * Add our new link to the Admin Bar
         *
         * @access      public
         * @since       1.0.0
         * @param       object $wp_admin_bar The Admin Bar object
         * @return      void
         */
        public function admin_bar( $wp_admin_bar ) {
            $wp_admin_bar->add_node( array(
                'id'        => 'toggle-admin-menu',
                'title'     => '<a href="' . add_query_arg( array( 'tam-action' => 'update' ) ) . '"><i class="dashicons dashicons-welcome-view-site"></i></a>',
                'meta'      => array(
                    'class'     => 'toggle-admin-menu',
                    'title'     => __( 'Toggle Admin Menu', 'toggle-admin-menu' )
                )
            ) );
        }
    }
}


/**
 * The main function responsible for returning the one true ToggleAdminMenu
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      ToggleAdminMenu The one true ToggleAdminMenu
 */
function toggleadminmenu() {
    return ToggleAdminMenu::instance();
}
add_action( 'plugins_loaded', 'toggleadminmenu' );
