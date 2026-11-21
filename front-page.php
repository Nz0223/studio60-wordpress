<?php
/**
 * Front page template — Studio60.
 *
 * @package studio60
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$page_id = (int) get_queried_object_id();
$front_id = (int) get_option( 'page_on_front' );

if ( $front_id && function_exists( 'pll_get_post' ) && function_exists( 'pll_current_language' ) ) {
	$translated_front_id = pll_get_post( $front_id, pll_current_language( 'slug' ) );
	if ( $translated_front_id ) {
		$page_id = (int) $translated_front_id;
	}
}

$acf_fields = array(
	'hero_title', 'hero_subtitle', 'hero_button_text', 'hero_background_image',
	'hero_tagline', 'hero_support_text', 'hero_contact_button',
	'about_kicker', 'about_title', 'about_text', 'about_vision', 'about_mission',
	'about_button_text', 'vision_label', 'mission_label',
	'services_kicker', 'services_title', 'services_text',
	'projects_kicker', 'projects_title',
	'contact_kicker', 'contact_title', 'contact_text', 'contact_secondary_text',
);

foreach ( $acf_fields as $field ) {
	$$field = function_exists( 'get_field' ) ? get_field( $field, $page_id ) : '';
}

$hero_title = $hero_title ?: studio60_t( 'Nous transformons vos ambitions en expériences remarquables.' );
$hero_subtitle = $hero_subtitle ?: studio60_t( 'Nous accompagnons les marques et les organisations dans leur développement grâce à des stratégies créatives et des solutions digitales pertinentes.' );
$hero_button_text = $hero_button_text ?: studio60_t( 'Découvrir nos réalisations' );
$hero_tagline = $hero_tagline ?: studio60_t( 'Studio60 · Stratégie · Créativité · Digital' );
$hero_support_text = $hero_support_text ?: studio60_t( 'Des idées fortes. Des expériences utiles.' );
$hero_contact_button = $hero_contact_button ?: studio60_t( 'Parlons de votre projet' );

$about_kicker = $about_kicker ?: studio60_t( 'L’esprit Studio60' );
$about_title = $about_title ?: studio60_t( 'La créativité au service de vos ambitions.' );
$about_text = $about_text ?: studio60_t( 'Nous réunissons stratégie, créativité et maîtrise digitale pour concevoir des expériences cohérentes, utiles et mémorables.' );

$services_kicker = $services_kicker ?: studio60_t( 'Ce que nous faisons' );
$services_title = $services_title ?: studio60_t( 'Des expertises qui donnent forme à vos idées.' );
$services_text = $services_text ?: studio60_t( 'Nous associons réflexion stratégique, sens du design et maîtrise technique pour faire avancer les marques.' );

$projects_kicker = $projects_kicker ?: studio60_t( 'Notre sélection' );
$projects_title = $projects_title ?: studio60_t( 'Des projets pensés pour faire la différence.' );

$about_button_text = $about_button_text ?: studio60_t( 'Construisons quelque chose ensemble' );
$vision_label = $vision_label ?: studio60_t( 'Notre vision' );
$mission_label = $mission_label ?: studio60_t( 'Notre mission' );

$contact_kicker = $contact_kicker ?: studio60_t( 'Entrons en contact' );
$contact_title = $contact_title ?: studio60_t( 'Votre prochain projet commence ici.' );
$contact_text = $contact_text ?: studio60_t( 'Parlez-nous de votre idée, de vos objectifs et des défis que vous souhaitez relever. Nous serons ravis d’en discuter.' );
$contact_secondary_text = $contact_secondary_text ?: studio60_t( 'Une conversation peut être le début de grandes choses.' );
?>

<main id="primary" class="site-main">
	<section class="hero-section" id="accueil">
		<div class="hero-section__backdrop" <?php if ( $hero_background_image ) : ?>style="background-image: url('<?php echo esc_url( $hero_background_image ); ?>')"<?php endif; ?>></div>
		<div class="hero-section__orb hero-section__orb--one" aria-hidden="true"></div>
		<div class="hero-section__orb hero-section__orb--two" aria-hidden="true"></div>
		<div class="hero-section__grid" aria-hidden="true"></div>
		<div class="hero-section__inner max-width">
			<div class="hero-copy" data-reveal>
				<p class="eyebrow eyebrow--light"><?php echo esc_html( $hero_tagline ); ?></p>
				<h1><?php echo esc_html( $hero_title ); ?></h1>
				<p class="hero-copy__lead"><?php echo esc_html( $hero_subtitle ); ?></p>
				<div class="hero-actions">
					<a class="button button--light" href="#projets"><?php echo esc_html( $hero_button_text ); ?><span aria-hidden="true">↗</span></a>
					<a class="button button--outline-light" href="#contact"><?php echo esc_html( $hero_contact_button ); ?></a>
				</div>
				<div class="hero-meta">
					<span class="hero-meta__line"></span>
					<span><?php echo esc_html( $hero_support_text ); ?></span>
				</div>
			</div>
			<div class="hero-art" aria-hidden="true" data-reveal>
				<div class="hero-art__ring hero-art__ring--outer"></div>
				<div class="hero-art__ring hero-art__ring--inner"></div>
				<div class="hero-art__core"><span>S60</span></div>
				<div class="hero-art__dot hero-art__dot--one"></div>
				<div class="hero-art__dot hero-art__dot--two"></div>
				<div class="hero-art__dot hero-art__dot--three"></div>
			</div>
		</div>
		<a class="hero-scroll" href="#services"><span></span><?php echo esc_html( studio60_t( 'Défiler pour découvrir' ) ); ?></a>
	</section>

	<section class="section services-section" id="services">
		<div class="max-width">
			<div class="section-heading" data-reveal>
				<div>
					<p class="eyebrow"><?php echo esc_html( $services_kicker ); ?></p>
					<h2><?php echo esc_html( $services_title ); ?></h2>
				</div>
				<p class="section-heading__intro"><?php echo esc_html( $services_text ); ?></p>
			</div>

			<div class="services-grid">
				<?php
				$services_query = new WP_Query( array(
					'post_type'      => 'services',
					'posts_per_page' => 4,
					'post_status'    => 'publish',
					'meta_key'       => 'service_order',
					'orderby'        => array( 'meta_value_num' => 'ASC', 'menu_order' => 'ASC', 'title' => 'ASC' ),
					'no_found_rows'  => true,
				) );
				$service_index = 0;
				?>
				<?php if ( $services_query->have_posts() ) : ?>
					<?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
						<?php
						$service_index++;
						$service_icon = function_exists( 'get_field' ) ? get_field( 'service_icon' ) : '';
						$service_description = function_exists( 'get_field' ) ? get_field( 'service_description' ) : '';
						if ( is_array( $service_icon ) && ! empty( $service_icon['url'] ) ) {
							$service_icon = $service_icon['url'];
						}
						if ( ! $service_description ) {
							$service_description = get_the_excerpt();
						}
						?>
						<article class="service-card" data-reveal>
							<div class="service-card__top">
								<span class="service-card__number"><?php echo esc_html( sprintf( '%02d', $service_index ) ); ?></span>
								<?php if ( $service_icon ) : ?>
									<img class="service-card__icon" src="<?php echo esc_url( $service_icon ); ?>" alt="" loading="lazy">
								<?php else : ?>
									<span class="service-card__symbol" aria-hidden="true">✳</span>
								<?php endif; ?>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_strip_all_tags( $service_description ) ); ?></p>
							
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<div class="empty-state">
						<p><?php echo esc_html( studio60_t( 'Nos expertises seront bientôt présentées ici.' ) ); ?></p>
					</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>

	<section class="section projects-section" id="projets">
		<div class="max-width">
			<div class="section-heading section-heading--projects" data-reveal>
				<div>
					<p class="eyebrow"><?php echo esc_html( $projects_kicker ); ?></p>
					<h2><?php echo esc_html( $projects_title ); ?></h2>
				</div>
				
			</div>

			<div class="projects-grid">
				<?php
				$projects_query = new WP_Query( array(
					'post_type'      => 'projets',
					'posts_per_page' => 6,
					'post_status'    => 'publish',
					'meta_key'       => 'projet_annee',
					'orderby'        => array( 'meta_value_num' => 'DESC', 'date' => 'DESC' ),
					'no_found_rows'  => true,
				) );
				$project_index = 0;
				?>
				<?php if ( $projects_query->have_posts() ) : ?>
					<?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
						<?php
						$project_index++;
						$project_image = function_exists( 'get_field' ) ? get_field( 'projet_image_principale' ) : '';
						$project_category = function_exists( 'get_field' ) ? get_field( 'projet_categorie' ) : '';
						$project_year = function_exists( 'get_field' ) ? get_field( 'projet_annee' ) : '';
						if ( is_array( $project_image ) && ! empty( $project_image['url'] ) ) {
							$project_image = $project_image['url'];
						}
						if ( ! $project_image ) {
							$project_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
						}
						$category_name = '';
						if ( $project_category instanceof WP_Term ) {
							$category_name = $project_category->name;
						} elseif ( is_array( $project_category ) && isset( $project_category['name'] ) ) {
							$category_name = $project_category['name'];
						} elseif ( is_string( $project_category ) ) {
							$category_name = $project_category;
						}
						if ( ! $category_name ) {
							$terms = get_the_terms( get_the_ID(), 'projet_category' );
							if ( is_array( $terms ) && ! is_wp_error( $terms ) && ! empty( $terms ) ) {
								$category_name = $terms[0]->name;
							}
						}
						?>
						<article class="project-card project-card--<?php echo esc_attr( $project_index % 3 ); ?>" data-reveal>
							<div class="project-card__link">
								<div class="project-card__media">
									<?php if ( $project_image ) : ?>
										<img src="<?php echo esc_url( $project_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
									<?php else : ?>
										<div class="project-card__placeholder"><span>Studio60</span></div>
									<?php endif; ?>
									<span class="project-card__arrow" aria-hidden="true">↗</span>
								</div>
								<div class="project-card__details">
									<div>
										<?php if ( $category_name ) : ?><p class="project-card__category"><?php echo esc_html( $category_name ); ?></p><?php endif; ?>
										<h3><?php the_title(); ?></h3>
									</div>
									<?php if ( $project_year ) : ?><span class="project-card__year"><?php echo esc_html( $project_year ); ?></span><?php endif; ?>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<div class="empty-state empty-state--wide">
						<p><?php echo esc_html( studio60_t( 'Les réalisations Studio60 seront bientôt disponibles.' ) ); ?></p>
					</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>

	<section class="about-section" id="apropos">
		<div class="about-section__shape" aria-hidden="true"></div>
		<div class="max-width about-section__inner">
			<div class="about-section__intro" data-reveal>
				<p class="eyebrow eyebrow--light"><?php echo esc_html( $about_kicker ); ?></p>
				<h2><?php echo esc_html( $about_title ); ?></h2>
				<p class="about-section__text"><?php echo esc_html( $about_text ); ?></p>
				<a class="button button--light" href="#contact"><?php echo esc_html( $about_button_text ); ?><span aria-hidden="true">↗</span></a>
			</div>
			<div class="about-pillars" data-reveal>
				<div class="about-pillar">
					<span class="about-pillar__index">01</span>
					<h3><?php echo esc_html( $vision_label ); ?></h3>
					<p><?php echo esc_html( $about_vision ? $about_vision : __( 'Faire du digital et de la création des leviers concrets de transformation.', 'studio60' ) ); ?></p>
				</div>
				<div class="about-pillar">
					<span class="about-pillar__index">02</span>
					<h3><?php echo esc_html( $mission_label ); ?></h3>
					<p><?php echo esc_html( $about_mission ? $about_mission : __( 'Concevoir des solutions pertinentes, soignées et durables pour chaque ambition.', 'studio60' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="section contact-section" id="contact">
		<div class="max-width contact-section__inner">
			<div class="contact-section__intro" data-reveal>
				<p class="eyebrow"><?php echo esc_html( $contact_kicker ); ?></p>
				<h2><?php echo esc_html( $contact_title ); ?></h2>
				<p><?php echo esc_html( $contact_text ); ?></p>
				<div class="contact-note">
					<span class="contact-note__icon" aria-hidden="true">✳</span>
					<span><?php echo esc_html( $contact_secondary_text ); ?></span>
				</div>
			</div>

			<div class="contact-form-wrap" data-reveal>
				<?php
				$contact_status = isset( $_GET['studio60_contact'] ) ? sanitize_key( wp_unslash( $_GET['studio60_contact'] ) ) : '';
				if ( 'sent' === $contact_status ) :
					?>
					<div class="form-notice form-notice--success" role="status"><?php echo esc_html( studio60_t( 'Merci. Votre message a bien été transmis.' ) ); ?></div>
				<?php elseif ( 'invalid' === $contact_status ) : ?>
					<div class="form-notice form-notice--error" role="alert"><?php echo esc_html( studio60_t( 'Vérifiez votre nom, votre adresse e-mail et votre message.' ) ); ?></div>
				<?php elseif ( 'mail_error' === $contact_status ) : ?>
					<div class="form-notice form-notice--error" role="alert"><?php echo esc_html( studio60_t( 'Le message n’a pas pu être envoyé. Veuillez réessayer ou nous contacter par e-mail.' ) ); ?></div>
				<?php endif; ?>

				<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="studio60_contact">
				<input type="hidden" name="studio60_return_url" value="<?php echo esc_url( get_permalink() ); ?>">
					<?php wp_nonce_field( 'studio60_contact', 'studio60_contact_nonce' ); ?>
					<div class="form-honeypot" aria-hidden="true">
						<label for="studio60-website"><?php echo esc_html( studio60_t( 'Ne pas remplir ce champ' ) ); ?></label>
						<input id="studio60-website" type="text" name="studio60_website" tabindex="-1" autocomplete="off">
					</div>
					<div class="form-row">
						<div class="form-field">
							<label for="studio60-name"><?php echo esc_html( studio60_t( 'Nom complet *' ) ); ?></label>
							<input id="studio60-name" type="text" name="studio60_name" autocomplete="name" required>
						</div>
						<div class="form-field">
							<label for="studio60-email"><?php echo esc_html( studio60_t( 'Adresse e-mail *' ) ); ?></label>
							<input id="studio60-email" type="email" name="studio60_email" autocomplete="email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label for="studio60-company"><?php echo esc_html( studio60_t( 'Entreprise' ) ); ?></label>
							<input id="studio60-company" type="text" name="studio60_company" autocomplete="organization">
						</div>
						<div class="form-field">
							<label for="studio60-subject"><?php echo esc_html( studio60_t( 'Sujet' ) ); ?></label>
							<input id="studio60-subject" type="text" name="studio60_subject">
						</div>
					</div>
					<div class="form-field">
						<label for="studio60-message"><?php echo esc_html( studio60_t( 'Votre message *' ) ); ?></label>
						<textarea id="studio60-message" name="studio60_message" rows="5" required></textarea>
					</div>
					<button class="button button--primary form-submit" type="submit"><?php echo esc_html( studio60_t( 'Envoyer le message' ) ); ?><span aria-hidden="true">↗</span></button>
					<p class="form-privacy"><?php echo esc_html( studio60_t( 'Les informations transmises sont utilisées uniquement pour répondre à votre demande.' ) ); ?></p>
				</form>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
