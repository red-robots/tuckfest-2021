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
$obj = get_queried_object();
$i=0;
	if ( have_posts() ) :
?>
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
	<div id="primary" class="content-area-full">
		<div class="wrapper pagecontent">
			<div class="anchors">
				<a href="#the-events">Deep Water Solo Events</a> | <a href="#the-atheletes">Atheletes</a>
			</div>
		<main id="main" class="site-main" role="main">

		<?php
		
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
		<?php } ?>


			<div id="the-events" class="repeatable-content-blocks">
			<?php
			/* Start the Loop */
			$n=1;
			while ( have_posts() ) : the_post();

				

				// echo '<pre>';
				// print_r($eventComingSoon);
				// echo '</pre>';
				

				if( $soon != 'soon' ) : ?>

				<?php include( locate_template('inc/article-deep-water-solo.php', false, false)); ?>

			<?php 
			endif; // coming soon
			endwhile; ?>
			</div>

		<?php endif; ?>

		<?php
			$wp_query = new WP_Query();
			$wp_query->query(array(
			'post_type'=>'athlete',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));
			if ($wp_query->have_posts()) : ?>
				<div id="the-atheletes" class="repeatable-content-blocks">
					<h2>Atheletes</h2>
		    		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
		    			if( $soon != 'soon' ) : 
							include( locate_template('inc/article-atheletes.php', false, false)); 
						endif;?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</main><!-- #main -->
	</div>
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
