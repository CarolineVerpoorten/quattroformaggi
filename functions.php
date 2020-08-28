<?php

// Chargement de la feuille du style du theme parent
wp_enqueue_style( 'quattroformaggi-theme', get_template_directory_uri() . '/style.css' );

// Ajout de fontawesome

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

/* Déclaration des Custom Post Type + Taxonomie pour type de recettes*/

function quattroformaggi_register_post_type(){

        $labels = array(
            'name' => 'recettes',
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
            'supports' => array('title','editor','thumbnail','excerpt','custom-fields','page-attributes','category'),
            'Menu_position' => 5,
            'Menu_icon' => 'dashicons-edit-page',
            'rewrite' => array('slug' => 'recettes'),
            'taxonomies' => array('category','post_tag')
        );

        register_post_type('recettes',$args);

        unset($labels);
        unset($args);
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

/* Pagination */

function recettes_pagination($query) {

    $baseURL="http://".$_SERVER['HTTP_HOST'];
    if($_SERVER['REQUEST_URI'] != "/"){
        $baseURL = $baseURL.$_SERVER['REQUEST_URI'];
    }

    // Suppression de '/page' de l'URL
    $sep = strrpos($baseURL, '/page/');
    if($sep != FALSE){
        $baseURL = substr($baseURL, 0, $sep);
    }

    // Suppression des paramètres de l'URL
    $sep = strrpos($baseURL, '?');
    if($sep != FALSE){
        // On supprime le caractère avant qui est un '/'
        $baseURL = substr($baseURL, 0, ($sep-1));
    }

    $page = $query->query_vars["paged"];
    if ( !$page ) $page = 1;
    $qs = $_SERVER["QUERY_STRING"] ? "?".$_SERVER["QUERY_STRING"] : "";

    // Nécessaire uniquement si on a plus de posts que de posts par page admis
    if ( $query->found_posts > $query->query_vars["posts_per_page"] ) {
        echo '<ul class="pagination">';
        // lien précédent si besoin
        if ( $page > 1 ) {
            echo '<li class="next_prev prev"><a title="Revenir à la page précédente (vous êtes à la page '.$page.')" href="'.$baseURL.'/page/'.($page-1).'/'.$qs.'">« précédente</a></li>';
        }
        // la boucle pour les pages
        for ( $i=1; $i <= $query->max_num_pages; $i++ ) {
            // ajout de la classe active pour la page en cours de visualisation
            if ( $i == $page ) {
                echo '<li class="active"><a href="#pagination" title="Vous êtes sur cette page '.$i.'">'.$i.'</a></li>';
            } else {
                echo '<li><a title="Rejoindre la page '.$i.'" href="'.$baseURL.'/page/'.$i.'/'.$qs.'">'.$i.'</a></li>';
            }
        }
        // le lien next si besoin
        if ( $page < $query->max_num_pages ) {
            echo '<li class="next_prev next"><a title="Passer à la page suivante (vous êtes à la page '.$page.')" href="'.$baseURL.'/page/'.($page+1).'/'.$qs.'">suivante »</a></li>';
        }
        echo '</ul>';
    }
}

/*************************************************************************/
    add_action('parse_query', 'changept');
    function changept()
    {
        $category = get_query_var('cat');
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (is_category() && !is_admin()) {
            set_query_var('cat', $category);
            set_query_var('paged', $paged);
            set_query_var('posts_per_page', 3);
            set_query_var('post_type', 'recettes');
        }
        return;
}
/* End of Fix Category Pagination */
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
