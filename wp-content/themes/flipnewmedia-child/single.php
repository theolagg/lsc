<?php
/**
 * Single Post template
 */
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

<main id="primary" class="site-main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('sp'); ?>>

  <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title"><?php the_title(); ?></h1>
<div class="hero-description">
<p></p>
    </div>
</div>
    <div class="hero-col hero-1-right">
     
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>

    <!-- Absolute text element relative to Row 1 -->
    
  </div>

</section>

 <div class="sp__bar">
        <a class="sp__back" href="https://wallypass.com/category/blog/">
          <span class="sp__back-ico" aria-hidden="true"></span>
          <span class="sp__back-txt">Πίσω</span>
        </a>

        <time class="sp__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
          <span>Δημοσιεύτηκε:</span> <?php echo esc_html( get_the_date( 'jS F Y' ) ); ?>
        </time>
      </div>

    <div class="sp__inner">


  


      <!-- Utility row: Back + date -->
     

      <!-- Featured image -->
      <?php if ( has_post_thumbnail() ) : ?>
        <figure class="sp__hero">
          <?php the_post_thumbnail( 'large', [ 'loading' => 'eager', 'decoding' => 'async' ] ); ?>
        </figure>
      <?php endif; ?>

      <!-- Content -->
      <div class="sp__content entry-content">
        <?php
          the_content();

          // Support for multipage posts
          wp_link_pages( [
            'before' => '<div class="sp__pages">' . esc_html__( 'Pages:', 'textdomain' ),
            'after'  => '</div>',
          ] );
        ?>
      </div>

   
     

    </div>


<?php
/**
 * Related Posts (by category) – 4 latest, excluding current post
 * Keeps the same markup/layout as your ACF section.
 */

