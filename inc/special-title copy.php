<header class="special-title">
	<div class="wrapper">
		<?php 
		if( is_page(3251) ) { // Tuck Fest Insiders Guide ?>
			<h1 class="">
				<span class="tan">Tuck Fest</span>
				<span class="orange">Insider's</span>
				<span class="dark-orange">Guide</span>
			</h1>
			<div class="waves">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/waves.png">
			</div>
		<?php } elseif( is_page(1017) ) { // Race and Comp Registration ?>
			<h1 class="">
				<span class="tan small center">Race and Comp</span>
				<span class="orange center">Registration</span>
			</h1>
			<div class="dots">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/dots.png">
			</div>
		<?php } elseif( is_page(19) ) { // Race and Comp Registration ?>
			<h1 class="">
				<span class="tan ">Schedule</span>
			</h1>
			<div class="waves">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/waves.png">
			</div>
		<?php } else { ?>
			<h1 class="">
				<span class="tan "><?php the_title(); ?></span>
			</h1>
			<div class="waves">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/waves.png">
			</div>
		<?php } ?>
	</div>
</header>