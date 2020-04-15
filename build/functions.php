<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _lhtbp
 */

if ( ! defined( '_LHTBP_SLUG' ) ) {
	define( '_LHTBP_SLUG', '<%= pkg.slug %>' );
}

if ( ! defined( '_LHTBP_VERSION' ) ) {
	define( '_LHTBP_VERSION', '<%= pkg.version %>' );
}

require get_template_directory() . '/vendor/autoload.php';

// Load the `wp__lhtbp()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Initialize the theme.
call_user_func( 'WpMunich\_lhtbp\wp__lhtbp' );
