<?php
/**
 * Template Name: Clinics
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('inc/coming-soon');
$comingSoon = get_field('coming_soon');
$soon = ( isset($comingSoon[0]) ) ? $comingSoon[0] : '';
if($soon !== 'soon') :
?>
	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); 

			//get_template_part('inc/special-title');
      get_template_part('inc/banner'); 

			?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content pagecontent">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

			<?php endwhile; // End of the loop.?>
			<?php
			$i=0;
			$wp_query = new WP_Query();
			$wp_query->query(array(
				'post_type'=>'demo_clinic',
				'posts_per_page' => -1,
				'paged' => $paged,
				'facetwp' => true
				// 'tax_query' => array(
				// 	array(
				// 		'taxonomy' => 'yoga_day', // your custom taxonomy
				// 		'field' => 'slug',
				// 		'terms' => array( 'friday', 'saturday', 'sunday' ) // the terms (categories) you created
				// 	)
				// )
			));
			if ($wp_query->have_posts()) : ?>
				<?php //echo do_shortcode('[facetwp facet="clinic_day"]'); ?>
				<div class="repeatable-content-blocks">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
						<?php include( locate_template('inc/article.php', false, false)); ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
