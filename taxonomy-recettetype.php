<?php

/*
Template Name: Recettes
*/

get_header();


?>
    <h1>Taxonomy des recettes</h1>
<p>testestestestestest</p>
<?php

$baseURL = "http://".$_SERVER['HTTP_HOST'];

//var_dump($_SERVER);
$recetteType = get_terms(array(
    'taxonomy' => 'recettetype',
    'hide_empty' => false,
));

$actualTaxo = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

echo '<a href="'.$baseURL.'/recettes/"> Toutes les catégories</a><br>';

foreach($recetteType as $type){

    if($actualTaxo->slug != $type->slug){
        echo '<a href="'.$baseURL.'/recettes/' . $type->slug .'">'.$type->name .'</a>';
    echo '<br>';
    }
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

    global $wp_query;
    inspiry_pagination( $wp_query ); // custom pagination function

} else {
    echo '<p>Aucune recette à afficher</p>';
}



get_footer(); ?>