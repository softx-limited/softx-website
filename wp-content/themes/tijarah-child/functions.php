<?php
/**
 * Tijarah Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tijarah Child
 * @since 1.0.0
 */

add_action( 'wp_enqueue_scripts', 'tijarah_enqueue_styles' );
function tijarah_enqueue_styles() {
    wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css',array('tijarah-plugin') ); 
								   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css',array('tijarah-plugin') ); 
}