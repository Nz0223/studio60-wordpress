<?php
/**
 * Studio60 site footer.
 *
 * @package studio60
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$studio60_front_page_id = (int) get_option( 'page_on_front' );
if ( $studio60_front_page_id && function_exists( 'pll_get_post' ) && function_exists( 'pll_current_language' ) ) {
	$studio60_translated_footer_id = pll_get_post( $studio60_front_page_id, pll_current_language( 'slug' ) );
	if ( $studio60_translated_footer_id ) {
		$studio60_front_page_id = (int) $studio60_translated_footer_id;
	}
}
$studio60_home_url = function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' );
$studio60_footer_address = function_exists( 'get_field' ) ? get_field( 'footer_address', $studio60_front_page_id ) : '';
$studio60_footer_hours = function_exists( 'get_field' ) ? get_field( 'footer_hours', $studio60_front_page_id ) : '';
$studio60_footer_social = function_exists( 'get_field' ) ? get_field( 'footer_social_links', $studio60_front_page_id ) : array();
$studio60_footer_copyright = function_exists( 'get_field' ) ? get_field( 'footer_copyright', $studio60_front_page_id ) : '';
?>
	</main>
	<footer class="site-footer">
		<div class="site-footer__main max-width">
			<div class="site-footer__brand">
				<a class="site-footer__logo" href="<?php echo esc_url( $studio60_home_url ); ?>">
					<strong>Studio60</strong>
				</a>
				<p><?php echo esc_html( studio60_t( 'Stratégie, création et solutions numériques pour faire grandir les marques.' ) ); ?></p>
			</div>

			<div class="site-footer__navigation">
				<h2><?php echo esc_html( studio60_t( 'Navigation' ) ); ?></h2>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'fallback_cb'    => false,
				) );
				?>
			</div>

			<div class="site-footer__contact">
				<h2><?php echo esc_html( studio60_t( 'Contact' ) ); ?></h2>
				<?php if ( $studio60_footer_address ) : ?>
					<p><?php echo esc_html( $studio60_footer_address ); ?></p>
				<?php endif; ?>
				<?php if ( $studio60_footer_hours ) : ?>
					<p><?php echo esc_html( $studio60_footer_hours ); ?></p>
				<?php endif; ?>
				<p><a href="<?php echo esc_url( $studio60_home_url . '#contact' ); ?>"><?php echo esc_html( studio60_t( 'Parlons de votre projet' ) ); ?></a></p>
			</div>

			<div class="site-footer__social">
				<h2><?php echo esc_html( studio60_t( 'Suivez-nous' ) ); ?></h2>
				<?php
				if ( is_array( $studio60_footer_social ) ) :
					$studio60_network = isset( $studio60_footer_social['social_network'] ) ? $studio60_footer_social['social_network'] : '';
					$studio60_url = isset( $studio60_footer_social['social_url'] ) ? $studio60_footer_social['social_url'] : '';
					if ( $studio60_network && $studio60_url ) : ?>
						<div class="social-links">
							<a href="<?php echo esc_url( $studio60_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( ucfirst( $studio60_network ) ); ?></a>
						</div>
					<?php endif;
				endif;
				?>
			</div>
		</div>

		<div class="site-footer__bottom">
			<div class="max-width">
				<p><?php
					if ( $studio60_footer_copyright ) {
						echo esc_html( str_replace( array( '{{ year }}', '&copy;' ), array( gmdate( 'Y' ), '©' ), $studio60_footer_copyright ) );
					} else {
						printf( studio60_t( '© %1$s Studio60. Tous droits réservés.' ), esc_html( gmdate( 'Y' ) ) );
					}
				?></p>
				<a href="<?php echo esc_url( $studio60_home_url . '#contact' ); ?>"><?php echo esc_html( studio60_t( 'Nous contacter' ) ); ?></a>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
