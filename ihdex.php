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

    require_once plugin_dir_path( __FILE__ ) . 'inc/helpers.php';

    /**
     * Wordpress hooks, to which the functions of the plugin are attached, for proper operation
     */
    add_action( 'admin_menu', 'un_car_admin_menu' );
    add_action( 'admin_init', 'un_car_admin_settings' );
    add_action( 'wp_ajax_mkm_api_ajax_more_articles', 'mkm_api_ajax_more_articles' );
    add_action( 'admin_enqueue_scripts', 'un_car_enqueue_admin' );

    /**
     * @return void
     * Connecting CSS and JS files (custom and WP)
     */
    function un_car_enqueue_admin() {
        wp_enqueue_script( 'un-car-admin', plugins_url( 'js/admin_scripts.js', __FILE__ ) );
        wp_enqueue_style( 'un-car-admin', plugins_url( 'css/admin_style.css', __FILE__ ) );
    }

    /**
     * @return void
     * Forming Plugin Pages
     */
    function un_car_admin_menu() {
        add_menu_page( 'Unchained Carrot', 'Unchained Carrot', 'manage_options', 'un-car-options', 'un_car_options', plugin_dir_url( __FILE__ ) . 'img/ico.png' );

        //add_submenu_page( 'mkm-api-options', 'MKM API DATA ACCOUNTS', 'API Accounts', 'manage_options', 'mkm-api-subpage-accounts', 'mkm_api_orders_accounts' );
        // add_submenu_page( 'mkm-api-options', 'MKM API DATA', 'API Orders', 'manage_options', 'mkm-api-subpage', 'mkm_api_orders' );
        // add_submenu_page( 'mkm-api-options', 'MKM API DATA ARTICLES', 'API Articles', 'manage_options', 'mkm-api-subpage-articles', 'mkm_api_orders_articles' );
    }

    /**
     * @return void
     * Formation of the main option for applications
     */
    function un_car_admin_settings() {

        register_setting( 'un_car_group_options', 'un_car_options', 'un_car_sanitize' );

    }

    /**
     * @param array
     * @return array
     * Checking and saving options when creating an application
     */
    function un_car_sanitize( $option ) {
        if ( $option['un_car_api_kay'] == '' || $option['un_car_segment_kay'] == '' ) {
            add_settings_error( 'un_car_options', 'un_car_options', __( 'Not all fields are filled in', 'un-car-plugin' ), 'error' );
            return false;
        }

        add_settings_error( 'un_car_options', 'un_car_options', __( 'The settings are saved', 'un-car-plugin' ), 'updated' );
        return $option;
    }

    /**
     * @return void
     * Data output to plugin settings page
     */
    function un_car_options() {
        $options = get_option( 'un_car_options' );
        $val_key = isset( $options['un_car_api_kay'] ) ? $options['un_car_api_kay'] : '';
        $val_seg = isset( $options['un_car_segment_kay'] ) ? $options['un_car_segment_kay'] : '';
        ?>
            <div class="wrap">
                <h2><?php _e( 'Settings', 'un-car-plugin' ); ?></h2>
                <?php settings_errors( 'un_car_options' ); ?>
                <form action="options.php" method="post">
                    <?php settings_fields( 'un_car_group_options' ); ?>
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row">
                                <label for="un_car_api_kay"><?php _e( 'API key', 'un-car-plugin' ); ?></label>
                            </th>
                            <td>
                                <input
                                    name="un_car_options[un_car_api_kay]"
                                    type="password"
                                    id="un_car_api_kay"
                                    value="<?php echo $val_key; ?>"
                                    class="regular-text un-car-text-pass"
                                    required
                                />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="un_car_segment_kay"><?php _e( 'Segment Write Key', 'un-car-plugin' ); ?></label>
                            </th>
                            <td>
                                <input
                                    name="un_car_options[un_car_segment_kay]"
                                    type="password"
                                    id="un_car_segment_kay"
                                    value="<?php echo $val_seg; ?>"
                                    class="regular-text un-car-text-pass"
                                    required
                                />
                            </td>
                        </tr>
                    </table>
                    <?php submit_button( __( 'Save', 'un-car-plugin' ) ); ?>
                </form>
            </div>
        <?php
    }