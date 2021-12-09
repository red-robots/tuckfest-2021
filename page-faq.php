<?php
/**
 * Template Name: FAQ's
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
 ?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); 
        get_template_part('inc/special-title');
				get_template_part('inc/banner');
			?>
				<div class="wrapper">
					<div class="entry-content">
						<?php //the_content(); ?>
						<section class="faqs">
						<?php /*
						     ------------------------------------
						        FAQ's
						   ------------------------------------*/ ?>
						 <?php if( have_rows('faqs') ): ?>
						     <?php while ( have_rows('faqs') ) : ?>
						         <?php the_row(); ?>
						                    
						            <div class="faqrow">
						               <div class="question">
						               <div class="plus-minus-toggle collapsed"></div>
						               <?php the_sub_field('question'); ?></div>
						               <div class="answer"><?php the_sub_field('answer'); ?></div>
						            </div><!-- faqrow -->
						<?php endwhile; endif; // end faq's ?>
					</div>
				</div>
			<?php endwhile; // End of the loop.
			?></section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