/* ---------- Helpers ---------- */
if (!function_exists('bfg_post_data_by_id')) {
  function bfg_post_data_by_id($pid) {
    if (!$pid) return null;
    $img_url = get_the_post_thumbnail_url($pid, 'large');
    $img_id  = get_post_thumbnail_id($pid);
    $alt     = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';
    // Trim to ~26 words like before
    $raw     = get_the_excerpt($pid);
    if (!$raw) {
      $raw = wp_strip_all_tags( get_post_field('post_content', $pid) );
    }
    $excerpt = wp_trim_words( $raw, 26, '…' );

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

/* ---------- Query 4 latest in same category (excluding current) ---------- */
$current_id = get_the_ID();
$cat_ids    = wp_get_post_categories( $current_id ); // array of IDs

$args = [
  'post_type'           => 'post',
  'posts_per_page'      => 4,
  'post__not_in'        => [$current_id],
  'ignore_sticky_posts' => 1,
  'orderby'             => 'date',
  'order'               => 'DESC',
];

if ( !empty($cat_ids) ) {
  $args['category__in'] = $cat_ids;
}

$q = new WP_Query($args);
$related_ids = [];

if ( $q->have_posts() ) {
  while ( $q->have_posts() ) { $q->the_post();
    $related_ids[] = get_the_ID();
  }
}
wp_reset_postdata();

/* Fallback: if less than 4 found, top up with latest posts overall (still excluding current + already used) */
if ( count($related_ids) < 4 ) {
  $need = 4 - count($related_ids);
  $fallback = new WP_Query([
    'post_type'           => 'post',
    'posts_per_page'      => $need,
    'post__not_in'        => array_merge([$current_id], $related_ids),
    'ignore_sticky_posts' => 1,
    'orderby'             => 'date',
    'order'               => 'DESC',
  ]);
  if ( $fallback->have_posts() ) {
    while ( $fallback->have_posts() ) { $fallback->the_post();
      $related_ids[] = get_the_ID();
    }
  }
  wp_reset_postdata();
}

/* Build data pack like your previous $d1..$d4 */
$cards = [];
foreach ($related_ids as $pid) {
  $cards[] = bfg_post_data_by_id($pid);
}
$cards = array_values(array_filter($cards)); // sanitize

if (empty($cards)) return;

// Map to positions (hero/left, split, tile left, tile right)
$d1 = $cards[0] ?? null;
$d2 = $cards[1] ?? null;
$d3 = $cards[2] ?? null;
$d4 = $cards[3] ?? null;

/* Button: link to primary category (or first), fallback to blog page/archive */
$btn_text = __('Δείτε όλα', 'textdomain');
$btn_url  = '';

if (!empty($cat_ids)) {
  $btn_url = get_category_link( $cat_ids[0] );
}
if (!$btn_url) {
  $posts_page = (int) get_option('page_for_posts');
  $btn_url    = $posts_page ? get_permalink($posts_page) : ( get_post_type_archive_link('post') ?: home_url('/') );
}

/* For mobile slider slides */
$slides = array_values(array_filter([$d1, $d2, $d3, $d4]));

$uid = uniqid('bfg-');
?>
<section id="<?php echo esc_attr($uid); ?>" class="bfg">
  <!-- Header -->
  <div class="bfg__head">
    <div class="bfg__head-left">
      <h2 class="bfg__title"><?php esc_html_e('Προτεινόμενα ', 'textdomain'); ?></h2>
    </div>
    <div class="bfg__head-right">
      <p class="bfg__subtitle">
        <?php esc_html_e('Δείτε τις τελευταίες εξελίξεις και νέα από τον χώρο μας. Μείνετε πάντα μπροστά με χρήσιμες συμβουλές από ειδικούς και αποκλειστικό περιεχόμενο.', 'textdomain'); ?>
      </p>
    </div>
  </div>

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

    <?php if ($btn_url): ?>
      <a class="bfg-btn mob" href="<?php echo esc_url($btn_url); ?>">
        <?php echo esc_html($btn_text); ?>
      </a>
    <?php endif; ?>
  </div>

  <!-- Desktop grid -->
  <div class="bfg__grid">
    <div class="bfg__col-left">
      <?php if ($d1): ?>
      <article class="bfg-hero">
        <?php if ($d1['img']): ?>
          <a href="<?php echo esc_url($d1['url']); ?>" class="bfg-hero__img" aria-label="<?php echo esc_attr($d1['title']); ?>">
            <img src="<?php echo esc_url($d1['img']); ?>" alt="<?php echo esc_attr($d1['img_alt']); ?>" loading="lazy" decoding="async">
          </a>
        <?php endif; ?>
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

    <div class="bfg__col-right">
      <?php if ($d2): ?>
      <article class="bfg-split">
        <?php if ($d2['img']): ?>
          <a href="<?php echo esc_url($d2['url']); ?>" class="bfg-split__img" aria-label="<?php echo esc_attr($d2['title']); ?>">
            <img src="<?php echo esc_url($d2['img']); ?>" alt="<?php echo esc_attr($d2['img_alt']); ?>" loading="lazy" decoding="async">
          </a>
        <?php endif; ?>
        <div class="bfg-split__content">
          <a class="bfg-link" href="<?php echo esc_url($d2['url']); ?>">
            <h3 class="bfg-split__title"><?php echo esc_html($d2['title']); ?></h3>
          </a>
          <?php if (!empty($d2['excerpt'])): ?>
            <p class="bfg-split__excerpt"><?php echo esc_html($d2['excerpt']); ?></p>
          <?php endif; ?>
        </div>
      </article>
      <?php endif; ?>

      <div class="bfg-row">
        <div class="bfg-row__left">
          <?php if ($d3): ?>
          <article class="bfg-tile bfg-tile--salmon">
            <a class="bfg-link" href="<?php echo esc_url($d3['url']); ?>">
              <h3 class="bfg-tile__title"><?php echo esc_html($d3['title']); ?></h3>
            </a>
            <?php if (!empty($d3['excerpt'])): ?>
              <p class="bfg-tile__excerpt"><?php echo esc_html($d3['excerpt']); ?></p>
            <?php endif; ?>
          </article>
          <?php endif; ?>
        </div>

        <div class="bfg-row__right">
          <?php if ($d4): ?>
          <article class="bfg-tile bfg-tile--maroon">
            <a class="bfg-link" href="<?php echo esc_url($d4['url']); ?>">
              <h3 class="bfg-tile__title bfg-tile__title--light"><?php echo esc_html($d4['title']); ?></h3>
            </a>
          </article>
          <?php endif; ?>

          <?php if ($btn_url): ?>
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





  </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>




<script>


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