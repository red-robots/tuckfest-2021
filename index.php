<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 

// $post_id = $GLOBALS['pageID'];
// $postType = get_post_type($post_id);
// echo '<pre>';
// print_r($post_id);
// echo '</pre>';
?>
<?php 
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'home'));
	if ( have_posts() ) : the_post(); 
	 // echo get_the_ID();
		get_template_part('inc/banner');
    $pattern = "/<p[^>]*><\\/p[^>]*>/";

    if ( preg_replace($pattern, '', get_the_content()) ) { ?>
    <div class="boxed-content">
      <div class="wrapper">
        <div class="inside">
          <div class="text"><?php the_content(); ?></div>
        </div>
      </div>
    </div>  
    <?php } ?>

    <?php if( have_rows('tiles') ) { ?>
    <section class="home-tiles-new">
      <div class="wrapper">
        <div class="flexwrap">
          <?php $i=1; while( have_rows('tiles') ) : the_row(); 
          $link = get_sub_field('link');
          $img = get_sub_field('image');
          $icon = get_sub_field('icon');
          $title = get_sub_field('title');
          $helper = get_bloginfo('template_url') . '/images/rectangle-lg.png';
          $tile_class = ($i % 2) ? 'odd':'even';
          if($img) { ?>	
          <div class="home-tile <?php echo $tile_class ?>">
            <div class="inside">
            	<a href="<?php echo $link; ?>" class="tile-link">
                <?php if ($title) { ?>
                  <span class="title"><?php echo $title ?></span>
                <?php } ?>

                <?php if ($tile_class=='odd') { ?>

                  <?php if ($icon) { ?>
                    <span class="icon" style="background-image:url('<?php echo $icon['url'] ?>');">
                      <img src="<?php echo $helper ?>" alt="" class="helper">
                    </span>
                  <?php } ?>
                  <span class="image" style="background-image:url('<?php echo $img['url'] ?>')">
                    <img src="<?php echo $helper ?>" alt="" class="helper">
                  </span>

                <?php } else { ?>

                  <span class="image" style="background-image:url('<?php echo $img['url'] ?>')">
                    <img src="<?php echo $helper ?>" alt="" class="helper">
                  </span>

                  <?php if ($icon) { ?>
                    <span class="not-visible icon" style="background-image:url('<?php echo $icon['url'] ?>');">
                      <img src="<?php echo $helper ?>" alt="" class="helper">
                    </span>
                  <?php } ?>

                <?php } ?>
               

                <?php if ($icon || $title) { ?>
                <span class="icon-and-title">
                  <span class="title-inner">

                    <?php if ($icon) { ?>
                    <span class="middle icon" style="background-image:url('<?php echo $icon['url'] ?>');">
                      <img src="<?php echo $helper ?>" alt="" class="helper">
                    </span>
                    <?php } ?>

                    <?php if ($title) { ?>
                    <span class="middle title">
                      <?php echo $title ?>
                    </span>
                    <?php } ?>

                  </span>
                </span>
                <?php } ?>

            	</a>
            </div>
          </div>
          <?php } ?>
          <?php $i++; endwhile; ?>
        </div>
      </div>
    </section>
    <?php } ?>

<?php endif; ?>
<div class="wrapper">
	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			

			<div class="row social search">
				<div class="sub-row search social">
					<div class="search">
						<gcse:search></gcse:search>
					</div>
					<?php if( have_rows('social_links', 'option') ) : ?>
					<div class="social">
						<h3>Social Media</h3>
						<ul>
						<?php while( have_rows('social_links', 'option') ) : the_row();

							$icon = get_sub_field('icon', 'option');
							$link = get_sub_field('link', 'option');

						?>
							<li>
								<a href="<?php echo $link; ?>" target="_blank">
									<?php echo $icon; ?>
								</a>
							</li>
						<?php endwhile; ?>
						</ul>
					</div>
					<?php endif; 

					// $social_links = get_field('social_links', 'option');
					// echo '<pre>';
					// print_r($icon);
					// echo '</pre>';

					?>

					<?php  ?>
				</div>
				
			</div>  

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer();
