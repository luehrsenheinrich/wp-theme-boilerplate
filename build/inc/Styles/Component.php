<?php
/**
 * _lhtbp\Styles\Component class
 *
 * @package _lhtbp
 */

namespace _lhtbp\Styles;
use _lhtbp\Component_Interface;
use function add_action;

/**
 * A class to enqueue the needed styles..
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() {
		return 'styles';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style( '_lhtbp-style--base', get_template_directory_uri() . '/css/base.min.css', array(), THEME_VERSION, 'all' );
		wp_enqueue_style( '_lhtbp-style--blocks', get_template_directory_uri() . '/css/blocks.min.css', array(), THEME_VERSION, 'all' );
	}
}
