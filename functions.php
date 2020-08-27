<?php

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

register_nav_menus( array(
   'main' => 'Menu Principal',
   'sub' => 'Menu footer'
));


function quattroformaggi_child_register_assets() {
  
    // Chargement de la feuille du style du theme parent
 	wp_enqueue_style( 'quattroformaggi-theme', get_template_directory_uri() . '/style.css' );

    // Chargement de la feuille de style complémentaire du thème enfant
 	wp_enqueue_style( 'quattroformaggi-child-theme', get_stylesheet_directory_uri() . '/assets/css/main.css' );
}
add_action( 'wp_enqueue_scripts', 'quattroformaggi_child_register_assets' );