<?php
/*
Template Name: Home Template
*/
add_action('wp_head', function () {
  ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "WallyPass",
    "url": "https://wallypass.com",
    "logo": "https://wallypass.com/wp-content/uploads/2025/10/Artboard-2@3x-100.jpg",
    "sameAs": [
      "https://www.facebook.com/digitalwallypass",
      "https://www.instagram.com/wallypass_com/"
    ]
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "WallyPass",
    "url": "https://wallypass.com",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "Web",
    "description": "WallyPass helps businesses create, manage, and distribute Apple & Google Wallet digital passes.",
    "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "EUR",
      "lowPrice": "0",
      "highPrice": "899",
      "offerCount": "5"
    }
  }
  </script>
  <?php
}, 20);
get_header();

?>

<section class="hero-two-rows hero-video">
  <!-- Desktop video (>= 992px) -->
  <div class="hero-video-desktop">
    <video
      class="hero-video-el"
      autoplay
      muted
      loop
      playsinline
      preload="metadata"
      poster="#"
    >
      <source src="https://wallypass.com/wp-content/uploads/2026/03/1920x1080-for-web-1.mp4" type="video/mp4" />
    </video>
  </div>

  <!-- Mobile video (<= 991px) -->
  <div class="hero-video-mobile">
    <video
      class="hero-video-el"
      autoplay
      muted
      loop
      playsinline
      preload="metadata"
      poster="#"
    >
      <source src="https://wallypass.com/wp-content/uploads/2026/03/1080x1920-for-web.mp4" type="video/mp4" />
    </video>
  </div>
 <a href="#sectiontwo" class="wrapper-mouse" >
      <img class="mouse-home" src="https://wallypass.com/wp-content/uploads/2025/09/Group-1450.svg" alt="App screen examples" loading="lazy" />
  </a>
</section>

<style>


.site-header {
    padding: 10px 0px;
    position: fixed;
    top: 0;
    z-index: 99999999;
    overflow: visible;
    width: 100%;
        background: rgba(255, 255, 255, 1);
    box-shadow: inset 0px -7px 4px rgba(0, 0, 0, 0.02);
    backdrop-filter: blur(7px);
}

.page-template-home section.hero-two-rows {
	height: 100vh;
}



.hero-two-rows.hero-video {
  position: relative;
  width: 100%;
  margin: 0;
  padding: 0;
}

.hero-two-rows.hero-video .hero-video-el {
  display: block;
  width: 100%;
  object-fit: cover;
height:100vh;
 object-position: top;
}

a.wrapper-mouse {
    position: relative;
    bottom: 5%;
}

img.mouse-home {

    left: 5%;
}

/* Desktop visible by default */
.hero-two-rows.hero-video .hero-video-desktop { display: block; }
.hero-two-rows.hero-video .hero-video-mobile { display: none; }

/* Mobile switch */
@media (max-width: 991px) {
  .hero-two-rows.hero-video .hero-video-desktop { display: none; }
  .hero-two-rows.hero-video .hero-video-mobile { display: block; }

  .hero-two-rows.hero-video .hero-video-el {
           height: calc(100vh - 77px);
        margin-top: 77px;
  }
	.site-header{
		    position: fixed;
background:white;
	}
  .home section.hero-two-rows {
        margin-top: 0px !important;
    }
.page-template-home section.hero-two-rows {
    height: calc(100vh - 77px);
}
}

</style>


<!-- <section class="hero-two-rows">
  
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1>Προσωποποιημένη επικοινωνία χωρίς app.</h1>

    </div>

    <div class="hero-col hero-1-right">
      <img src="https://wallypass.com/wp-content/uploads/2025/09/home-banner-image.png" alt="Digital passes preview" loading="eager" />
    </div>
	
	<div class="hero-abs-mob">
      <img src="https://wallypass.com/wp-content/uploads/2025/10/Digital-Passesmob.png">
    </div>
	
	 <div class="hero-col hero-1-right-mob">
      <img src="https://wallypass.com/wp-content/uploads/2025/10/adwaf-1.png" alt="Digital passes preview" loading="eager" />
    </div>

    
    <div class="hero-abs">
      <img src="https://wallypass.com/wp-content/uploads/2025/09/Digital-Passes.png">
    </div>
  </div>

 
  <div class="container hero-row hero-row-2">
    <div class="hero-col hero-2-left">
      <img class="mouse-home" src="https://wallypass.com/wp-content/uploads/2025/09/Group-1450.svg" alt="App screen examples" loading="lazy" />
    </div>

    <div class="hero-col hero-2-right">
      <p>
       Το <span>Wallypass</span> δίνει στις επιχειρήσεις τη δυνατότητα να επικοινωνούν άμεσα, προσωποποιημένα και σε πραγματικό χρόνο με τους πελάτες τους — μέσα από ψηφιακά πάσα στο Apple & Google Wallet.
      </p>
    </div>
  </div>
