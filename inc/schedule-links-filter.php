<?php 
$i=0; 
/*
################   First we Query the Day ##############

*/
// we'll store terms in this array so we don't repeat buttons of the same name.
$first = array();

$wp_query = new WP_Query();
$wp_query->query(array(
	'post_type'=> array('yoga','demo_clinic', 'competition','music'),
	'posts_per_page' => -1,
	'post_status' => array( 'publish', 'private' ),
	
));
if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) :  $wp_query->the_post(); 
		// Get the ID and terms of each post
		$theID = get_the_ID();
		$terms = get_the_terms($theID, 'event_day');
		// foreach ($terms as $term) {
		// 	$day = $term->name;
		// 	// if we havn't added the day into the array, add it. Let's not repeat ourselves.
		// 	if( !in_array($day, $first) ) {
		// 		$first[] = $day;
		// 	}
		// }

		// The above works, but we're just going to do the days manually for now.
		$first = array('Thursday', 'Friday', 'Saturday', 'Sunday');

	endwhile; 
endif; 

// we Queried Everything for the Day's now let's create the buttons.

?>
<div id="filters" class=" filters">
	<h2 class="filter-title">Filter By:</h2>

	<!-- <div class="button-group group1 filters-button-group" data-filter-group="day"> -->
	<select id="filter_by_days" class="option-set clearfix"  data-filter-group="day">
			<!-- <button class="filbutton button showall is-checked" data-filter="*">show all</button> -->
			<option value="*" data-filter-value="" class="selected">All Days</option>
		<?php 
		
			foreach ($first as $button) { 
				// sanitize it.
				$filterString = sanitize_title_with_dashes($button);
				?>
				<!-- <button class="filbutton button" data-filter=".<?php echo $filterString; ?>"><?php echo $button; ?></button> -->
				<option value="#filter-day-<?php echo $filterString; ?>" data-filter-value=".<?php echo $filterString; ?>"><?php echo $button; ?></option>
			<?php }
		?>
		</select>
	<!-- </div> -->

<?php 
$i=0;
/*
################   Second we Query the Activity Type   ##############

*/
// we'll store terms in this array so we don't repeat buttons of the same name.
$second = array();
$altN = array();
$combo = array();

$wp_query = new WP_Query();
$wp_query->query(array(
	'post_type'=> array('yoga','demo_clinic', 'competition','music'),
	'posts_per_page' => -1,
	'post_status' => array( 'publish', 'private' ),
	// No specific tax terms because we're pulling everything.
));
if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) :  $wp_query->the_post(); 
		// Get the ID and terms of each post
		$theID = get_the_ID();
		$terms = get_the_terms($theID, 'competition_type');
		// $termsDemo = get_the_terms($theID, 'demo_clinic_type');
		
		// Loop through competition type
		if($terms){
			foreach ($terms as $term) {
				$day = $term->name;
				$altName = get_field('alt_name', $term);
				//echo $altName.'</br>';
				if( $altName == '' ) {
					$altName = $day;
				}
				
				// echo '<pre>';
				// print_r($term);
				// echo '</pre>';

				// if we havn't added the day into the array, add it. Let's not repeat ourselves.
				if( !in_array($day, array_column($second, 'name') ) ) {
					// old method for a simple array
					// $second[] = $day;

					// new method with Alt name for menu dropdown
					$second[] = array( 'name' => $day, 'alt' => $altName );
					
				}
			}
		}

	endwhile; 
endif; 

// $combo[] = array_merge($second, $altN);

// let's get music and yoga in here manually just because
$second[] = array( 'name' => 'Music', 'alt' => 'Music' );
$second[] = array( 'name' => 'Demos', 'alt' => 'Demos' );
$second[] = array( 'name' => 'Yoga', 'alt' => 'Yoga' );
$second[] = array( 'name' => 'Clinics', 'alt' => 'Clinics' );
$second[] = array( 'name' => 'Films', 'alt' => 'Films' );

// alphabetize the dropdown.

// old method
// sort($second);

// new method for multidimensional array
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


array_sort_by_column($second, 'name');

// echo '<pre>';
// print_r($second);
// echo '</pre>';

