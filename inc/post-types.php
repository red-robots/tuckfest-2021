<?php 
/* Custom Post Types */

add_action('init', 'js_custom_init');
function js_custom_init() 
{
	
	// Register the Homepage Music
  
     $labels = array(
	'name' => _x('Music', 'post type general name'),
    'singular_name' => _x('Music', 'post type singular name'),
    'add_new' => _x('Add New', 'Music'),
    'add_new_item' => __('Add New Music'),
    'edit_item' => __('Edit Music'),
    'new_item' => __('New Music'),
    'view_item' => __('View Music'),
    'search_items' => __('Search Music'),
    'not_found' =>  __('No Music found'),
    'not_found_in_trash' => __('No Music found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Music'
  );
  $args = array(
	'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
	
  ); 
  register_post_type('music',$args); // name used in query


       $labels = array(
  'name' => _x('Competitions', 'post type general name'),
    'singular_name' => _x('Competition', 'post type singular name'),
    'add_new' => _x('Add New', 'Competition'),
    'add_new_item' => __('Add New Competition'),
    'edit_item' => __('Edit Competitions'),
    'new_item' => __('New Competition'),
    'view_item' => __('View Competitions'),
    'search_items' => __('Search Competitions'),
    'not_found' =>  __('No Competitions found'),
    'not_found_in_trash' => __('No Competitions found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Competitions'
  );
  $args = array(
  'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
  
  ); 
  register_post_type('competition',$args); // name used in query


       $labels = array(
  'name' => _x('Demos & Clinics', 'post type general name'),
    'singular_name' => _x('Demos & Clinic', 'post type singular name'),
    'add_new' => _x('Add New', 'Demos & Clinic'),
    'add_new_item' => __('Add New Demos & Clinic'),
    'edit_item' => __('Edit Demos & Clinics'),
    'new_item' => __('New Demos & Clinic'),
    'view_item' => __('View Demos & Clinics'),
    'search_items' => __('Search Demos & Clinics'),
    'not_found' =>  __('No Demos & Clinics found'),
    'not_found_in_trash' => __('No Demos & Clinics found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Demos & Clinics'
  );
  $args = array(
  'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
  
  ); 
  register_post_type('demo_clinic',$args); // name used in query



   $labels = array(
  'name' => _x('Yoga', 'post type general name'),
    'singular_name' => _x('Yoga', 'post type singular name'),
    'add_new' => _x('Add New', 'Yoga'),
    'add_new_item' => __('Add New Yoga'),
    'edit_item' => __('Edit Yoga'),
    'new_item' => __('New Yoga'),
    'view_item' => __('View Yoga'),
    'search_items' => __('Search Yoga'),
    'not_found' =>  __('No Yoga found'),
    'not_found_in_trash' => __('No Yoga found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Yoga'
  );
  $args = array(
  'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
  
  ); 
  register_post_type('yoga',$args); // name used in query

  $labels = array(
  'name' => _x('Athlete', 'post type general name'),
    'singular_name' => _x('Athlete', 'post type singular name'),
    'add_new' => _x('Add New', 'Athlete'),
    'add_new_item' => __('Add New Athlete'),
    'edit_item' => __('Edit Athlete'),
    'new_item' => __('New Athlete'),
    'view_item' => __('View Athlete'),
    'search_items' => __('Search Athlete'),
    'not_found' =>  __('No Athlete found'),
    'not_found_in_trash' => __('No Athlete found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Athletes'
  );
  $args = array(
  'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
  
  ); 
  register_post_type('athlete',$args); // name used in query


     $labels = array(
  'name' => _x('Hotels', 'post type general name'),
    'singular_name' => _x('Hotel', 'post type singular name'),
    'add_new' => _x('Add New', 'Hotel'),
    'add_new_item' => __('Add New Hotel'),
    'edit_item' => __('Edit Hotel'),
    'new_item' => __('New Hotel'),
    'view_item' => __('View Hotel'),
    'search_items' => __('Search Hotel'),
    'not_found' =>  __('No Hotel found'),
    'not_found_in_trash' => __('No Hotel found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Hotels'
  );
  $args = array(
  'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
  
  ); 
  register_post_type('hotel',$args); // name used in query


$labels = array(
  'name' => _x('F & B', 'post type general name'),
    'singular_name' => _x('F & B', 'post type singular name'),
    'add_new' => _x('Add New', 'F & B'),
    'add_new_item' => __('Add New F & B'),
    'edit_item' => __('Edit F & B'),
    'new_item' => __('New F & B'),
    'view_item' => __('View F & B'),
    'search_items' => __('Search F & B'),
    'not_found' =>  __('No F & B found'),
    'not_found_in_trash' => __('No F & B found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'F & B'
  );
  $args = array(
  'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
  
  ); 
  register_post_type('food_and_beverage',$args); // name used in query
  
  // Add more between here
  
  // & here
  
  } // close custom post type





/*
##############################################
  Custom Taxonomies
*/
add_action( 'init', 'build_taxonomies', 0 );
 
function build_taxonomies() {
// cusotm tax
  register_taxonomy( 'competition_type', 'competition',
  array( 
    'hierarchical' => true, // true = acts like categories false = acts like tags
    'label' => 'Competition Type', 
    'query_var' => true, 
    'rewrite' => true ,
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array( 'slug' => 'competition-type' ),
    '_builtin' => true
  ) );

  register_taxonomy( 'demo_clinic_type', 'demo_clinic',
  array( 
    'hierarchical' => true, // true = acts like categories false = acts like tags
    'label' => 'Demo Clinic Type', 
    'query_var' => true, 
    'rewrite' => true ,
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array( 'slug' => 'demo-clinic-type' ),
    '_builtin' => true
  ) );

  register_taxonomy( 'event_day', array('music', 'demo_clinic', 'competition', 'yoga'),
  array( 
    'hierarchical' => true, // true = acts like categories false = acts like tags
    'label' => 'Day', 
    'query_var' => true, 
    'rewrite' => true ,
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array( 'slug' => 'event-day' ),
    '_builtin' => true
  ) );

  register_taxonomy( 'yoga_day', 'yoga',
  array( 
    'hierarchical' => true, // true = acts like categories false = acts like tags
    'label' => 'Yoga Day', 
    'query_var' => true, 
    'rewrite' => true ,
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array( 'slug' => 'yoga-day' ),
    '_builtin' => true
  ) );

  register_taxonomy( 'athlete_type', 'athlete',
  array( 
    'hierarchical' => true, // true = acts like categories false = acts like tags
    'label' => 'Type', 
    'query_var' => true, 
    'rewrite' => true ,
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array( 'slug' => 'athlete-type' ),
    '_builtin' => true
  ) );
  
} // End build taxonomies