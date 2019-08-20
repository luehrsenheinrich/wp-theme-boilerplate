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
 * Load required files for this theme.
 */
function _lhtbp_load_required_files() {
	require_once 'inc/classNames.php';
}
add_action( 'init', '_lhtbp_load_required_files' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _lhtbp_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( '_lhtbp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header', '_lhtbp' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'_lhtbp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Enable support for post thumbnails and featured images.
	add_theme_support( 'post-thumbnails' );

	// Add support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for wide-aligned images.
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', '_lhtbp_theme_setup' );

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
