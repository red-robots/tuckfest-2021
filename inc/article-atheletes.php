<?php
$pId = get_the_ID();
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
$column_class = ( ($title || $text) &&  $image ) ? 'half':'full';
if( ($title || $text) ||  $image ) { ?>
<div class="content-block <?php echo $column_class.' '.$i; ?>">
  <?php if ( $title || $text ) { ?>
  <div class="textcol block athlete">
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


