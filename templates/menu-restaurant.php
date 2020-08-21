<?php 
/*
Template Name: Menu Restaurant
 */
get_header();
?>

<h1 class="subtitle">Welcome</h1>
<h1 class="title all-caps">The Menu</h1>

<?php if( have_rows('menu_sections') ):
    while( have_rows('menu_sections') ) : the_row();

        // Get parent value.
        $section_title = get_sub_field('section_title');?>

        <div class="section-title-container">
            <h2 class="all-caps"><?= $section_title; ?></h2>
        </div>

        <ul>

        <?php // Loop over sub repeater rows.
        if( have_rows('section_items') ):
            while( have_rows('section_items') ) : the_row();

                // Get sub value.
                $nom_plat = get_sub_field('nom_plat');
                $prix_plat = get_sub_field('prix_plat');
                $desc_plat = get_sub_field('description_plat');
                $selection = get_sub_field('selection_du_chef'); ?>

                <li <?php if($selection == true){ echo "class='highlight'";} ?> >
                    <div>
                        <div class="nom-plat all-caps"><?= $nom_plat; ?></div>
                        <div class="dotted-line"></div>
                        <div class="prix-plat"><?= $prix_plat; ?>€</div>
                    </div>
                    <div class="muted-text"><?= $desc_plat; ?></div>
                </li>

            <?php endwhile;
        endif; ?>

        </ul>

    <?php endwhile;
endif; 

get_footer();?>