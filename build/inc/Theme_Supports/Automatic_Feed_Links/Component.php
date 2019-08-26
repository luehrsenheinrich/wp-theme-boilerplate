<?php
/**
 * _lhtbp\Theme_Supports\Automatic_Feed_Links\Component class
 *
 * @package _lhtbp
 */

namespace _lhtbp\Theme_Supports\Automatic_Feed_Links;
use _lhtbp\Component_Interface;
use function add_action;

/**
 * Add theme support for autmatic feed links..
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() {
		return 'automatic_feed_links';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'enable_automatic_feed_links' ) );
	}

	/**
	 * Enable automatic feed links for this theme.
	 *
	 * @return void
	 */
	public function enable_automatic_feed_links() {
		add_theme_support( 'automatic-feed-links' );
	}
}
