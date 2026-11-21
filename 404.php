<?php
/**
 * 404 template.
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
		<p class="eyebrow">404</p>
		<h1><?php esc_html_e( 'Cette page est introuvable.', 'studio60' ); ?></h1>
		<p><?php esc_html_e( 'Le contenu recherché n’existe pas ou a été déplacé.', 'studio60' ); ?></p>
		<a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Retour à l’accueil', 'studio60' ); ?></a>
	</div>
</section>
<?php get_footer(); ?>
