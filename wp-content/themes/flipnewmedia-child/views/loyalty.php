<?php 

/* Template Name: loyalty */


get_header();


 ?>
 
 


<?php 
$herotitle        = get_field('hero-title');  
$herodescription  = get_field('hero-description');    

$img_desktop      = get_field('hero_image_desktop');
$img_mobile       = get_field('hero_image_mobile');

$desktop_id = is_array($img_desktop) ? ($img_desktop['ID'] ?? 0) : (int) $img_desktop;
$mobile_id  = is_array($img_mobile)  ? ($img_mobile['ID']  ?? 0) : (int) $img_mobile;

$desktop_url = $desktop_id ? wp_get_attachment_image_url($desktop_id, 'full') : '';
$mobile_url  = $mobile_id  ? wp_get_attachment_image_url($mobile_id, 'full')  : '';
$desktop_alt = $desktop_id ? get_post_meta($desktop_id, '_wp_attachment_image_alt', true) : 'Hero image';
$mobile_alt  = $mobile_id  ? get_post_meta($mobile_id, '_wp_attachment_image_alt', true)  : $desktop_alt;
?>

<section class="hero-two-rows">
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title"><?php echo wp_kses_post($herotitle); ?></h1>
      <div class="hero-description"><?php echo wp_kses_post($herodescription); ?></div>
	  <img src="https://wallypass.com/wp-content/uploads/2025/10/Group-1450.png" class="mouse-loyalty">
    </div>

    <div class="hero-col hero-1-right">
      <?php if ($desktop_url): ?>
        <img src="<?php echo esc_url($desktop_url); ?>" alt="<?php echo esc_attr($desktop_alt); ?>" loading="eager" decoding="async" fetchpriority="high" />
      <?php endif; ?>
    </div>

    <div class="hero-col hero-1-right-mob">
      <?php if ($mobile_url): ?>
        <img src="<?php echo esc_url($mobile_url); ?>" alt="<?php echo esc_attr($mobile_alt); ?>" loading="eager" decoding="async" />
      <?php endif; ?>
    </div>
  </div>
</section>
 
 <?php
// ACF reads (with fallback if image returns array)
$rt_title = function_exists('get_field') ? (get_field('ret_title') ?: '') : '';
$rt_head  = function_exists('get_field') ? (get_field('ret_headline') ?: '') : '';
$rt_desc  = function_exists('get_field') ? (get_field('ret_description') ?: '') : '';
$rt_btn_t = function_exists('get_field') ? (get_field('ret_btn_text') ?: '') : '';
$rt_btn_u = function_exists('get_field') ? (get_field('ret_btn_url') ?: '') : '';
$rt_img   = function_exists('get_field') ? (get_field('ret_image') ?: '') : '';

$rt_img_url = is_array($rt_img) ? ($rt_img['url'] ?? '') : $rt_img;
$rt_img_alt = is_array($rt_img) ? ($rt_img['alt'] ?? '') : '';
$uid = 'ret-'.wp_generate_uuid4();
?>

<section id="<?php echo esc_attr($uid); ?>" class="ret">
  <div class="ret__wrap">
   
  
    <div class="ret__content">
      <?php if ($rt_title): ?>
        <h2 class="ret__title"><?php echo esc_html($rt_title); ?></h2>
      <?php endif; ?>

      <?php if ($rt_head): ?>
        <div class="ret__headline">
          <?php echo wp_kses_post($rt_head); ?>
        </div>
      <?php endif; ?>

      <hr class="ret__rule">

      <?php if ($rt_desc): ?>
        <div class="ret__desc">
          <?php echo wp_kses_post($rt_desc); ?>
        </div>
      <?php endif; ?>

      <?php if ($rt_btn_t && $rt_btn_u): ?>
        <a class="ret__btn" href="<?php echo esc_url($rt_btn_u); ?>">
          <?php echo esc_html($rt_btn_t); ?>
        </a>
      <?php endif; ?>
    </div>
	
	 <div class="ret__media">
      <?php if ($rt_img_url): ?>
        <img class="ret__img" src="<?php echo esc_url($rt_img_url); ?>" alt="<?php echo esc_attr($rt_img_alt); ?>">
      <?php endif; ?>
    </div>
	
	
  </div>
</section>
 
 
 <?php
