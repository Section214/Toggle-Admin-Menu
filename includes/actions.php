<?php
/**
 * Actions
 *
 * @package     ToggleAdminMenu\Actions
 * @since       1.0.0
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


/**
 * Process all actions sent via POST and GET by looking for the 'tam-action'
 * request and running do_action() to call the function
 *
 * @since       1.0.0
 * @return      void
 */
function toggleadminmenu_process_actions() {
    if( isset( $_POST['tam-action'] ) ) {
        do_action( 'toggleadminmenu_' . $_POST['tam-action'], $_POST );
    }

    if( isset( $_GET['tam-action'] ) ) {
        do_action( 'toggleadminmenu_' . $_GET['tam-action'], $_GET );
    }
}
add_action( 'admin_init', 'toggleadminmenu_process_actions' );


/**
 * Update the user options
 *
 * @since       1.0.0
 * @return      void
 */
function toggleadminmenu_update() {
    $status = get_user_option( 'toggle_admin_menu' );
    
    if( ! $status ) {
        update_user_option( get_current_user_id(), 'toggle_admin_menu', 'true' );
    } else {
        delete_user_option( get_current_user_id(), 'toggle_admin_menu' );
    }
}
add_action( 'toggleadminmenu_update', 'toggleadminmenu_update' );
