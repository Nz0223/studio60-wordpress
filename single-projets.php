<?php
/**
 * Single Projet Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-projet' ); ?>>
	<div class="single-projet__featured-image">
		<?php the_post_thumbnail(); ?>
	</div>
	
	<div class="single-projet__content">
		<h1 class="single-projet__title"><?php the_title(); ?></h1>
		<div class="single-projet__excerpt">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="single-projet__meta">
			<span class="single-projet__category"><?php the_category( ', ' ); ?></span>
			<span class="single-projet__author"><?php the_author(); ?></span>
			<span class="single-projet__year"><?php the_field( 'projet_annee' ); ?></span>
		</div>
		
		<div class="single-projet__description">
			<?php the_content(); ?>
		</div>
		
		<div class="single-projet__external-link">
			<?php $external = get_field( 'projet_externe' );
			if ( $external ) : ?>
				<a href="<?php echo esc_url( $external ); ?>" class="btn btn-secondary" target="_blank" rel="noopener">
					Voir sur le site externe
				</a>
			<?php endif; ?>
		</div>
	</div>
</article>
<?php
wp_hook( 'single_projet_end' );
?>