// ACF reads for the new section
$eng_title = function_exists('get_field') ? (get_field('eng_title') ?: '') : '';
$eng_head  = function_exists('get_field') ? (get_field('eng_headline') ?: '') : '';
$eng_desc  = function_exists('get_field') ? (get_field('eng_description') ?: '') : '';
$eng_btn_t = function_exists('get_field') ? (get_field('eng_btn_text') ?: '') : '';
$eng_btn_u = function_exists('get_field') ? (get_field('eng_btn_url') ?: '') : '';
$eng_img   = function_exists('get_field') ? (get_field('eng_image') ?: '') : '';

$eng_img_url = is_array($eng_img) ? ($eng_img['url'] ?? '') : $eng_img;
$eng_img_alt = is_array($eng_img) ? ($eng_img['alt'] ?? '') : '';
$eng_uid = 'ret-'.wp_generate_uuid4();
?>

<section id="<?php echo esc_attr($eng_uid); ?>" class="ret ret--eng">
  <div class="ret__wrap">

    <!-- media (LEFT for this one) -->
    <div class="ret__media">
      <?php if ($eng_img_url): ?>
        <img class="ret__img" src="<?php echo esc_url($eng_img_url); ?>" alt="<?php echo esc_attr($eng_img_alt); ?>">
      <?php endif; ?>
    </div>

    <!-- copy (RIGHT) -->
    <div class="ret__content">
      <?php if ($eng_title): ?>
        <h2 class="ret__title"><?php echo esc_html($eng_title); ?></h2>
      <?php endif; ?>

      <?php if ($eng_head): ?>
        <div class="ret__headline">
          <?php echo wp_kses_post($eng_head); ?>
        </div>
      <?php endif; ?>

      <hr class="ret__rule">

      <?php if ($eng_desc): ?>
        <div class="ret__desc">
          <?php echo wp_kses_post($eng_desc); ?>
        </div>
      <?php endif; ?>

      <?php if ($eng_btn_t && $eng_btn_u): ?>
        <a class="ret__btn" href="<?php echo esc_url($eng_btn_u); ?>">
          <?php echo esc_html($eng_btn_t); ?>
        </a>
      <?php endif; ?>
    </div>

  </div>
</section>

 <?php
// ACF reads for the Customisation section
$cus_title = function_exists('get_field') ? (get_field('cus_title') ?: '') : '';
$cus_head  = function_exists('get_field') ? (get_field('cus_headline') ?: '') : '';
$cus_desc  = function_exists('get_field') ? (get_field('cus_description') ?: '') : '';
$cus_btn_t = function_exists('get_field') ? (get_field('cus_btn_text') ?: '') : '';
$cus_btn_u = function_exists('get_field') ? (get_field('cus_btn_url') ?: '') : '';
$cus_img   = function_exists('get_field') ? (get_field('cus_image') ?: '') : '';

$cus_img_url = is_array($cus_img) ? ($cus_img['url'] ?? '') : $cus_img;
$cus_img_alt = is_array($cus_img) ? ($cus_img['alt'] ?? '') : '';
$cus_uid = 'ret-'.wp_generate_uuid4();
?>

<section id="<?php echo esc_attr($cus_uid); ?>" class="ret ret--cus">
  <div class="ret__wrap">

    <div class="ret__content">
      <?php if ($cus_title): ?>
        <h2 class="ret__title"><?php echo esc_html($cus_title); ?></h2>
      <?php endif; ?>

      <?php if ($cus_head): ?>
        <div class="ret__headline">
          <?php echo wp_kses_post($cus_head); ?>
        </div>
      <?php endif; ?>

      <hr class="ret__rule">

      <?php if ($cus_desc): ?>
        <div class="ret__desc">
          <?php echo wp_kses_post($cus_desc); ?>
        </div>
      <?php endif; ?>

      <?php if ($cus_btn_t && $cus_btn_u): ?>
        <a class="ret__btn" href="<?php echo esc_url($cus_btn_u); ?>">
          <?php echo esc_html($cus_btn_t); ?>
        </a>
      <?php endif; ?>
    </div>

    <div class="ret__media">
      <?php if ($cus_img_url): ?>
        <img class="ret__img" src="<?php echo esc_url($cus_img_url); ?>" alt="<?php echo esc_attr($cus_img_alt); ?>">
      <?php endif; ?>
    </div>

  </div>
</section>

