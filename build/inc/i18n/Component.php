<?php
/**
 * lhtbp\i18n\Component class
 *
 * @package lhtbp
 */

namespace WpMunich\lhtbp\i18n;
use WpMunich\lhtbp\Component_Interface;
use function add_action;

/**
 * A class to handle textdomains and other i18n related logic..
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() {
		return 'i18n';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'load_text_domain' ) );
	}

	/**
	 * Load the themes textdomain.
	 *
	 * @return void
	 */
	public function load_text_domain() {
		load_theme_textdomain( 'lhtbp', get_template_directory() . '/languages' );
	}
}
