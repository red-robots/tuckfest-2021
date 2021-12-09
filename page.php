<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
					get_template_part('inc/special-title');
					get_template_part('inc/banner');
					$regLink = get_field('registration_link', 'option');
				?>
					<div class="wrapper pagecontent">
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
