<?php
/**
 * Template Name: Life Science Chemilab
 * Template Post Type: page
 *
 * @package FlipNewMedia
 */

get_header();

if ( ! function_exists( 'lsc_template_image_url' ) ) {
	function lsc_template_image_url( $value, $default = '' ) {
		if ( is_array( $value ) ) {
			if ( ! empty( $value['url'] ) ) {
				return (string) $value['url'];
			}

			if ( ! empty( $value['ID'] ) ) {
				$image_url = wp_get_attachment_image_url( (int) $value['ID'], 'full' );
				return $image_url ? $image_url : $default;
			}
		}

		if ( is_numeric( $value ) ) {
			$image_url = wp_get_attachment_image_url( (int) $value, 'full' );
			return $image_url ? $image_url : $default;
		}

		if ( is_string( $value ) && '' !== $value ) {
			return $value;
		}

		return $default;
	}
}

$hero_image_url       = '';
$hero_title           = '';
$hero_copy            = '';
$activity_items       = array();
$story_title          = '';
$story_intro          = '';
$story_slides         = array();
$certifications_title = '';
$certifications_copy  = array();
$certification_items  = array();

if ( function_exists( 'get_field' ) ) {
	$hero_image_url = lsc_template_image_url( get_field( 'lsc_hero_image' ) );
	$hero_title     = (string) ( get_field( 'lsc_hero_title' ) ?: '' );
	$hero_copy      = (string) ( get_field( 'lsc_hero_copy' ) ?: '' );

	$acf_activity_items = get_field( 'lsc_activity_items' );
	if ( is_array( $acf_activity_items ) && ! empty( $acf_activity_items ) ) {
		foreach ( $acf_activity_items as $index => $item ) {
			if ( empty( $item['title'] ) && empty( $item['description'] ) ) {
				continue;
			}
			$activity_items[] = array(
				'node'        => 'activity-' . $index,
				'title'       => isset( $item['title'] ) ? (string) $item['title'] : '',
				'description' => isset( $item['description'] ) ? (string) $item['description'] : '',
			);
		}
	}

	$story_title          = (string) ( get_field( 'lsc_story_title' ) ?: '' );
	$story_intro          = (string) ( get_field( 'lsc_story_intro' ) ?: '' );
	$story_fallback_image = lsc_template_image_url( get_field( 'lsc_story_fallback_image' ) );

	$acf_story_slides = get_field( 'lsc_story_slides' );
	if ( is_array( $acf_story_slides ) && ! empty( $acf_story_slides ) ) {
		foreach ( $acf_story_slides as $slide ) {
			$slide_image = lsc_template_image_url( $slide['image'] ?? '', $story_fallback_image );
			if ( empty( $slide['year'] ) && empty( $slide['count'] ) && empty( $slide['text'] ) && '' === $slide_image ) {
				continue;
			}
			$story_slides[] = array(
				'year'  => isset( $slide['year'] ) ? (string) $slide['year'] : '',
				'count' => isset( $slide['count'] ) ? (string) $slide['count'] : '',
				'text'  => isset( $slide['text'] ) ? (string) $slide['text'] : '',
				'image' => $slide_image,
			);
		}
	}

	$certifications_title = (string) ( get_field( 'lsc_certifications_title' ) ?: '' );

	$acf_certifications_copy = get_field( 'lsc_certifications_copy' );
	if ( is_string( $acf_certifications_copy ) && '' !== trim( $acf_certifications_copy ) ) {
		$certifications_copy = preg_split( '/\r\n\r\n|\n\n/', trim( $acf_certifications_copy ) );
	}

	$acf_certification_items = get_field( 'lsc_certification_items' );
	if ( is_array( $acf_certification_items ) && ! empty( $acf_certification_items ) ) {
		foreach ( $acf_certification_items as $index => $item ) {
			$item_image = lsc_template_image_url( $item['image'] ?? '' );
			if ( empty( $item['label'] ) && '' === $item_image ) {
				continue;
			}
			$certification_items[] = array(
				'node'   => 'certification-' . $index,
				'label'  => isset( $item['label'] ) ? (string) $item['label'] : '',
				'image'  => $item_image,
				'active' => ! empty( $item['active'] ),
			);
		}
	}
}
?>

