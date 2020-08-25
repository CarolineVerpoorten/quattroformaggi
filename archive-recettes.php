<?php

/*
Template Name: Recettes
*/

get_header(); ?>

    <h1>La liste des recettes</h1>

<?php

$baseURL = "http://".$_SERVER['HTTP_HOST'];
$recetteType = get_terms(array(
        'taxonomy' => 'recettetype',
        'hide_empty' => false,
    ));


    foreach($recetteType as $type){

        echo '<a href="'.$baseURL.'/recettes/' . $type->slug .'">'.$type->name .'</a>';
        echo '<br>';
    }


    if(have_posts()){

        while(have_posts()):the_post();

        ?>


<article class="post">

    <h2><?php the_title(); ?></h2>
    <?php the_post_thumbnail('thumbnail'); ?>

    <?php


    $RecupCategoryRecette = get_field('categorie_recette');
    $ArrayImageRecette = get_field('image_recette');

    $titreRecette = get_field('titre_recette');
    $categoryRecette = $RecupCategoryRecette->name;
    $URLImageRecette = $ArrayImageRecette['url'];

    ?>

    <img src="<?php echo $URLImageRecette; ?>"/>
    <p><?php echo $categoryRecette; ?></p>
    <p><?php echo $titreRecette; ?></p>



    <p>
        <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
    </p>

</article>

<?php endwhile;

        recettes_pagination($wp_query);


    } else {
        echo '<p>Aucune recette à afficher</p>';
    };

get_footer(); ?>