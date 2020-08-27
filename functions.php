<?php

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function quattroformaggi_child_register_assets() {

    // Chargement de la feuille du style du theme parent
     wp_enqueue_style( 'quattroformaggi-theme', get_template_directory_uri() . '/style.css' );

    // Chargement de la feuille de style complémentaire du thème enfant


    wp_enqueue_style( 'quattroformaggi-child-theme', get_stylesheet_directory_uri() . '/assets/css/single_rest.css' );

    wp_enqueue_style( 'quattroformaggi-child-theme', get_stylesheet_directory_uri() . '/assets/css/normalize.css' );
}

add_action( 'wp_enqueue_scripts', 'quattroformaggi_child_register_assets' );

add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
/**
 * Register and load font awesome CSS files using a CDN.
 */
function prefix_enqueue_awesome() {
    wp_enqueue_style(
        'font-awesome-5',
        'https://use.fontawesome.com/releases/v5.3.0/css/all.css',
        array(),
        '5.3.0'
    );
}
