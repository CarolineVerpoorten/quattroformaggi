

<?php get_header(); ?>


<?php
$baseURL = "http://".$_SERVER['HTTP_HOST'];
$recetteType = get_the_category();

$RecupCategoryRecette = get_field('categorie_recette');
$ArrayImageRecette = get_field('image_recette');
$date = get_the_date();
$titreRecette = get_field('titre_recette');
$categoryRecette = $RecupCategoryRecette->name;
$URLImageRecette = $ArrayImageRecette['url'];
$description = get_field('description_recette');
$ingredients = get_field('ingredients_recette');
$instructionArray = get_field('liste_instructions_recette');
$nbInstructions = count($instructionArray);


if( have_posts() ) : while( have_posts() ) : the_post();?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="bannerrecette">
            <div class="bannerrecette__top">
                <i class="fas fa-long-arrow-alt-left margey bannerrecette__top__icon"></i>
                    <?php echo '<a class="bannerrecette__top__lien" href="'.$baseURL.'/categorie/' . $recetteType[0]->slug .'">Retour</a>'; ?>
                <div class="row mt15">
                    <p class = "bannerrecette__top__date"><?php echo $date; ?></p>
                    <img class="bannerrecette__top__image margey" src="/wp-content/themes/quattroformaggi/img/svg/cutelry.svg" alt="Cutelry icon"/>
                    <p class ="bannerrecette__top__categorie margey"><?php echo $categoryRecette ?></p>
                </div>
            </div>
            <div class="bannerrecette__title">
            <h1><?php echo $titreRecette; ?></h1>
            </div>
            <div class="bannerrecette__description">
                <p><?php echo $description; ?></p>
            </div>
            <div class="bannerrecette__image">
                <img src="<?php echo $URLImageRecette; ?>"/>
            </div>
            <img class="imghachures" src="/wp-content/themes/quattroformaggi/img/hachures-noires.png"/>
        </div>

    <div class="contentrecette">
        <div class="contentrecette__ingredients">
                <h2 class="contentrecette__ingredients--title"> Ingrédients </h2>
            <div class="contentrecette__ingredients--list">
                    <?php echo $ingredients; ?>
            </div>
        </div>
        <div class="contentrecette__instructions">
            <h2 class="contentrecette__instructions--title"> Instructions </h2>

                        <?php

            for($i=0; $i<=($nbInstructions-1); $i++){

                $instruction = $instructionArray[$i]['texte_instructions_recette'];
                $instructionImage = $instructionArray[$i]['image_instructions_recette'];
                $instructionImageURL = $instructionImage['url'];

//                echo $instruction; ?>

                <div class="row">
                    <p class="contentrecette__instructions__number">
                    <?php echo ($i+1); ?>
                    </p>

                    <?php echo $instruction;?>

                    <?php if($instructionImageURL){ ?>
                        </div>
                        <div>
                        <?php echo '<img class="contentrecette__instructions--image" src="'. $instructionImageURL .'"/><br>';

                    }

                echo '</div>';
            }

            ?>
<!--            --><?php //echo var_dump($instructionArray); ?><!--<br>-->
<!--            --><?php //echo $nbInstructions; ?>
        </div>
    </div>
</div>


<?php
endwhile; endif;

get_footer();
?>