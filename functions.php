<?php
/**
 * STUDIO60 - Functions file
 * Theme setup, Custom Post Types, ACF, and scripts enqueuing
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * PHASE 2: Setup du thème et système de design
 */

/**
 * Enregistre les supports du thème
 */
function studio60_theme_setup() {
	load_theme_textdomain( 'studio60', get_template_directory() . '/languages' );

	// Ajouter le support des menus
	register_nav_menus( [
		'primary'    => __( 'Menu principal', 'studio60' ),
		'footer'     => __( 'Menu pied de page', 'studio60' ),
		'mobile'     => __( 'Menu mobile', 'studio60' ),
	] );

	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 260,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );

	// Ajouter le support de la largeur de contenu
	$GLOBALS['content_width'] = apply_filters( 'studio60_content_width', 1200 );

	// Activation des fonctionnalités HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Activation du thème pour les motifs de fond
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'studio60_theme_setup', 15 );

/**
 * Traductions des textes fixes Studio60 avec Polylang.
 */
function studio60_t( $text ) {
	if ( function_exists( 'pll__' ) ) {
		return pll__( $text );
	}
	return __( $text, 'studio60' );
}

function studio60_register_translations() {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$strings = array(
		'© %1$s Studio60. Tous droits réservés.',
		'Nous accompagnons les marques et les organisations dans leur développement grâce à des stratégies créatives et des solutions digitales pertinentes.',
		'Nous transformons vos ambitions en expériences remarquables.',
		'Studio60 · Stratégie · Créativité · Digital',
		'Parlons de votre projet',
		'Des idées fortes. Des expériences utiles.',
		'Défiler pour découvrir',
		'Ce que nous faisons',
		'Des expertises qui donnent forme à vos idées.',
		'Nous associons réflexion stratégique, sens du design et maîtrise technique pour faire avancer les marques.',
		'Notre sélection',
		'Des projets pensés pour faire la différence.',
		'Construisons quelque chose ensemble',
		'Notre vision',
		'Notre mission',
		'Entrons en contact',
		'Votre prochain projet commence ici.',
		'Parlez-nous de votre idée, de vos objectifs et des défis que vous souhaitez relever. Nous serons ravis d’en discuter.',
		'Une conversation peut être le début de grandes choses.',
		'Ne pas remplir ce champ',
		'Nom complet *',
		'Adresse e-mail *',
		'Entreprise',
		'Sujet',
		'Votre message *',
		'Envoyer le message',
		'Les informations transmises sont utilisées uniquement pour répondre à votre demande.',
		'Merci. Votre message a bien été transmis.',
		'Vérifiez votre nom, votre adresse e-mail et votre message.',
		'Le message n’a pas pu être envoyé. Veuillez réessayer ou nous contacter par e-mail.',
		'Nos expertises seront bientôt présentées ici.',
		'Les réalisations Studio60 seront bientôt disponibles.',
		'Navigation',
		'Contact',
		'Suivez-nous',
		'Nous contacter',
		'Stratégie, création et solutions numériques pour faire grandir les marques.',
		'Aller au contenu principal',
		'Navigation principale',
		'Choisir la langue',
		'Ouvrir le menu',
	);

	foreach ( $strings as $string ) {
		pll_register_string( 'Studio60 - ' . $string, $string, 'Studio60' );
	}
}
add_action( 'init', 'studio60_register_translations', 20 );


/**
 * PHASE 4: Custom Post Types
 */

/**
 * Enregistrement du Custom Post Type "services"
 */
function studio60_services_post_type() {

	$labels = [
		'name'               => _x( 'Services', 'Post type general name', 'studio60' ),
		'singular_name'      => _x( 'Service', 'Post type singular name', 'studio60' ),
		'menu_name'          => _x( 'Services', 'Admin menu', 'studio60' ),
		'name_admin_bar'     => __( 'Service', 'studio60' ),
		'add_new'            => __( 'Ajouter nouveau', 'studio60' ),
		'add_new_item'       => __( 'Ajouter nouveau service', 'studio60' ),
		'new_item'           => __( 'Nouveau service', 'studio60' ),
		'edit_item'          => __( 'Modifier le service', 'studio60' ),
		'view_item'          => __( 'Voir le service', 'studio60' ),
		'all_items'          => __( 'Tous les services', 'studio60' ),
		'search_items'       => __( 'Rechercher des services', 'studio60' ),
		'parent_item'        => null,
		'parent_item_colon'  => null,
		'not_found'          => __( 'Aucun service trouvé', 'studio60' ),
		'not_found_in_trash' => __( 'Aucun service dans la corbeille', 'studio60' ),
	];

	$args = [
		'labels'       => $labels,
		'public'       => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'service' ],
		'capability_type' => 'post',
		'has_archive'  => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'supports'     => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
		'has_archive'  => 'service',
		'menu_icon'    => 'dashicons-controls-below',
	];

	register_post_type( 'services', $args );
}
add_action( 'init', 'studio60_services_post_type', 0 );

