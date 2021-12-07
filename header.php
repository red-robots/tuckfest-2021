<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Crimson+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>

<!-- Google Tag Manager USNWC -->
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PLX2GN6');
</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-47534226-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-47534226-1');
</script>



<!-- Google Tag Manager -->
<script>
// (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
// new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
// j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
// 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore…
// })(window,document,'script','dataLayer','GTM-WJWJ742');
</script>
<!-- End Google Tag Manager -->

<?php 

wp_head(); 

$GLOBALS['pageID'] = get_the_ID();

$alert = get_field('toggle_on', 'option');
$alert = (isset($alert[0]) && $alert[0]) ? $alert[0] : '';
$alert_message = get_field('alert_message', 'option');
$text_color = get_field('text_color', 'option');
$background_color = get_field('background_color', 'option');
$link_color = get_field('link_color', 'option');
?>
<style type="text/css">
	.alert {
		width: 100%;
		position: relative;
		float: left;
		text-align: center;
		padding: 20px ;
		font-size: 22px;
	}
	@media screen and (min-width: 650px) {
		.alert {
			font-size: 28px;
		}
	}
	.alert {
		color: <?php echo $text_color; ?>
	}
	.alert {
		background-color: <?php echo $background_color; ?>
	}
	.alert a {
		color: <?php echo $link_color; ?>
	}
</style>
</head>

<body <?php body_class('theme2021'); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PLX2GN6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page" class="site">
<div id="dimmer"></div>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<!-- <div class="mobile-header-scroll">
				<div class="">
	            	<a href="<?php bloginfo('url'); ?>">
		            	<img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
		            </a>
		            <div class="event-date-mobile">
			        	<?php the_field('event_date', 'option'); ?>
			        </div>
	            </div>
			</div> -->
      <div class="mobile-wrapper">
        <div class="logo desktop">
          <a href="<?php bloginfo('url'); ?>">
            <?php if ( is_home() || is_front_page() ) { ?>
              <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
            <?php } else { ?>
              <?php if ( $sp_logo = get_field("subpageLogo","option") ) { ?>
                <img src="<?php echo $sp_logo['url'] ?>" alt="<?php bloginfo('name'); ?>">
              <?php } else { ?>
                <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
              <?php } ?>
            <?php } ?>
          </a>
        </div>
      </div>
			
		

		<div class="eyeglass">
			<a class="colorbox" href="#search">
				<img src="<?php bloginfo('template_url'); ?>/images/eyeglass.png">
			</a>
		</div>

		<div style="display: none;">
			<div id="search">
				<?php get_search_form(); ?>
			</div>
		</div>

		<?php get_template_part('inc/navmobile'); ?>		
				 
		<?php
      get_template_part('inc/nav-main');
      get_template_part('inc/subnav');
			//wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
    ?>
		
		
		</div><!-- wrapper -->
	</header><!-- #masthead -->

	<div id="content" class="site-content ">

		<?php 
	/*
		Alert message added for the Coronavirus.

	*/
	if( $alert == 'on' ) { ?>
		<div class="alert">
			<?php echo $alert_message; ?>
		</div>
	<?php } ?>

	<?php 
	$id = array();
  $ID = 0;
	if(27 == $post->post_parent ) { // About
		$id[] = 'has parent';
	} elseif(978 == $post->post_parent ) { // Music
		$id[] = 'has parent';
	} elseif(21 == $post->post_parent ) { // buy
		$id[] = 'has parent';
	}
	if( $id != '') {
		if ( is_page() && $post->post_parent ) {
			$ID = wp_get_post_parent_id($ID);
		}

		// Get Child pages
		$pageArgs = array(
			'child_of' => $ID,
			'title_li' => ''
		);

		 if( $post->post_parent )  { ?>
			<div class="drops">
				<div class="select">
					<div class="select-styled blue"><?php the_title(); ?></div>
					<ul class="select-options blue">
						<?php wp_list_pages($pageArgs); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
	<?php } ?>