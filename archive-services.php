<?php
/**
 * Archive template for Studio60 services.
 *
 * @package studio60
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="archive-hero">
	<div class="max-width">
		<p class="eyebrow"><?php esc_html_e( 'Notre expertise', 'studio60' ); ?></p>
		<h1><?php post_type_archive_title(); ?></h1>
		<p><?php esc_html_e( 'Des expertises complémentaires pour accompagner vos ambitions.', 'studio60' ); ?></p>
	</div>
</section>
<section class="services-section">
	<div class="max-width">
		<div class="services-grid">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$icon = function_exists( 'get_field' ) ? get_field( 'service_icon' ) : '';
				$description = function_exists( 'get_field' ) ? get_field( 'service_description' ) : '';
				$icon_url = is_array( $icon ) && ! empty( $icon['url'] ) ? $icon['url'] : $icon;
				?>
				<article <?php post_class( 'service-card' ); ?>>
					<?php if ( $icon_url ) : ?>
						<img class="service-card__icon" src="<?php echo esc_url( $icon_url ); ?>" alt="" loading="lazy">
					<?php endif; ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( $description ) : ?>
						<p><?php echo esc_html( $description ); ?></p>
					<?php else : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
					<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Découvrir', 'studio60' ); ?></a>
				</article>
			<?php endwhile; else : ?>
				<p><?php esc_html_e( 'Aucun service publié pour le moment.', 'studio60' ); ?></p>
			<?php endif; ?>
		</div>
		<?php the_posts_pagination(); ?>
	</div>
</section>
<?php
get_footer();