</section> -->

<?php
/**
 * Wallet Features Section — separate get_field() calls
 */


$bg_image   = get_field('background_image');         // Image (array/url/id per your return format)
$heading    = get_field('heading');          // Text/WYSIWYG
$button_txt = get_field('button_text');      // Text
$button_url = get_field('button_url');       // URL

// If your image returns array, extract url:
$bg_url = '';
if ($bg_image) {
  if (is_array($bg_image) && isset($bg_image['url'])) {
    $bg_url = $bg_image['url'];
  } else {
    $bg_url = $bg_image; // already a URL
  }
}

// Bail if totally empty (optional)
if (empty($heading) && empty($button_txt) && empty($bg_url) && !have_rows('wf_features')) {
  return;
}
?>

<section id="sectiontwo" class="wallet-features" style="--bg:url('<?php echo esc_url($bg_url); ?>');">
  <div class="wf__container">
    <!-- Row 1 -->
    <div class="wf__row-1">
      <?php if ($heading): ?>
        <h2 class="wf__title"><?php echo wp_kses_post($heading); ?></h2>
      <?php endif; ?>

      <?php if ($button_txt && $button_url): ?>
        <a class="wf__btn" href="https://wallypass.com/contact/">
          <?php echo esc_html($button_txt); ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- Row 2 -->
    <?php if (have_rows('features')): ?>
      <div class="wf__row-2">
        <div class="wf__grid js-wf-grid">
          <?php while (have_rows('features')): the_row();
            $icon        = get_sub_field('icon');          // Image
            $title       = get_sub_field('title');         // Text
            $description = get_sub_field('description');   // Textarea

            $icon_url = '';
            if ($icon) {
              $icon_url = is_array($icon) && isset($icon['url']) ? $icon['url'] : $icon;
            }
          ?>
          <article class="wf__card">
            <?php if ($icon_url): ?>
              <div class="wf__icon">
                <img src="<?php echo esc_url($icon_url); ?>" alt="" loading="lazy" decoding="async">
              </div>
            <?php endif; ?>

            <?php if ($title): ?>
              <h3 class="wf__card-title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if ($description): ?>
              <p class="wf__card-desc"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
          </article>
          <?php endwhile; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<section id="wallet-form" class="wallet-cta">
<img class="eclipse" src="https://wallypass.com/wp-content/uploads/2025/10/Ellipse-41.png" >
  <div class="wc__inner">
    <!-- Left column -->
    <div class="wc__left">
      <h3 class="wc__title">
        Προσθέστε το <span>Wallypass</span> στο<br> ψηφιακό σας πορτοφόλι
      </h3>
		<p>
			Δείτε πόσο εύκολα ένα digital pass αποθηκεύεται στο Apple ή Google Wallet — όπως ακριβώς θα το λαμβάνει και ο πελάτης σας.
		</p>

      <div class="wc__badges">
        <a href="#wallet-form" class="wc__badge">
          <img src="https://wallypass.com/wp-content/uploads/2025/09/addtoapple.png" alt="Add to Apple Wallet" loading="lazy" decoding="async">
        </a>
        <a href="#wallet-form" class="wc__badge">
          <img src="https://wallypass.com/wp-content/uploads/2025/09/addtogoogle.png" alt="Add to Google Wallet" loading="lazy" decoding="async">
        </a>
      </div>
    </div>

    <!-- Right column (Contact Form 7) -->
    <div class="wc__right">
      <?php echo do_shortcode('[contact-form-7 id="98f3031" title="Contact form 1"]'); ?>
      <!-- Your CF7 form should have two fields (name, email) + submit. No extra markup needed. -->
    </div>
  </div>
</section>


<?php
/**
 * Logos Strip — Desktop: 'logos' | Mobile: ONLY 'logos_row_1' + 'logos_row_2'
 */

function fm_get_logo_item_from_row() {
  $img   = get_sub_field('logo_image');
  $href  = trim((string) get_sub_field('logo_link'));
  $img_url = ''; $img_alt = '';

  if ($img) {
    if (is_array($img)) { $img_url = $img['url'] ?? ''; $img_alt = $img['alt'] ?? ''; }
    else { $img_url = $img; }
  }
  if (!$img_url) return null;
  return ['url'=>$img_url,'alt'=>$img_alt,'href'=>$href];
}

function fm_render_logo_cards($items){
  foreach ($items as $it){
    if (!$it || empty($it['url'])) continue; ?>
    <div class="brand-card">
      <?php if (!empty($it['href'])): ?>
        <a href="<?php echo esc_url($it['href']); ?>" target="_blank" rel="noopener">
          <img src="<?php echo esc_url($it['url']); ?>" alt="<?php echo esc_attr($it['alt']); ?>" loading="lazy" decoding="async">
        </a>
      <?php else: ?>
        <img src="<?php echo esc_url($it['url']); ?>" alt="<?php echo esc_attr($it['alt']); ?>" loading="lazy" decoding="async">
      <?php endif; ?>
    </div>
  <?php }
}

