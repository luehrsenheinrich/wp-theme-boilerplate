<?php
/**
 * WP_Rig\WP_Rig\Editor\Component class
 *
 * @package lhtbp
 */

namespace WpMunich\lhtbp\Editor;

use WpMunich\lhtbp\Component_Interface;
use function add_action;
use function add_theme_support;

/**
 * Class for integrating with the block editor.
 *
 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'editor';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_editor_support' ) );
	}

	/**
	 * Adds support for various editor features.
	 */
	public function action_add_editor_support() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for wide-aligned images.
		add_theme_support( 'align-wide' );

		/**
		 * Add support for color palettes.
		 *
		 * To preserve color behavior across themes, use these naming conventions:
		 * - Use primary and secondary color for main variations.
		 * - Use `theme-[color-name]` naming standard for standard colors (red, blue, etc).
		 * - Use `custom-[color-name]` for non-standard colors.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-colors' );
		 */
		add_theme_support(
			'editor-color-palette',
			array(
				// Primary.
				array(
					'name'  => __( 'Primary 300', 'lhtbp' ),
					'slug'  => 'primary-300',
					'color' => '#d05ce3',
				),
				array(
					'name'  => __( 'Primary 500', 'lhtbp' ),
					'slug'  => 'primary-500',
					'color' => '#9c27b0',
				),
				array(
					'name'  => __( 'Primary 700', 'lhtbp' ),
					'slug'  => 'primary-700',
					'color' => '#6a0080',
				),
				// Secondary.
				array(
					'name'  => __( 'Secondary 300', 'lhtbp' ),
					'slug'  => 'secondary-300',
					'color' => '#ff8a50',
				),
				array(
					'name'  => __( 'Secondary 500', 'lhtbp' ),
					'slug'  => 'secondary-500',
					'color' => '#ff5722',
				),
				array(
					'name'  => __( 'Secondary 700', 'lhtbp' ),
					'slug'  => 'secondary-700',
					'color' => '#c41c00',
				),
				// Tertiary.
				array(
					'name'  => __( 'Tertiary 300', 'lhtbp' ),
					'slug'  => 'tertiary-300',
					'color' => '#80e27e',
				),
				array(
					'name'  => __( 'Tertiary 500', 'lhtbp' ),
					'slug'  => 'tertiary-500',
					'color' => '#4caf50',
				),
				array(
					'name'  => __( 'Tertiary 700', 'lhtbp' ),
					'slug'  => 'tertiary-700',
					'color' => '#087f23',
				),
				// Grayscale.
				array(
					'name'  => __( 'White', 'lhtbp' ),
					'slug'  => 'white',
					'color' => '#ffffff',
				),
				array(
					'name'  => __( 'Gray 100', 'lhtbp' ),
					'slug'  => 'gray-100',
					'color' => '#f5f5f5',
				),
				array(
					'name'  => __( 'Gray 300', 'lhtbp' ),
					'slug'  => 'gray-300',
					'color' => '#e5e5e5',
				),
				array(
					'name'  => __( 'Gray 500', 'lhtbp' ),
					'slug'  => 'gray-500',
					'color' => '#9e9e9e',
				),
				array(
					'name'  => __( 'Gray 700', 'lhtbp' ),
					'slug'  => 'gray-700',
					'color' => '#616161',
				),
				array(
					'name'  => __( 'Gray 900', 'lhtbp' ),
					'slug'  => 'gray-900',
					'color' => '#212121',
				),
				array(
					'name'  => __( 'Black', 'lhtbp' ),
					'slug'  => 'black',
					'color' => '#000000',
				),
				// System.
				array(
					'name'  => __( 'System Success', 'lhtbp' ),
					'slug'  => 'system-success',
					'color' => '#23ad7b',
				),
				array(
					'name'  => __( 'System Warning', 'lhtbp' ),
					'slug'  => 'system-warning',
					'color' => '#ffc107',
				),
				array(
					'name'  => __( 'System Error', 'lhtbp' ),
					'slug'  => 'system-error',
					'color' => '#f44336',
				),
				array(
					'name'  => __( 'System Info', 'lhtbp' ),
					'slug'  => 'system-info',
					'color' => '#00a0d2',
				),
			)
		);

		/*
		 * Add support custom font sizes.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-font-sizes' );
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'lhtbp' ),
					'shortName' => __( 'S', 'lhtbp' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Medium', 'lhtbp' ),
					'shortName' => __( 'M', 'lhtbp' ),
					'size'      => 25,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'lhtbp' ),
					'shortName' => __( 'L', 'lhtbp' ),
					'size'      => 31,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Larger', 'lhtbp' ),
					'shortName' => __( 'XL', 'lhtbp' ),
					'size'      => 39,
					'slug'      => 'larger',
				),
			)
		);
	}
}
