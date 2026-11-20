<?php
/**
 * Archive Projets Template
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
			<p class="page-subtitle"><?php _e( 'Découvrez tous nos projets', 'studio60' ); ?></p>
		</div>
		
		<div class="projects-archive">
			<?php
			$projets_query = new WP_Query( [
				'post_type' => 'projets',
				'posts_per_page' => -1,
				'order' => 'DESC',
				'meta_key' => 'projet_annee',
			] );
			if ( $projets_query->have_posts() ) : while ( $projets_query->have_posts() ) : the_post();
				$project_image = get_field( 'projet_image_principale' );
				$project_category = get_field( 'projet_categorie' );
				$project_year = get_field( 'projet_annee' );
				?>
				<article class="projet-card--archive">
					<div class="projet-card__image--archive" style="background-image: url('<?php echo esc_url( $project_image ); ?>');">
						<span class="projet-card__category--archive"><?php echo esc_html( $project_category ? $project_category->name : '' ); ?></span>
						<h3 class="projet-card__title--archive"><?php the_title(); ?></h3>
						<p class="projet-card__year--archive"><?php echo esc_html( $project_year ); ?></p>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?><?php endif; ?>