// Desktop data (single repeater)
$logos = [];
if (have_rows('logos')) {
  while (have_rows('logos')) { the_row();
    $item = fm_get_logo_item_from_row();
    if ($item) $logos[] = $item;
  }
}

// Mobile data (two explicit repeaters ONLY; no fallback)
$row1 = []; $row2 = [];
if (have_rows('logos_row_1')) {
  while (have_rows('logos_row_1')) { the_row();
    $it = fm_get_logo_item_from_row(); if ($it) $row1[] = $it;
  }
}
if (have_rows('logos_row_2')) {
  while (have_rows('logos_row_2')) { the_row();
    $it = fm_get_logo_item_from_row(); if ($it) $row2[] = $it;
  }
}
?>

<?php if (!empty($logos) || !empty($row1) || !empty($row2)) : ?>
<section class="brand-strip">
  <div class="brand-strip__inner">

    <!-- Desktop (≥992px): single carousel -->
    <?php if (!empty($logos)) : ?>
      <div class="brand-carousel js-brand-desktop" aria-label="Our partners">
        <?php fm_render_logo_cards($logos); ?>
      </div>
    <?php endif; ?>

    <!-- Mobile (≤991px): two carousels from ACF ONLY -->
    <?php if (!empty($row1) || !empty($row2)) : ?>
      <div class="brand-carousel-pair">
        <?php if (!empty($row1)) : ?>
          <div class="brand-carousel js-brand-mobile-1" data-rtl="false" aria-label="Our partners row 1">
            <?php fm_render_logo_cards($row1); ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($row2)) : ?>
          <div class="brand-carousel js-brand-mobile-2" data-rtl="true" aria-label="Our partners row 2">
            <?php fm_render_logo_cards($row2); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>


<?php
/**
 * Solutions Section (no slider) – ACF
 */

$left_heading = get_field('sol_left_heading');
$right_title  = get_field('sol_right_title');
$right_text   = get_field('sol_right_text');

?>
<section class="solutions">
  <div class="solutions__container">
    <!-- Row 1: 2 columns -->
    <div class="solutions__head">
      <div class="solutions__left">
        <?php if ($left_heading): ?>
          <h2 class="solutions__h1"><?php echo esc_html($left_heading); ?></h2>
        <?php endif; ?>
      </div>

      <div class="solutions__right">
        <?php if ($right_title): ?>
          <h3 class="solutions__h2"><?php echo esc_html($right_title); ?></h3>
        <?php endif; ?>
        <?php if ($right_text): ?>
          <div class="solutions__text"><?php echo wp_kses_post($right_text); ?></div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Row 2: Grid of cards -->
    <?php if (have_rows('sol_items')): ?>
      <div class="solutions__grid">
        <?php
        $i = 0;
        while (have_rows('sol_items')): the_row(); $i++;
          $icon  = get_sub_field('icon');
          $title = get_sub_field('title');
          $bg    = get_sub_field('bg_color');
          $tc    = get_sub_field('text_color');
          $href  = trim((string) get_sub_field('link'));

          $icon_url = $icon && is_array($icon) ? ($icon['url'] ?? '') : (string) $icon;
          $icon_alt = $icon && is_array($icon) ? ($icon['alt'] ?? '') : '';
          $style    = '';
          if ($bg) $style .= 'background:' . $bg . ';';
          if ($tc) $style .= 'color:' . $tc . ';';
        ?>
          <div class="sol-card<?php echo $i >= 5 ? ' sol-card--row2' : ''; ?>" style="<?php echo esc_attr($style); ?>">
            <?php if ($href): ?><a class="sol-card__link" href="<?php echo esc_url($href); ?>"><?php endif; ?>
              <div class="sol-card__inner">
                <?php if ($icon_url): ?>
                  <span class="sol-card__icon">
                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" loading="lazy" decoding="async">
                  </span>
                <?php endif; ?>
                <?php if ($title): ?>
                  <span class="sol-card__title"><?php echo esc_html($title); ?></span>
                <?php endif; ?>
              </div>
            <?php if ($href): ?></a><?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</section>


<?php
/**
 * Case Showcase – fixed phone with card stack + Slick content carousel
 */

$phone_frame  = get_field('cs_phone_frame_image'); // optional
$slides_exist = have_rows('cs_slides');
if (!$slides_exist) return;

// Build arrays once (used both by slider + phone stack)
$slides = [];
while (have_rows('cs_slides')): the_row();
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
  $r_title  = $s['right_title'] ?? '';
  $cta_text = $s['cta_text'] ?? '';
  $cta_url  = $s['cta_url'] ?? '';
  $color    = $s['color_text'] ?? '';
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



