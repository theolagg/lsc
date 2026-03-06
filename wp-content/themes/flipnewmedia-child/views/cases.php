<?php 

/* Template Name: cases */


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

 
 <div class="precases" style=""></div>
<?php
/**
 * Case Showcase – fixed phone with card stack + Slick content carousel
 */

$phone_frame  = get_field('cs_phone_frame_image' , 10); // optional
$slides_exist = have_rows('cs_slides' , 10);
if (!$slides_exist) return;

// Build arrays once (used both by slider + phone stack)
$slides = [];
while (have_rows('cs_slides', 10 )): the_row();
  $slides[] = [
    'bg'         => get_sub_field('bg_image'),
    'left_label' => get_sub_field('left_label'),
    'left_text'  => get_sub_field('left_text'),
    'cta_text'   => get_sub_field('cta_text'),
    'cta_url'    => get_sub_field('cta_url'),
    'right_title'=> get_sub_field('right_title'),
    'right_text' => get_sub_field('right_text'),
    'card'       => get_sub_field('phone_card'),
	'color_text' => get_sub_field('color_text'),
  ];
endwhile;

// Helper for image url/alt
$img = function($image, $key='url'){ return is_array($image) ? ($image[$key] ?? '') : (string)$image; };
$bg0 = $img($slides[0]['bg']);
?>

<section class="case-showcase" style="--cs-bg:url('<?php echo esc_url($bg0); ?>');">
  <div class="cs__container">

    <!-- Fixed phone shell with glass -->
    <div class="cs__phone">
      <?php if ($phone_frame): ?>
        <img class="cs__phone-frame" src="<?php echo esc_url($img($phone_frame)); ?>" alt="<?php echo esc_attr($img($phone_frame,'alt')); ?>" loading="eager">
      <?php else: ?>
        <!-- Fallback simple shell if no frame image is provided -->
        <div class="cs__phone-fallback">
          <div class="cs__notch"></div>
        </div>
      <?php endif; ?>

      <!-- Screen area with stacked cards -->
      <div class="cs__screen">
        <div class="cs__stack">
          <?php foreach ($slides as $i => $s):
            $card_url = esc_url($img($s['card']));
            $card_alt = esc_attr($img($s['card'],'alt'));
          ?>
            <div class="cs-card" data-stack-index="<?php echo $i; ?>">
              <?php if ($card_url): ?>
                <img src="<?php echo $card_url; ?>" alt="<?php echo $card_alt; ?>" loading="lazy" decoding="async">
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- subtle glass flare -->
      <div class="cs__glass"><img src="https://wallypass.com/wp-content/uploads/2025/10/Rectangle-118.png" ></div>
    </div>

    <!-- Slick carousel: content slides (bg/title/cta/etc) -->
    <div class="cs__slider js-cs-slider">
      <?php foreach ($slides as $i => $s): 
         $bg_url   = esc_url($img($s['bg']));
  $r_title  = isset($s['right_title']) ? $s['right_title'] : '';
  $cta_text = isset($s['cta_text']) ? $s['cta_text'] : '';
  $cta_url  = isset($s['cta_url']) ? $s['cta_url'] : '';
  $color    = isset($s['color_text']) ? $s['color_text'] : '';
      ?>
       <div
  class="cs-slide"
  data-index="<?php echo $i; ?>"
  data-bg="<?php echo $bg_url; ?>"
  data-right-title="<?php echo esc_attr($r_title); ?>"
  data-left-text="<?php echo esc_attr( wp_strip_all_tags($s['left_text'] ?? '') ); ?>"
  data-cta-text="<?php echo esc_attr($cta_text); ?>"
  data-cta-url="<?php echo esc_url($cta_url); ?>"
  data-color="<?php echo esc_attr($color); ?>"
 style="--slide-bg: url('<?php echo $bg_url; ?>');"
>
  <div class="cs-slide__grid">
  
  <?php if (!empty($s['left_label'])): ?>
                <h3 class="cs-left__label mob"><?php echo esc_html($s['left_label']); ?></h3>
              <?php endif; ?>
  
            <div class="cs-slide__left">
              <?php if (!empty($s['left_label'])): ?>
                <h3 class="cs-left__label"><?php echo esc_html($s['left_label']); ?></h3>
              <?php endif; ?>
              <?php if (!empty($s['left_text'])): ?>
                <div class="cs-left__text" style="color:<?php echo esc_html($s['color_text']); ?>;"><?php echo wp_kses_post($s['left_text']); ?></div>
              <?php endif; ?>
              <?php if (!empty($s['cta_text']) && !empty($s['cta_url'])): ?>
                <a class="cs-left__btn" href="<?php echo esc_url($s['cta_url']); ?>">
                  <?php echo esc_html($s['cta_text']); ?>
                </a>
              <?php endif; ?>
            </div>

            <div class="cs-slide__right">
              <?php if (!empty($s['right_title'])): ?>
                <h4 class="cs-right__title" style="color:<?php echo esc_html($s['color_text']); ?>;"><?php echo esc_html($s['right_title']); ?></h4>
              <?php endif; ?>
              <?php if (!empty($s['right_text'])): ?>
                <div class="cs-right__text" style="color:<?php echo esc_html($s['color_text']); ?>;"><?php echo wp_kses_post($s['right_text']); ?></div>
              <?php endif; ?>
			  
			  
            </div>
			             
          </div>
        </div>
      <?php endforeach; ?>
    </div>
