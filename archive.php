<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 

$comingSoonImage = get_field('coming_soon', 'option');
$soon = ( isset($comingSoon[0]) ) ? $comingSoon[0] : '';
?>
<div class="content-wrapper pagecontent">
	<div id="primary" class="content-area-full">
		<div class="wrapper pagecontent">
		<main id="main" class="site-main" role="main">

		<?php
		$obj = get_queried_object();
		$tax = $obj->taxonomy;
		// echo $tax;
		$catArgs = array(
			'taxonomy' => $tax,
			'title_li' => '',
		);
		?>
		<?php if( $tax != 'demo_clinic_type') { ?>
		<div class="drops">
			<div class="select">
				<div class="select-styled blue"><?php echo $obj->name; ?></div>
				<ul class="select-options blue">
					<?php wp_list_categories($catArgs); ?>
				</ul>
			</div>
		</div>
		<?php } 

		

		$i=0;
		if ( have_posts() ) : ?>

		<div id="banner">
		<?php 
			$banner = get_field('featured_image', $obj);
			// echo '<pre>';
			// print_r($banner);
			// echo '</pre>';
			if($banner) { ?>
				<img src="<?php echo $banner['url']; ?>">
			<?php } ?>
		</div>

		
			<!-- <header class="page-header">
				<h1 class="entry-title">
					<?php single_term_title(); ?>
				</h1>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</header>.page-header -->

			<div class="repeatable-content-blocks">
			<?php
			/* Start the Loop */
			$n=1;
			while ( have_posts() ) : the_post();

				

				// echo '<pre>';
				// print_r($eventComingSoon);
				// echo '</pre>';

				if( $soon != 'soon' ) : ?>

				<?php include( locate_template('inc/article.php', false, false)); ?>

			<?php 
			endif; // coming soon
			endwhile; ?>
			</div>

		<?php endif; ?>

		</main><!-- #main -->
	</div>
	</div><!-- #primary -->
</div>
<?php
// get_sidebar();
get_footer();
