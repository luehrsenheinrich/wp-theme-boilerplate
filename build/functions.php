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

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _lhtbp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = 640;
}
add_action( 'after_setup_theme', '_lhtbp_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function _lhtbp_scripts() {
	wp_enqueue_style( '_lhtbp-style--base', get_template_directory_uri() . '/css/base.min.css', array(), THEME_VERSION, 'all' );
	wp_enqueue_style( '_lhtbp-style--blocks', get_template_directory_uri() . '/css/blocks.min.css', array(), THEME_VERSION, 'all' );

	wp_enqueue_script( '_lhtbp-script', get_template_directory_uri() . '/script.min.js', array( 'jquery' ), THEME_VERSION, true );

	$translation_array = array(
		'themeUrl' => get_template_directory_uri(),
		'restUrl'  => get_rest_url(),
	);
	wp_localize_script( '_lhtbp-script', '_lhtbp', $translation_array );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_lhtbp_scripts' );
