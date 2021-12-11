<?php
/**
 * Template Name: Repeatable Block
 */

get_header(); 
?>
<div id="primary" class="content-area-full repeatable-blocks">
	<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); 
				get_template_part('inc/banner');
        $main_content = get_field("main_content");
        //$blocks = get_field("repeatable_block");
			?>
			<div class="wrapper pagecontent">
        <?php if ($main_content) { ?>
        <div class="entry-content">
          <?php echo anti_email_spam($main_content); ?>
        </div>
        <?php } ?>
				
        <?php if( have_rows('repeatable_block') ) { ?>
        <div class="repeatable-content-blocks">
          <?php $n=1; while ( have_rows('repeatable_block') ) : the_row(); 
            $title = get_sub_field('title');
            $text = get_sub_field('text');
            $buttons = get_sub_field('buttons');
            $image = get_sub_field('image');
            $column_class = ( ($title || $text) &&  $image ) ? 'half':'full';
            if( ($title || $text) ||  $image ) { ?>
            <div class="content-block <?php echo $column_class ?>">
              <?php if ( $title || $text ) { ?>
              <div class="textcol block">
                <div class="inside">
                  <?php if ($title) { ?>
                   <h2 class="rb_title"><?php echo $title ?></h2> 
                  <?php } ?>

                  <?php if ($text) { ?>
                   <div class="rb_content"><?php echo anti_email_spam($text); ?></div> 
                  <?php } ?>

                  <?php if ($buttons) { ?>
                   <div class="rb_buttons">
                     <?php foreach ($buttons as $btn) { 
                      $b = $btn['button'];
                      $btn_target = ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_self';
                      $btn_text = ( isset($b['title']) && $b['title'] ) ? $b['title'] : '';
                      $btn_link = ( isset($b['url']) && $b['url'] ) ? $b['url'] : '';
                      if( $btn_text && $btn_link ) { ?>
                        <a href="<?php echo $btn_link ?>" targe="<?php echo $btn_target ?>" class="btn2"><?php echo $btn_text ?></a>
                      <?php } ?>
                     <?php } ?>
                   </div> 
                  <?php } ?>
                </div>
              </div> 
              <?php } ?>

              <?php if ( $image ) { ?>
              <div class="imagecol block">
                <img src="<?php echo $image['url'] ?>" alt=" <?php echo $image['title'] ?>">
              </div> 
              <?php } ?>
            </div>
            <?php } ?>
          <?php endwhile; ?>
        </div>
        <?php } ?>

			</div>
			<?php endwhile; ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
