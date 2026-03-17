<?php
/**
 * Taxonomy template for BU Brands.
 *
 * @package FlipNewMedia_Child
 */

get_header();

$term = get_queried_object();

if ( ! $term instanceof WP_Term ) {
	get_footer();
	return;
}

$hero_video                   = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/1009729562-preview.mp4';
$brand_intro_title            = '';
$brand_intro_description      = '';
$brand_intro_button_text      = '';
$brand_intro_button_url       = '';
$brand_categories_description = '';

if ( function_exists( 'get_field' ) ) {
	$brand_intro_title            = (string) ( get_field( 'brand_intro_title', $term ) ?: get_field( 'title', $term ) ?: '' );
	$brand_intro_description      = (string) ( get_field( 'brand_intro_description', $term ) ?: get_field( 'description', $term ) ?: '' );
	$brand_intro_button_text      = (string) ( get_field( 'brand_intro_button_text', $term ) ?: get_field( 'button_text', $term ) ?: '' );
	$brand_intro_button_url       = (string) ( get_field( 'brand_intro_button_url', $term ) ?: get_field( 'button_url', $term ) ?: '' );
	$brand_categories_description = (string) ( get_field( 'brand_categories_description', $term ) ?: get_field( 'categories_description', $term ) ?: '' );
}

$brand_intro_title            = $brand_intro_title ? $brand_intro_title : $term->name;
$brand_intro_description      = $brand_intro_description ? $brand_intro_description : wp_strip_all_tags( term_description( $term, 'bu-brand' ) );
$brand_intro_button_text      = $brand_intro_button_text ? $brand_intro_button_text : __( 'Περισσότερα', 'flipnewmedia' );
$brand_intro_button_url       = $brand_intro_button_url ? $brand_intro_button_url : '';
$brand_categories_description = $brand_categories_description ? $brand_categories_description : __( 'Δείτε όλες τις διαθέσιμες κατηγορίες προϊόντων αυτού του brand και περιηγηθείτε στις αντίστοιχες λύσεις.', 'flipnewmedia' );

$brand_slider_query = new WP_Query(
	array(
		'post_type'           => 'bu-product',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'tax_query'           => array(
			array(
				'taxonomy' => 'bu-brand',
				'field'    => 'term_id',
				'terms'    => array( (int) $term->term_id ),
			),
		),
	)
);

$brand_category_tabs = array();

if ( $brand_slider_query->have_posts() ) {
	$product_ids = wp_list_pluck( $brand_slider_query->posts, 'ID' );
	$brand_category_tabs = wp_get_object_terms(
		$product_ids,
		'bu-category',
		array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
		)
	);
	$brand_category_tabs = is_wp_error( $brand_category_tabs ) ? array() : array_values( $brand_category_tabs );
}
?>

