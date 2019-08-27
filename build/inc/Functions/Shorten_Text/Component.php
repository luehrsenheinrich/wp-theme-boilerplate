<?php
/**
 * _lhtbp\Functions\Shorten_Text\Component class
 *
 * @package _lhtbp
 */

namespace _lhtbp\Functions\Shorten_Text;
use _lhtbp\Component_Interface;
use _lhtbp\Templating_Component_Interface;

/**
 * Class for managing navigation menus.
 *
 * Exposes template tags:
 * * `wp__lhtbp()->shorten_text( $str, $length, $minword = 3, $end = ' ...' )`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() {
		return 'shorten_text';
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
			'shorten_text' => array( $this, 'shorten_text' ),
		);
	}

	/**
	 * Gracefully shortens text whithout cutting words
	 *
	 * @author Hendrik Luehrsen
	 * @since 1.0
	 *
	 * @param string $str     The text, that shall be shortened.
	 * @param int    $length  The length to which the text should be shortened.
	 * @param int    $minword The minimum amount of words, that shall be displayed.
	 * @param string $end     The ending if the text doesn't end with a full sentence.
	 *
	 * @return string The shortened string with "..." attatched.
	 */
	public function shorten_text( $str, $length, $minword = 3, $end = ' ...' ) {
		$sub = '';
		$len = 0;
		foreach ( explode( ' ', $str ) as $word ) {
			$part = ( ( $sub !== '' ) ? ' ' : '' ) . $word;
			$sub .= $part;
			$len += strlen( $part );

			if ( strlen( $word ) > $minword && strlen( $sub ) >= $length ) {
				break;
			}
		}

		if ( $len >= strlen( $str ) and substr( $sub, strlen( $sub ) - 1 ) === '.' ) {
			$end = null;
		}

		return $sub . $end;
	}
}
