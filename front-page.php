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

$page_id = get_queried_object_id();
$hero_title = function_exists( 'get_field' ) ? get_field( 'hero_title', $page_id ) : '';
$hero_subtitle = function_exists( 'get_field' ) ? get_field( 'hero_subtitle', $page_id ) : '';
$hero_button_text = function_exists( 'get_field' ) ? get_field( 'hero_button_text', $page_id ) : '';
$hero_background = function_exists( 'get_field' ) ? get_field( 'hero_background_image', $page_id ) : '';
$about_kicker = function_exists( 'get_field' ) ? get_field( 'about_kicker', $page_id ) : '';
$about_title = function_exists( 'get_field' ) ? get_field( 'about_title', $page_id ) : '';
$about_text = function_exists( 'get_field' ) ? get_field( 'about_text', $page_id ) : '';
$about_vision = function_exists( 'get_field' ) ? get_field( 'about_vision', $page_id ) : '';
$about_mission = function_exists( 'get_field' ) ? get_field( 'about_mission', $page_id ) : '';

$hero_title = $hero_title ? $hero_title : __( 'Nous transformons vos ambitions en expériences remarquables.', 'studio60' );
$hero_subtitle = $hero_subtitle ? $hero_subtitle : __( 'Nous accompagnons les marques et les organisations dans leur développement grâce à des stratégies créatives et des solutions digitales pertinentes.', 'studio60' );
$hero_button_text = $hero_button_text ? $hero_button_text : __( 'Découvrir nos réalisations', 'studio60' );
$about_kicker = $about_kicker ? $about_kicker : __( 'L’esprit Studio60', 'studio60' );
$about_title = $about_title ? $about_title : __( 'La créativité au service de vos ambitions.', 'studio60' );
$about_text = $about_text ? $about_text : __( 'Nous réunissons stratégie, créativité et maîtrise digitale pour concevoir des expériences cohérentes, utiles et mémorables.', 'studio60' );
?>

