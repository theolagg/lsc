<?php
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

<section class="archive-posts">

  
    <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title">Blog</h1>
<div class="hero-description">
<p>Ανακαλύψτε τον κόσμο των ψηφιακών πορτοφολιών και μείνετε ενημερωμένοι με τις τελευταίες <span>εξελίξεις και τάσεις στα mobile wallets.</span></p>
    </div>
</div>
    <div class="hero-col hero-1-right">
     
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>

    <!-- Absolute text element relative to Row 1 -->
    
  </div>

</section>

<section class="keep">

<h2> Μείνετε ενημερωμένοι </h2>

</section>


    <?php
    // AJAX LOAD MORE — uses the current archive query automatically
    // Make sure you have a repeater template named "post-card-grid" in ALM → Repeater Templates
    echo do_shortcode('[ajax_load_more
      archive="true"
      posts_per_page="9"
      scroll="false"
      button_label="Δείτε περισσότερα"
      transition_container_classes="post-grid"
      repeater="post-card-grid"
    ]');
    ?>

 
</section>

<?php get_footer(); ?>