// we Queried Everything for the Day's now let's create the buttons.


?>

	<!-- <h2 class="filter-title">Filter By Activity Type:</h2> -->

	<!-- <div class="button-group group2 filters-button-group" data-filter-group="type"> -->
	<select id="filter_by_type" class="option-set clearfix"  data-filter-group="type" >
			<!-- <button class="filbutton button showall is-checked" data-filter="*">show all</button> -->
			<option value="*" data-filter-value="" class="selected">All</option>
		<?php 
		
			foreach ($second as $button) { 
				// sanitize it.
				$filterString = sanitize_title_with_dashes($button['name']);
				$bName = $button['alt'];
				// grab the first 4 characters so multi names can still link
				// $str = substr($filterString, 0, 4);
				?>
				<!-- <button class="filbutton button" data-filter=".<?php echo $filterString; ?>"><?php echo $button; ?></button> -->

<option value="#filter-type-<?php echo $filterString; ?>" data-filter-value=".<?php echo $filterString; ?>"><?php echo $bName; ?></option>			<?php }
		?>
		</select>
	<!-- </div> -->
</div>



	

<?php 
/*
################   Third we Query the All that will be filtered   ##############

*/ 
$newList = array();
$i=0; 
$wp_query = new WP_Query();
$arg = array(
	'post_type'=> array('yoga','demo_clinic', 'competition','music'),
	'posts_per_page' => -1,
	'post_status' => array( 'publish', 'private' ),
	'tax_query' => array(
		array(
			'taxonomy' => 'event_day', // your custom taxonomy
			'field' => 'slug',
			'terms' => array( 'thursday', 'friday', 'saturday', 'sunday' ) // the terms (categories) you created
		)
	)
);
$events = get_posts($arg);

// echo '<pre>';
// print_r($events);
// echo '</pre>';

$day_option['thursday'] = array(
						'start'=>'thursday_time_p',
						'end'=>'thursday_time_p_end',
						'music'=>'thursday-line-up'
					);
$day_option['friday'] = array(
						'start'=>'friday_time_p',
						'end'=>'friday_time_p_end',
						'music'=>'friday-line-up'
					);
$day_option['saturday'] = array(
						'start'=>'saturday_time_p',
						'end'=>'saturday_time_p_end',
						'music'=>'saturday-line-up'
					);
$day_option['sunday'] = array(
						'start'=>'sunday_time_p',
						'end'=>'sunday_time_p_end',
						'music'=>'sunday-line-up'
					);

$postList = array();
if ( $events ) {  
	foreach($events as $row) {
		// setup_postdata( $post );
		$theID = $row->ID;
		$postType = $row->post_type;
		$event_name = $row->post_title;

		/* List post according to day. */
		if($postType=='yoga') {
			$terms = get_the_terms($theID, 'yoga_day');
			foreach ( $terms as $term ) {
				$day = $term->slug;
				$postList[] = array(
								'day'=>$day,
								'post_id'=>$theID
							);
			}
		} else {
			$terms = get_the_terms($theID, 'event_day');
			foreach ( $terms as $term ) {
				$day = $term->slug;
				$postList[] = array(
								'day'=>$day,
								'post_id'=>$theID
							);
			}
		}

	}
} 

$eventList = array();
if($postList) {
	foreach($postList as $p) {
		$post_id = $p['post_id'];
		$day = $p['day'];
		if( array_key_exists($day, $day_option) ) {
			$start_field = $day_option[$day]['start'];
			$startTime = get_field($start_field,$post_id);

			/* Convert start time to 24-hour format. Then convert to minutes. */
			$time_in_24_hour_format  = date("H:i", strtotime($startTime));
			$time_in_minutes = convert_time_to_minutes( $time_in_24_hour_format );
			$p['start_in_minutes'] = $time_in_minutes;
			$eventList[$day][] = $p;
		}
	}
}


$records = array();
foreach($day_option as $day_name => $val ) {
	if( isset($eventList[$day_name]) ) {
		/* Re-order arrays according to start time in Ascending order. See functions.php */
		$list = sortArray( $eventList[$day_name],'start_in_minutes','ASC' ); 
		foreach($list as $itm) {
			$records[] = $itm;
		}
	}
}
?>

