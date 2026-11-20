<?php
/**
 * Archive Services Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php get_header(); ?>

<main id="primary" class="site-main">
	<div class="max-width">
		<div class="page-header">
			<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
			<p class="page-subtitle"><?php _e( 'Découvrez tous nos services', 'studio60' ); ?></p>
		</div>
		
		<div class="services-archive">
			<?php
			$services_query = new WP_Query( [
				'post_type' => 'services',
				'posts_per_page' => -1,
				'order' => 'ASC',
				'orderby' => 'meta_value_num',
				'meta_key' => 'service_order',
			] );
			
			if ( $services_query->have_posts() ) : while ( $services_query->have_posts() ) : the_post();
				$service_icon = get_field( 'service_icon' );
				?>
				<article class="service-card--archive">
					<div class="service-card__image--archive" style="background-image: url('<?php echo esc_url( $service_icon ); ?>');">
						<?php if ( $service_icon ) : ?>
							<span class="service-card__icon--archive <?= esc_html( get_the_title() ); ?>-icon</span>
						<?php endif; ?>
					</div>
					<div class="service-card__info--archive">
						<h3 class="service-card__title--archive"><?php the_title(); ?></h3>
						<p class="service-card__description--archive"><?php the_excerpt(); ?></p>
					</div>
				</article>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>