<?php
/**
 * How It Works – ACF Repeater timeline accordion
 */

// Separate get_field() calls
$hiw_title   = get_field('hiw_title');
$hiw_desc    = get_field('hiw_desc');
$hiw_notice  = get_field('hiw_notice');
$hiw_image   = get_field('hiw_image_left');

// Fallback image if ACF empty (as requested)
$hiw_img_url = $hiw_image && is_array($hiw_image) ? ($hiw_image['url'] ?? '') : (string) $hiw_image;
$hiw_img_alt = $hiw_image && is_array($hiw_image) ? ($hiw_image['alt'] ?? '') : '';

if (!$hiw_img_url) {
  $hiw_img_url = 'https://wallypass.com/wp-content/uploads/2025/10/Mask-group.jpg';
  $hiw_img_alt = 'How it works';
}
?>

<section class="how-it-works">
  <div class="hiw__inner">

    <!-- Left column -->
    <div class="hiw__left">
      <img src="<?php echo esc_url($hiw_img_url); ?>" alt="<?php echo esc_attr($hiw_img_alt); ?>" loading="lazy" decoding="async">
    </div>

    <!-- Right column -->
    <div class="hiw__right">
      <?php if ($hiw_title): ?>
        <h2 class="hiw__title"><?php echo esc_html($hiw_title); ?></h2>
      <?php endif; ?>

      <?php if ($hiw_desc): ?>
        <div class="hiw__desc"><?php echo wp_kses_post($hiw_desc); ?></div>
      <?php endif; ?>

      <?php if ($hiw_notice): ?>
        <p class="hiw__notice"><?php echo esc_html($hiw_notice); ?></p>
      <?php endif; ?>

      <?php if (have_rows('hiw_steps')): ?>
        <div class="hiw__steps" data-open-arrow="https://wallypass.com/wp-content/uploads/2025/10/open-arrow.svg"
             data-close-arrow="https://wallypass.com/wp-content/uploads/2025/10/close-arrow.svg">
          <?php $i = 0; while (have_rows('hiw_steps')): the_row(); $i++; 
            $title = get_sub_field('step_title');
            $text  = get_sub_field('step_description');
            // First step open by default
            $is_open = ($i === 1);
          ?>
            <div class="hiw-step<?php echo $is_open ? ' is-active' : ''; ?>" data-step-index="<?php echo esc_attr($i); ?>">
              <div class="hiw-step__head" role="button" tabindex="0" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
                <div class="hiw-step__marker"><span></span></div>
                <div class="hiw-step__info">
                  <span class="hiw-step__num">Βήμα <?php echo esc_html($i); ?></span>
                  <?php if ($title): ?>
                    <h3 class="hiw-step__title"><?php echo esc_html($title); ?></h3>
                  <?php endif; ?>
                </div>
                <button class="hiw-step__toggle" type="button" aria-label="toggle step">
                  <img src="<?php echo $is_open ? 'https://wallypass.com/wp-content/uploads/2025/10/close-arrow.svg' : 'https://wallypass.com/wp-content/uploads/2025/10/open-arrow.svg'; ?>" alt="">
                </button>
              </div>

              <div class="hiw-step__body<?php echo $is_open ? ' is-open' : ''; ?>">
                <?php if ($text): ?>
                  <div class="hiw-step__content"><?php echo wp_kses_post($text); ?></div>
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php
/**
 * FAQ Section (2 columns + accordion) — ACF
 */

$faq_title       = get_field('faq_title');
$faq_desc        = get_field('faq_desc');
$faq_btn_text    = get_field('faq_button_text');
$faq_btn_url     = get_field('faq_button_url');

$icon_plus  = 'https://wallypass.com/wp-content/uploads/2025/10/plus-icon.svg';
$icon_minus = 'https://wallypass.com/wp-content/uploads/2025/10/minus-icon.svg';
?>

