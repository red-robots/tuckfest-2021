<?php
$i++;
$hash = sanitize_title_with_dashes(get_the_title());
if($i==2) {
	$class='right';
	$i=0;
} else {
	$class='left';
}

// echo '<pre>';
// print_r($eventComingSoon);
// echo '</pre>';

?>
<article id="<?php echo $hash; ?>" class="<?php echo $class; ?>">
	<div class="featured-image-mobile">
		<?php 
		if(has_post_thumbnail()) {
			the_post_thumbnail('tile');
		} else { ?>
			<img src="<?php echo $comingSoonImage['url']; ?>">
		<?php } ?>
	</div>
	<div class="copy">
		<header class="entry-header">
			<?php the_title( '<h1 class="">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		<!-- <div class="offset-border"></div> -->
		<div class="featured-image">
			<?php 
			if(has_post_thumbnail()) {
				the_post_thumbnail('tile');
			} else { ?>
				<img src="<?php echo $comingSoonImage['url']; ?>">
			<?php } ?>
		</div>
	</div>
</article><!-- #post-## -->