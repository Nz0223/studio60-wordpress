<?php
/**
 * Generic archive template.
 *
 * @package studio60
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="archive-hero"><div class="max-width"><h1><?php the_archive_title(); ?></h1><?php the_archive_description(); ?></div></section>
<section class="single-page"><div class="max-width">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'single-content' ); ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</article>
	<?php endwhile; the_posts_pagination(); else : ?>
		<p><?php esc_html_e( 'Aucun contenu trouvé.', 'studio60' ); ?></p>
	<?php endif; ?>
</div></section>
<?php get_footer(); ?>
