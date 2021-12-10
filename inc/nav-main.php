<!-- Main Nav -->
<?php  
$currentURL = getFullURL();
$exclude_url_parts[] = '/competition-type/';
$exclude_url_parts[] = '/tuckfest-music/past-line-ups/';
//$exclude_url_parts[] = '/buy/';
$activeNav = '';
foreach($exclude_url_parts as $str) {
  if(strpos($currentURL,$str) !== false){
    $activeNav = ' active';
  }
}
?>
<nav id="site-navigation" class="main-navigation" role="navigation">
  <div class="wrapper">
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','link_before'=>'<span>','link_after'=>'</span>','container'=>false) ); ?>
  </div>
</nav>
<nav class="mobilemenu">
  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu-mobile','link_before'=>'<span>','link_after'=>'</span>','container'=>false) ); ?>
</nav>
<div id="subNavs"><div id="subnavdata" class="wrapper"></div></div>
