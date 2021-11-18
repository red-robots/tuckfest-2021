<?php
/**
 * Da Banner
 *
 */ 
// echo $term->term_id;
// if($term->term_id != '') {
//  $term = $term->term_id;
// } else {
//  $term = get_queried_object();
// }
// echo $term;
// echo '<pre>';
// print_r($term);
// echo '</pre>';
// $flexslider = get_field( 'flexslider_banner');
// if( is_page('home') ) {
//  $homeClass = 'home';
// } else {
//  $homeClass = '';
// }
// echo '<pre>';
// print_r($flexslider);
// echo '</pre>';

$homeClass = ( is_page('home') ) ? 'home':'subpage';
?>
<?php
/**
 * Sidebar-banner.php
 *
 */ ?>
<div id="banner" class="banner-<?php echo $homeClass ?>">
  <?php 
  $flexslider = get_field( "flexslider_banner" );
  $showImg = get_field('show_image');
  $imgOverlay = get_field('image_overlay');
  if ( $flexslider ): ?>
    <div class="flexslider">
      <ul class="slides">
      <?php if( is_page('home') && $showImg == 'yes' ) { ?>
        <div class="logo-w-date">
          <img src="<?php echo $imgOverlay['url']; ?>">
        </div>
        
      <?php } ?>
        <?php for ($i = 0; $i< count($flexslider) ; $i++ ):
        $row = $flexslider[$i]; ?>
          <?php if ( strcmp( $row['video_or_image'], "video" ) === 0 && ($row['video']||$row['native_video']) ): ?>
            <li>
              <div class="iframe-wrapper <?php echo ($row['mobile_video']||$row['mobile_image'])?'yes-mobile':'no-mobile';?>">
                                <?php if($row['link']):?>
                    <a href="<?php echo $row['link']; ?>" <?php if ( $row['target'] ):echo 'target="_blank"'; endif; ?>></a>
                <?php endif;?>
                  <?php if($row['native_video']):?>
                    <video class="desktop" autoPlay loop muted playsinline>
                      <source src="<?php echo $row['native_video'];?>" type="video/mp4">
                    </video>
                  <?php elseif($row['video']):?>
                    <iframe class="desktop" src="<?php echo $row['video']; ?>" webkitallowfullscreen mozallowfullscreen allowfullscreen="true"
                      frameborder="0"></iframe>
                  <?php endif;
                  if($row['mobile_video']):?>
                    <video class="mobile" autoPlay loop muted playsinline>
                      <source src="<?php echo $row['mobile_video'];?>" type="video/mp4">
                    </video>
                  <?php elseif($row['mobile_image']):?>
                    <img class="mobile <?php if($i!==0) echo 'lazy';?>" <?php if($i!==0) echo 'data-';?>src="<?php echo $row['mobile_image']['url']; ?>"
                        alt="<?php echo $row['mobile_image']['alt']; ?>">
                  <?php endif;?> 
              </div><!--.iframe-wrapper-->
            </li>
          <?php elseif ( strcmp( $row['video_or_image'], "image" ) === 0 && $row['image'] ): ?>
            <li>
              <div class="image-wrapper <?php echo $row['mobile_image']?'yes-mobile':'no-mobile';?>"
                   style="background-image: url(<?php if($row['mobile_image']):
                     echo $row['mobile_image']['url'];
                   else:
                                     echo $row['image']['url'];
                   endif;?>);">
                                <?php if($row['link']):?>
                    <a href="<?php echo $row['link']; ?>" <?php if ( $row['target'] ):echo 'target="_blank"'; endif; ?>>
                <?php endif;?>
                                        <img class="desktop <?php if($i!==0) echo 'lazy';?>" <?php if($i!==0) echo 'data-';?>src="<?php echo $row['image']['url']; ?>"
                       alt="<?php echo $row['image']['alt']; ?>">
                                        <?php if($row['mobile_image']):?>
                                            <img class="mobile <?php if($i!==0) echo 'lazy';?>" <?php if($i!==0) echo 'data-';?>src="<?php echo $row['mobile_image']['url']; ?>"
                                                 alt="<?php echo $row['mobile_image']['alt']; ?>">
                                        <?php endif;?>
                                <?php if($row['link']):?>
                    </a>
                                <?php endif;?>
              </div><!--.image-wrapper-->
            </li>
          <?php endif; ?>
        <?php endfor; ?>
      </ul>
    </div><!--.flexslider-->
  <?php endif; ?>
</div><!--#banner-->