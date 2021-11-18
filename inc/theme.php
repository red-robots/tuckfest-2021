<?php
/**
 * Custom theme functions.
 *
 * 
 *
 * @package ACStarter
 */
function the_title_trim($title) {

  $title = esc_attr($title);

  $findthese = array(
    '#Protected:#',
    '#Private:#'
  );

  $replacewith = array(
    '', // What to replace "Protected:" with
    '' // What to replace "Private:" with
  );

  $title = preg_replace($findthese, $replacewith, $title);
  return $title;
}
add_filter('the_title', 'the_title_trim');
/*-------------------------------------
 new image size
---------------------------------------*/

add_image_size('tile', 350, 350, array('center', 'center'));



function wpsites_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 100 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );

/*-------------------------------------
	Custom client login, link and title.
---------------------------------------*/
function my_login_logo() { ?>
<style type="text/css">
  body.login div#login h1 a {
  	background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
  	background-size: 327px 67px;
  	width: 327px;
  	height: 67px;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Link
function loginpage_custom_link() {
	return the_permalink();
}
add_filter('login_headerurl','loginpage_custom_link');

/*-------------------------------------
	Favicon.
---------------------------------------*/
function mytheme_favicon() { 
 echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/images/favicon.ico" >'; 
} 
add_action('wp_head', 'mytheme_favicon');

/*-------------------------------------
	Adds Options page for ACF.
---------------------------------------*/
if( function_exists('acf_add_options_page') ) {acf_add_options_page();}

/*-------------------------------------
  Hide Front End Admin Menu Bar
---------------------------------------*/
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}
 /*-------------------------------------
  Move Yoast to the Bottom
---------------------------------------*/
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
/*-------------------------------------
  Custom WYSIWYG Styles

  If you are using the Plugin: MRW Web Design Simple TinyMCE

  Keep this commented out to keep from getting duplicate "Format" dropdowns

---------------------------------------*/
function acc_custom_styles($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'acc_custom_styles');


/*
* Callback function to filter the MCE settings


  But always use this to get the custom formats

*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
  $style_formats = array(  
    // Each array child is a format with it's own settings
    
    // A block element
    array(  
      'title' => 'Button',  
      'block' => 'span',  
      'classes' => 'reg-btn',
      'wrapper' => true,
      
    ),
    // inline color
    array(  
      'title' => 'Intro Text',  
      'inline' => 'span',  
      'classes' => 'intro-text',
      'wrapper' => true,
      
    ),
    //  array(
    //     'title' => 'Header 2',
    //     'format' => 'h2',
    // ),
    // array(
    //     'title' => 'Header 3',
    //     'format' => 'h3'
    // ),
    // array(
    //     'title' => 'Paragraph',
    //     'format' => 'p'
    // )
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
// Add styles to WYSIWYG in your theme's editor-style.css file
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
/*-------------------------------------
  Change Admin Labels
---------------------------------------*/
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News Item';
    //$submenu['edit.php'][15][0] = 'Status'; // Change name for categories
    //$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News';
        $labels->singular_name = 'News Item';
        $labels->add_new = 'Add News Item';
        $labels->add_new_item = 'Add News Item';
        $labels->edit_item = 'Edit News Item';
        $labels->new_item = 'News Item';
        $labels->view_item = 'View News Item';
        $labels->search_items = 'Search News';
        $labels->not_found = 'No News found';
        $labels->not_found_in_trash = 'No News found in Trash';
    }
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/*-------------------------------------
  Add a last and first menu class option
---------------------------------------*/

