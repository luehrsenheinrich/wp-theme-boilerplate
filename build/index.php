<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _lhtbp
 */

namespace _lhtbp;

get_header();
?>

<div id="primary" class="content-area">
	<?php wp__lhtbp()->print_styles( '_lhtbp-blocks' ); ?>
	<main id="main" class="site-main stack">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

				<article <?php post_class( 'entry stack' ); ?> id="post-<?php the_ID(); ?>">
					<div class="entry-header inner-container">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="entry-content wide-content">
						<?php the_content(); ?>
					</div>
				</article>

		<?php endwhile; else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

		<?php endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->


<?php
get_footer();
