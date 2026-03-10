<?php
/**
 * Template Name: Strategic Partners
 * Template Post Type: page
 *
 * @package FlipNewMedia
 */

get_header();

$image_url = static function ( $image ) {
	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return $image['url'];
	}

	if ( is_string( $image ) ) {
		return $image;
	}

	return '';
};

$default_title      = 'Στρατηγικοί Συνεργάτες';
$default_copy_left  = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
$default_copy_right = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

$default_slider_title = 'ΟΙ ΣΤΡΑΤΗΓΙΚΟΙ ΜΑΣ ΣΥΝΕΡΓΑΤΕΣ';
$default_slider_items = array(
	array(
		'left_bg'    => 'https://www.figma.com/api/mcp/asset/18e8f49a-0974-4a85-8d1f-b0d5ebbcda9b',
		'right_bg'   => 'https://www.figma.com/api/mcp/asset/67be2099-8bbf-4a8f-97e8-a2c64be642a0',
		'logo'       => 'https://www.figma.com/api/mcp/asset/649f5ae5-afb2-43cb-bd92-3439a7c65eff',
		'more_url'   => '#',
		'more_label' => 'Περισσότερα',
	),
	array(
		'left_bg'    => 'https://www.figma.com/api/mcp/asset/18e8f49a-0974-4a85-8d1f-b0d5ebbcda9b',
		'right_bg'   => 'https://www.figma.com/api/mcp/asset/67be2099-8bbf-4a8f-97e8-a2c64be642a0',
		'logo'       => 'https://www.figma.com/api/mcp/asset/649f5ae5-afb2-43cb-bd92-3439a7c65eff',
		'more_url'   => '#',
		'more_label' => 'Περισσότερα',
	),
	array(
		'left_bg'    => 'https://www.figma.com/api/mcp/asset/18e8f49a-0974-4a85-8d1f-b0d5ebbcda9b',
		'right_bg'   => 'https://www.figma.com/api/mcp/asset/67be2099-8bbf-4a8f-97e8-a2c64be642a0',
		'logo'       => 'https://www.figma.com/api/mcp/asset/649f5ae5-afb2-43cb-bd92-3439a7c65eff',
		'more_url'   => '#',
		'more_label' => 'Περισσότερα',
	),
);

$default_logo_items = array(
	'https://www.figma.com/api/mcp/asset/c679f174-cc54-4acc-b039-5d1a064440e3',
	'https://www.figma.com/api/mcp/asset/628a172a-518b-485d-ae24-fb36049e4deb',
	'https://www.figma.com/api/mcp/asset/64749510-3142-4513-a348-954055acbd45',
	'https://www.figma.com/api/mcp/asset/90c36cf2-5eeb-4763-9031-8dc1e5f7bc9c',
	'https://www.figma.com/api/mcp/asset/2f19ae33-755e-41cf-ae93-6743e6cc6c7d',
	'https://www.figma.com/api/mcp/asset/628a172a-518b-485d-ae24-fb36049e4deb',
	'https://www.figma.com/api/mcp/asset/64749510-3142-4513-a348-954055acbd45',
	'https://www.figma.com/api/mcp/asset/90c36cf2-5eeb-4763-9031-8dc1e5f7bc9c',
	'https://www.figma.com/api/mcp/asset/2f19ae33-755e-41cf-ae93-6743e6cc6c7d',
	'https://www.figma.com/api/mcp/asset/c679f174-cc54-4acc-b039-5d1a064440e3',
	'https://www.figma.com/api/mcp/asset/c679f174-cc54-4acc-b039-5d1a064440e3',
	'https://www.figma.com/api/mcp/asset/628a172a-518b-485d-ae24-fb36049e4deb',
	'https://www.figma.com/api/mcp/asset/64749510-3142-4513-a348-954055acbd45',
	'https://www.figma.com/api/mcp/asset/90c36cf2-5eeb-4763-9031-8dc1e5f7bc9c',
	'https://www.figma.com/api/mcp/asset/2f19ae33-755e-41cf-ae93-6743e6cc6c7d',
	'https://www.figma.com/api/mcp/asset/628a172a-518b-485d-ae24-fb36049e4deb',
	'https://www.figma.com/api/mcp/asset/64749510-3142-4513-a348-954055acbd45',
	'https://www.figma.com/api/mcp/asset/90c36cf2-5eeb-4763-9031-8dc1e5f7bc9c',
	'https://www.figma.com/api/mcp/asset/2f19ae33-755e-41cf-ae93-6743e6cc6c7d',
	'https://www.figma.com/api/mcp/asset/c679f174-cc54-4acc-b039-5d1a064440e3',
);

