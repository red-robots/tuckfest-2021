<?php 
$comingSoon = get_field('coming_soon');
if( isset($comingSoon[0]) ) {
  if($comingSoon[0] == 'soon') { ?>
  <div class="coming-soon">
  	<div class="lefty">
  		<h2>
  			<span class="pagename tan"><?php the_title(); ?></span>
  			<span class="pagename orange">Coming</span>
  			<span class="pagename dark-orange">Soon</span>
  		</h2>
  	</div>
  	<div class="righty">
  		<div class="img">
  			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/trees.png">
  		</div>
  	</div>
  </div>
  <?php }
} ?>