<div class="cs__dots"></div>

<a class="mouse-cases" href="#"> <img src="https://wallypass.com/wp-content/uploads/2025/09/Group-1450.svg"> </a>
    <!-- arrows (optional custom) -->
    <button class="cs__nav cs__prev" type="button" aria-label="Previous"></button>
    <button class="cs__nav cs__next" type="button" aria-label="Next"></button>
  <?php
$init = $slides[0];
$init_title = esc_html($init['right_title'] ?? '');
$init_btn_text = esc_html($init['cta_text'] ?? '');
$init_btn_url = esc_url($img($init['cta_url'] ?? ''));
$init_color = esc_attr($init['color_text'] ?? '');
$init_left = wp_kses_post($init['left_text']??'');
?>

  <h4 class="cs-right__title mob js-ext-title" style="color:<?php echo $init_color; ?>;"><?php echo $init_title; ?></h4>
<div class="cs-left__text js-ext-text" style="color:<?php echo $init_color; ?>;">
    <?php echo wp_trim_words( $init_left, 25, '...' ); ?>
</div>
  <a class="cs-left__btn mob js-ext-btn" href="<?php echo $init_btn_url; ?>"><?php echo $init_btn_text; ?></a>
	</div>
</section>

 <script>
 
 jQuery(function($){
  const $section   = $('.case-showcase');
  const $slider    = $('.js-cs-slider');
  const $extTitle  = $('.js-ext-title');
  const $extBtn    = $('.js-ext-btn');
  const $extText    = $('.js-ext-text');
  const $stackCards = $('.cs__stack .cs-card');
  let total = $stackCards.length;

  // helper: always return the inner .cs-slide element
  function coreSlide($node){
    return $node.hasClass('cs-slide') ? $node : $node.find('.cs-slide').first();
  }

  function setBackgroundFrom($node){
    const $s = coreSlide($node);
    const bg = $s.attr('data-bg');
    if (bg) $section[0].style.setProperty('--cs-bg', `url('${bg}')`);
  }

  function setStackActive(activeIndex){
    $stackCards.each(function(i){
      const $c = $(this);
      $c.removeClass('is-active is-queued is-hidden').css('--q','1');
      if (i === activeIndex) {
        $c.addClass('is-active');
      } else {
        let q = (i - activeIndex);
        if (q < 0) q += total;
        q === 0 ? $c.addClass('is-active') : $c.addClass('is-queued').css('--q', q);
      }
    });
  }

  function updateExternalFrom($node){
    const $s     = coreSlide($node);
    const title  = $s.attr('data-right-title') || '';
    const btnTxt = $s.attr('data-cta-text') || '';
    const btnUrl = $s.attr('data-cta-url') || '#';
    const color  = $s.attr('data-color') || '';
	const leftTxt= $s.attr('data-left-text') || '';

    $extTitle.text(title).css('color', color || '');
  $extText.text(leftTxt.split(/\s+/).slice(0,25).join(' ') + (leftTxt.split(/\s+/).length>25 ? '...' : '')).css('color', color || '');
    $extBtn.text(btnTxt).attr('href', btnUrl || '#');
    btnTxt ? $extBtn.show() : $extBtn.hide();
  }

  $slider.on('init', function(e, slick){
    const $start = $(slick.$slides[slick.currentSlide]);
    setBackgroundFrom($start);
    setStackActive(slick.currentSlide);
    updateExternalFrom($start);
  });

  $slider.slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 1,
    adaptiveHeight: false,
    appendDots: $('.cs__dots'),
    vertical: true,
    verticalSwiping: true
  });

  $('.cs__prev').on('click', () => $slider.slick('slickPrev'));
  $('.cs__next').on('click', () => $slider.slick('slickNext'));

  $slider.on('beforeChange', function (e, slick, current, next) {
    const $next = $(slick.$slides[next]);
    setBackgroundFrom($next);
    setStackActive(next);
    updateExternalFrom($next);
  });
});

 
 </script>
 
 
 
 <?php 

get_footer();

 ?>
 