<section class="faq-sec" data-plus="<?php echo esc_url($icon_plus); ?>" data-minus="<?php echo esc_url($icon_minus); ?>">
  <div class="faq__inner">

    <!-- Left column -->
    <div class="faq__left">
      <?php if ($faq_title): ?>
        <h2 class="faq__title"><?php echo esc_html($faq_title); ?></h2>
      <?php endif; ?>

      <?php if ($faq_desc): ?>
        <div class="faq__desc"><?php echo wp_kses_post($faq_desc); ?></div>
      <?php endif; ?>

      <?php if ($faq_btn_text && $faq_btn_url): ?>
        <a class="faq__btn" href="<?php echo esc_url($faq_btn_url); ?>">
          <?php echo esc_html($faq_btn_text); ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- Right column (Accordion) -->
    <div class="faq__right">
      <?php if (have_rows('faq_items')): ?>
        <div class="faq-acc">
          <?php $i=0; while (have_rows('faq_items')): the_row(); $i++;
            $q = get_sub_field('faq_item_title');
            $a = get_sub_field('faq_item_desc');
            $open = ($i===1); // first open
          ?>
          <div class="faq-item<?php echo $open ? ' is-open' : ''; ?>">
            <button class="faq-head" type="button" aria-expanded="<?php echo $open ? 'true':'false'; ?>">
              <h3 class="faq-q"><?php echo esc_html($q); ?></h3>
              <img class="faq-ico" src="<?php echo esc_url($open ? $icon_minus : $icon_plus); ?>" alt="">
            </button>
            <div class="faq-body" <?php if($open): ?>style="max-height:fit-content!important; opacity:1;"<?php endif; ?>>
              <div class="faq-a"><?php echo wp_kses_post($a); ?></div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
<p class=" text-mob-faq">
Έχετε άλλες ερωτήσεις; Ζητήστε ένα demo και ανακαλύψτε πώς μπορεί να λειτουργήσει το Wallypass για την επιχείρησή σας!
 </p>
 
 <a class="faq__btn mob" href="<?php echo esc_url($faq_btn_url); ?>">
          <?php echo esc_html($faq_btn_text); ?>
        </a>
  </div>
</section>

<?php
/**
 * Integrations Section
 * Fields:
 *  - int_title (Text)
 *  - int_desc  (WYSIWYG or Textarea)
 *  - int_logos (Repeater, optional)
 *      - logo_image (Image)
 *      - logo_link  (URL, optional)
 */

$int_title = get_field('int_title');
$int_desc  = get_field('int_desc');

// Collect logos: from repeater if present, else fallback to provided URLs
$logos = [];
if (have_rows('int_logos')) {
  while (have_rows('int_logos')): the_row();
    $img = get_sub_field('logo_image');
    $url = is_array($img) ? ($img['url'] ?? '') : (string)$img;
    $alt = is_array($img) ? ($img['alt'] ?? '') : '';
    $lnk = trim((string) get_sub_field('logo_link'));
    if ($url) $logos[] = ['url'=>$url, 'alt'=>$alt, 'link'=>$lnk];
  endwhile;
}

// Fallback to the two provided assets if no repeater rows
if (empty($logos)) {
  $logos = [
    ['url' => 'https://wallypass.com/wp-content/uploads/2025/10/woocommerce_logo-1.png', 'alt' => 'WooCommerce', 'link' => ''],
    ['url' => 'https://wallypass.com/wp-content/uploads/2025/10/mailchimp_logo-1.png',    'alt' => 'Mailchimp',   'link' => ''],
  ];
}
?>
<section class="integrations">
  <div class="int__container">
    <?php if ($int_title): ?>
      <h2 class="int__title"><?php echo esc_html($int_title); ?></h2>
    <?php endif; ?>

    <?php if ($int_desc): ?>
      <div class="int__desc"><?php echo wp_kses_post($int_desc); ?></div>
    <?php endif; ?>

    <div class="int__logos">
      <?php foreach ($logos as $logo): ?>
        <div class="int-logo">
          <?php if (!empty($logo['link'])): ?>
            <a href="<?php echo esc_url($logo['link']); ?>" target="_blank" rel="noopener">
              <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" loading="lazy" decoding="async">
            </a>
          <?php else: ?>
            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" loading="lazy" decoding="async">
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
/**
 * Blog Featured Grid (ACF positions 1–4)
 * ACF fields:
 *  - bf_position_1, bf_position_2, bf_position_3, bf_position_4  (Relationship, max 1)
 *  - bf_view_all_text (Text)
 *  - bf_view_all_url  (URL)
 */

/* Helpers */
if (!function_exists('bfg_get_post_id')) {
  function bfg_get_post_id($val) {
    if (!$val) return 0;
    if (is_array($val)) {
      $first = reset($val);
      if ($first instanceof WP_Post) return $first->ID;
      if (is_numeric($first)) return (int)$first;
      if (is_array($first) && isset($first['ID'])) return (int)$first['ID'];
      if ($val instanceof WP_Post) return $val->ID;
      return 0;
    }
    if ($val instanceof WP_Post) return $val->ID;
    if (is_numeric($val)) return (int)$val;
    return 0;
  }
}
if (!function_exists('bfg_post_data_by_id')) {
  function bfg_post_data_by_id($pid) {
    if (!$pid) return null;
    $img_url = get_the_post_thumbnail_url($pid, 'large');
    $img_id  = get_post_thumbnail_id($pid);
    $alt     = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';
    $excerpt = has_excerpt($pid)
      ? get_the_excerpt($pid)
      : wp_trim_words( wp_strip_all_tags( get_post_field('post_content', $pid) ), 25 );
    return [
      'id'      => $pid,
      'url'     => get_permalink($pid),
      'title'   => get_the_title($pid),
      'excerpt' => $excerpt,
      'img'     => $img_url,
      'img_alt' => $alt,
    ];
  }
}