<main id="primary" class="site-main">
	<section class="hero-section" id="accueil">
		<div class="hero-section__backdrop" <?php if ( $hero_background ) : ?>style="background-image: url('<?php echo esc_url( $hero_background ); ?>')"<?php endif; ?>></div>
		<div class="hero-section__orb hero-section__orb--one" aria-hidden="true"></div>
		<div class="hero-section__orb hero-section__orb--two" aria-hidden="true"></div>
		<div class="hero-section__grid" aria-hidden="true"></div>
		<div class="hero-section__inner max-width">
			<div class="hero-copy" data-reveal>
				<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Studio60 · Stratégie · Créativité · Digital', 'studio60' ); ?></p>
				<h1><?php echo esc_html( $hero_title ); ?></h1>
				<p class="hero-copy__lead"><?php echo esc_html( $hero_subtitle ); ?></p>
				<div class="hero-actions">
					<a class="button button--light" href="#projets"><?php echo esc_html( $hero_button_text ); ?><span aria-hidden="true">↗</span></a>
					<a class="button button--outline-light" href="#contact"><?php esc_html_e( 'Parlons de votre projet', 'studio60' ); ?></a>
				</div>
				<div class="hero-meta">
					<span class="hero-meta__line"></span>
					<span><?php esc_html_e( 'Des idées fortes. Des expériences utiles.', 'studio60' ); ?></span>
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
		<a class="hero-scroll" href="#services"><span></span><?php esc_html_e( 'Défiler pour découvrir', 'studio60' ); ?></a>
	</section>

	<section class="section services-section" id="services">
		<div class="max-width">
			<div class="section-heading" data-reveal>
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Ce que nous faisons', 'studio60' ); ?></p>
					<h2><?php esc_html_e( 'Des expertises qui donnent forme à vos idées.', 'studio60' ); ?></h2>
				</div>
				<p class="section-heading__intro"><?php esc_html_e( 'Nous associons réflexion stratégique, sens du design et maîtrise technique pour faire avancer les marques.', 'studio60' ); ?></p>
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
							<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Découvrir', 'studio60' ); ?><span aria-hidden="true">↗</span></a>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<div class="empty-state">
						<p><?php esc_html_e( 'Nos expertises seront bientôt présentées ici.', 'studio60' ); ?></p>
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
					<p class="eyebrow"><?php esc_html_e( 'Notre sélection', 'studio60' ); ?></p>
					<h2><?php esc_html_e( 'Des projets pensés pour faire la différence.', 'studio60' ); ?></h2>
				</div>
				<a class="text-link text-link--large" href="<?php echo esc_url( get_post_type_archive_link( 'projets' ) ); ?>"><?php esc_html_e( 'Tous les projets', 'studio60' ); ?><span aria-hidden="true">↗</span></a>
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
						<p><?php esc_html_e( 'Les réalisations Studio60 seront bientôt disponibles.', 'studio60' ); ?></p>
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
				<a class="button button--light" href="#contact"><?php esc_html_e( 'Construisons quelque chose ensemble', 'studio60' ); ?><span aria-hidden="true">↗</span></a>
			</div>
			<div class="about-pillars" data-reveal>
				<div class="about-pillar">
					<span class="about-pillar__index">01</span>
					<h3><?php esc_html_e( 'Notre vision', 'studio60' ); ?></h3>
					<p><?php echo esc_html( $about_vision ? $about_vision : __( 'Faire du digital et de la création des leviers concrets de transformation.', 'studio60' ) ); ?></p>
				</div>
				<div class="about-pillar">
					<span class="about-pillar__index">02</span>
					<h3><?php esc_html_e( 'Notre mission', 'studio60' ); ?></h3>
					<p><?php echo esc_html( $about_mission ? $about_mission : __( 'Concevoir des solutions pertinentes, soignées et durables pour chaque ambition.', 'studio60' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="section contact-section" id="contact">
		<div class="max-width contact-section__inner">
			<div class="contact-section__intro" data-reveal>
				<p class="eyebrow"><?php esc_html_e( 'Entrons en contact', 'studio60' ); ?></p>
				<h2><?php esc_html_e( 'Votre prochain projet commence ici.', 'studio60' ); ?></h2>
				<p><?php esc_html_e( 'Parlez-nous de votre idée, de vos objectifs et des défis que vous souhaitez relever. Nous serons ravis d’en discuter.', 'studio60' ); ?></p>
				<div class="contact-note">
					<span class="contact-note__icon" aria-hidden="true">✳</span>
					<span><?php esc_html_e( 'Une conversation peut être le début de grandes choses.', 'studio60' ); ?></span>
				</div>
			</div>

			<div class="contact-form-wrap" data-reveal>
				<?php
				$contact_status = isset( $_GET['studio60_contact'] ) ? sanitize_key( wp_unslash( $_GET['studio60_contact'] ) ) : '';
				if ( 'sent' === $contact_status ) :
					?>
					<div class="form-notice form-notice--success" role="status"><?php esc_html_e( 'Merci. Votre message a bien été transmis.', 'studio60' ); ?></div>
				<?php elseif ( 'invalid' === $contact_status ) : ?>
					<div class="form-notice form-notice--error" role="alert"><?php esc_html_e( 'Vérifiez votre nom, votre adresse e-mail et votre message.', 'studio60' ); ?></div>
				<?php elseif ( 'mail_error' === $contact_status ) : ?>
					<div class="form-notice form-notice--error" role="alert"><?php esc_html_e( 'Le message n’a pas pu être envoyé. Veuillez réessayer ou nous contacter par e-mail.', 'studio60' ); ?></div>
				<?php endif; ?>

				<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="studio60_contact">
					<?php wp_nonce_field( 'studio60_contact', 'studio60_contact_nonce' ); ?>
					<div class="form-honeypot" aria-hidden="true">
						<label for="studio60-website"><?php esc_html_e( 'Ne pas remplir ce champ', 'studio60' ); ?></label>
						<input id="studio60-website" type="text" name="studio60_website" tabindex="-1" autocomplete="off">
					</div>
					<div class="form-row">
						<div class="form-field">
							<label for="studio60-name"><?php esc_html_e( 'Nom complet *', 'studio60' ); ?></label>
							<input id="studio60-name" type="text" name="studio60_name" autocomplete="name" required>
						</div>
						<div class="form-field">
							<label for="studio60-email"><?php esc_html_e( 'Adresse e-mail *', 'studio60' ); ?></label>
							<input id="studio60-email" type="email" name="studio60_email" autocomplete="email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label for="studio60-company"><?php esc_html_e( 'Entreprise', 'studio60' ); ?></label>
							<input id="studio60-company" type="text" name="studio60_company" autocomplete="organization">
						</div>
						<div class="form-field">
							<label for="studio60-subject"><?php esc_html_e( 'Sujet', 'studio60' ); ?></label>
							<input id="studio60-subject" type="text" name="studio60_subject">
						</div>
					</div>
					<div class="form-field">
						<label for="studio60-message"><?php esc_html_e( 'Votre message *', 'studio60' ); ?></label>
						<textarea id="studio60-message" name="studio60_message" rows="5" required></textarea>
					</div>
					<button class="button button--primary form-submit" type="submit"><?php esc_html_e( 'Envoyer le message', 'studio60' ); ?><span aria-hidden="true">↗</span></button>
					<p class="form-privacy"><?php esc_html_e( 'Les informations transmises sont utilisées uniquement pour répondre à votre demande.', 'studio60' ); ?></p>
				</form>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
