<?php
/**
 * Plugin Name: Popup generator
 * Plugin URI: http://www.pixels-addict.fr
 * Description: A little plugin made with love to generate popup with HTML code.
 * Version: 0.1
 * Author: Yacine BOUMAZA
 * Author URI: http://www.pixels-addict.fr
 */
define( 'ME_URL', plugin_dir_url ( __FILE__ ) );
define( 'ME_JS_DIR', plugin_dir_url ( __FILE__ ) . 'js/' );
define( 'ME_CSS_DIR', plugin_dir_url ( __FILE__ ) . 'css/' );
define( 'ME_DIR', plugin_dir_path( __FILE__ ) );
define( 'ME_VERSION', '0.1' );
define( 'ME_OPTION', 'me_ext' );

// Register and enqueue popup's javascript

function popup_generator(){
        if (!is_admin()) {
                wp_register_script('popup', ME_JS_DIR . 'jquery.popup.js');
                wp_enqueue_script('popup');
        }
}

// Deregister WordPress jQuery and load jQuery directly from Google libraries 

function google_jquery() {
        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_register_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1/
jquery.min.js', false, '');
            wp_enqueue_script('jquery');
            wp_deregister_script('jquery-ui');
            wp_register_script('jquery-ui','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/
jquery-ui.min.js', false, '');
            wp_enqueue_script('jquery-ui');
        }
}

add_action('init', 'google_jquery');

// Register and enqueue the popup's stylesheet 

function add_stylesheets() {
    wp_register_style( 'popup_style',
    ME_CSS_DIR . 'popup-style.css',
    array(),
    ME_VERSION,
    'all' );
    wp_enqueue_style( 'popup_style' );
}

add_action('wp_enqueue_scripts', 'add_stylesheets');

add_action('init','popup_generator');
