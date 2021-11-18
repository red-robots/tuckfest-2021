<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */
wp_reset_postdata();
// if ( is_front_page() ) {
// 	echo 'front page';
// } else {
// 	echo get_the_ID();
// }
	 


// echo '<pre>';
// var_dump($wp_query->query,get_queried_object()); die;
// set blank variables
// global $post;
// $obg = '';
// $obg = '';
// $obj = get_queried_object();
$post_id = $GLOBALS['pageID'];
$postType = get_post_type($post_id);
$hpID = get_the_ID();
// echo '<pre>';
// print_r($post_id);
// echo '</pre>';
// echo get_the_ID();
// die;

// $post = get_post($post_id); 
// $page = $post->post_name;
//// 1876=home 3251=insiders guide 19=Schedule 98=faq 1908=gallery 2625=accomedations 100=contact
//// 3034=vendors 2759=fnb 1017=race and comp reg 3445=chiped and timed events 529=terrace
$mtnPageArray = array(1876, 3251, 19, 98, 1908, 2625, 100, 3034, 2759, 1017, 529, 3445);
//// 3442=2020Artists
$tigerPageArray = array(3442);
//// 2131=Yoga
$yogaPageArray = array(2131);
// echo $obj->music;
if( $hpID == '1876' ) {
	$img = '-mountains.png';
} elseif( $postType == 'competition' ) {
	$img = '-peaks.png';
} elseif( $postType == 'music' ) {
	$img = '-tiger.png';
} elseif( $postType == 'yoga' ) {
	$img = '-yoga.png';
} elseif( $postType == 'demo_clinic' ) {
	$img = '-clinics.png';
} elseif( $postType == 'page' ) {
	if( in_array($post_id , $mtnPageArray) ) {
		$img = '-mountains.png';
	} elseif( in_array($post_id , $tigerPageArray) ) {
		$img = '-tiger.png';
	} elseif( in_array($post_id , $yogaPageArray) ) {
		$img = '-yoga.png';
	} else {
		$img = '-mountains.png';
	}
}
/* Pages not to show
*	3347 = lineup poster
*
*
*/
if( !is_page( array(3447) )) {
?>
<div class="bottom-graphic type-<?php echo $postType; ?>">
<?php  ?>
	<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/background<?php echo $img; ?>">
</div>
<?php } ?>

	</div><!-- #content -->

	<footer class="site-footer">
		<div class="wrapper footer-content">

		<?php if( have_rows('footer_sponsors', 'option') ) : ?>
			<div class="sponsors container rotator">
				<ul>
				<?php while( have_rows('footer_sponsors', 'option') ) : the_row();

					$icon = get_sub_field('icon', 'option');
					$link = get_sub_field('link', 'option');

				?>
						<li>
							<a href="<?php echo $link; ?>" target="_blank">
								<img src="<?php echo $icon['url']; ?>">
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php endif; ?>

      <div class="footer-info">
        <div class="wrap">
          <div class="brand-image">
            <a href="https://usnwc.org" target="_blank">
              <img src="<?php bloginfo('template_url'); ?>/images/whitewater-white.png">
            </a>
          </div>

          <div class="footLinks">
            <?php wp_nav_menu( array( 'menu' => 'Footer Links', 'container'=>false, 'menu_id' => 'footer-menu') ); ?>
          </div>
        </div>
      </div>

    </div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