function ac_first_and_last_menu_class($items) {
  foreach($items as $k => $v){
    $parent[$v->menu_item_parent][] = $v;
  }
  foreach($parent as $k => $v){
    $v[0]->classes[] = 'first';
    $v[count($v)-1]->classes[] = 'last';
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'ac_first_and_last_menu_class');
/*-------------------------------------



 Limit File Size in Media Uploader




---------------------------------------*/
define('WPISL_DEBUG', false);

require_once ('wpisl-options.php');

class WP_Image_Size_Limit {

  public function __construct()  {  
      add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($this, 'add_plugin_links') );
      add_filter('wp_handle_upload_prefilter', array($this, 'error_message'));
  }  

  public function add_plugin_links( $links ) {
    return array_merge(
      array(
        'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/options-media.php?settings-updated=true#wpisl-limit">Settings</a>'
      ),
      $links
    );
  }

  public function get_limit() {
    $option = get_option('wpisl_options');

    if ( isset($option['img_upload_limit']) ){
      $limit = $option['img_upload_limit'];
    } else {
      $limit = $this->wp_limit();
    }

    return $limit;
  }

  public function output_limit() {
    $limit = $this->get_limit();
    $limit_output = $limit;
    $mblimit = $limit / 1000;


    if ( $limit >= 1000 ) {
      $limit_output = $mblimit;
    }

    return $limit_output;
  }

  public function wp_limit() {
    $output = wp_max_upload_size();
    $output = round($output);
    $output = $output / 1000000; //convert to megabytes
    $output = round($output);
    $output = $output * 1000; // convert to kilobytes

    return $output;

  }

  public function limit_unit() {
    $limit = $this->get_limit();

    if ( $limit < 1000 ) {
      return 'KB';
    }
    else {
      return 'MB';
    }

  }

  public function error_message($file) {
    $size = $file['size'];
    $size = $size / 1024;
    $type = $file['type'];
    $is_image = strpos($type, 'image');
    $limit = $this->get_limit();
    $limit_output = $this->output_limit();
    $unit = $this->limit_unit();

    if ( ( $size > $limit ) && ($is_image !== false) ) {
       $file['error'] = 'Image files must be smaller than '.$limit_output.$unit;
       if (WPISL_DEBUG) {
        $file['error'] .= ' [ filesize = '.$size.', limit ='.$limit.' ]';
       }
    }
    return $file;
  }

  public function load_styles() {
    $limit = $this->get_limit();
    $limit_output = $this->output_limit();
    $mblimit = $limit / 1000;
    $wplimit = $this->wp_limit();
    $unit = $this->limit_unit();


    ?>
    <!-- .Custom Max Upload Size -->
    <style type="text/css">
    .after-file-upload {
      display: none;
    }
    <?php if ( $limit < $wplimit ) : ?>
    .upload-flash-bypass:after {
      content: 'Maximum image size: <?php echo $limit_output . $unit; ?>.';
      display: block;
      margin: 15px 0;
    }
    <?php endif; ?>

    </style>
    <!-- END Custom Max Upload Size -->
    <?php
  }


}
$WP_Image_Size_Limit = new WP_Image_Size_Limit;
add_action('admin_head', array($WP_Image_Size_Limit, 'load_styles'));

/*-------------------------------------------------------------------------------
  Sortable Columns
-------------------------------------------------------------------------------*/

add_filter( 'manage_edit-page_columns', 'my_edit_movie_columns' ) ;

function my_edit_movie_columns( $columns ) {

  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => __( 'Pages' ),
    // 'startdate' => __( 'Course Start Date' ),
    'coming_soon' => __( 'Coming Soon' ),
    // 'courselocation' => __( 'Course Location' ),
    // 'date' => __( 'Date' )
  );

  return $columns;
}



add_action( 'manage_page_posts_custom_column', 'my_manage_movie_columns', 10, 2 );

