<?php
/**
 * Template Name: Artists
 * 
 *
 * @package ACStarter
 */

get_header(); 

get_template_part('inc/coming-soon');

get_template_part('inc/banner');

$comingSoon = get_field('coming_soon');
$soon = ( isset($comingSoon[0]) ) ? $comingSoon[0] : '';
if($soon !== 'soon') : ?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post(); 
				//get_template_part('inc/special-title');
        get_template_part('inc/banner');
			endwhile; // End of the loop.$wp_query = new WP_Query();

			$wp_query->query(array(
				'post_type'=> 'music',
				'posts_per_page' => -1,
				'orderby'   => 'menu_order',
				'order'     => 'ASC'
			));
			if ($wp_query->have_posts()) :  ?>
      <div class="wrapper">
  			<section class="artists">
  				<?php while ($wp_query->have_posts()) :  $wp_query->the_post(); 

  					$hash = sanitize_title_with_dashes(get_the_title());

  				?>
  				
  					<div class="artists-tile wrapblock" id="<?php echo $hash; ?>">
  						<span id=""></span>
  						<header class="">
  							<?php the_title( '<h2 class="artist-title">', '</h2>' ); ?>
  						</header><!-- .entry-header -->
  						<?php 
  						if(has_post_thumbnail()) {
  							the_post_thumbnail('tile');
  						} else { ?>
  							<img src="<?php echo $comingSoon['url']; ?>">
  						<?php } ?>
  						<div class="showlater">
  							<span class="a-title"><?php the_title(); ?></span>
  							<?php the_content(); ?>
  						</div>
  					</div>
  					
  				<?php endwhile; ?>
  				<!-- 
  						The Dude
  						jquery for Artist Description
  				-->
  					<div id="dude" class="desc artist-desc">
  						<div class="art-close"><i class="fal fa-times fa-2x"></i></div>
  						<div class="art-contents"></div>
  					</div>
  			</section>
      </div>
			<?php endif; wp_reset_postdata(); ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
