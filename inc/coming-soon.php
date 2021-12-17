<?php 
$comingSoon = get_field('coming_soon');
$soon = ( isset($comingSoon[0]) ) ? $comingSoon[0] : '';
if( $soon== 'soon' ) { 
  $comingSoonText = get_field("coming_soon_custom_text");
  $text1 = ( isset($comingSoonText['text_tan']) && $comingSoonText['text_tan'] ) ? $comingSoonText['text_tan'] : get_the_title();
  $text2 = ( isset($comingSoonText['text_orange']) && $comingSoonText['text_orange'] ) ? $comingSoonText['text_orange'] : 'Coming';
  $text3 = ( isset($comingSoonText['text_dark_orange']) && $comingSoonText['text_dark_orange'] ) ? $comingSoonText['text_dark_orange'] : 'Soon';
  $texts = array($text1,$text2,$text3); 
  ?>
  <div class="coming-soon coming-soon-wrap">
  	<div class="lefty">
      <?php if( $texts && array_filter($texts) ) { ?>
  		<h2>
  			<span class="pagename tan"><?php echo $text1; ?></span>
  			<?php if ($text2) { ?><span class="pagename orange"><?php echo $text2; ?></span><?php } ?>
  			<?php if ($text3) { ?><span class="pagename dark-orange"><?php echo $text3; ?></span><?php } ?>
  		</h2>
      <?php } ?>
  	</div>
  	<div class="righty">
  		<div class="img">
  			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/trees.png">
  		</div>
  	</div>
  </div>
<?php } ?>