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

// afficher les derniers articles d'une catégorie
// Utilisation : wppln_last_posts('ID DE LA CATEGORIE','NBRE DE POSTS A RETOURNER','AFFICHER LE RESUME');
function wppln_last_posts($cat_id,$nbr_post,$excerpt) {
	$query = new WP_Query("cat=$cat_id&posts_per_page=$nbr_post");
	echo '<ul>';
	while($query -> have_posts()) :
		$query->the_post();
		echo '<li><a href="'.the_permalink().'" rel="bookmark">'.the_title().'</a></li>';
		if($excerpt == 'true') :
			echo '<ul><li>'.the_excerpt().'</li></ul>';
		endif;
	endwhile;
	//wp_reset_postdata;
	echo '</ul>';
}

?>