function my_manage_movie_columns( $column ) {
  global $post;

  
  if($column == 'coming_soon')
  {
    // Set some variables to set how to show the dates.
    //$startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));

    $soon = get_field('coming_soon');
    // echo $soon;
    if($soon =='1') {
      echo 'Marked Coming Soon';
    } else {
      echo 'Live';
    }
    
    
    //echo 'ho';
  }
  elseif($column == 'courselocation')
  {
    $location = get_field('location');
    echo $location;
  }
  elseif($column == 'courselist')
  {
    $term = get_term( '72', 'visibility' );
    //$term = get_term( '366' 'visibility' );
    $visibility = $term->name;
    if( has_term( 'hidden', 'visibility' ) ) {
      echo $visibility;
    }
    
  }
}
add_action( 'quick_edit_custom_box', 'quick_edit_add', 10, 2 );
 
/**
 * Add Headline news checkbox to quick edit screen
 *
 * @param string $column_name Custom column name, used to check
 * @param string $post_type
 *
 * @return void
 */
// function quick_edit_add( $column_name, $post_type ) {
//     if ( 'coming_soon' != $column_name ) {
//         return;
//     }
 
//     printf( '
//         <input type="checkbox" name="coming_soon" class="coming_soon"> %s',
//         'Coming Soon'
//     );
// }

// add_action( 'save_post', 'save_quick_edit_data' );
 
/**
 * Save quick edit data
 *
 * @param int $post_id
 *
 * @return void|int
 */
// function save_quick_edit_data( $post_id ) {
//     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
//         return $post_id;
//     }
 
//     if ( ! current_user_can( 'edit_post', $post_id ) || 'page' != $_POST['post_type'] ) {
//         return $post_id;
//     }
 
//     $data = empty( $_POST['coming_soon'] ) ? 0 : 1;
//     update_post_meta( $post_id, 'coming_soon', $data );
// }
// add_action( 'admin_footer', 'quick_edit_javascript' );
 
/**
 * Pass headline news value to checked_headline_news javascript function
 *
 * @param array $actions
 * @param array $post
 *
 * @return array
 */
// function expand_quick_edit_link( $actions, $post ) {
//     global $current_screen;
 
//     if ( 'page' != $current_screen->post_type ) {
//         return $actions;
//     }
 
//     $data                               = get_post_meta( $post->ID, 'coming_soon', true );
//     $data                               = empty( $data ) ? 0 : 1;
//     $actions['inline hide-if-no-js']    = '<a href="#" class="editinline" title="';
//     $actions['inline hide-if-no-js']    .= esc_attr( 'Edit this item inline' ) . '"';
//     $actions['inline hide-if-no-js']    .= " onclick=\"checked_coming_soon('{$data}')\" >";
//     $actions['inline hide-if-no-js']    .= 'Quick Edit';
//     $actions['inline hide-if-no-js']    .= '</a>';
 
//     return $actions;
// }

/*-------------------------------------------------------------------------------
  Sortable Columns
-------------------------------------------------------------------------------*/

// function my_column_register_sortable( $columns )
// {
//   $columns['startdate'] = 'startdate';
//   return $columns;
// }

// add_filter("manage_edit-courses_sortable_columns", "my_column_register_sortable" );


// /* Only run our customization on the 'edit.php' page in the admin. */
// add_action( 'load-edit.php', 'my_edit_movie_load' );

// function my_edit_movie_load() {
//   add_filter( 'request', 'my_sort_movies' );
// }

// /* Sorts the movies. */
// function my_sort_movies( $vars ) {

//   /* Check if we're viewing the 'movie' post type. */
//   if ( isset( $vars['post_type'] ) && 'courses' == $vars['post_type'] ) {

//     /* Check if 'orderby' is set to 'duration'. */
//     if ( isset( $vars['orderby'] ) && 'startdate' == $vars['orderby'] ) {

//       /* Merge the query vars with our custom variables. */
//       $vars = array_merge(
//         $vars,
//         array(
//           'meta_key' => 'start_date',
//           'orderby' => 'meta_value_num'
//         )
//       );
//     }
//   }

//   return $vars;
// }

// function has_children() {
//   global $post;
//   return count( get_posts( array('post_parent' => $post->ID, 'post_type' => $post->post_type) ) );
// }