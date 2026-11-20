<?php
/**
 * Header template for STUDIO60
 * Contains the main header with logo, navigation, and language selector
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/php/rules/2014">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Skip link -->
	<a href="#primary" class="skip-link"><?php _e( 'Sauter au contenu principal', 'studio60' ); ?></a>

	<header class="site-header" id="masthead">
		<div class="site-header__inner">
			<div class="max-width">

				<!-- Logo -->
				<figure class="site-header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php
						// Logo via Customizer ou ACF
						$logo = get_theme_mod( 'logo', '' );
						if ( $logo ) {
							echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
						} else {
							// Fallback: titre du site
							bloginfo( 'name' );
						}
						?>
					</a>
				</figure>

				<!-- Navigation principale -->
				<nav class="site-header__nav" role="navigation">
					<?php
					wp_nav_menu( [
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-nav',
						'depth'          => 2,
						'container'      => false,
					] );
					?>
				</nav>

				<!-- Sélecteur de langue FR / EN -->
				<div class="site-header__lang-selector">
					<?php
					// Si WPML est disponible
					if ( function_exists( 'icl_language_switcher' ) ) {
						echo icl_language_switcher( array( 'display_flag' => true, 'show_names' => true, 'hide_current' => false ) );
					} else {
						// Sinon, liens simples
						?>
						<div class="lang-links">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lang-link current<?php if ( is_frontpage() ) echo ' active'; ?>">FR</a>
							<a href="<?php echo esc_url( '/en/' ); ?>" class="lang-link<?php if ( is_home() && ! is_frontpage() ) echo ' active'; ?>">EN</a>
						</div>
						<?php
					}
					?>
				</div>

				<!-- Bouton d'action CTA -->
				<div class="site-header__cta">
					<a href="#contact" class="btn btn-primary">
						<?php _e( 'Parlons de votre projet', 'studio60' ); ?>
					</a>
				</div>

			</div>
		</div>

		<!-- Menu mobile (hamburger) -->
		<nav class="site-header__mobile-nav" aria-label="<?php _e( 'Menu principal', 'studio60' ); ?>">
			<button class="menu-toggle" aria-expanded="false" aria-label="<?php _e( 'Ouvrir le menu', 'studio60' ); ?>">
				<span class="menu-toggle__lines">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>
			<?php
			wp_nav_menu( [
				'theme_location' => 'mobile',
				'menu_id'        => 'mobile-menu',
				'menu_class'     => 'mobile-nav',
				'container'      => false,
			] );
			?>
		</nav>
	</header>

	<!-- Overlay mobile -->
	<div class="site-header__mobile-overlay" id="mobile-overlay">
		<button class="mobile-overlay__close" aria-label="<?php _e( 'Fermer le menu', 'studio60' ); ?>">&times;</button>
		<?php
		wp_nav_menu( [
			'theme_location' => 'mobile',
			'menu_id'        => 'mobile-menu',
			'menu_class'     => 'mobile-nav-overlay',
			'container'      => false,
		] );
		?>
	</div>
	</header>

	<!-- Main content -->
	<main id="primary" class="site-main">