/* Get ACF selections */
$p1 = bfg_get_post_id(get_field('bf_position_1'));
$p2 = bfg_get_post_id(get_field('bf_position_2'));
$p3 = bfg_get_post_id(get_field('bf_position_3'));
$p4 = bfg_get_post_id(get_field('bf_position_4'));

$d1 = bfg_post_data_by_id($p1);
$d2 = bfg_post_data_by_id($p2);
$d3 = bfg_post_data_by_id($p3);
$d4 = bfg_post_data_by_id($p4);

$btn_text = get_field('bf_view_all_text');
$btn_url  = get_field('bf_view_all_url');

if (!$d1 && !$d2 && !$d3 && !$d4) return;

$uid = uniqid('bfg-');
?>
<section id="<?php echo esc_attr($uid); ?>" class="bfg">
  <!-- Header -->
  <div class="bfg__head">
    <div class="bfg__head-left">
      <h2 class="bfg__title">Μείνετε ενημερωμένοι</h2>
    </div>
    <div class="bfg__head-right">
      <p class="bfg__subtitle">
        Βρείτε τις τελευταίες ενημερώσεις, νέα και πληροφορίες από τον κλάδο μας. Μείνετε ενημερωμένοι και ένα βήμα μπροστά με τις συμβουλές των ειδικών μας και το αποκλειστικό μας περιεχόμενο.
      </p>
    </div>
  </div>
<?php
// Build the slides pool from your ACF picks (only non-empty)
$slides = array_values(array_filter([$d1, $d2, $d3, $d4]));
?>
<!-- Mobile slider (<=991px) -->
<div class="bfg__mobile" aria-label="Featured posts slider">
  <?php if (!empty($slides)): ?>
    <div class="bfg-slider js-bfg-slider">
      <?php foreach ($slides as $s): ?>
        <article class="bfg-hero">
          <?php if (!empty($s['img'])): ?>
            <a href="<?php echo esc_url($s['url']); ?>" class="bfg-hero__img" aria-label="<?php echo esc_attr($s['title']); ?>">
              <img src="<?php echo esc_url($s['img']); ?>" alt="<?php echo esc_attr($s['img_alt']); ?>" loading="lazy" decoding="async">
            </a>
          <?php endif; ?>
          <div class="bfg-hero__panel">
            <a class="bfg-link" href="<?php echo esc_url($s['url']); ?>">
              <h3 class="bfg-hero__title"><?php echo esc_html($s['title']); ?></h3>
            </a>
            <?php if (!empty($s['excerpt'])): ?>
              <p class="bfg-hero__excerpt"><?php echo esc_html($s['excerpt']); ?></p>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Progress bar -->
    <div class="bfg-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-label="Slide progress">
      <span class="bfg-progress__bar"></span>
    </div>
  <?php endif; ?>
  
   <a class="bfg-btn mob" href="<?php echo esc_url($btn_url); ?>">
              <?php echo esc_html($btn_text); ?>
            </a>
</div>
  <!-- Grid -->
  <div class="bfg__grid">
    <!-- Left column: Position 1 (Hero) -->
    <div class="bfg__col-left">
      <?php if ($d1): ?>
      <article class="bfg-hero">
        <?php if ($d1['img']): ?>
          <!-- 1) IMAGE BLOCK -->
          <a href="<?php echo esc_url($d1['url']); ?>" class="bfg-hero__img" aria-label="<?php echo esc_attr($d1['title']); ?>">
            <img src="<?php echo esc_url($d1['img']); ?>" alt="<?php echo esc_attr($d1['img_alt']); ?>" loading="lazy" decoding="async">
          </a>
        <?php endif; ?>

        <!-- 2) TEXT PANEL (stacked under image) -->
        <div class="bfg-hero__panel">
          <a class="bfg-link" href="<?php echo esc_url($d1['url']); ?>">
            <h3 class="bfg-hero__title"><?php echo esc_html($d1['title']); ?></h3>
          </a>
          <?php if (!empty($d1['excerpt'])): ?>
            <p class="bfg-hero__excerpt"><?php echo esc_html($d1['excerpt']); ?></p>
          <?php endif; ?>
        </div>
      </article>
      <?php endif; ?>
    </div>

    <!-- Right column -->
    <div class="bfg__col-right">
      <!-- Row 1: Position 2 (image left, text right) -->
      <?php if ($d2): ?>
      <article class="bfg-split">
        <?php if ($d2['img']): ?>
          <a href="<?php echo esc_url($d2['url']); ?>" class="bfg-split__img" aria-label="<?php echo esc_attr($d2['title']); ?>">
            <img src="<?php echo esc_url($d2['img']); ?>" alt="<?php echo esc_attr($d2['img_alt']); ?>" loading="lazy" decoding="async">
          </a>
        <?php endif; ?>
        <div class="bfg-split__content">
          <a class="bfg-link" href="<?php echo esc_url( $d2['url'] ); ?>">
  <h3 class="bfg-split__title">
    <?php echo esc_html( wp_trim_words( $d2['title'], 4, '…' ) ); ?>
  </h3>
