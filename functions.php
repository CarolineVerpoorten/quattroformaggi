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

/* Déclaration des Custom Post Type + Taxonomie pour type de recettes*/

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
            'has_archive' => 'recettes',
            'supports' => array('title','editor','thumbnail','excerpt','custom-fields','page-attributes','category'),
            'Menu_position' => 5,
            'Menu_icon' => 'dashicons-edit-page',
            'taxonomies' => array('recettes'),
            'capability_type' => array('recette','recettes'),
            'map_meta_cap' => true,
            'rewrite' => array(
                'slug' => 'recettes/%recettetype%', 'with_front' => true),
        );

        register_post_type('recettes',$args);

        $labels = array(
            'name' => 'Types',
            'singular_name' => 'Type',
            'all_items' => 'Tous les types',
            'edit_item' => 'Editer le type',
            'view_item' => 'Voir le type',
            'update_item' => 'Mettre à jour le type',
            'add_new_item' => 'Ajouter un nouveau type',
            'search_items' => 'Rechercher parmi les types',
            'popular_items' => 'Types les plus populaires',
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'meta_box_cb' => false,
            'show_in_rest' => true,
            'hierarchical' => true,
            'rewrite' => array(
                'slug' => 'recettes'
            ),
        );

        register_taxonomy('recettetype','recettes', $args);

        unset($labels);
        unset($args);
}

add_action('init','quattroformaggi_register_post_type');

/*************************************************************************/

/* Création des permaliens pour le Post Type et la taxonomie recettetype */

function recettetype_permalink_structure($post_link, $post) {
    if (false !== strpos($post_link, '%recettetype%')) {
        $projectscategory_type_term = get_the_terms($post->ID, 'recettetype');
        if (!empty($projectscategory_type_term))
            $post_link = str_replace('%recettetype%', array_pop($projectscategory_type_term)->
            slug, $post_link);
        else
            $post_link = str_replace('%recettetype%', 'uncategorized', $post_link);
    }
    return $post_link;
}

add_filter('post_type_link','recettetype_permalink_structure', 1, 2);

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

/* Récupération de la liste des toxonomies Recettes */

function recettes_get_taxonomies(){


    $recetteType = get_terms(array(
        'taxonomy' => 'recettetype',
        'hide_empty' => false,
    ));

    $typeArray = array(
        'name' => [],
        'slug' => [],
    );

    foreach($recetteType as $type){



        if(isset($type->name)){

            array_push($typeArray['name'], $type->name);
            array_push($typeArray['slug'], $type->slug);

        }
    }

    return $typeArray;
}

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

function inspiry_pagination( $query ) {
    echo "<div class='pagination'>";
    $big = 999999999; // need an unlikely integer
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url ( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'inspiry' ),
        'next_text' => __( '<i class="fa fa-angle-right"></i>', 'inspiry' ),
        'current' => max( 1, get_query_var ( 'paged' ) ),
        'total' => $query->max_num_pages,
    ) );
    echo "</div>";
}

function inspiry_update_taxonomy_pagination( $query ) {
    if ( is_tax( 'property-city' ) )  {

        // Theme options array
        global $inspiry_options;

        if ( $query->is_main_query() ) {

            // Get number of properties from theme options
            $number_of_properties = $inspiry_options['archive_properties_number'];

            if ( !$number_of_properties ) {
                $number_of_properties = 6;  // default number
            }

            $query->set ( 'posts_per_page', $number_of_properties );
        }
    }
}

add_action( 'pre_get_posts', 'inspiry_update_taxonomy_pagination' );
