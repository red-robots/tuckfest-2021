<?php 
$i++;
$eventComingSoon=get_field('coming_soon');
$hash = sanitize_title_with_dashes(get_the_title());
if($i==2) {
	$class='rightz';
	$i=0;
} else {
	$class='leftz';
}
 ?>
<article id="<?php echo $hash; ?>" class="basic <?php echo $class; ?>">
	
	<div class="featured-image-mobile js-tileinfo">
		<header class="">
			<?php the_title( '<h2 class="mobile-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
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
		<div class="art-close js-closecopy"><i class="fal fa-times  fa-2x"></i></div>
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