<section class="wallet-cta">
<img class="eclipse" src="https://wallypass.com/wp-content/uploads/2025/10/Ellipse-41.png" >
  <div class="wc__inner">
    <!-- Left column -->
    <div class="wc__left">
      
    </div>

    <!-- Right column (Contact Form 7) -->
    <div class="wc__right">
	<h3 class="wc__title">
        Προσθέστε το <span>Wallypass</span> στο<br> ψηφιακό σας πορτοφόλι
      </h3>

      <div class="wc__badges">
        <a href="#" class="wc__badge">
          <img src="https://wallypass.com/wp-content/uploads/2025/09/addtoapple.png" alt="Add to Apple Wallet" loading="lazy" decoding="async">
        </a>
        <a href="#" class="wc__badge">
          <img src="https://wallypass.com/wp-content/uploads/2025/09/addtogoogle.png" alt="Add to Google Wallet" loading="lazy" decoding="async">
        </a>
      </div>
      <?php echo do_shortcode('[contact-form-7 id="98f3031" title="Contact form 1"]'); ?>
      <!-- Your CF7 form should have two fields (name, email) + submit. No extra markup needed. -->
    </div>
  </div>
</section>

<?php
$slides = get_field('cs_slides');
$overlay = get_field('cs_phone_overlay'); // image array or URL
$cstitle = get_field('cs_title');


if ($slides) : ?>
<section class="case-studies-wrap">
 <div class="cs-grid cs-1-grid">
   <div class="cs-left">
 <h2 class="cs-title"><?php echo wp_kses_post($cstitle); ?></h2>


   </div>
   <div class="cs-right">
 <div class="cs-arrows">
        <button type="button" class="cs__nav cs__prev cs-prev" aria-label="Previous"></button>
        <button type="button" class="cs__nav cs__next cs-next" aria-label="Next"></button>
      </div>
   </div>
   </div>
  <div class="cs-grid">
   
    <!-- LEFT: text slider -->
    <div class="cs-left">
      <div id="csTextSlider" class="cs-text-slider">
        <?php foreach ($slides as $row): ?>
          <div class="cs-text-slide">
            <?php if (!empty($row['cs_slide_client'])): ?>
              <h3 class="cs-client"><?php echo esc_html($row['cs_slide_client']); ?></h3>
            <?php endif; ?>
			
			<hr class="cs__rule">
            <div class="cs-text">
              <?php
              // allow basic formatting from the WYSIWYG
              echo wp_kses_post( $row['cs_slide_text'] ?? '' );
              ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

     
    </div>

    <!-- RIGHT: images slider (+ optional phone overlay) -->
    <div class="cs-right">
      <div class="cs-phone">
	   
        <div id="csImageSlider" class="cs-image-slider">
          <?php foreach ($slides as $row):
            $img = $row['cs_slide_image'] ?? null;
            if (!$img) continue;
            $src = is_array($img) ? $img['url'] : $img;
            $alt = is_array($img) ? ($img['alt'] ?? ($row['cs_slide_client'] ?? '')) : ($row['cs_slide_client'] ?? '');
          ?>
            <div class="cs-slide"><img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($alt); ?>" loading="lazy"></div>
          <?php endforeach; ?>
        </div>
<?php if ($overlay): 
          $oSrc = is_array($overlay) ? $overlay['url'] : $overlay; ?>
          <img class="cs-phone-overlay" src="<?php echo esc_url($oSrc); ?>" alt="" aria-hidden="true">
        <?php endif; ?>
       
      </div>
    </div>
  </div>
</section>
<?php endif; ?>


 
  <?php 

get_footer();

 ?>
 
 
<script>
jQuery(function($){
  var $text = $('#csTextSlider');
  var $imgs = $('#csImageSlider');

  if (!$imgs.length || !$text.length) return;

  $text.slick({
    asNavFor: '#csImageSlider',
    arrows: false,
    dots: false,
    infinite: true ,
    adaptiveHeight: true,
    fade: true,
    swipe: false
  });

  $imgs.slick({
    asNavFor: '#csTextSlider',
    arrows: false,
    dots: false,
    infinite: true,
    adaptiveHeight: true,
    slidesToShow: 2,
    slidesToScroll: 1
  });

  // left arrows drive both (because of asNavFor)
  $('.cs-prev').on('click', function(){ $imgs.slick('slickPrev'); });
  $('.cs-next').on('click', function(){ $imgs.slick('slickNext'); });
});
</script>