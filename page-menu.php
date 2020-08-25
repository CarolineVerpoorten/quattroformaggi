<?php 
/*
Template Name: Menu Restaurant
 */
get_header(); 
$image = get_field('image');?>

<div class="banner-container" <?php if( !empty( $image ) ):?>style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url($image['url']); ?>');"<?php endif;?>> 

    <div class="banner-text banner-subtitle" style="color: #FFF;"><?= the_field('sous-titre'); ?></div>
    <div class="banner-text banner-title all-caps" style="color: #FFF;"><?= the_field('titre'); ?></div>
    <div class="banner-text banner-link"><hr class="line"/><a href="#" class="proper-link">Order online</a></div>

</div>

<div class="hachures">
    <img class="bordure-hachure"src="https://raw.githubusercontent.com/becodeorg/LIE-Jepsen-3.20/master/02-the-hill/06-wordpress/project/assets/images/hachures-blanches.png?token=APOXPWZHSGUATKTHO4ABFBS7JYNH6" />
</div>

<div class="menu-body">

    <div class="center">
        <div class="subtitle">Welcome</div>
        <h1 class="title all-caps">The Menu</h1>
    </div>

    <?php if( have_rows('menu_sections') ):
        while( have_rows('menu_sections') ) : the_row();

            // Get parent value.
            $section_title = get_sub_field('section_title');?>

            <div class="section-title-container center">
                <div class="all-caps section-title"><?= $section_title; ?></div>
            </div>

            <ul class="menu-center">

            <?php // Loop over sub repeater rows.
            if( have_rows('section_items') ):
                while( have_rows('section_items') ) : the_row();

                    // Get sub value.
                    $nom_plat = get_sub_field('nom_plat');
                    $prix_plat = get_sub_field('prix_plat');
                    $desc_plat = get_sub_field('description_plat');
                    $selection = get_sub_field('selection_du_chef'); ?>

                    <?php if($selection == true){ echo "<div class='chef-selection all-caps'>chef selection</div>";} ?>
                    <li class="<?php if($selection == true){ echo 'highlight';}else{ echo 'not-highlight';} ?>" >
                        <div class="flex-container">
                            <div class="nom-plat all-caps"><?= $nom_plat; ?></div>
                            <hr class="dotted"/>
                            <div class="prix-plat"><?= $prix_plat; ?>€</div>
                        </div>
                        <div class="muted-text"><?= $desc_plat; ?></div>
                    </li>

                <?php endwhile;
            endif; ?>

            </ul>

        <?php endwhile;
    endif; ?>

</div>

<?php get_footer();?>