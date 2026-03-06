<?php

/*Template name:Industries*/

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

<?php $herodesc = get_field('hero-desc');  ?>


 <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <?php $title = get_the_title(); ?>
<h1 class="hero-title"><?php echo esc_html($title); ?></h1>
<div class="hero-description">
  <?php echo wp_kses_post($herodesc); ?>
    </div>
</div>
    <div class="hero-col hero-1-right">
     
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>

    <!-- Absolute text element relative to Row 1 -->
    
  </div>

</section>


<section class="industries">
    

    <?php if (!function_exists('have_rows')): ?>
      <p style="color:#c00">ACF is required for this template.</p>
      <?php the_content(); ?>
    <?php else: ?>

      <?php if (have_rows('industries')): ?>
        <div class="industries__grid">
          <?php while (have_rows('industries')): the_row();
            $title = trim((string) get_sub_field('title'));
            $url   = trim((string) get_sub_field('url'));
            $img   = (string) get_sub_field('image'); // assuming return = URL
            ?>
            <article class="ind-card" tabindex="0" aria-label="<?php echo esc_attr($title ?: 'Industry'); ?>">
              <!-- Hover banner -->
              <div class="ind-hero" style="<?php echo $img ? 'background-image:url(' . esc_url($img) . ');' : ''; ?>">
                <div class="ind-hero__overlay"></div>
                <?php if ($title): ?>
                  <h2 class="ind-hero__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
              </div>

              <!-- Body -->
              <div class="ind-body">
                <?php if ($title): ?>
                  <h3 class="ind-body__title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if (have_rows('items')): ?>
                  <ul class="ind-list">
                    <?php while (have_rows('items')): the_row();
                      $text = trim((string) get_sub_field('text'));
                      if ($text === '') continue; ?>
                      <li class="ind-list__item"><span class="ind-list__chev">›</span><?php echo esc_html($text); ?></li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>

                <?php if ($url): ?>
                  <a class="ind-btn" href="<?php echo esc_url($url); ?>">
                    <?php echo esc_html__('Δείτε περισσότερα', 'flipnewmedia-child'); ?>
                  </a>
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p><?php esc_html_e('No industries added yet.', 'flipnewmedia-child'); ?></p>
      <?php endif; ?>

    <?php endif; ?>
  </section>
  
  
  <?php 
  
  get_footer();
  ?>
  
<script>
document.addEventListener('DOMContentLoaded', function () {
  const cards = document.querySelectorAll('.ind-card');
  const mq = window.matchMedia('(max-width: 991px)');

  function setMobileMode() {
    cards.forEach(c => {
      c.classList.add('is-active');
      c.setAttribute('aria-expanded', 'true');
    });
  }

  function setDesktopMode() {
    cards.forEach(c => {
      c.classList.remove('is-active');
      c.removeAttribute('aria-expanded');
    });
  }

  function applyMode() {
    if (mq.matches) {
      setMobileMode();
    } else {
      setDesktopMode();
    }
  }

  // Initial apply
  applyMode();

  // Respond to viewport changes
  if (mq.addEventListener) {
    mq.addEventListener('change', applyMode);
  } else {
    // Safari <14
    mq.addListener(applyMode);
  }

  // Click handler: enabled only on desktop
  document.addEventListener('click', function (e) {
    if (mq.matches) return; // disable toggling on <=991px

    const card = e.target.closest('.ind-card');

    // close others
    document.querySelectorAll('.ind-card.is-active').forEach(c => {
      if (c !== card) c.classList.remove('is-active');
    });

    // toggle current (ignore clicks on CTA)
    if (card && !e.target.closest('.ind-btn')) {
      card.classList.toggle('is-active');
    }
  });
});
</script>