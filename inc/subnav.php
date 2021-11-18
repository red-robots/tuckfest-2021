<?php 
global $post; 
$ID = get_the_ID();
// echo $ID.' - ';


if( is_page() ) : 

	if ( is_page() && $post->post_parent ) {
		$ID = wp_get_post_parent_id($ID);
	}

	// Get Child pages
	$pageArgs = array(
		'child_of' => $ID,
		'title_li' => '',
		'exclude'  => ''
	);

	 if( $post->post_parent )  { ?>
		<nav class="subnav"id="js-tsn">
			<?php wp_list_pages($pageArgs); ?>
		</nav>
		<!-- <div class="drops">
			<div class="select">
				<div class="select-styled blue"><?php the_title(); ?></div>
				<ul class="select-options blue">
					<?php wp_list_pages($pageArgs); ?>
				</ul>
			</div>
		</div> -->
	<?php } ?>

<?php 
elseif( is_archive() ) :

	$obj = get_queried_object();
	$tax = $obj->taxonomy;
	// echo $tax;
	$catArgs = array(
		'taxonomy' => $tax,
		'title_li' => '',
	);
	?>
	<?php if( $tax != 'demo_clinic_type') { ?>
	<nav class="subnav" id="js-tsn">
		<?php wp_list_categories($catArgs); ?>
	</nav>
	<!-- <div class="drops">
		<div class="select">
			<div class="select-styled blue"><?php echo $obj->name; ?></div>
			<ul class="select-options blue">
				<?php wp_list_categories($catArgs); ?>
			</ul>
		</div>
	</div> -->
	<?php } ?>
<?php endif; ?>