<div id="outer-container" class="closed">
<div id="container">

	<?php if($records) { ?>
		<?php foreach($records as $row) {
			$post_id = $row['post_id']; 
			$eventName = get_the_title($post_id);
			$postType = get_post_type($post_id);
			$day = $row['day'];
			$start_field = $day_option[$day]['start'];
			$startTime = get_field($start_field,$post_id);

			$end_field = $day_option[$day]['end'];
			$EndTime = get_field($end_field,$post_id);

			$classes = $day;

			$activity = get_the_terms($post_id, 'competition_type');
			if($activity) {
				foreach( $activity as $act ) {
					$act = $act->slug;
					$classes .= ' ' . $act;
				}
			}

			if( $postType == 'music' ) {
				$classes .= ' music';
			}
			// if( $postType == 'demo_clinic' ) {
			// 	$classes .= ' film';
			// }

			if( $postType == 'demo_clinic' ) {
				$termz = get_the_terms($post_id, 'demo_clinic_type');
				foreach ( $termz as $t ) {
					$classes .= ' '.$t->slug;
				}
				// $classes .= $post_id;
			}
			// $demC = get_the_terms($post_id, 'demo_clinic');
			// if($demC) {
			// 	foreach( $demC as $dem ) {
			// 		$dem = $dem->slug;
			// 		$classes .= ' ' . $dem;
			// 	}
			// }

			if( $postType == 'yoga' ) {
				$classes .= ' yoga';
			}


			$location = get_field('location',$post_id);

			// Instructor
			$instructor = get_field('instructor',$post_id);
			$instructorInfo = get_field('instructor_information',$post_id);

			// Map (in options)
			$mapLink = get_field('map_link', 'option');

			if( $postType == 'music') {
					$taxSlug = 'event-day';
					$tax = 'event_day';
					$type = 'Music';
			} elseif( $postType == 'competition') {
				$taxSlug = 'competition-type';
				$tax = 'competition_type';
				$type = '';
			} elseif( $postType == 'demo_clinic') {
				$taxSlug = 'demo-clinic-type';
				$tax = 'demo_clinic_type';
				$type = '';
			} elseif( $postType == 'yoga') {
				$taxSlug = 'yoga-day';
				$tax = 'yoga_day';
				$type = 'Yoga';
			}
			if( $tax != '' ) {
				$terms = get_the_terms($post_id, $tax );
				if($terms){
					$term = $terms[0]->slug;
				}
				// set the name
				if($type == '') {
					if($terms){$type = $terms[0]->name;}
				}
				$hash = sanitize_title_with_dashes( get_the_title($post_id) );
			}


				if( $postType == 'music' ) {
					$page = $day_option[$day]['music'];
					$url = get_bloginfo('url').'/tuckfest-music/'.$page.'/#'.$hash;
				} elseif( $postType == 'demo_clinic' ) {
					$url = get_bloginfo('url').'/clinics/#'.$hash;
				} else {
					$url = get_bloginfo('url').'/'.$taxSlug.'/'.$term.'/#'.$hash;
				} 

			?>
			<div class="item <?php echo $classes?>">
				<div class="card">
					<div class="info">
						<div class="title">
							<h2><?php echo $eventName; ?></h2>
						</div>
						<div class="info-item">
							<?php echo ucwords($day); ?>
						</div>
						<?php if($startTime) { ?>
							<div class="info-item">
								TIME: <?php 
									echo $startTime; 
									if( $EndTime != '') {
										echo ' - '.$EndTime;
									} ?>
							</div>
						<?php } ?>
						<?php if($location) { ?>
							<div class="info-item">
								LOCATION: <?php echo $location[0]; ?> <a href="<?php echo $mapLink; ?>">[MAP]</a>
							</div>
						<?php } ?>
						<?php if($instructor) { ?>
							<div class="info-item">
								INSTRUCTOR: <?php echo $instructor; ?>
							</div>
						<?php } ?>
						<div class="info-item">
							<a class="eventLinkp" href="<?php echo $url; ?>">
								Information & Description
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>

</div>
</div>