<main id="primary" class="site-main lsc-chemilab-template">
  <?php if ( '' !== $hero_image_url || '' !== $hero_title || '' !== $hero_copy ) : ?>
  <section class="lsc-chemilab-hero figma-node-642-4715" data-node-id="642:4715">
    <div class="lsc-chemilab-hero__media" style="background-image:url('<?php echo esc_url( $hero_image_url ); ?>');">
      <div class="lsc-chemilab-hero__overlay figma-node-642-4717" data-node-id="642:4717" aria-hidden="true"></div>
      <div class="container-ext lsc-chemilab-hero__content">
        <div class="lsc-chemilab-hero__grid">
          <?php if ( '' !== $hero_title ) : ?>
          <h1 class="lsc-chemilab-hero__title" data-node-id="642:4720"><?php echo nl2br( esc_html( $hero_title ) ); ?></h1>
          <?php endif; ?>
          <?php if ( '' !== $hero_copy ) : ?>
          <p class="lsc-chemilab-hero__copy" data-node-id="642:4719"><?php echo esc_html( $hero_copy ); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if ( ! empty( $activity_items ) || '' !== $story_title || '' !== $story_intro || ! empty( $story_slides ) ) : ?>
  <section class="lsc-chemilab-story figma-node-706-34" data-node-id="706:34" aria-label="<?php esc_attr_e( 'Life Science Chemilab story', 'flipnewmedia' ); ?>">
    <?php if ( ! empty( $activity_items ) ) : ?>
    <div class="lsc-chemilab-story__top">
      <div class="container-ext">
        <div class="lsc-chemilab-story__activities">
          <?php foreach ( $activity_items as $item ) : ?>
            <article class="lsc-chemilab-story__activity" data-node-id="<?php echo esc_attr( $item['node'] ); ?>">
              <h3 class="lsc-chemilab-story__activity-title"><?php echo esc_html( $item['title'] ); ?></h3>
              <?php if ( '' !== $item['description'] ) : ?>
                <p class="lsc-chemilab-story__activity-copy"><?php echo esc_html( $item['description'] ); ?></p>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <div class="container-ext lsc-chemilab-story__panel-wrap">
      <div class="lsc-chemilab-story__panel">
        <button class="lsc-chemilab-story__arrow lsc-chemilab-story__arrow--prev" type="button" aria-label="<?php esc_attr_e( 'Previous story milestone', 'flipnewmedia' ); ?>">
          <span aria-hidden="true"></span>
        </button>

        <div class="lsc-chemilab-story__inner">
          <header class="lsc-chemilab-story__head">
            <?php if ( '' !== $story_title ) : ?>
            <h2 class="lsc-chemilab-story__title" data-node-id="642:4722"><?php echo esc_html( $story_title ); ?></h2>
            <?php endif; ?>
            <?php if ( '' !== $story_intro ) : ?>
            <p class="lsc-chemilab-story__intro" data-node-id="642:4739"><?php echo esc_html( $story_intro ); ?></p>
            <?php endif; ?>
          </header>

          <?php if ( ! empty( $story_slides ) ) : ?>
          <div class="lsc-chemilab-story__timeline">
            <div class="lsc-chemilab-story__track" aria-hidden="true">
              <span class="lsc-chemilab-story__dot lsc-chemilab-story__dot--left"></span>
              <span class="lsc-chemilab-story__dot lsc-chemilab-story__dot--active"></span>
              <span class="lsc-chemilab-story__dot lsc-chemilab-story__dot--right"></span>
            </div>

            <div class="lsc-chemilab-story__years">
              <span class="lsc-chemilab-story__year lsc-chemilab-story__year--side js-story-year-prev"><?php echo esc_html( $story_slides[0]['year'] ); ?></span>
              <span class="lsc-chemilab-story__year lsc-chemilab-story__year--active js-story-year-current"><?php echo esc_html( $story_slides[1]['year'] ); ?></span>
              <span class="lsc-chemilab-story__year lsc-chemilab-story__year--side js-story-year-next"><?php echo esc_html( $story_slides[2]['year'] ); ?></span>
            </div>

            <div class="lsc-chemilab-story__slider js-lsc-chemilab-story-slider">
              <?php foreach ( $story_slides as $slide ) : ?>
                <article class="lsc-chemilab-story__slide" data-year="<?php echo esc_attr( $slide['year'] ); ?>">
                  <div class="lsc-chemilab-story__card">
                    <div class="lsc-chemilab-story__card-media">
                      <img src="<?php echo esc_url( $slide['image'] ); ?>" alt="" loading="lazy" decoding="async" />
                    </div>
                    <div class="lsc-chemilab-story__card-copy">
                      <span class="lsc-chemilab-story__card-count" data-node-id="642:4741"><?php echo esc_html( $slide['count'] ); ?></span>
                      <p class="lsc-chemilab-story__card-text" data-node-id="642:4740"><?php echo esc_html( $slide['text'] ); ?></p>
                    </div>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <button class="lsc-chemilab-story__arrow lsc-chemilab-story__arrow--next" type="button" aria-label="<?php esc_attr_e( 'Next story milestone', 'flipnewmedia' ); ?>">
          <span aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if ( '' !== $certifications_title || ! empty( $certifications_copy ) || ! empty( $certification_items ) ) : ?>
  <section class="lsc-chemilab-certifications figma-node-707-35" data-node-id="707:35" aria-label="<?php esc_attr_e( 'Certifications', 'flipnewmedia' ); ?>">
    <div class="container-ext">
      <div class="lsc-chemilab-certifications__head">
        <?php if ( '' !== $certifications_title ) : ?>
        <h2 class="lsc-chemilab-certifications__title" data-node-id="642:4737"><?php echo esc_html( $certifications_title ); ?></h2>
        <?php endif; ?>
      </div>

      <div class="lsc-chemilab-certifications__grid">
        <div class="lsc-chemilab-certifications__copy" data-node-id="642:4750">
          <?php foreach ( $certifications_copy as $paragraph ) : ?>
            <?php if ( '' === trim( (string) $paragraph ) ) : ?>
              <?php continue; ?>
            <?php endif; ?>
            <p><?php echo esc_html( $paragraph ); ?></p>
          <?php endforeach; ?>
        </div>

        <div class="lsc-chemilab-certifications__panel js-lsc-certifications-panel">
          <?php if ( ! empty( $certification_items ) ) : ?>
          <div class="lsc-chemilab-certifications__list">
            <?php foreach ( $certification_items as $item ) : ?>
              <article class="lsc-chemilab-certifications__item<?php echo $item['active'] ? ' is-active' : ''; ?>" data-node-id="<?php echo esc_attr( $item['node'] ); ?>" data-image="<?php echo esc_url( $item['image'] ); ?>">
                <span class="lsc-chemilab-certifications__item-label"><?php echo esc_html( $item['label'] ); ?></span>
                <span class="lsc-chemilab-certifications__item-icon" aria-hidden="true">
                  <svg width="44" height="51" viewBox="0 0 44 51" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M30.4 1V7.06712C30.4 9.74788 32.907 11.9208 36 11.9208H43M30.4 1H6.6C3.50705 1 1 3.17294 1 5.8537V44.6833C1 47.3641 3.50705 49.537 6.6 49.537H37.4C40.4929 49.537 43 47.3641 43 44.6833V11.9208M30.4 1L43 11.9208" stroke="#00AEEF" stroke-width="2"/>
