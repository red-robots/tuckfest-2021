<?php get_header(); ?>
<?php get_template_part('inc/subpage-banner'); ?>

	<div id="primary" class="content-area-full single-competition">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
      <?php  
      $eventStartDate = get_field("eventStartDate");
      $start_date = ($eventStartDate) ? date('l, M d, Y',strtotime($eventStartDate)) . ' <span>&ndash;</span> ' . date('h:i a',strtotime($eventStartDate)) : '';
      ?>
      <div class="wrapper">
        <h2 class="entry-title"><?php the_title(); ?></h2>

        <?php if ($start_date) { ?>
        <ul class="tabs-info">
          <?php if ($start_date) { ?>
            <li><span class="orange nolink"><?php echo $start_date ?></span></li>
          <?php } ?>
            <li><span class="red"><a href="#">Register</a></span></li>
            <li><span class="gray"><a href="#">Past Results</a></span></li>
        </ul> 
        <?php } ?>

        <?php if ( get_the_content() ) { ?>
        <div class="event-info">
          <div class="pad"><?php the_content(); ?></div>
        </div> 
        <?php } ?>
      </div>

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
