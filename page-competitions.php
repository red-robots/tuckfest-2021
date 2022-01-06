<?php
/**
 * Template Name: Competitions
 */

get_header(); 
get_template_part('inc/coming-soon');
$comingSoon = get_field('coming_soon');
$soon = ( isset($comingSoon[0]) ) ? $comingSoon[0] : '';
if($soon !== 'soon') : ?>

<div id="primary" class="content-area-full competitions-page">
  <main id="main" class="site-main" role="main">
      <?php while ( have_posts() ) : the_post(); 
        get_template_part('inc/banner');
      ?>
      <div class="wrapper pagecontent">
        <?php if ( get_the_content() ) { ?>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <?php } ?>
      </div>
      <?php endwhile; ?>


      <?php 
      $filter_day = ( isset($_GET['day']) && $_GET['day'] ) ? $_GET['day'] : '';
      // $today = date('Y-m-d');
      // $time = date('H:i:s'); 
      $today = date('Y-m-d H:i:s');

      $args = array(
        'posts_per_page'  => -1,
        'post_type'       => 'competition',
        'post_status'     => 'publish',
        'facetwp' => true,
      );

      if( $filter_day ) {

        $args['tax_query'] = array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'event_day',
            'field'    => 'name',
            'terms'    => $filter_day,
          )
        );

        $args['meta_query'] = array(
         'relation' => 'AND',
          array(
           'key' => 'eventStartDate',
           'compare' => 'EXISTS',
          )
        );

        $args['orderby'] = 'meta_value';
        $args['order'] = 'DESC';

      } else {

        $args['meta_query'] = array(
         'relation' => 'OR',
          array(
           'key' => 'eventStartDate',
           'compare' => '>=',
           'value' => $today,
          ),
          array(
           'key' => 'eventStartDate',
           'compare' => '=',
           'value' => ''
          ),
          array(
           'key' => 'eventStartDate',
           'compare' => '=',
           'value' => NULL
          ),
          array(
           'key' => 'eventStartDate',
           'compare' => 'NOT EXISTS', // works!
           'value' => '' // This is ignored, but is necessary...
          ),
        );
        $args['orderby'] = 'meta_value';
        $args['order'] = 'DESC';
      }


      // echo "<pre>";
      // print_r($args);
      // echo "</pre>";
      

      $entries =  new WP_Query($args);
      // $comingSoon = get_field('coming_soon', 'option');
      // $comingSoonURL = ($comingSoon) ? $comingSoon['url'] : get_images_dir('competition-coming-soon.gif');
      
      ?>

      <div class="entries-wrapper">
        <div class="entries-inner">
        <?php if ( $entries->have_posts() ) {  $totalFound = $entries->found_posts; ?>
          
          <?php //include( locate_template('template-parts/competitions-filter-form.php') ); ?>
          
          <div class="filter-wrapper">
            <div class="filter-title">Filter By:</div>
            <?php echo do_shortcode('[facetwp facet="competition_type"]'); ?>
            <?php echo do_shortcode('[facetwp facet="competition_day"]'); ?>
          </div>
          
          <div class="entries">
            <?php while ( $entries->have_posts() ) : $entries->the_post(); 
              $eventStartDate = get_field("eventStartDate");
              $start_date = ($eventStartDate) ? date('l, M d, Y',strtotime($eventStartDate)) . '<span>&#8226;</span>' . date('h:i a',strtotime($eventStartDate)) : '';
            ?>
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
                  <h2 class="title"><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h2>
                  <?php if ($start_date) { ?>
                  <span class="date"><?php echo $start_date ?></span>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>

      <?php } else { ?>
        <div class="no-result">
          <?php include( locate_template('template-parts/competitions-filter-form.php') ); ?>
          <h2>No results found.</h2>
        </div>
      <?php } ?>
        </div>
      </div>

    </div>
  </main><!-- #main -->
</div><!-- #primary -->
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
  
});
</script>
<?php
get_footer();