/**
 * Enregistrement du Custom Post Type "projets"
 */
function studio60_projets_post_type() {

	$labels = [
		'name'               => _x( 'Projets', 'Post type general name', 'studio60' ),
		'singular_name'      => _x( 'Projet', 'Post type singular name', 'studio60' ),
		'menu_name'          => _x( 'Projets', 'Admin menu', 'studio60' ),
		'name_admin_bar'     => __( 'Projet', 'studio60' ),
		'add_new'            => __( 'Ajouter nouveau', 'studio60' ),
		'add_new_item'       => __( 'Ajouter nouveau projet', 'studio60' ),
		'new_item'           => __( 'Nouveau projet', 'studio60' ),
		'edit_item'          => __( 'Modifier le projet', 'studio60' ),
		'view_item'          => __( 'Voir le projet', 'studio60' ),
		'all_items'          => __( 'Tous les projets', 'studio60' ),
		'search_items'       => __( 'Rechercher des projets', 'studio60' ),
		'parent_item'        => null,
		'parent_item_colon'  => null,
		'not_found'          => __( 'Aucun projet trouvé', 'studio60' ),
		'not_found_in_trash' => __( 'Aucun projet dans la corbeille', 'studio60' ),
	];

	$args = [
		'labels'       => $labels,
		'public'       => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'projet' ],
		'capability_type' => 'post',
		'has_archive'  => true,
		'hierarchical' => false,
		'menu_position' => 10,
		'supports'     => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
		'has_archive'  => 'projet',
		'menu_icon'    => 'dashicons-portfolio',
	];

	register_post_type( 'projets', $args );
}
add_action( 'init', 'studio60_projets_post_type', 0 );

function studio60_register_project_taxonomy() {
	register_taxonomy( 'projet_category', array( 'projets' ), array(
		'labels' => array(
			'name'          => __( 'Catégories de projets', 'studio60' ),
			'singular_name' => __( 'Catégorie de projet', 'studio60' ),
			'all_items'     => __( 'Toutes les catégories', 'studio60' ),
			'add_new_item'  => __( 'Ajouter une catégorie', 'studio60' ),
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'categorie-projet' ),
	) );
}
add_action( 'init', 'studio60_register_project_taxonomy', 1 );


/**
 * PHASE 7: Champs ACF (Advanced Custom Fields)
 * Configuration des champs personnalisés pour les CPT et sections
 */

/**
 * Champs ACF pour le Custom Post Type "services"
 */
function studio60_acf_services_fields() {

	if( function_exists('acf_add_local_field_group') ) {

		acf_add_local_field_group( [
			'key'       => 'group_services',
			'title'     => __( 'Champs Services', 'studio60' ),
			'fields'    => [

				[
					'key'       => 'field_service_title',
					'label'     => __( 'Titre du service', 'studio60' ),
					'name'      => 'service_title',
					'type'      => 'text',
					'required'  => true,
					'admin_style' => 'input',
				],

				[
					'key'       => 'field_service_description',
					'label'     => __( 'Description', 'studio60' ),
					'name'      => 'service_description',
					'type'      => 'textarea',
					'rows'      => 3,
					'admin_style' => 'input',
				],

				[
					'key'       => 'field_service_icon',
					'label'     => __( 'Icône / Image', 'studio60' ),
					'name'      => 'service_icon',
					'type'      => 'image',
					'library'   => 'all',
					'return_format' => 'url',
				],

				[
					'key'       => 'field_service_order',
					'label'     => __( 'Ordre d\'affichage', 'studio60' ),
					'name'      => 'service_order',
					'type'      => 'number',
					'min'       => 1,
					'default'   => 1,
				],

			],
			'location'  => [
				[
					[ 'param' => 'post_type',
					  'operator' => '==',
					  'value' => 'services' ],
				],
			],
			'menu_order' => 0,
			'position'   => 'side',
			'style'      => 'seamless',
			'label'      => 'studio60',
		] );
	}
}
add_action( 'acf/init', 'studio60_acf_services_fields', 20 );

/**
 * Champs ACF pour le Custom Post Type "projets"
 */
