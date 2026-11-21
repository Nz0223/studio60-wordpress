<?php
/**
 * Single service template.
 *
 * @package studio60
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="single-page">
	<div class="max-width">
		<?php while ( have_posts() ) : the_post();
			$description = function_exists( 'get_field' ) ? get_field( 'service_description' ) : '';
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?>>
				<p class="eyebrow"><?php esc_html_e( 'Notre expertise', 'studio60' ); ?></p>
				<h1><?php the_title(); ?></h1>
				<?php if ( $description ) : ?>
					<p class="single-content__intro"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
