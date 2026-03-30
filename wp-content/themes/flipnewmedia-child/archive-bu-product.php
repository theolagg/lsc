<?php
/**
 * Archive template for BU Products.
 *
 * @package FlipNewMedia_Child
 */

get_header();

$bu_terms = get_terms(
	array(
		'taxonomy'   => 'bu-category',
		'hide_empty' => false,
		'parent'     => 0,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);

$bu_terms = is_wp_error( $bu_terms ) ? array() : array_values( $bu_terms );
$term_columns = array_chunk( $bu_terms, 5 );
$mobile_visible_terms = 4;
$has_mobile_term_overflow = count( $bu_terms ) > $mobile_visible_terms;

while ( count( $term_columns ) < 3 ) {
	$term_columns[] = array();
}

$hero_title    = __( 'Εξοπλισμος / Επιστημονικα οργανα', 'flipnewmedia' );
$hero_label    = __( 'ΚΑΤΗΓΟΡΙΕΣ', 'flipnewmedia' );
$empty_message = __( 'Δεν υπάρχουν ακόμη κατηγορίες για BU Products.', 'flipnewmedia' );
$hero_video    = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/1009729562-preview.mp4';
$feature_video = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/3569576413-preview.mp4';
$latest_products_query = new WP_Query(
	array(
		'post_type'           => 'bu-product',
		'post_status'         => 'publish',
		'posts_per_page'      => 10,
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	)
);
$brand_terms = get_terms(
	array(
		'taxonomy'   => 'bu-brand',
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);
$brand_terms = is_wp_error( $brand_terms ) ? array() : array_values( $brand_terms );
$brand_term_rows = array(
	array(),
	array(),
);

foreach ( array_values( $brand_terms ) as $brand_index => $brand_term ) {
	$brand_term_rows[ $brand_index % 2 ][] = $brand_term;
}

if ( empty( $brand_term_rows[0] ) ) {
	$brand_term_rows[0] = $brand_terms;
}

if ( empty( $brand_term_rows[1] ) ) {
	$brand_term_rows[1] = $brand_term_rows[0];
}
?>

<main id="primary" class="site-main bu-products-archive">
	<section class="bu-products-hero figma-node-712-36" data-node-id="712:36" aria-label="<?php esc_attr_e( 'BU products categories', 'flipnewmedia' ); ?>">
		<div class="bu-products-hero__bg" aria-hidden="true"></div>
		<video class="bu-products-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
			<source src="<?php echo esc_url( $hero_video ); ?>" type="video/mp4">
		</video>
		<div class="bu-products-hero__overlay" aria-hidden="true"></div>

		<div class="container-ext bu-products-hero__inner">
			<div class="bu-products-hero__head">
				<h1 class="bu-products-hero__title" data-node-id="642:5409"><?php echo nl2br( esc_html( $hero_title ) ); ?></h1>
				<p class="bu-products-hero__eyebrow" data-node-id="642:5413"><?php echo esc_html( $hero_label ); ?></p>
			</div>

			<div class="bu-products-hero__line" data-node-id="642:5410" aria-hidden="true"></div>

			<?php if ( ! empty( $bu_terms ) ) : ?>
				<?php $mobile_term_index = 0; ?>
				<div class="bu-products-hero__grid" id="bu-products-hero-grid">
					<?php foreach ( $term_columns as $column_index => $column_terms ) : ?>
						<div class="bu-products-hero__column bu-products-hero__column--<?php echo esc_attr( (string) ( $column_index + 1 ) ); ?><?php echo $has_mobile_term_overflow && $column_index > 0 ? ' bu-products-hero__column--mobile-hidden' : ''; ?>">
							<?php foreach ( $column_terms as $term ) : ?>
								<?php
								$children = get_terms(
									array(
										'taxonomy'   => 'bu-category',
										'hide_empty' => false,
										'parent'     => $term->term_id,
										'orderby'    => 'name',
										'order'      => 'ASC',
									)
								);
								$children = is_wp_error( $children ) ? array() : array_values( $children );
								$has_children = ! empty( $children );
								$card_classes = 'bu-products-hero__card';

								if ( $has_mobile_term_overflow && $mobile_term_index >= $mobile_visible_terms ) {
									$card_classes .= ' bu-products-hero__card--mobile-hidden';
								}
								?>
								<article class="<?php echo esc_attr( $card_classes ); ?>" data-term-id="<?php echo esc_attr( (string) $term->term_id ); ?>">
									<a class="bu-products-hero__card-link" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
										<span class="bu-products-hero__card-title"><?php echo esc_html( $term->name ); ?></span>
									</a>

									<?php if ( $has_children ) : ?>
										<button
											class="bu-products-hero__expand"
											type="button"
											data-modal-trigger="<?php echo esc_attr( 'bu-category-' . $term->term_id ); ?>"
											aria-haspopup="dialog"
											aria-expanded="false"
											aria-controls="<?php echo esc_attr( 'bu-category-' . $term->term_id ); ?>"
										>
											<span aria-hidden="true"></span>
											<span class="sr-only"><?php echo esc_html( sprintf( __( 'Show subcategories for %s', 'flipnewmedia' ), $term->name ) ); ?></span>
										</button>
									<?php endif; ?>
								</article>
								<?php $mobile_term_index++; ?>

								<?php if ( $has_children ) : ?>
									<div class="bu-products-modal" id="<?php echo esc_attr( 'bu-category-' . $term->term_id ); ?>" hidden>
										<div class="bu-products-modal__backdrop" data-modal-close></div>
										<div class="bu-products-modal__panel" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr( 'bu-category-title-' . $term->term_id ); ?>">
											<div class="bu-products-modal__header">
												<h2 class="bu-products-modal__title" id="<?php echo esc_attr( 'bu-category-title-' . $term->term_id ); ?>" data-node-id="642:5584"><?php echo esc_html( $term->name ); ?></h2>
												<button class="bu-products-modal__close" type="button" data-modal-close aria-label="<?php esc_attr_e( 'Close', 'flipnewmedia' ); ?>"></button>
											</div>

											<div class="bu-products-modal__rule" data-node-id="642:5583" aria-hidden="true"></div>

											<div class="bu-products-modal__columns">
												<?php
												$children_columns = array_chunk( $children, (int) ceil( count( $children ) / 3 ) );
												while ( count( $children_columns ) < 3 ) {
													$children_columns[] = array();
												}
												?>

												<?php foreach ( $children_columns as $children_column ) : ?>
													<div class="bu-products-modal__column">
														<?php foreach ( $children_column as $child_term ) : ?>
															<a class="bu-products-modal__item" href="<?php echo esc_url( get_term_link( $child_term ) ); ?>">
																<span class="bu-products-modal__bullet" aria-hidden="true"></span>
																<span class="bu-products-modal__item-label"><?php echo esc_html( $child_term->name ); ?></span>
															</a>
														<?php endforeach; ?>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( $has_mobile_term_overflow ) : ?>
					<div class="bu-products-hero__more">
						<button
							class="bu-products-hero__more-btn"
							type="button"
							data-bu-hero-more
							aria-expanded="false"
							aria-controls="bu-products-hero-grid"
						>
							<?php esc_html_e( 'Περισσότερα', 'flipnewmedia' ); ?>
						</button>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<p class="bu-products-hero__empty"><?php echo esc_html( $empty_message ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="bu-products-feature figma-node-642-5317" data-node-id="642:5317" aria-label="<?php esc_attr_e( 'BU products feature visual', 'flipnewmedia' ); ?>">
		<div class="bu-products-feature__media">
			<video class="bu-products-feature__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
				<source src="<?php echo esc_url( $feature_video ); ?>" type="video/mp4">
			</video>
		</div>
	</section>

	<?php if ( $latest_products_query->have_posts() ) : ?>
		<section class="bu-products-latest figma-node-712-38" data-node-id="712:38" aria-label="<?php esc_attr_e( 'Latest BU products', 'flipnewmedia' ); ?>">
			<div class="bu-products-latest__viewport">
				<div class="bu-products-latest__slider js-bu-products-latest-slider">
					<?php
					while ( $latest_products_query->have_posts() ) :
						$latest_products_query->the_post();
						$product_title = get_the_title();
						$product_link  = get_permalink();
						$product_image = get_the_post_thumbnail(
							get_the_ID(),
							'large',
							array(
								'alt'      => esc_attr( $product_title ),
								'loading'  => 'lazy',
								'decoding' => 'async',
							)
						);
						?>
						<article class="bu-products-latest__slide">
							<a class="bu-products-latest__card" href="<?php echo esc_url( $product_link ); ?>">
								<div class="bu-products-latest__media">
									<?php if ( $product_image ) : ?>
										<?php echo $product_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php endif; ?>
									<span class="bu-products-latest__bubble">
										<span class="bu-products-latest__bubble-text"><?php esc_html_e( 'Περισσότερα', 'flipnewmedia' ); ?></span>
									</span>
								</div>
								<h2 class="bu-products-latest__title"><?php echo esc_html( $product_title ); ?></h2>
							</a>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>

				<button class="bu-products-latest__nav bu-products-latest__nav--prev js-bu-products-latest-prev" type="button" aria-label="<?php esc_attr_e( 'Previous products', 'flipnewmedia' ); ?>"></button>
				<button class="bu-products-latest__nav bu-products-latest__nav--next js-bu-products-latest-next" type="button" aria-label="<?php esc_attr_e( 'Next products', 'flipnewmedia' ); ?>"></button>
			</div>

			<div class="bu-products-latest__progress" aria-hidden="true">
				<span class="bu-products-latest__progress-track"></span>
				<span class="bu-products-latest__progress-bar"></span>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $brand_terms ) ) : ?>
		<section class="bu-brands-slider figma-node-712-39" data-node-id="712:39" aria-label="<?php esc_attr_e( 'BU brands', 'flipnewmedia' ); ?>">
			<div class="bu-brands-slider__track js-bu-brands-slider">
				<?php foreach ( $brand_terms as $brand_term ) : ?>
					<?php
					$brand_link = get_term_link( $brand_term );
					$brand_logo = '';

					if ( function_exists( 'get_field' ) ) {
						$brand_logo = get_field( 'logo', $brand_term ) ?: get_field( 'brand_logo', $brand_term ) ?: get_field( 'image', $brand_term );
					}

					$brand_logo_url = '';
					if ( is_array( $brand_logo ) && ! empty( $brand_logo['url'] ) ) {
						$brand_logo_url = $brand_logo['url'];
					} elseif ( is_string( $brand_logo ) ) {
						$brand_logo_url = $brand_logo;
					}
					?>
					<div class="bu-brands-slider__item">
						<a class="bu-brands-slider__card" href="<?php echo esc_url( $brand_link ); ?>" aria-label="<?php echo esc_attr( $brand_term->name ); ?>">
							<?php if ( $brand_logo_url ) : ?>
								<img class="bu-brands-slider__logo" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="<?php echo esc_attr( $brand_term->name ); ?>" loading="lazy" decoding="async" />
							<?php else : ?>
								<span class="bu-brands-slider__name"><?php echo esc_html( $brand_term->name ); ?></span>
							<?php endif; ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="bu-brands-slider__mobile">
				<?php foreach ( $brand_term_rows as $row_index => $row_terms ) : ?>
					<div class="bu-brand-marquee-row bu-brand-marquee-row--<?php echo 0 === $row_index ? 'forward' : 'reverse'; ?>">
						<div class="bu-brand-marquee-track">
							<?php foreach ( $row_terms as $brand_term ) : ?>
								<?php
								$brand_link = get_term_link( $brand_term );
								$brand_logo = '';

								if ( function_exists( 'get_field' ) ) {
									$brand_logo = get_field( 'logo', $brand_term ) ?: get_field( 'brand_logo', $brand_term ) ?: get_field( 'image', $brand_term );
								}

								$brand_logo_url = '';
								if ( is_array( $brand_logo ) && ! empty( $brand_logo['url'] ) ) {
									$brand_logo_url = $brand_logo['url'];
								} elseif ( is_string( $brand_logo ) ) {
									$brand_logo_url = $brand_logo;
								}
								?>
								<div class="bu-brands-slider__mobile-item bu-brand-marquee-slide">
									<a class="bu-brands-slider__card" href="<?php echo esc_url( $brand_link ); ?>" aria-label="<?php echo esc_attr( $brand_term->name ); ?>">
										<?php if ( $brand_logo_url ) : ?>
											<img class="bu-brands-slider__logo" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="<?php echo esc_attr( $brand_term->name ); ?>" loading="lazy" decoding="async" />
										<?php else : ?>
											<span class="bu-brands-slider__name"><?php echo esc_html( $brand_term->name ); ?></span>
										<?php endif; ?>
									</a>
								</div>
							<?php endforeach; ?>
							<?php foreach ( $row_terms as $brand_term ) : ?>
								<?php
								$brand_link = get_term_link( $brand_term );
								$brand_logo = '';

								if ( function_exists( 'get_field' ) ) {
									$brand_logo = get_field( 'logo', $brand_term ) ?: get_field( 'brand_logo', $brand_term ) ?: get_field( 'image', $brand_term );
								}

								$brand_logo_url = '';
								if ( is_array( $brand_logo ) && ! empty( $brand_logo['url'] ) ) {
									$brand_logo_url = $brand_logo['url'];
								} elseif ( is_string( $brand_logo ) ) {
									$brand_logo_url = $brand_logo;
								}
								?>
								<div class="bu-brands-slider__mobile-item bu-brand-marquee-slide" aria-hidden="true">
									<a class="bu-brands-slider__card" href="<?php echo esc_url( $brand_link ); ?>" tabindex="-1">
										<?php if ( $brand_logo_url ) : ?>
											<img class="bu-brands-slider__logo" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="" loading="lazy" decoding="async" />
										<?php else : ?>
											<span class="bu-brands-slider__name"><?php echo esc_html( $brand_term->name ); ?></span>
										<?php endif; ?>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var heroSection = document.querySelector('.bu-products-hero');
  var heroMoreButton = heroSection ? heroSection.querySelector('[data-bu-hero-more]') : null;

  if (heroSection && heroMoreButton) {
    heroMoreButton.addEventListener('click', function () {
      heroSection.classList.add('is-mobile-expanded');
      heroMoreButton.setAttribute('aria-expanded', 'true');
      heroMoreButton.disabled = true;
    });
  }

  var triggers = document.querySelectorAll('[data-modal-trigger]');
  if (!triggers.length) return;

  var activeModal = null;
  var activeTrigger = null;

  function closeModal() {
    if (!activeModal) return;
    activeModal.hidden = true;
    document.body.classList.remove('bu-products-modal-open');
    if (activeTrigger) {
      activeTrigger.setAttribute('aria-expanded', 'false');
      activeTrigger.focus();
    }
    activeModal = null;
    activeTrigger = null;
  }

  function openModal(trigger) {
    var modalId = trigger.getAttribute('data-modal-trigger');
    var modal = modalId ? document.getElementById(modalId) : null;
    if (!modal) return;

    if (activeModal && activeModal !== modal) {
      closeModal();
    }

    activeModal = modal;
    activeTrigger = trigger;
    modal.hidden = false;
    trigger.setAttribute('aria-expanded', 'true');
    document.body.classList.add('bu-products-modal-open');

    var closeButton = modal.querySelector('.bu-products-modal__close');
    if (closeButton) {
      closeButton.focus();
    }
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      openModal(trigger);
    });
  });

  document.querySelectorAll('[data-modal-close]').forEach(function (element) {
    element.addEventListener('click', function () {
      closeModal();
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeModal();
    }
  });
});
</script>