<main id="primary" class="site-main bu-brand-taxonomy">
	<section class="bu-brand-hero figma-node-712-43" data-node-id="712:43" aria-label="<?php echo esc_attr( $term->name ); ?>">
		<div class="bu-brand-hero__visual">
			<video class="bu-brand-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
				<source src="<?php echo esc_url( $hero_video ); ?>" type="video/mp4">
			</video>
			<div class="bu-brand-hero__visual-overlay" aria-hidden="true"></div>
			<div class="container-ext bu-brand-hero__visual-inner">
				<h1 class="bu-brand-hero__title" data-node-id="642:4365"><?php echo esc_html( $term->name ); ?></h1>
			</div>
			<div class="bu-brand-hero__fade" aria-hidden="true"></div>
		</div>
	</section>

	<section class="bu-brand-intro figma-node-712-44" data-node-id="712:44" aria-label="<?php esc_attr_e( 'Brand introduction', 'flipnewmedia' ); ?>">
		<div class="container-ext bu-brand-intro__inner">
			<div class="bu-brand-intro__left">
				<h2 class="bu-brand-intro__title" data-node-id="642:4362"><?php echo esc_html( $brand_intro_title ); ?></h2>

				<?php if ( $brand_intro_button_url ) : ?>
					<a class="bu-brand-intro__button" href="<?php echo esc_url( $brand_intro_button_url ); ?>" data-node-id="642:4401">
						<span class="bu-brand-intro__button-text"><?php echo esc_html( $brand_intro_button_text ); ?></span>
						<span class="bu-brand-intro__button-icon" aria-hidden="true">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4 11H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
								<path d="M12 5L18 11L12 17" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</span>
					</a>
				<?php endif; ?>
			</div>

			<div class="bu-brand-intro__right" data-node-id="642:4406">
				<?php echo wp_kses_post( wpautop( $brand_intro_description ) ); ?>
			</div>
		</div>
	</section>

	<?php if ( $brand_slider_query->have_posts() ) : ?>
		<section class="bu-brand-categories figma-node-712-45" data-node-id="712:45" aria-label="<?php esc_attr_e( 'Brand product categories', 'flipnewmedia' ); ?>">
			<div class="container-ext bu-brand-categories__inner">
				<h2 class="bu-brand-categories__title" data-node-id="642:4363"><?php esc_html_e( 'Κατηγορίες', 'flipnewmedia' ); ?></h2>

				<div class="bu-brand-categories__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Product categories', 'flipnewmedia' ); ?>">
					<button class="bu-brand-categories__tab is-active" type="button" role="tab" aria-selected="true" data-category-tab="all" data-node-id="642:4387">
						<?php esc_html_e( 'All', 'flipnewmedia' ); ?>
					</button>
					<?php foreach ( $brand_category_tabs as $category_tab ) : ?>
						<button class="bu-brand-categories__tab" type="button" role="tab" aria-selected="false" data-category-tab="<?php echo esc_attr( (string) $category_tab->term_id ); ?>">
							<?php echo esc_html( $category_tab->name ); ?>
						</button>
					<?php endforeach; ?>
				</div>

				<div class="bu-brand-categories__description" data-node-id="642:4361">
					<?php echo wp_kses_post( wpautop( $brand_categories_description ) ); ?>
				</div>

				<div class="bu-brand-categories__viewport">
					<div class="bu-brand-categories__slider-wrap">
						<div class="bu-brand-categories__slider js-bu-brand-categories-slider">
							<?php
							while ( $brand_slider_query->have_posts() ) :
								$brand_slider_query->the_post();

								$product_id        = get_the_ID();
								$product_title     = get_the_title();
								$product_permalink = get_permalink();
								$product_image     = get_the_post_thumbnail(
									$product_id,
									'large',
									array(
										'alt'      => esc_attr( $product_title ),
										'loading'  => 'lazy',
										'decoding' => 'async',
									)
								);
								$product_terms     = get_the_terms( $product_id, 'bu-category' );
								$product_term_ids  = array();

								if ( ! is_wp_error( $product_terms ) && ! empty( $product_terms ) ) {
									$product_term_ids = wp_list_pluck( $product_terms, 'term_id' );
								}
								?>
								<article class="bu-brand-categories__slide" data-category-ids="<?php echo esc_attr( implode( ',', array_map( 'intval', $product_term_ids ) ) ); ?>">
									<div class="bu-brand-categories__card">
										<a class="bu-brand-categories__media" href="<?php echo esc_url( $product_permalink ); ?>">
											<?php if ( $product_image ) : ?>
												<?php echo $product_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php endif; ?>
											<span class="bu-brand-categories__bubble" aria-hidden="true">
												<span class="bu-brand-categories__bubble-text"><?php esc_html_e( 'Περισσότερα', 'flipnewmedia' ); ?></span>
											</span>
										</a>
										<h3 class="bu-brand-categories__item-title"><?php echo esc_html( $product_title ); ?></h3>
									</div>
								</article>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
				</div>

				<div class="bu-brand-categories__progress" aria-hidden="true">
					<span class="bu-brand-categories__progress-track"></span>
					<span class="bu-brand-categories__progress-bar"></span>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<script>
