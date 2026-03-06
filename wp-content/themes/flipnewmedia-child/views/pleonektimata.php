<?php

/*Template name:pleonektimata*/

get_header(); ?>


<?php
// Breadcrumbs (Yoast)
if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
  <section class="cs-breadcrumbs" role="navigation" aria-label="Breadcrumb">
    <div class="cs-breadcrumbs__inner">
      <?php yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); ?>
    </div>
  </section>
<?php endif; ?>

<?php $herodesc = get_field('hero-desc'); 
$fullcont = get_field('fullcont'); 
?>


 <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title"><?php the_title(); ?></h1>
<div class="hero-description">
  <?php echo wp_kses_post($herodesc); ?>
    </div>
</div>
    <div class="hero-col hero-1-right">
     
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>

    
  </div>

</section>




<section class="faqsec">
  
    
 <?php echo wp_kses_post($fullcont); ?>
    
</section>


<?php get_footer(); ?>
