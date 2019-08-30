<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _lhtbp
 */

if ( ! defined( 'THEME_SLUG' ) ) {
	define( 'THEME_SLUG', '<%= pkg.slug %>' );
}

if ( ! defined( 'THEME_VERSION' ) ) {
	define( 'THEME_VERSION', '<%= pkg.version %>' );
}

/**
 * Custom autoloader function for theme classes.
 * Autoloader and architecture below heavily inspired by WP Rig.
 * Thank you guys for your awesome work!
 *
 * Changes were made to fit the boilerplates needs (e.g. change namespaces and function names).
 *
 * @access private
 * @see https://github.com/wprig/wprig
 * @param string $class_name Class name to load.
 * @return bool True if the class was loaded, false otherwise.
 */
function _lhtbp_autoload( $class_name ) {
	$namespace = '_lhtbp';

	if ( strpos( $class_name, $namespace . '\\' ) !== 0 ) {
		return false;
	}

	$parts = explode( '\\', substr( $class_name, strlen( $namespace . '\\' ) ) );
	$path  = get_template_directory() . '/inc';

	foreach ( $parts as $part ) {
		$path .= '/' . $part;
	}

	$path .= '.php';

	if ( ! file_exists( $path ) ) {
		return false;

	}

	require_once $path;

	return true;
}
spl_autoload_register( '_lhtbp_autoload' );

// Load the `wp__lhtbp()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Initialize the theme.
call_user_func( '_lhtbp\wp__lhtbp' );
