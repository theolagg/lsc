<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlipNewMedia
 */
 
  ?>
 

 
<footer id="colophon" class="site-footer">
		

		<aside class="footer-wrapper container-ext position-relative" role="complementary">	
		<div class="container">
		<div class="row">
		<div id="" class="col col-3 col-logo">
	<div id="fw1" class="footer_widget_1 widget-area"><?php dynamic_sidebar( 'fw1' ); ?></div>
</div>
	<div id="" class="col col-3 col-menu1">
		<div id="fw2" class="footer_widget_2 widget-area"><?php dynamic_sidebar( 'fw2' ); ?></div>
		</div>
		<div id="" class="col col-3 col-small">
		<div id="fw3" class="footer_widget_2 widget-area"><?php dynamic_sidebar( 'fw3' ); ?></div>
		</div>
		<div id="" class="col newsletter-col">
		<div id="fw4" class="footer_widget_3 widget-area"><?php dynamic_sidebar( 'fw4' ); ?></div>
		</div>
		
	   </div>
		</div>	
		
			<div class="footer-copyright ">
			<div class="container ">
			<div class="row py-3">
			<div class="col col-uf-left col-md">
				<div class="cpl">Copyright © <?php echo date('Y');?> wallypass.com  - All rights reserved.</div>	
				</div>
				<div class="col justify-end d-flex col-uf-right col-md">
			<div class="cpr">Made by <a href="https://www.flipnewmedia.com/" target="_blank">FLIPNEWMEDIA</a></div>
			</div>
			</div>
			</div>
			</div>
		</aside><!-- #footer-wrapper -->		 
	</footer><!-- #colophon --><!-- #colophon --><!-- #colophon -->

<img class="image-bottom" src="https://wallypass.com/wp-content/uploads/2025/10/Ellipse-26.png" >
<img class="image-bottom mob" src="https://wallypass.com/wp-content/uploads/2025/10/Ellipse-32-scaled.png" >
<?php wp_footer(); ?>




</div><!-- #page -->
</body>
</html>
 
 
 
 <script>
 jQuery(document).ready(function() {

jQuery(".newsletter_form").submit(function(e) {
	  e.preventDefault();
	  var newsletter_email = jQuery("#newsletter_email").val();
	  var oroi = jQuery('#newsletter_oroi').is(':checked');
	  if (newsletter_email == "") {
		jQuery('.newsletter_success').empty();
		jQuery('.newsletter_error').text("Please enter your email!");
	  } else if (!oroi) {
		jQuery('.newsletter_success').empty();
		jQuery('.newsletter_error').text("Please accept the terms of use!");
	  } else {
		jQuery('.newsletter_error').empty();
		jQuery.ajax({
		  type: 'POST',
		  url: 'https://wallypass.com/ajax/newsletter.php',
		  data: jQuery('.newsletter_form').serialize(),
		  success: function(data) {
			jQuery('.newsletter_success').text("You have successfully subscribed!");
			  jQuery("#newsletter_email").val('');
		  }
		});
	  }
	});
	
 });
 
 </script>