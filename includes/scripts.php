<?php
/**
 * Scripts
 *
 * @package     ToggleAdminMenu\Scripts
 * @since       1.0.0
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


/**
 * Load admin scripts
 *
 * @since       1.0.0
 * @return      void
 */
function toggleadminmenu_scripts() {
    $visible = ( get_user_option( 'toggle_admin_menu' ) ? 'false' : 'true' );

    wp_enqueue_style( 'toggleadminmenu', TOGGLEADMINMENU_URL . 'assets/css/admin.css' );
    wp_enqueue_script( 'toggleadminmenu', TOGGLEADMINMENU_URL . 'assets/js/admin.js', array( 'jquery' ) );
    wp_localize_script( 'toggleadminmenu', 'toggleadminmenu_vars', array(
        'visible' => $visible
    ) );
}
add_action( 'admin_enqueue_scripts', 'toggleadminmenu_scripts' );
