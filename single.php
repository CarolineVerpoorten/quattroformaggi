<?php
/*
Template Name: Single Restaurant
*/
get_header();
if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <h1>Single restaurant</h1>

    <article class="post">
			<h2><?php the_title(); ?></h2>

        	<?php the_post_thumbnail(); ?>

            <p class="post__meta">
                Publié le <?php the_time( get_option( 'date_format' ) ); ?>
                par <?php the_author(); ?> • <?php comments_number(); ?>
            </p>

      		<?php the_excerpt(); ?>

      		<p>
                <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
            </p>
		</article>
		<p>
    	<strong>Avis :</strong>
    	<?php echo get_post_meta( get_the_ID(), 'titre', true ); ?>
		</p>

  <?php endwhile; endif; ?>
<?php get_footer(); ?>
