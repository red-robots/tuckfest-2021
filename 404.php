<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ACStarter
 */

get_header(); 

	$fof = get_field('404_page', 'option');

?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				
				<div class="error">
					<img src="<?php echo $fof['url']; ?>">
				</div>
				
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
