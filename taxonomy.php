<?php

get_header(); ?>

    <h1>taxonomy.php</h1>

<?php

$baseURL = "http://".$_SERVER['HTTP_HOST'];
$recetteType = get_categories(array(
    'category' => 'recettes',
    'hide_empty' => false,
));


foreach($recetteType as $type){

    if($type->slug != 'default_cat')
        echo '<a href="'.$baseURL.'/' . $type->slug .'">'.$type->name .'</a><br>';
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

    recettes_pagination();


} else {
    echo '<p>Aucune recette à afficher</p>';
};

get_footer(); ?>