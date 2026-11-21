<?php
/**
 * Single project template.
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
			$image = function_exists( 'get_field' ) ? get_field( 'projet_image_principale' ) : '';
			$year = function_exists( 'get_field' ) ? get_field( 'projet_annee' ) : '';
			$external = function_exists( 'get_field' ) ? get_field( 'projet_externe' ) : '';
			$image_url = is_array( $image ) && ! empty( $image['url'] ) ? $image['url'] : $image;
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?>>
				<p class="eyebrow"><?php esc_html_e( 'Projet', 'studio60' ); ?><?php echo $year ? ' · ' . esc_html( $year ) : ''; ?></p>
				<h1><?php the_title(); ?></h1>
				<?php if ( $image_url ) : ?>
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
				<?php elseif ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php endif; ?>
				<div class="entry-content"><?php the_content(); ?></div>
				<?php if ( $external ) : ?>
					<p><a class="button button--primary" href="<?php echo esc_url( $external ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Voir le projet', 'studio60' ); ?></a></p>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
