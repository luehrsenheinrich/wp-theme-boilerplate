<?php
/**
 * _lhtbp\Functions\Class_Names\Component class
 *
 * @package _lhtbp
 */

namespace _lhtbp\Functions\Class_Names;
use _lhtbp\Component_Interface;
use _lhtbp\Templating_Component_Interface;

/**
 * Class for managing navigation menus.
 *
 * Exposes template tags:
 * * `wp__lhtbp()->class_names()`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() {
		return 'class_names';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp__lhtbp()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() {
		return array(
			'class_names' => array( $this, 'class_names' ),
		);
	}

	/**
	 * An PHP implementation of Jed Watsons javascript "classnames" utility.
	 *
	 * @see https://github.com/JedWatson/classnames
	 * @return string String of classnames. Mainly used by dynamic blocks.
	 */
	public function class_names() {
		$args = func_get_args();

		$data = array_reduce(
			$args,
			function ( $carry, $arg ) {
				if ( is_array( $arg ) ) {
					return array_merge( $carry, $arg );
				}

				$carry[] = $arg;
				return $carry;
			},
			array()
		);

		$classes = array_map(
			function ( $key, $value ) {
				$condition = $value;
				$return    = $key;

				if ( is_int( $key ) ) {
					$condition = null;
					$return    = $value;
				}

				$is_array           = is_array( $return );
				$is_object          = is_object( $return );
				$is_stringable_type = ! $is_array && ! $is_object;

				$is_stringable_object = $is_object && method_exists( $return, '__toString' );

				if ( ! $is_stringable_type && ! $is_stringable_object ) {
					return null;
				}

				if ( $condition === null ) {
					return $return;
				}

				return $condition ? $return : null;

			},
			array_keys( $data ),
			array_values( $data )
		);

		$classes = array_filter( $classes );

		return implode( ' ', $classes );
	}
}