jQuery(function ($) {
  if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;

  $(document)
    .on('mouseenter', '.bu-brand-categories__card', function () {
      $(this).addClass('is-cursor-active');
    })
    .on('mousemove', '.bu-brand-categories__card', function (event) {
      var card = this;
      var bubble = card.querySelector('.bu-brand-categories__bubble');
      if (!bubble) return;

      var rect = card.getBoundingClientRect();
      var x = event.clientX - rect.left;
      var y = event.clientY - rect.top;
      var padX = bubble.offsetWidth / 2;
      var padY = bubble.offsetHeight / 2;

      x = Math.max(padX, Math.min(rect.width - padX, x));
      y = Math.max(padY, Math.min(rect.height - padY, y));

      bubble.style.left = x + 'px';
      bubble.style.top = y + 'px';
    })
    .on('mouseleave', '.bu-brand-categories__card', function () {
      $(this).removeClass('is-cursor-active');
    });
});
</script>

<script>
jQuery(function ($) {
  var $slider = $('.js-bu-brand-categories-slider');
  var $tabs = $('.bu-brand-categories__tabs');
  var allSlidesHtml = $slider.html();
  if (!$slider.length || !$tabs.length) return;
  if (typeof $.fn.slick !== 'function') {
    $('.bu-brand-categories__progress-bar').css('width', '100%');
    return;
  }

  function updateProgress() {
    var sliderNode = $slider.get(0);
    var slick = sliderNode && sliderNode.slick ? sliderNode.slick : null;
    if (!slick) return;
    var total = slick.slideCount || 1;
    var slidesToShow = typeof slick.options.slidesToShow === 'number' ? slick.options.slidesToShow : 1;
    var pages = Math.max(1, total - slidesToShow + 1);
    var index = Math.min(pages - 1, Math.max(0, slick.currentSlide || 0));
    var pct = pages <= 1 ? 100 : ((index + 1) / pages) * 100;
    $('.bu-brand-categories__progress-bar').css('width', pct + '%');
  }

  function initSlider() {
    if ($slider.hasClass('slick-initialized')) {
      $slider.slick('unslick');
    }

    $slider.off('init afterChange');
    $slider.on('init afterChange', function () {
      updateProgress();
    });

    $slider.slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: true,
      arrows: false,
      dots: false,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
  }

  function getSlidesMarkup(categoryId) {
    var $source = $('<div>').html(allSlidesHtml);

    if (categoryId !== 'all') {
      $source.find('.bu-brand-categories__slide').each(function () {
        var ids = String($(this).attr('data-category-ids') || '').split(',');
        if (ids.indexOf(categoryId) === -1) {
          $(this).remove();
        }
      });
    }

    return $source.html();
  }

  function applyFilter(categoryId) {
    var filteredMarkup = getSlidesMarkup(categoryId);

    if ($slider.hasClass('slick-initialized')) {
      $slider.slick('unslick');
    }

    $slider.html(filteredMarkup);

    if (!$slider.children('.bu-brand-categories__slide').length) {
      $('.bu-brand-categories__progress-bar').css('width', '0');
      return;
    }

    initSlider();
    if ($slider.hasClass('slick-initialized')) {
      $slider.slick('slickGoTo', 0, true);
    }
    updateProgress();
  }

  applyFilter('all');

  $tabs.on('click', '.bu-brand-categories__tab', function () {
    var $tab = $(this);
    var categoryId = String($tab.data('category-tab'));

    $tabs.find('.bu-brand-categories__tab').removeClass('is-active').attr('aria-selected', 'false');
    $tab.addClass('is-active').attr('aria-selected', 'true');

    applyFilter(categoryId);
  });
});
</script>

<?php
get_footer();