function studio60_acf_projets_fields() {

	if( function_exists('acf_add_local_field_group') ) {

		acf_add_local_field_group( [
			'key'       => 'group_projets',
			'title'     => __( 'Champs Projets', 'studio60' ),
			'fields'    => [

				[
					'key'       => 'field_projet_title',
					'label'     => __( 'Titre du projet', 'studio60' ),
					'name'      => 'projet_title',
					'type'      => 'text',
					'required'  => true,
					'admin_style' => 'input',
				],

				[
					'key'       => 'field_projet_description',
					'label'     => __( 'Description', 'studio60' ),
					'name'      => 'projet_description',
					'type'      => 'textarea',
					'rows'      => 3,
					'admin_style' => 'input',
				],

				[
					'key'       => 'field_projet_image_principale',
					'label'     => __( 'Image principale', 'studio60' ),
					'name'      => 'projet_image_principale',
					'type'      => 'image',
					'library'   => 'all',
					'return_format' => 'url',
				],

				[
					'key'       => 'field_projet_galerie',
					'label'     => __( 'Galerie d\'images', 'studio60' ),
					'name'      => 'projet_galerie',
					'type'      => 'gallery',
					'min_count' => 1,
					'return_format' => 'array',
				],

				[
					'key'       => 'field_projet_categorie',
					'label'     => __( 'Catégorie', 'studio60' ),
					'name'      => 'projet_categorie',
					'type'      => 'taxonomy',
					'taxonomy'  => 'projet_category',
				],

				[
					'key'       => 'field_projet_annee',
					'label'     => __( 'Année', 'studio60' ),
					'name'      => 'projet_annee',
					'type'      => 'number',
					'min'       => 2000,
					'max'       => 2100,
				],

				[
					'key'       => 'field_projet_externe',
					'label'     => __( 'Lien externe', 'studio60' ),
					'name'      => 'projet_externe',
					'type'      => 'url',
				],

			],
			'location'  => [
				[
					[ 'param' => 'post_type',
					  'operator' => '==',
					  'value' => 'projets' ],
				],
			],
			'menu_order' => 0,
			'position'   => 'side',
			'style'      => 'seamless',
			'label'      => 'studio60',
		] );
	}
}
add_action( 'acf/init', 'studio60_acf_projets_fields', 21 );

/**
 * Champs ACF pour la section Hero
 */
function studio60_acf_hero_fields() {

	if( function_exists('acf_add_local_field_group') ) {

		acf_add_local_field_group( [
			'key'       => 'group_hero',
			'title'     => __( 'Champs Hero', 'studio60' ),
			'fields'    => [

				[
					'key'       => 'field_hero_title',
					'label'     => __( 'Titre principal', 'studio60' ),
					'name'      => 'hero_title',
					'type'      => 'text',
					'required'  => true,
				],

				[
					'key'       => 'field_hero_subtitle',
					'label'     => __( 'Sous-titre', 'studio60' ),
					'name'      => 'hero_subtitle',
					'type'      => 'textarea',
					'rows'      => 3,
				],

				[
					'key'       => 'field_hero_button_text',
					'label'     => __( 'Texte du bouton', 'studio60' ),
					'name'      => 'hero_button_text',
					'type'      => 'text',
					'default'   => 'Découvrir nos réalisations',
				],

				[
					'key'       => 'field_hero_background',
					'label'     => __( 'Image d\'arrière-plan', 'studio60' ),
					'name'      => 'hero_background_image',
					'type'      => 'image',
					'return_format' => 'url',
				],

			],
			'location'  => [
				[
					[ 'param' => 'page_type',
					  'operator' => '==',
					  'value' => 'front_page' ],
				],
			],
			'menu_order' => 0,
			'position'   => 'normal',
			'style'      => 'seamless',
			'label'      => 'studio60',
		] );
	}
}
add_action( 'acf/init', 'studio60_acf_hero_fields', 22 );

/**
 * Champs ACF pour le footer
 */
