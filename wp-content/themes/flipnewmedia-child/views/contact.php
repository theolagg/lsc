<?php
/*
Template Name: Contact
*/
get_header();
?>

<?php
// Breadcrumbs (Yoast)
if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
  <section class="cs-breadcrumbs" role="navigation" aria-label="Breadcrumb">
    <div class="cs-breadcrumbs__inner">
      <?php yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); ?>
    </div>
  </section>
<?php endif; ?>

<?php 

$herotitle    = get_field('hero-title');  
$herodescription = get_field('hero-description');    

?>


<section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title"><?php echo wp_kses_post($herotitle); ?></h1>
<div class="hero-description">
<?php echo wp_kses_post($herodescription); ?>
    </div>
</div>
    <div class="hero-col hero-1-right">
      <img src="https://wallypass.com/wp-content/uploads/2025/09/home-banner-image.png" alt="Digital passes preview" loading="eager" />
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      <img src="https://wallypass.com/wp-content/uploads/2025/10/adwaf-1.png" alt="Digital passes preview" loading="eager" />
    </div>

    <!-- Absolute text element relative to Row 1 -->
    
  </div>

</section>


<section class="contact-section">
  <div class="contact-inner">
    <?php echo do_shortcode('[contact-form-7 id="889bf3d" title="contact page"]'); ?>
  </div>
</section>


<?php get_footer(); ?>