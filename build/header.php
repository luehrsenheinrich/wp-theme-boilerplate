<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _lhtbp
 */

namespace _lhtbp;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', '_lhtbp' ); ?></a>

<?php wp__lhtbp()->display_primary_nav_menu( array( 'menu_class' => 'menu header clearfix', 'container_class' => 'header-menu header-menu--main' ) ); ?>
