<?php 
global $post; 
$ID = get_the_ID();
$url = get_permalink();
$showNav = true;
if(strpos($url,'/tuckfest-music/') !== false){
  $showNav = false;
}
if( page_has_subnav() ) {
  if( is_page() ) { 

  	if ( is_page() && $post->post_parent ) {
  		$ID = wp_get_post_parent_id($ID);
      // Get Child pages
      $pageArgs = array(
        'child_of' => $ID,
        'title_li' => '',
        'exclude'  => ''
      );
      if(  $showNav ) { ?>
      <nav class="subnav"id="js-tsn">
        <?php wp_list_pages($pageArgs); ?>
      </nav>
      <?php } ?>
    <?php
  	}

  } elseif( is_archive() ) {

  	$obj = get_queried_object();
  	$tax = ( isset($obj->taxonomy) && $obj->taxonomy ) ? $obj->taxonomy : '';
    if($tax) {
    	$catArgs = array(
    		'taxonomy' => $tax,
    		'title_li' => '',
    	);
      if( $tax != 'demo_clinic_type') { ?>
      	<nav class="subnav" id="js-tsn">
      		<?php //wp_list_categories($catArgs); ?>
      	</nav>
    	<?php } ?>
    <?php } ?>

  <?php } ?>

<?php } ?>

