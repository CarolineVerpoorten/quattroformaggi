<?php

// Modification de la vue des articles

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );
// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );



// Gestion du menu et des fonctionnalités depuis le panneau d'administration

// Désactivation de l'éditeur de block pour les posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// Désactivation de l'éditeur de block pour les post-types
add_filter('use_block_editor_for_post_type', '__return_false', 10);