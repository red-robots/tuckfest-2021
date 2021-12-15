<?php
$banner = get_field( "static_banner" );
if ( $banner ) { ?>
<div id="banner" class="banner-wrap subpage-banner">
 <div class="banner-inner">
   <img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>">
 </div>
</div>
<?php } ?>