</a>
<?php if ( ! empty( $d2['excerpt'] ) ) : ?>
  <p class="bfg-split__excerpt">
    <?php echo esc_html( wp_trim_words( $d2['excerpt'], 20, '…' ) ); ?>
  </p>
<?php endif; ?>

        </div>
      </article>
      <?php endif; ?>

      <!-- Row 2: Position 3 (left) + Position 4 THEN button (reversed as requested) -->
      <div class="bfg-row">
        <div class="bfg-row__left">
          <?php if ($d3): ?>
          <article class="bfg-tile bfg-tile--salmon">
            <a class="bfg-link" href="<?php echo esc_url($d3['url']); ?>">
              <h3 class="bfg-tile__title">
    <?php echo esc_html( wp_trim_words( $d3['title'], 3, '…' ) ); ?>
  </h3>
            </a>
            <?php if ( ! empty( $d3['excerpt'] ) ) : ?>
  <p class="bfg-tile__excerpt">
    <?php echo esc_html( wp_trim_words( $d3['excerpt'], 12, '…' ) ); ?>
  </p>
<?php endif; ?>
          </article>
          <?php endif; ?>
        </div>

        <div class="bfg-row__right">
          <?php if ($d4): ?>
          <article class="bfg-tile bfg-tile--maroon">
            <a class="bfg-link" href="<?php echo esc_url( $d4['url'] ); ?>">
  <h3 class="bfg-tile__title bfg-tile__title--light">
    <?php echo esc_html( wp_trim_words( $d4['title'], 5, '…' ) ); ?>
  </h3>
</a>
          </article>
          <?php endif; ?>

          <?php if ($btn_text && $btn_url): ?>
          <div class="bfg-cta bfg-cta--under">
            <a class="bfg-btn" href="<?php echo esc_url($btn_url); ?>">
              <?php echo esc_html($btn_text); ?>
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>

<script>
(function ($) {
  const $grid = $('.js-wf-grid');
  if (!$grid.length) return;

  // init/unslick by breakpoint
  function enableSlider() {
    if (window.matchMedia('(max-width: 990px)').matches) {
      if (!$grid.hasClass('slick-initialized')) {
        $grid.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          arrows: false,
          infinite: true,
          adaptiveHeight: true,
          mobileFirst: true
        });
      }
    } else {
      if ($grid.hasClass('slick-initialized')) {
        $grid.slick('unslick');
      }
    }
  }

  // When mounted & on resize/orientation
  $(window).on('load resize orientationchange', enableSlider);
  enableSlider();
})(jQuery);


(function ($) {
  const $desktop = $('.js-brand-desktop');
  if ($desktop.length) {
    $desktop.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      autoplay: true,
      autoplaySpeed: 1800,
      speed: 500,
      infinite: true,
      pauseOnHover: false,
      pauseOnFocus: false,
      responsive: [
        { breakpoint: 1400, settings: { slidesToShow: 3 } },
        { breakpoint: 1200, settings: { slidesToShow: 3 } },
        { breakpoint: 1024, settings: { slidesToShow: 3 } }
      ]
    });
  }

 const initMobile = ($el, rtl, cls) => {
    if (!$el.length) return;
    $el.addClass(cls); // mark direction for CSS
    $el.slick({
      rtl: rtl,
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      autoplay: true,
      autoplaySpeed: 1600,
      speed: 500,
      infinite: true,
      pauseOnHover: false,
      pauseOnFocus: false,
      responsive: [
        { breakpoint: 750, settings: { slidesToShow: 2 } },
        { breakpoint: 640, settings: { slidesToShow: 1 } },
        { breakpoint: 420, settings: { slidesToShow: 1 } }
      ]
    });
  };

  const $row1 = $('.js-brand-mobile-1'); // LTR
  const $row2 = $('.js-brand-mobile-2'); // RTL (opposite)

  // Force explicit directions
  $row1.css('direction', 'ltr');
  $row2.css('direction', 'rtl');

  initMobile($row1, false, 'is-ltr');
  initMobile($row2, true,  'is-rtl');

  // Recalculate after everything is loaded (prevents initial drift)
  $(window).on('load', function(){
    $row1.slick('setPosition');
    $row2.slick('setPosition');
  });
})(jQuery);

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


