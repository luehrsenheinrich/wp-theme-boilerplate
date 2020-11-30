<?php
/**
 * lhtbp\Component_Interface interface
 *
 * @package lhtbp
 */

namespace WpMunich\lhtbp;

/**
 * Interface for a theme component.
 */
interface Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug();

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize();
}
