<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlipNewMedia
 */

get_header();
?>

	<main id="primary" class="site-main">
		
		<?php
		page_outside_content();
		$so = get_field('simple_page');	
		if($so=="YES") {
			echo "<div class='simple_page'>";
		}	
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );


		endwhile; // End of the loop.
		?>
		<?php 
		if($so=="YES") {
			echo "</div>";
		}	
		?>

	</main><!-- #main -->

<?php
get_footer();
