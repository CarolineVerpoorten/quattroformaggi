<?php
/*
Template Name: Single Restaurant
*/

if( have_posts() ) : while( have_posts() ) : the_post();
  if( get_field('photo') ): ?>
    <img class="top_image" src="<?php the_field('photo'); ?>" />
  <?php endif; ?>
  <img class="top_hach" src="wp-content/themes/quatroformaggi/img/hachures-blanches.png" alt="Hachures">
  <?php get_header(); ?>

  <article class="post">
    <h3><?php the_field('sur_titre'); ?></h3>
		<h2><?php the_title(); ?></h2>
    <a href="#">check our menu</a>
    <?php the_excerpt(); ?>
  </article>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