$hero_title      = function_exists( 'get_field' ) ? ( get_field( 'sp_hero_title' ) ?: $default_title ) : $default_title;
$hero_copy_left  = function_exists( 'get_field' ) ? ( get_field( 'sp_hero_copy_left' ) ?: $default_copy_left ) : $default_copy_left;
$hero_copy_right = function_exists( 'get_field' ) ? ( get_field( 'sp_hero_copy_right' ) ?: $default_copy_right ) : $default_copy_right;

$partners_section_title = function_exists( 'get_field' ) ? ( get_field( 'sp_partners_slider_title' ) ?: $default_slider_title ) : $default_slider_title;
$partners_slides        = array();

if ( function_exists( 'have_rows' ) && have_rows( 'sp_partners_slides' ) ) {
	while ( have_rows( 'sp_partners_slides' ) ) {
		the_row();

		$partners_slides[] = array(
			'left_bg'    => $image_url( get_sub_field( 'left_bg' ) ),
			'right_bg'   => $image_url( get_sub_field( 'right_bg' ) ),
			'logo'       => $image_url( get_sub_field( 'logo' ) ),
			'more_url'   => get_sub_field( 'more_url' ) ?: '#',
			'more_label' => get_sub_field( 'more_label' ) ?: 'Περισσότερα',
		);
	}
}

if ( empty( $partners_slides ) ) {
	$partners_slides = $default_slider_items;
}

$logo_items = array();

if ( function_exists( 'have_rows' ) && have_rows( 'sp_logo_items' ) ) {
	while ( have_rows( 'sp_logo_items' ) ) {
		the_row();

		$logo_url = $image_url( get_sub_field( 'logo' ) );
		if ( $logo_url ) {
			$logo_items[] = $logo_url;
		}
	}
}

if ( empty( $logo_items ) ) {
	$logo_items = $default_logo_items;
}

$logos_more_label = function_exists( 'get_field' ) ? ( get_field( 'sp_logos_more_label' ) ?: 'Περισσότερα' ) : 'Περισσότερα';
$logos_more_url   = function_exists( 'get_field' ) ? ( get_field( 'sp_logos_more_url' ) ?: '#' ) : '#';
?>

