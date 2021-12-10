<?php
/**
 * Template Name: Contact
 * 
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
					//get_template_part('inc/special-title');
					get_template_part('inc/banner');
					$regLink = get_field('registration_link', 'option');
          $leftcol = get_field("leftcol_content");
          $rightcol = get_field("rightcol_content");
          $column_class = ($leftcol && $rightcol) ? 'half':'full';
				?>
					<div class="wrapper pagecontent">
						<div class="entry-content">
							<?php //the_content(); ?>

              <?php if ( $leftcol || $rightcol ) { ?>
              <div class="flexcol-content <?php echo $column_class ?>">

                <?php if ( $leftcol ) { ?>
                <div class="flexcol fl">
                  <div class="inside"><div class="wrap"><?php echo $leftcol ?></div></div>
                </div>
                <?php } ?>

                <?php if ( $rightcol ) { ?>
                <div class="flexcol fr">
                  <div class="inside"><div class="wrap"><?php echo $rightcol ?></div></div>
                </div>
                <?php } ?>

              </div> 
              <?php } ?>
						</div>
					</div>
				<?php endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
endif;
// get_sidebar();
get_footer();
