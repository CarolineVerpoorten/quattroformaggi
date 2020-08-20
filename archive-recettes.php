<?php

/*
Template Name: Recettes
*/

get_header(); ?>

<h1>La liste des recettes</h1>

<?php if(have_posts()):while(have_posts()):the_post(); ?>

<article class="post">

    <h2><?php the_title(); ?></h2>
    <?php the_post_thumbnail('thumbnail'); ?>

    <p class="post__meta">
        <?php

        $category = get_the_category();
        
        ?>
        <?php echo $category[0]->name; ?>
    </p>

    <?php the_excerpt(); ?>

    <p>
        <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
    </p>

</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>