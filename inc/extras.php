<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
      $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
      $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
      $classes[] = 'homepage';
    } else {
      $classes[] = 'subpage';
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );

function get_page_id_by_template($fileName) {
  $page_id = 0;
  if($fileName) {
      $pages = get_pages(array(
          'post_type' => 'page',
          'meta_key' => '_wp_page_template',
          'meta_value' => $fileName.'.php'
      ));

      if($pages) {
          $row = $pages[0];
          $page_id = $row->ID;
      }
  }
  return $page_id;
}

function page_no_subnav($slug) {
  $no_subnav = array('faqs');
  return ( in_array($slug,$no_subnav) ) ? true : false;
}

function page_has_subnav() {
  $list = '';
  //$no_subnav = array('faqs');
  $no_subnav = array();
  if( is_page() ) {
    global $post;
    $post_id = $post->ID;
    $post_slug = $post->post_name;
    if ( is_page() && $post->post_parent ) {
      $ID = wp_get_post_parent_id($post_id);
      $pageArgs = array(
        'child_of' => $ID,
        'title_li' => '',
        'exclude'  => ''
      );
      ob_start();
      wp_list_pages($pageArgs);
      $list =  ob_get_contents();
      ob_end_clean();
    }

    if( in_array( $post_slug, $no_subnav) ) {
      $list = '';
    }

  } elseif( is_archive() ) {
    $obj = get_queried_object();
    $tax = ( isset($obj->taxonomy) && $obj->taxonomy ) ? $obj->taxonomy : '';
    if($tax) {
      $catArgs = array(
        'taxonomy' => $tax,
        'title_li' => '',
      );
      ob_start();
      wp_list_categories($catArgs);
      $list =  ob_get_contents();
      ob_end_clean();
    }
  }

  return ($list) ? true : false;
}

function getFullURL() {
  return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . 
                "://" . $_SERVER['HTTP_HOST'] . 
                $_SERVER['REQUEST_URI'];
}

function get_images_dir($fileName=null) {
    return get_bloginfo('template_url') . '/images/' . $fileName;
}


add_action('admin_head', 'my_admin_head_scripts');
function my_admin_head_scripts() { ?>
  <style type="text/css">
    .bws_shortcode_button_tooltip.wp-pointer-right {
      display: none;
    }
  </style>
<?php 
}