<script>
jQuery(function ($) {
  var $slider = $('.js-bu-products-latest-slider');
  if (!$slider.length) return;
  if (typeof $.fn.slick !== 'function') {
    $('.bu-products-latest__progress-bar').css('width', '100%');
    return;
  }
  if ($slider.hasClass('slick-initialized')) return;

  function updateProgress(slick, currentSlide) {
    var total = slick.slideCount || 1;
    var slidesToShow = typeof slick.options.slidesToShow === 'number' ? slick.options.slidesToShow : 1;
    var pages = Math.max(1, total - slidesToShow + 1);
    var index = Math.min(pages - 1, Math.max(0, currentSlide || 0));
    var pct = pages <= 1 ? 100 : ((index + 1) / pages) * 100;
    $('.bu-products-latest__progress-bar').css('width', pct + '%');
  }

  function refreshLatestProductsLensCursor() {
    if (typeof window.lscRefreshLensCursors !== 'function') return;

    window.lscRefreshLensCursors();

    window.requestAnimationFrame(function () {
      if (typeof window.lscRefreshLensCursors === 'function') {
        window.lscRefreshLensCursors();
      }
    });
  }

  $slider.on('init reInit setPosition', function (event, slick) {
    updateProgress(slick, slick.currentSlide || 0);
    refreshLatestProductsLensCursor();
  });

  $slider.on('afterChange', function (event, slick, currentSlide) {
    updateProgress(slick, currentSlide);
    refreshLatestProductsLensCursor();
  });

  $slider.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    dots: false,
    variableWidth: false,
    prevArrow: $('.js-bu-products-latest-prev'),
    nextArrow: $('.js-bu-products-latest-next'),
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
          slidesToShow: 1,
          arrows: false,
          centerMode: true,
          centerPadding: '24px',
          swipeToSlide: true
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          arrows: false,
          centerMode: true,
          centerPadding: '24px',
          swipeToSlide: true
        }
      }
    ]
  });

  refreshLatestProductsLensCursor();
});
</script>

<script>
jQuery(function ($) {
  var $slider = $('.js-bu-brands-slider');
  if (!$slider.length) return;
  if (typeof $.fn.slick !== 'function') return;
  var mobileQuery = window.matchMedia('(max-width: 991px)');

  function syncBrandSlider() {
    if (mobileQuery.matches) {
      if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }
      return;
    }

    if ($slider.hasClass('slick-initialized')) return;

    $slider.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      infinite: true,
      arrows: false,
      dots: false,
      autoplay: true,
      autoplaySpeed: 2500,
      speed: 500,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
  }

  syncBrandSlider();
  window.addEventListener('resize', syncBrandSlider);
});
</script>

<?php
get_footer();
