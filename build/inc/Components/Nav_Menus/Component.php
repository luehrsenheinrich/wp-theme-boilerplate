<?php
/**
 * _lhtbp\Nav_Menus\Component class
 *
 * @package _lhtbp
 */
namespace _lhtbp\Components\Nav_Menus;
use _lhtbp\Components\Component_Interface;
use _lhtbp\Components\Templating_Component_Interface;
use WP_Post;
use function add_action;
use function add_filter;
use function register_nav_menus;
use function esc_html__;
use function has_nav_menu;
use function wp_nav_menu;
/**
 * Class for managing navigation menus.
 *
 * Exposes template tags:
 * * `wp__lhtbp()->is_nav_menu_active( string $slug )`
 * * `wp__lhtbp()->display_nav_menu( array $args = [] )`
 */
class Component implements Component_Interface, Templating_Component_Interface {
	const NAV_MENU_LIST = array(
		'header' => 'Header',
		'footer' => 'Footer',
	);

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'nav_menus';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_register_nav_menus' ) );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp__lhtbp()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return [
			'is_nav_menu_active' => array( $this, 'is_nav_menu_active' ),
			'display_nav_menu'   => array( $this, 'display_nav_menu' ),
		];
	}

	/**
	 * Registers the navigation menus.
	 */
	public function action_register_nav_menus() {
		register_nav_menus( static::NAV_MENU_LIST );
	}

	/**
	 * Checks whether the primary navigation menu is active.
	 *
	 * @return bool True if the primary navigation menu is active, false otherwise.
	 */
	public function is_nav_menu_active( $slug ) : bool {
		if ( ! isset( static::NAV_MENU_LIST[ $slug ] ) ) {
			return false;
		}

		return (bool) has_nav_menu( $slug );
	}

	/**
	 * Displays the primary navigation menu.
	 *
	 * @param array $args Optional. Array of arguments. See `wp_nav_menu()` documentation for a list of supported
	 *                    arguments.
	 */
	public function display_nav_menu( array $args = [] ) {
		// Return if no theme location is defined.
		if ( ! isset( $args['theme_location'] ) ) {
			return;
		}

		// Get the navs slug.
		$slug = $args['theme_location'];

		// Define defaults.
		$defaults = array(
			'container'       => 'nav',
			'container_class' => $slug . '-menu ' . $slug . '-menu--main',
			'menu_class'      => 'menu ' . $slug,
		);

		// Merge args with defaults.
		$args = wp_parse_args( $args, $defaults );

		// Output the nav.
		wp_nav_menu( $args );
	}
}
