<?php
/**
 * @package Unchained_Carrot
 * @version 1.0.0
 */

/**
 * 
 * Plugin Name: Unchained Carrot
 * Description: The plugin establishes an API connection with the service Unchained Carrot and helps in the integration of user surveys on the site
 * Author:      Dmitriy Kovalev
 * Version:     1.0.0
 * Plugin URI:  https://wordpress.org
 * Author URI:  https://www.upwork.com/fl/dmitriykovalev9
 * 
 */

    /**
     * Wordpress hooks, to which the functions of the plugin are attached, for proper operation
     */
    add_action( 'admin_menu', 'un_car_admin_menu' );

    /**
     * @return void
     * Forming Plugin Pages
     */
    function un_car_admin_menu() {
        add_menu_page( 'Unchained Carrot', 'Unchained Carrot', 'manage_options', 'un-car-options', 'un_car_options', plugin_dir_url( __FILE__ ) . 'img/ico.png' );

        // add_submenu_page( 'mkm-api-options', 'MKM API DATA ACCOUNTS', 'API Accounts', 'manage_options', 'mkm-api-subpage-accounts', 'mkm_api_orders_accounts' );
        // add_submenu_page( 'mkm-api-options', 'MKM API DATA', 'API Orders', 'manage_options', 'mkm-api-subpage', 'mkm_api_orders' );
        // add_submenu_page( 'mkm-api-options', 'MKM API DATA ARTICLES', 'API Articles', 'manage_options', 'mkm-api-subpage-articles', 'mkm_api_orders_articles' );
    }