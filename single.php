<?php get_header(); ?>
<?php
/*
Template Name: Single Restaurant
*/
?>

<img class="top_hach" src="wp-content/themes/quatroformaggi/img/hachures-blanches.png" alt="Hachures">

<div class="top_title_group">
  <div class="top_subtitle">
    <h3>Welcome</h3>
  </div>
  <div class="top_title">
    <h2>The Presentation</h2>
  </div>
</div>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

  <article class="post">
    <?php if( get_field('photo') ): ?>
      <img class="top_image" src="<?php the_field('photo'); ?>" />
    <?php endif; ?>
    <h5><?php the_field('sur_titre'); ?></h5>
  	<h4><?php the_title(); ?></h4>
    <?php the_excerpt();?>
    <img class="top_image" src="wp-content/themes/quatroformaggi/img/plate1.png" alt="Plate">
    <h5><?php the_field('sur_titre'); ?></h5>
    <h4><?php the_title(); ?></h4>
    <?php the_field('description'); ?>
  </article>

<img class="middle_hach" src="wp-content/themes/quatroformaggi/img/hachures-grises.png" alt="Hachures">

<div class="top_title_group">
  <div class="top_subtitle">
    <h3>Find us</h3>
  </div>
  <div class="top_title">
    <h2>LOCATION</h2>
  </div>
</div>

<iframe src="https://www.google.com/maps?q=<?php the_field('location'); ?>&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

<?php endwhile; endif; ?>

<div class="top_title_group">
  <div class="top_subtitle">
    <h3>Submit Information to Place Order</h3>
  </div>
  <div class="top_title">
    <h2>RESERVE A TABLE</h2>
  </div>
</div>

<img class="top_image" src="wp-content/themes/quatroformaggi/img/plate2.png" alt="Plate">

<div class="form_res">
  <form class="form_item" action="index.html" method="post">
    <label for="name">Your Name</label><br>
    <input class="form_item" type="text" name="name" autocomplete="off" label="Your name" required="required" /><br>
    <label for="email">Your Email</label><br>
    <input class="form_item" type="text" name="email" autocomplete="off" label="Your name" required="required" /><br>
    <label for="phone">Phone Number</label><br>
    <input class="form_item" type="text" name="phone" autocomplete="off" label="Your name" required="required" /><br>
    <label for="people">Table For</label><br>
    <select name="people" class="form_item" required="required">
      <option value="1" selected="selected">1 Person</option>
      <option value="2">2 Persons</option>
      <option value="3">3 Persons</option>
      <option value="4">4 Persons</option>
    </select><br>
    <label for="place">Place</label><br>
    <select name="place" class="form_item" required="required">
      <option value="1" selected="selected">The Chef's Cafeteria - Liège</option>
      <option value="2">BeCentral Resto - Brussels</option>
      <option value="3">The Honkytonk - Houte-Si-Plout</option>
    </select><br>

  </form>
</div>
<?php get_footer(); ?>
