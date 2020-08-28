<?php

/*
Template Name: Categorie de recettes
*/

get_header(); ?>

<?php

$baseURL = "http://".$_SERVER['HTTP_HOST'];
$recetteType = get_categories(array(
    'category' => 'recettes',
    'hide_empty' => false,
));

echo '<a href="'.$baseURL.'/recettes/">Toutes les recettes</a><br>    ';
foreach($recetteType as $type){

    if($type->slug != 'default_cat' && $type->slug !='restaurant')
        echo '<a href="'.$baseURL.'/categorie/' . $type->slug .'">'.$type->name .'</a><br>';
}

$getCategory = get_the_category();
$category = $getCategory[0]->name;

?>



<?php

if(have_posts()){?>
    <h1> <?php echo $category; ?></h1>
    <?php
    while(have_posts()):the_post();

        ?>


            <article class="post">

            <?php


            $RecupCategoryRecette = get_field('categorie_recette');
            $ArrayImageRecette = get_field('image_recette');
            $date = get_the_date();
            $titreRecette = get_field('titre_recette');
            $categoryRecette = $RecupCategoryRecette->name;
            $URLImageRecette = $ArrayImageRecette['url'];
            $description = get_field('description_recette')

            ?>

            <img src="<?php echo $URLImageRecette; ?>"/>
            <p><?php echo $date; ?></p>
            <p><?php echo $categoryRecette; ?></p>
            <p><?php echo $titreRecette; ?></p>
            <p><?php echo $description; ?></p>


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