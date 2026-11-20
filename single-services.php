<?php
/**
 * Single Service Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-service' ); ?>>
	<div class="single-service__featured-image">
		<?php the_post_thumbnail(); ?>
	</div>
	
	<div class="single-service__content">
		<h1 class="single-service__title"><?php the_title(); ?></h1>
		<div class="single-service__excerpt">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="single-service__meta">
			<span class="single-service__category"><?php the_category( ', ' ); ?></span>
			<span class="single-service__author"><?php the_author(); ?></span>
		</div>
		
		<div class="single-service__description">
			<?php the_content(); ?>
		</div>
	</div>
</article>
<?php
wp_hook( 'single_service_end' );
?>