<?php
$pId = get_the_ID();
$posttype = get_post_type();
// $title = get_field('title');
// $text = get_field('text');
$title = get_the_title();
$text = get_the_content();
$buttons = get_field('buttons');
// $image = get_field('image');
// $image = get_the_post_thumbnail($pId, 'large');
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
// echo '<pre>';
// print_r($image);
// echo '</pre>';
$eventStartDate = get_field("eventStartDate");
 $start_date = ($eventStartDate) ? date('l, M d, Y',strtotime($eventStartDate)) . ' <span>&ndash;</span> ' . date('h:i a',strtotime($eventStartDate)) : '';
$santi = $santi = sanitize_title_with_dashes( get_the_title() );
if( $posttype === 'competition' ) {
  $terms = get_the_terms( get_the_ID(), 'competition_type');
  foreach ($terms as $t) {
  	$termName = $t->name;
  	$termID = $t->term_id;
  }
  $termLink = get_term_link( $termID );
}


$column_class = ( ($title || $text) &&  $image ) ? 'half':'full';
if( ($title || $text) ||  $image ) { ?>
<div id="<?php echo $santi; ?>" class="content-block <?php echo $column_class.' '.$i; ?>">
  <?php if ( $title || $text ) { ?>
  <div class="textcol block">
    <div class="inside">
      <?php if ($title) { ?>
       <h2 class="rb_title"><?php echo $title ?></h2> 
      <?php } ?>
      <?php if ($start_date) { ?>
        <h3 class="comp-date"><?php echo $start_date ?></h3>
      <?php } ?>
      <?php if ($text) { ?>
       <div class="rb_content"><?php echo anti_email_spam($text); ?></div> 
       		<div class="comp-footer">
	          	<?php if( $posttype === 'competition' ) { 
	          		echo '<div class="other-links-btn"><a href="'.get_bloginfo('url').'/competitions">See All Competitions</a></div>';
	          		echo '<div class="other-links-btn"><a href="'.$termLink.'">See All '.$termName.' Competitions</a></div>';
	          	} elseif( $posttype === 'yoga' ) { 
	          		echo '<div class="other-links-btn"><a href="'.get_bloginfo('url').'/tuckfest-yoga">See All Yoga</a></div>';
	          	} elseif( $posttype === 'demo_clinic' ) { 
	          		echo '<div class="other-links-btn"><a href="'.get_bloginfo('url').'/clinics">See All Clinics</a></div>';
	          	}
	          	?>
          	</div>
      <?php } ?>

      <?php if ($buttons) { ?>
       <div class="rb_buttons">
         <?php foreach ($buttons as $btn) { 
          $b = $btn['button'];
          $btn_target = ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_self';
          $btn_text = ( isset($b['title']) && $b['title'] ) ? $b['title'] : '';
          $btn_link = ( isset($b['url']) && $b['url'] ) ? $b['url'] : '';
          if( $btn_text && $btn_link ) { ?>
            <a href="<?php echo $btn_link ?>" targe="<?php echo $btn_target ?>" class="btn2 btn-green"><?php echo $btn_text ?></a>
          <?php } ?>
         <?php } ?>
       </div> 
      <?php } ?>
    </div>
  </div> 
  <?php } ?>

  <?php if ( $image ) { ?>
  <div class="imagecol block">
    <div class="imagediv" style="background-image:url('<?php echo $image ?>')">
      <img src="<?php echo $image ?>" >
    </div>
  </div> 
  <?php } ?>
</div>
<?php } ?>


