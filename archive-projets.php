<?php
/**
 * Archive template for Studio60 projects.
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
		<p class="eyebrow"><?php esc_html_e( 'Nos réalisations', 'studio60' ); ?></p>
		<h1><?php post_type_archive_title(); ?></h1>
		<p><?php esc_html_e( 'Découvrez une sélection de projets et de collaborations.', 'studio60' ); ?></p>
	</div>
</section>
<section class="projects-section">
	<div class="max-width">
		<div class="projects-grid">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$image = function_exists( 'get_field' ) ? get_field( 'projet_image_principale' ) : '';
				$category = function_exists( 'get_field' ) ? get_field( 'projet_categorie' ) : '';
				$year = function_exists( 'get_field' ) ? get_field( 'projet_annee' ) : '';
				$image_url = is_array( $image ) && ! empty( $image['url'] ) ? $image['url'] : $image;
				?>
				<article <?php post_class( 'project-card' ); ?>>
					<div class="project-card__media">
						<?php if ( $image_url ) : ?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
						<?php elseif ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large' ); ?>
						<?php endif; ?>
					</div>
					<div class="project-card__content">
						<p class="project-card__meta"><?php
							if ( $category ) {
								echo esc_html( is_object( $category ) ? $category->name : ( is_array( $category ) && isset( $category['name'] ) ? $category['name'] : $category ) );
							}
							if ( $year ) {
								echo ' · ' . esc_html( $year );
							}
						?></p>
						<h2><?php the_title(); ?></h2>
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; else : ?>
				<p><?php esc_html_e( 'Aucun projet publié pour le moment.', 'studio60' ); ?></p>
			<?php endif; ?>
		</div>
		<?php the_posts_pagination(); ?>
	</div>
</section>
<?php
get_footer();
