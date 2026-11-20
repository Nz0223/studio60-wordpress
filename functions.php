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

	// Ajouter le support des menus
	register_nav_menus( [
		'primary'    => __( 'Menu principal', 'studio60' ),
		'footer'     => __( 'Menu pied de page', 'studio60' ),
		'mobile'     => __( 'Menu mobile', 'studio60' ),
	] );

	// Ajouter le support de la miniature (thumbnail)
	add_theme_support( 'post-thumbnails' );

	// Ajouter le support de la largeur de contenu
	$GLOBALS['content_width'] = apply_filters( 'studio60_content_width', 1200 );

	// Activation de la navigation sticky
	add_theme_support( 'sticky-posts' );

	// Activation des fonctionnalités HTML5
	add_theme_support( [
		'html5' => [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		],
	] );

	// Activation du thème pour les motifs de fond
	add_theme_support( 'align-wide' );

	// Activation de la prise en charge du CSS personnalisé
	add_theme_support( 'custom-style' );

	// Activation des polices Google dans le customizer
	add_theme_support( 'google-fonts', [
		'family' => 'Manrope:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700',
		'family' => 'Inter:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	] );
}
add_action( 'after_setup_theme', 'studio60_theme_setup', 15 );

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
		'publicly_queryable' => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'service' ],
		'capability_type' => 'post',
		'has_archive'  => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'supports'     => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
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
		'publicly_queryable' => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'projet' ],
		'capability_type' => 'post',
		'has_archive'  => true,
		'hierarchical' => false,
		'menu_position' => 10,
		'supports'     => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'has_archive'  => 'projet',
		'menu_icon'    => 'dashicons-portfolio',
	];

	register_post_type( 'projets', $args );
}
add_action( 'init', 'studio60_projets_post_type', 0 );

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

				acf_add_local_field( [
					'key'       => 'field_service_title',
					'label'     => __( 'Titre du service', 'studio60' ),
					'name'      => 'service_title',
					'type'      => 'text',
					'required'  => true,
					'admin_style' => 'input',
				] ),

				acf_add_local_field( [
					'key'       => 'field_service_description',
					'label'     => __( 'Description', 'studio60' ),
					'name'      => 'service_description',
					'type'      => 'textarea',
					'rows'      => 3,
					'admin_style' => 'input',
				] ),

				acf_add_local_field( [
					'key'       => 'field_service_icon',
					'label'     => __( 'Icône / Image', 'studio60' ),
					'name'      => 'service_icon',
					'type'      => 'image',
					'library'   => 'all',
					'return_format' => 'url',
				] ),

				acf_add_local_field( [
					'key'       => 'field_service_order',
					'label'     => __( 'Ordre d\'affichage', 'studio60' ),
					'name'      => 'service_order',
					'type'      => 'number',
					'min'       => 1,
					'default'   => 1,
				] ),

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

				acf_add_local_field( [
					'key'       => 'field_projet_title',
					'label'     => __( 'Titre du projet', 'studio60' ),
					'name'      => 'projet_title',
					'type'      => 'text',
					'required'  => true,
					'admin_style' => 'input',
				] ),

				acf_add_local_field( [
					'key'       => 'field_projet_description',
					'label'     => __( 'Description', 'studio60' ),
					'name'      => 'projet_description',
					'type'      => 'textarea',
					'rows'      => 3,
					'admin_style' => 'input',
				] ),

				acf_add_local_field( [
					'key'       => 'field_projet_image_principale',
					'label'     => __( 'Image principale', 'studio60' ),
					'name'      => 'projet_image_principale',
					'type'      => 'image',
					'library'   => 'all',
					'return_format' => 'url',
				] ),

				acf_add_local_field( [
					'key'       => 'field_projet_galerie',
					'label'     => __( 'Galerie d\'images', 'studio60' ),
					'name'      => 'projet_galerie',
					'type'      => 'gallery',
					'min_count' => 1,
					'return_format' => 'array',
				] ),

				acf_add_local_field( [
					'key'       => 'field_projet_categorie',
					'label'     => __( 'Catégorie', 'studio60' ),
					'name'      => 'projet_categorie',
					'type'      => 'taxonomy',
					'taxonomy'  => 'projet_category',
				] ),

				acf_add_local_field( [
					'key'       => 'field_projet_annee',
					'label'     => __( 'Année', 'studio60' ),
					'name'      => 'projet_annee',
					'type'      => 'number',
					'min'       => 2000,
					'max'       => 2025,
				] ),

				acf_add_local_field( [
					'key'       => 'field_projet_externe',
					'label'     => __( 'Lien externe', 'studio60' ),
					'name'      => 'projet_externe',
					'type'      => 'url',
				] ),

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

				acf_add_local_field( [
					'key'       => 'field_hero_title',
					'label'     => __( 'Titre principal', 'studio60' ),
					'name'      => 'hero_title',
					'type'      => 'text',
					'required'  => true,
				] ),

				acf_add_local_field( [
					'key'       => 'field_hero_subtitle',
					'label'     => __( 'Sous-titre', 'studio60' ),
					'name'      => 'hero_subtitle',
					'type'      => 'textarea',
					'rows'      => 3,
				] ),

				acf_add_local_field( [
					'key'       => 'field_hero_button_text',
					'label'     => __( 'Texte du bouton', 'studio60' ),
					'name'      => 'hero_button_text',
					'type'      => 'text',
					'default'   => 'Découvrir nos réalisations',
				] ),

				acf_add_local_field( [
					'key'       => 'field_hero_background',
					'label'     => __( 'Image d\'arrière-plan', 'studio60' ),
					'name'      => 'hero_background_image',
					'type'      => 'image',
					'return_format' => 'url',
				] ),

			],
			'location'  => [
				[
					[ 'param' => 'option',
					  'operator' => '==',
					  'value' => 'hero' ],
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

				acf_add_local_field( [
					'key'       => 'field_footer_address',
					'label'     => __( 'Adresse', 'studio60' ),
					'name'      => 'footer_address',
					'type'      => 'text',
				] ),

				acf_add_local_field( [
					'key'       => 'field_footer_hours',
					'label'     => __( 'Horaires', 'studio60' ),
					'name'      => 'footer_hours',
					'type'      => 'text',
				] ),

				acf_add_local_field( [
					'key'       => 'field_footer_social_links',
					'label'     => __( 'Réseaux sociaux', 'studio60' ),
					'name'      => 'footer_social_links',
					'type'      => 'group',
					'sub_fields' => [

						acf_add_local_field( [
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
						] ),

						acf_add_local_field( [
							'key'       => 'field_social_url',
							'label'     => __( 'URL', 'studio60' ),
							'name'      => 'social_url',
							'type'      => 'url',
						] ),

					],
					'layout'    => 'row',
					'return_format' => 'array',
				] ),

				acf_add_local_field( [
					'key'       => 'field_footer_copyright',
					'label'     => __( 'Copyright', 'studio60' ),
					'name'      => 'footer_copyright',
					'type'      => 'text',
					'default'   => '&copy; {{ year }} Studio60. Tous droits réservés.',
				] ),

			],
			'location'  => [
				[
					[ 'param' => 'option',
					  'operator' => '==',
					  'value' => 'footer' ],
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
 * PHASE 8: Enregistrement des scripts et styles
 */
function studio60_enqueue_assets() {

	// CSS global
	wp_enqueue_style( 'studio60-style', get_stylesheet_uri(), [], '1.0.0', 'all' );

	// Style des icônes Dashicon
	wp_enqueue_style( 'dashicons' );

	// Script personnalisateur
	wp_enqueue_script( 'studio60-customizer', get_template_directory_uri() . '/js/customizer.js', [], '1.0.0', true );

	// Script navigation
	wp_enqueue_script( 'studio60-navigation', get_template_directory_uri() . '/js/navigation.js', ['jquery'], '1.0.0', true );

	// Script pour le header sticky
	wp_enqueue_script( 'studio60-header', get_template_directory_uri() . '/js/header.js', ['jquery'], '1.0.0', true );

	// Vérifier si on est sur la page d'accueil et charger les scripts spécifiques
	if ( is_front_page() || is_home() ) {
		wp_enqueue_script( 'studio60-hero', get_template_directory_uri() . '/js/hero.js', ['jquery'], '1.0.0', true );
		wp_enqueue_script( 'studio60-services', get_template_directory_uri() . '/js/services.js', ['jquery'], '1.0.0', true );
		wp_enqueue_script( 'studio60-projects', get_template_directory_uri() . '/js/projects.js', ['jquery'], '1.0.0', true );
	}
add_action( 'wp_enqueue_scripts', 'studio60_enqueue_assets', 100 );

/**
 * PERMALINK PERSONNALISÉ
 */
function studio60_permalink_structure() {
	// Structure optimisée pour le SEO et la lisibilité
	$structure = '/%postname%/';
	return $structure;
}
add_filter( 'user_permalink_structure', 'studio60_permalink_structure' );
}
// End of file
//========================================
// FIN FUNCTIONS.PHP STUDIO60
//========================================