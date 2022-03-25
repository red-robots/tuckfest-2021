<?php
$obj = get_queried_object();
// echo '<pre>';
// print_r($obj);
// echo '</pre>';
$post_name = (isset($obj->post_name) && $obj->post_name) ? $obj->post_name : '';
$is_archive = ( isset($obj->taxonomy) && $obj->taxonomy ) ? $obj->taxonomy : '';
$id = get_the_ID(); 
$arrpage[3251] = 'Tuck Fest Insiders Guide';
$arrpage[1017] = 'Registration';
$arrpage[19] = 'Schedule';
$page_title = ( isset($arrpage[$id]) && $arrpage[$id] ) ? $arrpage[$id] : get_the_title();
$comingSoon = get_field('coming_soon');
$soon = ( isset($comingSoon[0]) ) ? $comingSoon[0] : '';


?>
<header class="special-title">
	<div class="wrapper">
    <?php 
    if($is_archive) {
      $page_title = ( isset($obj->name) && $obj->name ) ? $obj->name : '';
    } else if( is_404() ) {
      $page_title = 'Page Not Found!';
    }
    if($page_title) { ?>
      <h1 class="pageTitle"><span class="tan"><?php echo $page_title; ?></span></h1>
    <?php } ?>

    
    

	</div>
  <?php if ($post_name=='competitions' || $obj->post_type == 'competition') { 
    $registration = get_field("registration_link","option");
    ?>
      <?php if($soon !== 'soon') { ?>
        <div class="reg-wrap">
        <div class="registrationBtn">
          <a href="<?php echo $registration ?>" target="_blank" title="Click Here To Register"  class="register-btn"><span>Register</span></a>
        </div>
        </div>
    <?php } ?>
    <?php } ?>
</header>
