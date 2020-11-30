<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lhtbp
 */

if ( ! defined( 'lhtbp_SLUG' ) ) {
	define( 'LHTBP_SLUG', '<%= pkg.slug %>' );
}

if ( ! defined( 'lhtbp_VERSION' ) ) {
	define( 'LHTBP_VERSION', '<%= pkg.version %>' );
}

require get_template_directory() . '/vendor/autoload.php';

// Load the `wp_lhtbp()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Initialize the theme.
call_user_func( 'WpMunich\lhtbp\wp_lhtbp' );