function studio60_acf_footer_fields() {

	if( function_exists('acf_add_local_field_group') ) {

		acf_add_local_field_group( [
			'key'       => 'group_footer',
			'title'     => __( 'Champs Footer', 'studio60' ),
			'fields'    => [

				[
					'key'       => 'field_footer_address',
					'label'     => __( 'Adresse', 'studio60' ),
					'name'      => 'footer_address',
					'type'      => 'text',
				],

				[
					'key'       => 'field_footer_hours',
					'label'     => __( 'Horaires', 'studio60' ),
					'name'      => 'footer_hours',
					'type'      => 'text',
				],

				[
					'key'       => 'field_footer_social_links',
					'label'     => __( 'Réseaux sociaux', 'studio60' ),
					'name'      => 'footer_social_links',
					'type'      => 'group',
					'sub_fields' => [

						[
							'key'       => 'field_social_network',
							'label'     => __( 'Réseau', 'studio60' ),
							'name'      => 'social_network',
							'type'      => 'select',
							'choices'   => [
								'facebook' => __( 'Facebook', 'studio60' ),
								'twitter'  => __( 'Twitter', 'studio60' ),
								'linkedin' => __( 'LinkedIn', 'studio60' ),
								'instagram'=> __( 'Instagram', 'studio60' ),
								'dribbble' => __( 'Dribbble', 'studio60' ),
							],
						],

						[
							'key'       => 'field_social_url',
							'label'     => __( 'URL', 'studio60' ),
							'name'      => 'social_url',
							'type'      => 'url',
						],

					],
					'layout'    => 'row',
					'return_format' => 'array',
				],

				[
					'key'       => 'field_footer_copyright',
					'label'     => __( 'Copyright', 'studio60' ),
					'name'      => 'footer_copyright',
					'type'      => 'text',
					'default'   => '&copy; {{ year }} Studio60. Tous droits réservés.',
				],

			],
			'location'  => [
				[
					[ 'param' => 'page_type',
					  'operator' => '==',
					  'value' => 'front_page' ],
				],
			],
			'menu_order' => 0,
			'position'   => 'side',
			'style'      => 'seamless',
			'label'      => 'studio60',
		] );
	}
}
add_action( 'acf/init', 'studio60_acf_footer_fields', 23 );


/**
 * Process the public Studio60 contact form.
 */
function studio60_handle_contact_form() {
	$return_url = isset( $_POST['studio60_return_url'] )
		? esc_url_raw( wp_unslash( $_POST['studio60_return_url'] ) )
		: ( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) );
	$return_url = wp_validate_redirect( $return_url, home_url( '/' ) );
	$redirect = add_query_arg( 'studio60_contact', 'invalid', $return_url ) . '#contact';

	if (
		! isset( $_POST['studio60_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['studio60_contact_nonce'] ) ), 'studio60_contact' )
	) {
		wp_safe_redirect( $redirect );
		exit;
	}

	// Honeypot: silently accept automated submissions without sending mail.
	if ( ! empty( $_POST['studio60_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'studio60_contact', 'sent', $return_url ) . '#contact' );
		exit;
	}

	$name    = isset( $_POST['studio60_name'] ) ? sanitize_text_field( wp_unslash( $_POST['studio60_name'] ) ) : '';
	$email   = isset( $_POST['studio60_email'] ) ? sanitize_email( wp_unslash( $_POST['studio60_email'] ) ) : '';
	$company = isset( $_POST['studio60_company'] ) ? sanitize_text_field( wp_unslash( $_POST['studio60_company'] ) ) : '';
	$subject = isset( $_POST['studio60_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['studio60_subject'] ) ) : '';
	$message = isset( $_POST['studio60_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['studio60_message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( $redirect );
		exit;
	}

	$recipient = sanitize_email( get_option( 'admin_email' ) );
	$mail_subject = $subject ? $subject : sprintf( __( 'Nouvelle demande de contact de %s', 'studio60' ), $name );
	$mail_body = "Nom : {$name}\nE-mail : {$email}\nEntreprise : {$company}\nSujet : {$subject}\n\nMessage :\n{$message}";
	$headers = array( 'Reply-To: <' . $email . '>' );

	$sent = $recipient && wp_mail( $recipient, $mail_subject, $mail_body, $headers );
	$status = $sent ? 'sent' : 'mail_error';

	wp_safe_redirect( add_query_arg( 'studio60_contact', $status, $return_url ) . '#contact' );
	exit;
}
add_action( 'admin_post_nopriv_studio60_contact', 'studio60_handle_contact_form' );
add_action( 'admin_post_studio60_contact', 'studio60_handle_contact_form' );

/**
 * Enqueue theme assets only when the files exist.
 */
function studio60_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$css_file = get_stylesheet_directory() . '/style.css';
	$css_version = file_exists( $css_file ) ? (string) filemtime( $css_file ) : $theme_version;

	wp_enqueue_style( 'studio60-style', get_stylesheet_uri(), array(), $css_version );
	wp_enqueue_style( 'dashicons' );

	$script_files = array(
		'studio60-navigation' => '/js/navigation.js',
	);

	foreach ( $script_files as $handle => $relative_path ) {
		$absolute_path = get_template_directory() . $relative_path;
		if ( file_exists( $absolute_path ) && filesize( $absolute_path ) > 0 ) {
			wp_enqueue_script(
				$handle,
				get_template_directory_uri() . $relative_path,
				array(),
				(string) filemtime( $absolute_path ),
				true
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'studio60_enqueue_assets', 20 );
