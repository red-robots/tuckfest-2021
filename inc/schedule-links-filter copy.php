<?php 
// echo '<pre>';
// print_r($terms);
// echo '</pre>';
$i=0; 
/*
################   First we Query the Day ##############

*/
// we'll store terms in this array so we don't repeat buttons of the same name.
$first = array();
$args = array(
	'post_type'=> array('yoga','demo_clinic', 'competition','music'),
	'posts_per_page' => -1,
	'post_status' => array( 'publish', 'private' ),
);
$wp_query = new WP_Query();
$wp_query->query($args);
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
	<select class="option-set clearfix"  data-filter-group="day">
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
				// if we havn't added the day into the array, add it. Let's not repeat ourselves.
				if( !in_array($day, $second) ) {
					$second[] = $day;
				}
			}
		}

	endwhile; 
endif; 

// let's get music and yoga in here manually just because
$second[] = 'Music';
$second[] = 'Demos';
$second[] = 'Yoga';


// echo '</pre>';
// print_r($second);
// echo '</pre>';

// alphabetize the dropdown.
sort($second);

// we Queried Everything for the Day's now let's create the buttons.


?>

	<!-- <h2 class="filter-title">Filter By Activity Type:</h2> -->

	<!-- <div class="button-group group2 filters-button-group" data-filter-group="type"> -->
	<select class="option-set clearfix"  data-filter-group="type">
			<!-- <button class="filbutton button showall is-checked" data-filter="*">show all</button> -->
			<option value="*" data-filter-value="" class="selected">All</option>
		<?php 
		
			foreach ($second as $button) { 
				// sanitize it.
				$filterString = sanitize_title_with_dashes($button);
				// grab the first 4 characters so multi names can still link
				// $str = substr($filterString, 0, 4);
				?>
				<!-- <button class="filbutton button" data-filter=".<?php echo $filterString; ?>"><?php echo $button; ?></button> -->

<option value="#filter-type-<?php echo $filterString; ?>" data-filter-value=".<?php echo $filterString; ?>"><?php echo $button; ?></option>			<?php }
		?>
		</select>
	<!-- </div> -->
</div>

<div id="outer-container" class="closed">
	<div id="container">
	<?php
	$args = array(
		'post_type'=> array('yoga','demo_clinic', 'competition','music'),
		'posts_per_page' => -1,
		'post_status' => array( 'publish', 'private' ),
	);
	$events = get_posts($args);
	$records = array();
	$final_lists = array();
	$day_option['thursday'] = array(
							'start'=>'thursday_time_p',
							'end'=>'thursday_time_p_end'
						);
	$day_option['friday'] = array(
							'start'=>'friday_time_p',
							'end'=>'friday_time_p_end'
						);
	$day_option['saturday'] = array(
							'start'=>'saturday_time_p',
							'end'=>'saturday_time_p_end'
						);
	$day_option['sunday'] = array(
							'start'=>'sunday_time_p',
							'end'=>'sunday_time_p_end'
						);
	if($events) {
		foreach($events as $e) {
			$theID = $e->ID;
			$eventName = $e->post_title;
			$terms = get_the_terms($theID, 'event_day');
			$activity = get_the_terms($theID, 'competition_type');
			$yogaDay = get_the_terms($theID, 'yoga_day');
			$postType = get_post_type($theID);
			$classes = array();

			if( $postType == 'music' ) {
				$classes[] = 'music ';
			}

			if( $postType == 'demo_clinic' ) {
				$classes[] = 'demos ';
			}

			if($activity) {
				foreach($activity as $term) {
					$slug = $term->slug;
					$classes[] = $slug.' ';
				}
			}

			if($terms) {
				foreach($terms as $term) {
					$classes[] = $term->slug . ' ';
				}
			}

			if($yogaDay) {
				foreach($yogaDay as $term) {
					$classes[] = $term->slug . ' ';
				}
			}

			if($terms) {
				foreach($terms as $term) {
					$slug = $term->slug;
					$day = $slug;
					if( array_key_exists($day, $day_option) ) {
						$start_field = $day_option[$day]['start'];
						$end_field = $day_option[$day]['end'];
						$startTime = get_field($start_field, $theID);
						$EndTime = get_field($end_field, $theID);
						$time_in_24_hour_format  = date("H:i", strtotime($startTime));
						$time_in_minutes = convert_time_to_minutes( $time_in_24_hour_format );
						$records[$slug][] = array(
									'post_id'=>$theID,
									'event_name'=>$eventName,
									'post_type'=>$postType,
									'day_name'=>$term->name,
									'day_slug'=>$slug,
									'start_time'=>$startTime,
									'end_time'=>$EndTime,
									'start_time_in_minutes'=>$time_in_minutes,
									'classes'=>$classes
								);
					}
					
				}
			}
			if($yogaDay) {
				foreach($yogaDay as $term) {
					$slug = $term->slug;
					$day = $slug;
					if( array_key_exists($day, $day_option) ) {
						$start_field = $day_option[$day]['start'];
						$end_field = $day_option[$day]['end'];
						$startTime = get_field($start_field, $theID);
						$EndTime = get_field($end_field, $theID);
						$time_in_24_hour_format  = date("H:i", strtotime($startTime));
						$time_in_minutes = convert_time_to_minutes( $time_in_24_hour_format );
						$records[$slug][] = array(
									'post_id'=>$theID,
									'event_name'=>$eventName,
									'post_type'=>$postType,
									'day_name'=>$term->name,
									'day_slug'=>$slug,
									'start_time'=>$startTime,
									'end_time'=>$EndTime,
									'start_time_in_minutes'=>$time_in_minutes,
									'classes'=>$classes
								);
					}
					
				}
			}

		}

		
		foreach ($day_option as $k => $v) {
			if( isset($records[$k]) ) {
				$arrs = $records[$k];
				$sorted = sortArray($arrs,'start_time_in_minutes','DESC');
				foreach($sorted as $item) {
					$final_lists[] = $item;
				}
			}
		}

	} ?>

		<?php if($final_lists) { ?>
			<?php foreach($final_lists as $row) {
				$post_id = $row['post_id']; 
				$eventName = $row['event_name'];
				$day = $row['day_name'];
				$day_slug = $row['day_slug'];
				$startTime = $row['start_time'];
				$EndTime = $row['end_time'];
				$postType = $row['post_type'];
				$classes_arr = ($row['classes']) ? array_unique($row['classes']) : '';
				//$classes = ($classes_arr) ? ( implode(' ', $classes_arr) ) : '';
				$classes = $day_slug;

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

				if( $postType == 'demo_clinic' ) {
					$classes .= ' demos';
				}

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
					$type = 'demos';
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
					if( $term == 'thursday') {
						$page = 'thursday-line-up';
					} elseif( $term == 'friday') {
						$page = 'friday-line-up';
					} elseif( $term == 'saturday') {
						$page = 'saturday-line-up';
					} elseif( $term == 'sunday') {
						$page = 'sunday-line-up';
					}
					$url = get_bloginfo('url').'/tuckfest-music/'.$page.'/#'.$hash;
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
							<?php echo $day; ?>
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
							<a href="<?php echo $url; ?>">
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




