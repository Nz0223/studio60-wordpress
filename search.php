<?php
/**
 * Search results template.
 *
 * @package studio60
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="archive-hero"><div class="max-width"><h1><?php printf( esc_html__( 'Résultats pour : %s', 'studio60' ), esc_html( get_search_query() ) ); ?></h1></div></section>
<section class="single-page"><div class="max-width">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'single-content' ); ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</article>
	<?php endwhile; the_posts_pagination(); else : ?>
		<p><?php esc_html_e( 'Aucun résultat trouvé.', 'studio60' ); ?></p>
	<?php endif; ?>
</div></section>
<?php get_footer(); ?>
