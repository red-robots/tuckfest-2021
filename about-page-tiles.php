<?php 
$i=0;
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'page',
	'post_parent' => 27, // about page
);
$query = new WP_Query($args);
if( $query->have_posts() ) :
 ?>
 <div class="entries-wrapper">
    <div class="entries-inner">
		 <div class="entries">
			<?php while ( $query->have_posts() ) : $query->the_post(); $i++; ?>
				<div class="entry animated fadeIn">
					<div class="pad">
						<div class="image">
							<a href="<?php echo get_permalink(); ?>">
							<?php 
							if(has_post_thumbnail()) {
								the_post_thumbnail('tile');
							} else { ?>
								<img src="<?php echo $comingSoonURL; ?>" alt="" aria-hidden='true'>
							<?php } ?>
							</a>  
						</div>
						<div class="info">
							<h2 class="title">
								<a href="<?php echo get_permalink(); ?>">
									<?php the_title() ?>
								</a>
							</h2>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
<?php endif; ?>
	</div>
</div>