<path d="M19.0838 26.7203L22.1753 29.3998M22.1753 29.3998L25.2669 26.7203M22.1753 29.3998V24.0407M29.9044 26.7203C29.9044 30.42 26.4439 33.4193 22.1753 33.4193C17.9067 33.4193 14.4463 30.42 14.4463 26.7203C14.4463 23.0205 17.9067 20.0212 22.1753 20.0212C26.4439 20.0212 29.9044 23.0205 29.9044 26.7203Z" stroke="#00AEEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                </span>
              </article>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <?php if ( ! empty( $certification_items ) ) : ?>
          <div class="lsc-chemilab-certifications__visual js-lsc-certifications-visual" aria-hidden="true">
            <span class="lsc-chemilab-certifications__glow" aria-hidden="true"></span>
            <img class="js-lsc-certifications-image" src="<?php echo esc_url( $certification_items[0]['image'] ); ?>" alt="" loading="lazy" decoding="async" />
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php while ( have_posts() ) : the_post(); ?>
    <section class="lsc-chemilab-content">
      <div class="container-ext">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<script>
  (function () {
    function initChemilabStorySlider() {
      if (typeof window.jQuery === 'undefined') return;
      var $ = window.jQuery;
      if (typeof $.fn.slick !== 'function') return;

      var $slider = $('.js-lsc-chemilab-story-slider');
      if (!$slider.length) return;

      var slidesCount = $slider.children().length;
      var $prevYear = $('.js-story-year-prev');
      var $currentYear = $('.js-story-year-current');
      var $nextYear = $('.js-story-year-next');

      function getYear(index) {
        var normalized = ((index % slidesCount) + slidesCount) % slidesCount;
        var node = $slider.find('.lsc-chemilab-story__slide').eq(normalized);
        return node.attr('data-year') || '';
      }

      function updateYears(currentIndex) {
        if (!$prevYear.length || !$currentYear.length || !$nextYear.length) return;
        $prevYear.text(getYear(currentIndex - 1));
        $currentYear.text(getYear(currentIndex));
        $nextYear.text(getYear(currentIndex + 1));
      }

      if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }

      $slider.on('init', function (event, slick) {
        updateYears(slick.currentSlide || 0);
      });

      $slider.on('afterChange', function (event, slick, currentSlide) {
        updateYears(currentSlide || 0);
      });

      $slider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        speed: 500,
        arrows: true,
        dots: false,
        adaptiveHeight: false,
        initialSlide: 1,
        prevArrow: $('.lsc-chemilab-story__arrow--prev'),
        nextArrow: $('.lsc-chemilab-story__arrow--next')
      });
    }

    function initChemilabCertificationHover() {
      var panel = document.querySelector('.js-lsc-certifications-panel');
      var visual = document.querySelector('.js-lsc-certifications-visual');
      var image = document.querySelector('.js-lsc-certifications-image');
      if (!panel || !visual || !image) return;
      if (window.matchMedia('(max-width: 991px)').matches) return;

      var items = panel.querySelectorAll('.lsc-chemilab-certifications__item[data-image]');
      if (!items.length) return;

      function setVisualPosition(event) {
        var rect = panel.getBoundingClientRect();
        var x = event.clientX - rect.left;
        var y = event.clientY - rect.top;
        var padX = 48;
        var padY = 48;

        x = Math.max(padX, Math.min(rect.width - padX, x));
        y = Math.max(padY, Math.min(rect.height - padY, y));

        visual.style.left = x + 'px';
        visual.style.top = y + 'px';
      }

      items.forEach(function (item) {
        item.addEventListener('mouseenter', function (event) {
          panel.classList.add('is-cursor-active');
          item.classList.add('is-hovered');
          image.src = item.getAttribute('data-image') || image.src;
          visual.classList.add('is-visible');
          setVisualPosition(event);
        });

        item.addEventListener('mousemove', function (event) {
          setVisualPosition(event);
        });

        item.addEventListener('mouseleave', function () {
          item.classList.remove('is-hovered');
          visual.classList.remove('is-visible');
          panel.classList.remove('is-cursor-active');
        });
      });

      panel.addEventListener('mouseleave', function () {
        visual.classList.remove('is-visible');
        panel.classList.remove('is-cursor-active');
        items.forEach(function (item) {
          item.classList.remove('is-hovered');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function () {
        initChemilabStorySlider();
        initChemilabCertificationHover();
      });
    } else {
      initChemilabStorySlider();
      initChemilabCertificationHover();
    }
  })();
</script>

<?php
get_footer();