<main id="primary" class="site-main strategic-partners-template">
  <section class="strategic-partners-hero figma-node-711-213" data-node-id="711:213" aria-label="<?php esc_attr_e( 'Strategic partners introduction', 'flipnewmedia' ); ?>">
    <div class="container-ext">
      <div class="strategic-partners-hero__heading">
        <h1 class="strategic-partners-hero__title" data-node-id="642:4283"><?php echo esc_html( $hero_title ); ?></h1>
        <div class="strategic-partners-hero__line" data-node-id="642:4229" aria-hidden="true"></div>
      </div>

      <div class="strategic-partners-hero__grid">
        <?php if ( $hero_copy_left ) : ?>
          <div class="strategic-partners-hero__column">
            <p class="strategic-partners-hero__copy" data-node-id="642:4284"><?php echo wp_kses_post( nl2br( $hero_copy_left ) ); ?></p>
          </div>
        <?php endif; ?>

        <?php if ( $hero_copy_right ) : ?>
          <div class="strategic-partners-hero__column">
            <p class="strategic-partners-hero__copy" data-node-id="642:4285"><?php echo wp_kses_post( nl2br( $hero_copy_right ) ); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php if ( ! empty( $partners_slides ) ) : ?>
    <section class="home-partners figma-node-700-95" data-node-id="700:95" aria-label="<?php esc_attr_e( 'Strategic partners', 'flipnewmedia' ); ?>">
      <div class="container-ext">
        <h2 class="home-partners-title" data-node-id="642:4138"><?php echo esc_html( $partners_section_title ); ?></h2>
      </div>
      <div class="home-partners-slider js-home-partners-slider">
        <?php foreach ( $partners_slides as $slide ) : ?>
          <article class="home-partners-slide">
            <div class="home-partners-media">
              <div class="home-partners-bg home-partners-bg--left" style="background-image:url('<?php echo esc_url( $slide['left_bg'] ); ?>');"></div>
              <div class="home-partners-bg home-partners-bg--right" style="background-image:url('<?php echo esc_url( $slide['right_bg'] ); ?>');"></div>
              <div class="home-partners-logo-wrap">
                <img class="home-partners-logo" src="<?php echo esc_url( $slide['logo'] ); ?>" alt="<?php esc_attr_e( 'Partner logo', 'flipnewmedia' ); ?>" loading="lazy" decoding="async" />
              </div>
              <a class="home-partners-more" href="<?php echo esc_url( $slide['more_url'] ); ?>">
                <span><?php echo esc_html( $slide['more_label'] ); ?></span>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( ! empty( $logo_items ) ) : ?>
    <section class="strategic-partners-logos figma-node-711-215" data-node-id="711:215" aria-label="<?php esc_attr_e( 'Strategic partners logos', 'flipnewmedia' ); ?>">
      <div class="container-ext">
        <div class="strategic-partners-logos__grid">
          <?php foreach ( $logo_items as $index => $logo_url ) : ?>
            <div class="strategic-partners-logos__item" data-node-id="<?php echo esc_attr( '711:215-' . $index ); ?>">
              <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php esc_attr_e( 'Strategic partner logo', 'flipnewmedia' ); ?>" loading="lazy" decoding="async" />
            </div>
          <?php endforeach; ?>
        </div>

        <?php if ( $logos_more_label ) : ?>
          <div class="strategic-partners-logos__cta">
            <a href="<?php echo esc_url( $logos_more_url ); ?>" class="strategic-partners-logos__more">
              <span class="strategic-partners-logos__more-label"><?php echo esc_html( $logos_more_label ); ?></span>
              <span class="strategic-partners-logos__more-icon" aria-hidden="true">↓</span>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php while ( have_posts() ) : the_post(); ?>
    <section class="strategic-partners-template__content">
      <div class="container-ext">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (typeof window.jQuery === 'undefined') {
    return;
  }

  var $ = window.jQuery;
  if (typeof $.fn.slick !== 'function') {
    return;
  }

  var $slider = $('.js-home-partners-slider');
  if (!$slider.length) {
    return;
  }

  if ($slider.hasClass('slick-initialized')) {
    $slider.slick('unslick');
  }

  $slider.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    speed: 550,
    arrows: true,
    dots: true,
    adaptiveHeight: false,
    prevArrow: '<button type="button" class="slick-prev" aria-label="Previous partner"></button>',
    nextArrow: '<button type="button" class="slick-next" aria-label="Next partner"></button>'
  });

  $slider.off('.partnersCursor');
  $slider.on('mouseenter.partnersCursor', '.home-partners-media', function () {
    this.classList.add('is-cursor-active');
  });

  $slider.on('mousemove.partnersCursor', '.home-partners-media', function (event) {
    var bubble = this.querySelector('.home-partners-more');
    if (!bubble) return;

    var rect = this.getBoundingClientRect();
    var x = event.clientX - rect.left;
    var y = event.clientY - rect.top;
    var pad = 24;

    x = Math.max(pad, Math.min(rect.width - pad, x));
    y = Math.max(pad, Math.min(rect.height - pad, y));

    bubble.style.left = x + 'px';
    bubble.style.top = y + 'px';
  });

  $slider.on('mouseleave.partnersCursor', '.home-partners-media', function () {
    this.classList.remove('is-cursor-active');
  });
});
</script>

<?php
get_footer();