document.addEventListener('DOMContentLoaded', function () {
  const stepsWrap = document.querySelector('.how-it-works .hiw__steps');
  if (!stepsWrap) return;

  const OPEN_ARROW  = stepsWrap.dataset.openArrow  || 'https://wallypass.com/wp-content/uploads/2025/10/open-arrow.svg';
  const CLOSE_ARROW = stepsWrap.dataset.closeArrow || 'https://wallypass.com/wp-content/uploads/2025/10/close-arrow.svg';

  const steps = Array.from(stepsWrap.querySelectorAll('.hiw-step'));

  function setProgress(activeIndex){
    steps.forEach((step, i) => {
      step.classList.toggle('is-active', i === activeIndex);
      step.classList.toggle('is-past', i < activeIndex);
      const head  = step.querySelector('.hiw-step__head');
      head?.setAttribute('aria-expanded', i === activeIndex ? 'true' : 'false');
      const btnImg = step.querySelector('.hiw-step__toggle img');
      const body   = step.querySelector('.hiw-step__body');

      if (i === activeIndex){
        body?.classList.add('is-open');
        if (btnImg) btnImg.src = CLOSE_ARROW;
      } else {
        body?.classList.remove('is-open');
        if (btnImg) btnImg.src = OPEN_ARROW;
      }
    });
  }

  // Open first by default (matches template)
  let active = steps.findIndex(s => s.classList.contains('is-active'));
  if (active < 0) active = 0;
  setProgress(active);

  // Click/keyboard toggle
  steps.forEach((step, idx) => {
    const head = step.querySelector('.hiw-step__head');
    const btn  = step.querySelector('.hiw-step__toggle');

    function openThis(){
      if (active === idx) return; // already open
      active = idx;
      setProgress(active);
    }

    head?.addEventListener('click', openThis);
    head?.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openThis(); }
    });
    btn?.addEventListener('click', (e) => { e.stopPropagation(); openThis(); });
  });
});


document.addEventListener('DOMContentLoaded', function(){
  const sec = document.querySelector('.faq-sec');
  if(!sec) return;

  const PLUS  = sec.dataset.plus  || 'https://wallypass.com/wp-content/uploads/2025/10/plus-icon.svg';
  const MINUS = sec.dataset.minus || 'https://wallypass.com/wp-content/uploads/2025/10/minus-icon.svg';

  const items = Array.from(sec.querySelectorAll('.faq-item'));

  function openItem(target){
    items.forEach(it => {
      const head = it.querySelector('.faq-head');
      const body = it.querySelector('.faq-body');
      const ico  = it.querySelector('.faq-ico');
      const open = it === target;

      it.classList.toggle('is-open', open);
      head.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (open) {
        // measure content for smooth max-height
        body.style.maxHeight = body.scrollHeight + 'px';
        body.style.opacity = '1';
        body.style.transform = 'translateY(0)';
        if (ico) ico.src = MINUS;
      } else {
        body.style.maxHeight = '0px';
        body.style.opacity = '0';
        body.style.transform = 'translateY(-4px)';
        if (ico) ico.src = PLUS;
      }
    });
  }

  // init: respect .is-open in markup
  const current = items.find(i => i.classList.contains('is-open')) || items[0];
  if (current) openItem(current);

  items.forEach(it => {
    const head = it.querySelector('.faq-head');
    head.addEventListener('click', () => openItem(it));
    head.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openItem(it); }
    });
  });
});


  jQuery(function($){
    var $slider = $('.js-bfg-slider');
    if(!$slider.length) return;

    var autoplaySpeed = 4000;  // keep your values if you had them
    var transitionSpeed = 500;

    // Update the step progress width (1..N)
    function setProgress($scope, total, currentIndex){
      total = Math.max(1, total);
      // currentIndex is 0-based, but we want step = 1..total
      var step = Math.min(total, Math.max(1, currentIndex + 1));
      var pct = (step / total) * 100;
      $scope.find('.bfg-progress__bar').css('width', pct + '%');
    }

    // Bind events BEFORE init
    $slider.on('init', function(e, slick){
      var $wrap = $(slick.$slider).closest('.bfg__mobile');
      setProgress($wrap, slick.slideCount, slick.currentSlide || 0); // first slide -> 1 step
    });

    $slider.on('afterChange', function(e, slick, currentSlide){
      var $wrap = $(slick.$slider).closest('.bfg__mobile');
      setProgress($wrap, slick.slideCount, currentSlide); // advance 1 step
    });

    // Init Slick
    $slider.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: autoplaySpeed,
      speed: transitionSpeed,
      pauseOnHover: false,
      pauseOnFocus: false,
      swipe: true,
      touchThreshold: 10,
      adaptiveHeight: false,
      waitForAnimate: true
    });
  });

</script>