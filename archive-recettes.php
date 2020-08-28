<?php

/*
Template Name: Recettes
*/

get_header(); ?>

<?php

?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="bannerrecettes">
            <div class="bannerrecettes__image">
                <img class="bannerrecettes__image--attrib" src="../wp-content/themes/quattroformaggi/img/resto1.jpg"/>
            </div>
            <img class="imghachures" src="/wp-content/themes/quattroformaggi/img/hachures-grises.png"/>

            <div class="bannerrecettes__subtitles">
                <h2 class="bannerrecettes__subtitles--text">
                    La sélection du chef
                </h2>
            </div>
            <div class="bannerrecettes__title">
                <h1 class="bannerrecettes__title--text">
                    Les recettes
                </h1>
            </div>
            <div class="bannerrecettes__link">
                <div class="bannerrecettes__link__line"></div>
                <a class="bannerrecettes__link--text" href="#">Voir le menu</a>
            </div>
        </div>
    </div>
        <div class="recettesmenu">
<?php
$baseURL = "http://".$_SERVER['HTTP_HOST'];
$recetteType = get_categories(array(
        'category' => 'recettes',
        'hide_empty' => false,
    ));
    echo '<div class="recettesmenu__item">';
        echo '<img class="recettesmenu__image margey" src="/wp-content/themes/quattroformaggi/img/svg/cutelry.svg" alt="Cutelry icon"/>';
        echo '<a href="'.$baseURL.'/recettes/">Toutes les recettes</a>    ';
    echo '</div>';
    foreach($recetteType as $type){

        if($type->slug != 'default_cat' && $type->slug !='restaurant'){
        echo '<div class="recettesmenu__item">';
            echo '<img class="recettesmenu__image margey" src="/wp-content/themes/quattroformaggi/img/svg/cutelry.svg" alt="Cutelry icon"/>';
            echo '<a href="'.$baseURL.'/categorie/' . $type->slug .'">'.$type->name .'</a>    ';
        echo '</div>';
        }
    }?>

        </div>
    <div class="recetteslist">

<?php
    if(have_posts()){ ?>
        <?php
        while(have_posts()):the_post();


        ?>



<article class="recetteslist__single">

    <?php


    $RecupCategoryRecette = get_field('categorie_recette');
    $ArrayImageRecette = get_field('image_recette');
    $date = get_the_date();
    $titreRecette = get_field('titre_recette');
    $categoryRecette = $RecupCategoryRecette->name;
    $URLImageRecette = $ArrayImageRecette['url'];
    $description = get_field('description_recette')

    ?>


    <img  class="recetteslist__single--image"src="<?php echo $URLImageRecette; ?>"/>
    <div class="recetteslist__single__date">
        <img  class="recetteslist__single__date--image" src="/wp-content/themes/quattroformaggi/img/svg/time-clock.svg" alt="Clock icon""/>
        <p class="recetteslist__single__date--text"><?php echo $date; ?></p>
    </div>
    <p class="recetteslist__single--category"><?php echo $categoryRecette; ?></p>
    <p class="recetteslist__single--titre"><?php echo $titreRecette; ?></p>
    <p class="recetteslist__single--description"><?php echo $description; ?></p>



    <p>
        <a  class="recetteslist__single--link" href="<?php the_permalink(); ?>">Lire la suite</a>
    </p>

</article>


<?php endwhile;?>
</div>
        <?php recettes_pagination($wp_query);


    } else {
        echo '<p>Aucune recette à afficher</p>';
    };

get_footer(); ?>