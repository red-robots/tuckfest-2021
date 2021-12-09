<?php
/**
 * Template Name: Photos
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
$i=0;
?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); //$i++;
			 
				get_template_part('inc/banner');

				$regLink = get_field('registration_link', 'option');
			?>
				<!--<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header> .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div>


					<section class="photo-gallery">
						<?php 

						$gallery = get_field('gallery');

						foreach ( $gallery as $image ) { 

							// echo '<pre>';
							// print_r($image);
							// echo $i;
							// echo '</pre>';

							if( $image['caption'] ) {
								$output = $image['caption'];
								$class='youtube';
								$i++;
							} else {
								$output = $image['url'];
								$class='gallery';
							}
							

							?>
							<div class="gal-thumb">
								<?php if( $image['caption'] ) { ?>
									<a class="<?php echo $class; ?>" href="#video-<?php echo $i; ?>">
										<img src="<?php echo $image['sizes']['tile']; ?>">
									</a>
								<?php } else { ?>
									<a class="<?php echo $class; ?>" href="<?php echo $output; ?>">
										<img src="<?php echo $image['sizes']['tile']; ?>">
									</a>
								<?php } ?>
									
								</div>

								<?php if( $image['caption'] ) { ?>
									<div style="display: none;">
										<div id="video-<?php echo $i; ?>" class="video">
											<?php echo wp_oembed_get($output); ?>
										</div>
									</div>
								<?php } ?>

						<?php }
						 ?>
					</section>


			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
