<?php
/**
 * Studio60 site header.
 *
 * @package studio60
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$studio60_home_url = function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link" href="#primary"><?php echo esc_html( studio60_t( 'Aller au contenu principal' ) ); ?></a>

	<header class="site-header" id="masthead">
		<div class="site-header__inner max-width">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="site-branding__title" href="<?php echo esc_url( $studio60_home_url ); ?>" rel="home">
						<span class="site-branding__mark">S60</span>
						<span><?php echo esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : 'Studio60' ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<nav class="primary-navigation" aria-label="<?php echo esc_attr( studio60_t( 'Navigation principale' ) ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 2,
				) );
				?>
			</nav>

			<?php
			$studio60_languages = function_exists( 'pll_the_languages' )
    ? pll_the_languages( array(
        'raw' => 1,
        'hide_if_empty' => 0,
    ) )
    : array();

if ( is_array( $studio60_languages ) && count( $studio60_languages ) > 1 ) :
    ?>
    <nav class="language-switcher" aria-label="<?php echo esc_attr( studio60_t( 'Choisir la langue' ) ); ?>">
        <?php foreach ( $studio60_languages as $language ) : ?>
            <a
                href="<?php echo esc_url( $language['url'] ); ?>"
                lang="<?php echo esc_attr( $language['locale'] ); ?>"
                class="<?php echo ! empty( $language['is_current'] ) ? 'is-active' : ''; ?>"
                <?php echo ! empty( $language['is_current'] ) ? 'aria-current="page"' : ''; ?>
            ><?php echo esc_html( strtoupper( $language['slug'] ) ); ?></a>
        <?php endforeach; ?>
    </nav>
<?php endif; ?>

			<a class="button button--small header-cta" href="<?php echo esc_url( $studio60_home_url . '#contact' ); ?>">
				<?php echo esc_html( studio60_t( 'Parlons de votre projet' ) ); ?>
			</a>

			<button class="menu-toggle" type="button" aria-controls="mobile-navigation" aria-expanded="false">
				<span class="menu-toggle__line"></span>
				<span class="menu-toggle__line"></span>
				<span class="menu-toggle__line"></span>
				<span class="screen-reader-text"><?php echo esc_html( studio60_t( 'Ouvrir le menu' ) ); ?></span>
			</button>
		</div>

		<div class="mobile-navigation" id="mobile-navigation" hidden>
			<div class="max-width">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'mobile-menu',
					'menu_class'     => 'mobile-menu',
					'container'      => false,
					'fallback_cb'    => false,
				) );
				?>
				<a class="button button--primary mobile-navigation__cta" href="<?php echo esc_url( $studio60_home_url . '#contact' ); ?>">
					<?php echo esc_html( studio60_t( 'Parlons de votre projet' ) ); ?>
				</a>
			</div>
		</div>
	</header>

	<main id="primary" class="site-main">
