<?php
/**
 * Enqueue scripts and styles.
 */
function acstarter_scripts() {
	wp_enqueue_style( 
		'acstarter-style', 
		get_template_directory_uri() . '/style.css',
		array(), '4.33', 
			false 
		 );

	wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', false, '3.1.1', false);
		// wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2', true);
		wp_enqueue_script('jquery');

	
  /* replace if showing errors `vendors.js` */
	 wp_enqueue_script( 
			'acstarter-blocks', 
			get_template_directory_uri() . '/assets/js/vendors.js', 
			array(), '20120206', 
			true 
		);

    wp_enqueue_script( 
      'acstarter-select2', 
      get_template_directory_uri() . '/assets/js/vendors/select2.min.js', 
      array(), '4.1.0', 
      true 
    );

	 wp_enqueue_script( 
			'acstarter-custom', 
			get_template_directory_uri() . '/assets/js/custom.js', 
			array(), '20211215', 
			true 
		);

	wp_enqueue_script( 
		'font-awesome', 
		'https://use.fontawesome.com/8f931eabc1.js', 
		array(), '20180424', 
		true 
	);



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'acstarter_scripts' );