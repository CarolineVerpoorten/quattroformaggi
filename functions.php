<?php

// Modification de la vue des articles

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );


/* Gestion du menu et des fonctionnalités depuis le panneau d'administration */

// Désactivation de l'éditeur de block pour les posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// Désactivation de l'éditeur de block pour les post-types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/*************************************************************************/

/* Permet de déclarer un script ou un style */
/* Ne sera utilisé qu'à partir du moment où on appelera nos Scripts */

//add_action( 'wp_enqueue_scripts', 'votre_fonction' );

/*************************************************************************/

/* Déclaration des Custom Post Type */

function quattroformaggi_register_post_type(){

        $labels = array(
            'name' => 'Recettes',
            'all-items' => 'Toutes les recettes',
            'singular_name' => 'Recette',
            'add_new_item' => 'Ajouter une recette',
            'edit_item' => 'Modifier une recette',
            'menu_name' => 'Recettes'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'supports' => array('title','editor','thumbnail','excerpt','custom-fields','page-attributes'),
            'Menu_position' => 5,
            'Menu_icon' => 'dashicons-edit-page',
            'taxonomies' => array('category'),
            'capability_type' => array('recette','recettes'),
            'map_meta_cap' => true
        );

        register_post_type('recettes',$args);
}

add_action('init','quattroformaggi_register_post_type');

/*************************************************************************/

/* Configuration des menus du site */

register_nav_menus( array(
    'main' => 'Menu Principal',
    'sub' => 'Menu footer'
));

/*************************************************************************/

/* Mise à jour du JQuery pour le site si on devait l'appeler */

function quattroformaggi_register_assets() {

    // Déclarer jQuery
    wp_deregister_script( 'jquery' ); // On annule l'inscription du jQuery de WP
    wp_enqueue_script( // On déclare une version plus moderne
        'jquery',
        'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        false,
        '3.3.1',
        true
    );

}
add_action( 'wp_enqueue_scripts', 'quattroformaggi_register_assets' );

/*************************************************************************/