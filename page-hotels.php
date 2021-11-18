<?php
/**
 * Template Name: Hotels
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('inc/coming-soon');
$comingSoon = get_field('coming_soon');
if($comingSoon[0] !== 'soon') :
?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); 

				get_template_part('inc/special-title');
				get_template_part('inc/banner');

			?>
			<div class="sub-wrapper">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!--<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header> .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
			</div>
			<?php endwhile; // End of the loop.?>
			<?php
			$wp_query = new WP_Query();
			$wp_query->query(array(
				'post_type'=>'hotel',
				'posts_per_page' => -1
			));
			if ($wp_query->have_posts()) : ?>
				<section class="types">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<?php include( locate_template('inc/article.php', false, false)); ?>
					<?php endwhile; ?>
				</section>
			<?php endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
