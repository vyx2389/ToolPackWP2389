<?php
/*
Plugin Name: ToolsWP 2389 PRO
Plugin URI: 
Description: ToolPack para crear plugins integrada por 2389.tech WP Dev
Version: 11.03
Author:
Author URI:
License:
*/

//INCLUIR ACF ACFE

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path(__FILE__) . '/includes/acf/' );
define( 'MY_ACF_URL', plugin_dir_url(__FILE__) . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true;
}
define('MY_ACFE_PATH', plugin_dir_path(__FILE__) . 'includes/acf-extended-pro/');
define('MY_ACFE_URL', plugin_dir_url(__FILE__) . 'includes/acf-extended-pro/');

include_once(MY_ACFE_PATH . 'acf-extended.php');

add_filter('acf/settings/acfe/url', 'my_acfe_settings_url');
function my_acfe_settings_url($url){
    
    return MY_ACFE_URL;
    
}

//FIN INCLUIR ACF ACFE

//DESACTIVAR ACTIALIZACIONES
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', '__return_null');

remove_action('load-update-core.php', 'wp_update_themes');
add_filter('pre_site_transient_update_themes', create_function('$a', "return null;"));

add_action('after_setup_theme', 'remove_core_updates');

function remove_core_updates() {
	if (!current_user_can('update_core')) {
		return;
	}
	add_action('init', create_function('$a', "remove_action( 'init', 'wp_version_check' );"), 2);
	add_filter('pre_option_update_core', '__return_null');
	add_filter('pre_site_transient_update_core', '__return_null');
}

//DESACTIVAR ACTIALIZACIONES

//CPT K0
include_once 'includes/cpts.php';