<?php
/**
 * Single template for BU Product.
 *
 * @package FlipNewMedia_Child
 */

get_header();

while ( have_posts() ) :
	the_post();

	$product_id = get_the_ID();
	$related_cursor_asset = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/Frame-2.svg';
	$image_to_url = static function ( $image, $size = 'large' ) {
		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			return $image['url'];
		}

		if ( is_numeric( $image ) ) {
			$url = wp_get_attachment_image_url( (int) $image, $size );
			return $url ? $url : '';
		}

		if ( is_string( $image ) ) {
			return $image;
		}

		return '';
	};
	$brand_logo = '';
	$brand_terms = get_the_terms( $product_id, 'bu-brand' );

	if ( ! is_wp_error( $brand_terms ) && ! empty( $brand_terms ) && function_exists( 'get_field' ) ) {
		$primary_brand = $brand_terms[0];
		$brand_logo    = get_field( 'logo', $primary_brand ) ?: get_field( 'brand_logo', $primary_brand ) ?: get_field( 'image', $primary_brand );
	}

	$brand_logo_url = '';
	if ( is_array( $brand_logo ) && ! empty( $brand_logo['url'] ) ) {
		$brand_logo_url = $brand_logo['url'];
	} elseif ( is_numeric( $brand_logo ) ) {
		$brand_logo_url = wp_get_attachment_image_url( (int) $brand_logo, 'medium' );
	} elseif ( is_string( $brand_logo ) ) {
		$brand_logo_url = $brand_logo;
	}

	$hero_title = get_the_title();

	$hero_description = function_exists( 'get_field' ) ? (string) ( get_field( 'bu_product_hero_description', $product_id ) ?: '' ) : '';
	$hero_description = $hero_description ? $hero_description : get_the_excerpt();

	$hero_features = function_exists( 'get_field' ) ? get_field( 'bu_product_hero_features', $product_id ) : array();
	$hero_features = is_array( $hero_features ) ? $hero_features : array();

	$pdf_field = function_exists( 'get_field' ) ? ( get_field( 'bu_product_pdf', $product_id ) ?: get_field( 'pdf', $product_id ) ) : '';
	$pdf_url   = '';
	if ( is_array( $pdf_field ) && ! empty( $pdf_field['url'] ) ) {
		$pdf_url = $pdf_field['url'];
	} elseif ( is_string( $pdf_field ) ) {
		$pdf_url = $pdf_field;
	}

	$pdf_label = function_exists( 'get_field' ) ? (string) ( get_field( 'bu_product_pdf_label', $product_id ) ?: '' ) : '';
	$pdf_label = $pdf_label ? $pdf_label : __( 'Download PDF', 'flipnewmedia' );

	$view_more_label = function_exists( 'get_field' ) ? (string) ( get_field( 'bu_product_view_more_label', $product_id ) ?: '' ) : '';
	$view_more_label = $view_more_label ? $view_more_label : __( 'View more', 'flipnewmedia' );

	$view_more_url = function_exists( 'get_field' ) ? (string) ( get_field( 'bu_product_view_more_url', $product_id ) ?: '' ) : '';
	$view_more_url = $view_more_url ? $view_more_url : '';

	$gallery_items = function_exists( 'get_field' ) ? get_field( 'bu_product_gallery', $product_id ) : array();
	$gallery_items = is_array( $gallery_items ) ? $gallery_items : array();
	$gallery_urls  = array();

	if ( has_post_thumbnail() ) {
		$gallery_urls[] = get_the_post_thumbnail_url( $product_id, 'large' );
	}

	foreach ( $gallery_items as $gallery_item ) {
		$image = isset( $gallery_item['image'] ) ? $gallery_item['image'] : '';
		$url   = $image_to_url( $image );

		if ( $url ) {
			$gallery_urls[] = $url;
		}
	}

	$gallery_urls = array_values( array_filter( $gallery_urls ) );
	$main_slider_id   = 'bu-product-main-slider-' . $product_id;
	$thumbs_slider_id = 'bu-product-thumbs-slider-' . $product_id;
	$category_terms    = get_the_terms( $product_id, 'bu-category' );
	$category_term_ids = ( ! is_wp_error( $category_terms ) && ! empty( $category_terms ) ) ? wp_list_pluck( $category_terms, 'term_id' ) : array();
	$related_products  = new WP_Query(
		array(
			'post_type'           => 'bu-product',
			'post_status'         => 'publish',
			'posts_per_page'      => 10,
			'post__not_in'        => array( $product_id ),
			'ignore_sticky_posts' => true,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'tax_query'           => ! empty( $category_term_ids ) ? array(
				array(
					'taxonomy'         => 'bu-category',
					'field'            => 'term_id',
					'terms'            => $category_term_ids,
					'include_children' => true,
				),
			) : array(),
		)
	);
	$brand_source_query = new WP_Query(
		array(
			'post_type'           => 'bu-product',
			'post_status'         => 'publish',
			'posts_per_page'      => -1,
			'fields'              => 'ids',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'tax_query'           => ! empty( $category_term_ids ) ? array(
				array(
					'taxonomy'         => 'bu-category',
					'field'            => 'term_id',
					'terms'            => $category_term_ids,
					'include_children' => true,
				),
			) : array(),
		)
	);
	$category_brand_terms = array();

	if ( ! empty( $brand_source_query->posts ) ) {
		$category_brand_terms = wp_get_object_terms(
			$brand_source_query->posts,
			'bu-brand',
			array(
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => true,
			)
		);
		$category_brand_terms = is_wp_error( $category_brand_terms ) ? array() : array_values( $category_brand_terms );
	}
	?>

	<main id="primary" class="site-main bu-product-single">
		<section class="bu-product-hero figma-node-712-46" data-node-id="712:46" aria-label="<?php echo esc_attr( $hero_title ); ?>">
			<div class="container-ext bu-product-hero__inner">
				<div class="bu-product-hero__media-col">
					<div class="bu-product-hero__gallery">
						<div class="bu-product-hero__main-wrap">
							<button class="bu-product-hero__nav bu-product-hero__nav--prev" type="button" aria-label="<?php esc_attr_e( 'Previous image', 'flipnewmedia' ); ?>">
								<svg viewBox="0 0 26 45" aria-hidden="true" focusable="false">
									<path d="M24.4648 43.7305L1.46485 22.2305L24.4648 0.73053" />
								</svg>
							</button>

							<div class="bu-product-hero__main js-bu-product-main-slider" id="<?php echo esc_attr( $main_slider_id ); ?>">
								<?php foreach ( $gallery_urls as $index => $gallery_url ) : ?>
									<div class="bu-product-hero__main-slide">
										<img class="bu-product-hero__main-image" src="<?php echo esc_url( $gallery_url ); ?>" alt="<?php echo esc_attr( 0 === $index ? $hero_title : sprintf( __( '%1$s image %2$d', 'flipnewmedia' ), $hero_title, $index + 1 ) ); ?>" loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>" decoding="async" />
									</div>
								<?php endforeach; ?>
							</div>

							<button class="bu-product-hero__nav bu-product-hero__nav--next" type="button" aria-label="<?php esc_attr_e( 'Next image', 'flipnewmedia' ); ?>">
								<svg viewBox="0 0 26 45" aria-hidden="true" focusable="false">
									<path d="M0.682617 0.73053L23.6826 22.2305L0.682617 43.7305" />
								</svg>
							</button>
						</div>

						<?php if ( ! empty( $gallery_urls ) ) : ?>
							<div class="bu-product-hero__thumbs js-bu-product-thumbs-slider" id="<?php echo esc_attr( $thumbs_slider_id ); ?>">
								<?php foreach ( $gallery_urls as $index => $gallery_url ) : ?>
									<div class="bu-product-hero__thumb-wrap">
										<button class="bu-product-hero__thumb<?php echo 0 === $index ? ' is-active' : ''; ?>" type="button" data-slide-index="<?php echo esc_attr( (string) $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Show image %d', 'flipnewmedia' ), $index + 1 ) ); ?>">
											<img src="<?php echo esc_url( $gallery_url ); ?>" alt="" loading="lazy" decoding="async" />
										</button>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="bu-product-hero__content">
					<?php if ( $brand_logo_url ) : ?>
						<img class="bu-product-hero__brand" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="" loading="lazy" decoding="async" data-node-id="642:4588" />
					<?php endif; ?>

					<h1 class="bu-product-hero__title" data-node-id="642:4587"><?php echo esc_html( $hero_title ); ?></h1>

					<?php if ( $hero_description ) : ?>
						<div class="bu-product-hero__description" data-node-id="642:4583">
							<?php echo wp_kses_post( wpautop( $hero_description ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $hero_features ) ) : ?>
						<ul class="bu-product-hero__features">
							<?php foreach ( $hero_features as $feature ) : ?>
								<?php
								$feature_text = isset( $feature['text'] ) ? (string) $feature['text'] : '';
								if ( '' === $feature_text ) {
									continue;
								}
								?>
								<li class="bu-product-hero__feature"><?php echo esc_html( $feature_text ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="bu-product-hero__actions">
						<?php if ( $pdf_url ) : ?>
							<a class="bu-product-hero__button bu-product-hero__button--pdf" href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" rel="noopener">
								<span><?php echo esc_html( $pdf_label ); ?></span>
								<span class="bu-product-hero__button-icon" aria-hidden="true"></span>
							</a>
						<?php endif; ?>

						<?php if ( $view_more_url ) : ?>
							<a class="bu-product-hero__button bu-product-hero__button--more" href="<?php echo esc_url( $view_more_url ); ?>">
								<span><?php echo esc_html( $view_more_label ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<?php if ( $related_products->have_posts() ) : ?>
			<section class="bu-product-related figma-node-712-47" data-node-id="712:47" aria-label="<?php esc_attr_e( 'More BU product options', 'flipnewmedia' ); ?>">
				<div class="container-ext">
					<h2 class="bu-product-related__title" data-node-id="642:4608"><?php esc_html_e( 'Περισσότερες επιλογές', 'flipnewmedia' ); ?></h2>

					<div class="bu-product-related__slider js-bu-product-related-slider">
						<?php
						while ( $related_products->have_posts() ) :
							$related_products->the_post();

							$related_image = get_the_post_thumbnail(
								get_the_ID(),
								'large',
								array(
									'alt'      => esc_attr( get_the_title() ),
									'loading'  => 'lazy',
									'decoding' => 'async',
								)
							);
							?>
							<article class="bu-product-related__slide">
								<div class="bu-product-related__card">
									<a class="bu-product-related__media" href="<?php the_permalink(); ?>">
										<?php if ( $related_image ) : ?>
											<?php echo $related_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<?php endif; ?>
									</a>
									<a class="bu-product-related__more" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1" style="background-image:url('<?php echo esc_url( $related_cursor_asset ); ?>');">
										<span class="bu-product-related__more-text"><?php esc_html_e( 'Περισσότερα', 'flipnewmedia' ); ?></span>
									</a>
									<h3 class="bu-product-related__item-title"><?php the_title(); ?></h3>
								</div>
							</article>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( ! empty( $category_brand_terms ) ) : ?>
			<section class="bu-product-brands figma-node-719-48" data-node-id="719:48" aria-label="<?php esc_attr_e( 'Brands in this category', 'flipnewmedia' ); ?>">
				<div class="bu-product-brands__track js-bu-product-brands-slider">
					<?php foreach ( $category_brand_terms as $brand_term ) : ?>
						<?php
						$brand_link = get_term_link( $brand_term );
						$brand_logo = '';

						if ( function_exists( 'get_field' ) ) {
							$brand_logo = get_field( 'logo', $brand_term ) ?: get_field( 'brand_logo', $brand_term ) ?: get_field( 'image', $brand_term );
						}

						$brand_logo_url = '';
						if ( is_array( $brand_logo ) && ! empty( $brand_logo['url'] ) ) {
							$brand_logo_url = $brand_logo['url'];
						} elseif ( is_numeric( $brand_logo ) ) {
							$brand_logo_url = wp_get_attachment_image_url( (int) $brand_logo, 'medium' );
						} elseif ( is_string( $brand_logo ) ) {
							$brand_logo_url = $brand_logo;
						}
						?>
						<div class="bu-product-brands__item">
							<a class="bu-product-brands__card" href="<?php echo esc_url( $brand_link ); ?>" aria-label="<?php echo esc_attr( $brand_term->name ); ?>">
								<?php if ( $brand_logo_url ) : ?>
									<img class="bu-product-brands__logo" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="<?php echo esc_attr( $brand_term->name ); ?>" loading="lazy" decoding="async" />
								<?php else : ?>
									<span class="bu-product-brands__name"><?php echo esc_html( $brand_term->name ); ?></span>
								<?php endif; ?>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>
	</main>

	<script>
	document.addEventListener('DOMContentLoaded', function () {
	  var totalSlides = <?php echo (int) count( $gallery_urls ); ?>;
	  if (totalSlides < 1) return;

	  var mainSelector = '#<?php echo esc_js( $main_slider_id ); ?>';
	  var thumbsSelector = '#<?php echo esc_js( $thumbs_slider_id ); ?>';
	  var tries = 0;
	  var initialized = false;

	  function bootGallery() {
	    if (!window.jQuery || !window.jQuery.fn || !window.jQuery.fn.slick) {
	      tries += 1;
	      if (tries < 40) {
	        window.setTimeout(bootGallery, 150);
	      }
	      return;
	    }

	    var $ = window.jQuery;
	    var $section = $('.bu-product-hero');
	    var $main = $(mainSelector);
	    var $thumbs = $(thumbsSelector);
	    var $prev = $section.find('.bu-product-hero__nav--prev');
	    var $next = $section.find('.bu-product-hero__nav--next');
	    if (!$section.length || !$main.length || !$thumbs.length) return;

	    function syncThumbState(index) {
	      $thumbs.find('.bu-product-hero__thumb').removeClass('is-active');
	      $thumbs.find('.bu-product-hero__thumb[data-slide-index="' + index + '"]').addClass('is-active');
	    }

	    if (!initialized) {
	      $main.on('init', function () {
	        syncThumbState(0);
	      });

	      $main.on('afterChange', function (event, slick, currentSlide) {
	        syncThumbState(currentSlide || 0);
	      });

	      $main.slick({
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        arrows: false,
	        dots: false,
	        infinite: totalSlides > 1,
	        adaptiveHeight: false,
	        swipe: totalSlides > 1,
	        draggable: totalSlides > 1,
	        cssEase: 'ease',
	        speed: 450
	      });

	      $thumbs.slick({
	        slidesToShow: Math.min(4, totalSlides),
	        slidesToScroll: 1,
	        arrows: false,
	        dots: false,
	        focusOnSelect: false,
	        infinite: totalSlides > 1,
	        vertical: true,
	        verticalSwiping: true,
	        swipeToSlide: true,
	        cssEase: 'ease',
	        speed: 300,
	        responsive: [
	          {
	            breakpoint: 767,
	            settings: {
	              vertical: false,
	              verticalSwiping: false,
	              slidesToShow: Math.min(4, totalSlides)
	            }
	          }
	        ]
	      });

	      initialized = true;

	      $prev.off('click.buProductGallery').on('click.buProductGallery', function (event) {
	        event.preventDefault();
	        if ($main.hasClass('slick-initialized')) {
	          $main.slick('slickPrev');
	        }
	      });

	      $next.off('click.buProductGallery').on('click.buProductGallery', function (event) {
	        event.preventDefault();
	        if ($main.hasClass('slick-initialized')) {
	          $main.slick('slickNext');
	        }
	      });

	      $thumbs.off('click.buProductGalleryThumb').on('click.buProductGalleryThumb', '.bu-product-hero__thumb', function (event) {
	        event.preventDefault();
	        var index = parseInt(this.getAttribute('data-slide-index') || '0', 10);
	        if ($main.hasClass('slick-initialized')) {
	          $main.slick('slickGoTo', index);
	        }
	        if ($thumbs.hasClass('slick-initialized')) {
	          $thumbs.slick('slickGoTo', index);
	        }
	        syncThumbState(index);
	      });
	    }

	    window.addEventListener('resize', function () {
	      if ($main.hasClass('slick-initialized')) {
	        $main.slick('resize');
	      }
	      if ($thumbs.hasClass('slick-initialized')) {
	        $thumbs.slick('resize');
	      }
	    });
	  }

	  bootGallery();
	});
	</script>

	<script>
	document.addEventListener('DOMContentLoaded', function () {
	  var tries = 0;

	  function initRelatedSlider() {
	    if (!window.jQuery || !window.jQuery.fn || !window.jQuery.fn.slick) {
	      tries += 1;
	      if (tries < 40) {
	        window.setTimeout(initRelatedSlider, 150);
	      }
	      return;
	    }

	    var $ = window.jQuery;
	    var $slider = $('.js-bu-product-related-slider');
	    if (!$slider.length || $slider.hasClass('slick-initialized')) return;

	    $slider.slick({
	      slidesToShow: 4,
	      slidesToScroll: 1,
	      infinite: false,
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

	  initRelatedSlider();
	});
	</script>

	<script>
	document.addEventListener('DOMContentLoaded', function () {
	  if (window.matchMedia && window.matchMedia('(max-width: 991px)').matches) return;

	  var section = document.querySelector('.bu-product-related');
	  if (!section) return;

	  var cards = section.querySelectorAll('.bu-product-related__card');
	  if (!cards.length) return;

	  cards.forEach(function (card) {
	    var bubble = card.querySelector('.bu-product-related__more');
	    if (!bubble) return;

	    function moveBubble(event) {
	      var rect = card.getBoundingClientRect();
	      var x = event.clientX - rect.left;
	      var y = event.clientY - rect.top;
	      bubble.style.left = x + 'px';
	      bubble.style.top = y + 'px';
	    }

	    card.addEventListener('mouseenter', function (event) {
	      card.classList.add('is-cursor-active');
	      moveBubble(event);
	    });

	    card.addEventListener('mousemove', moveBubble);

	    card.addEventListener('mouseleave', function () {
	      card.classList.remove('is-cursor-active');
	    });
	  });
	});
	</script>

	<script>
	document.addEventListener('DOMContentLoaded', function () {
	  var tries = 0;

	  function initBrandsSlider() {
	    if (!window.jQuery || !window.jQuery.fn || !window.jQuery.fn.slick) {
	      tries += 1;
	      if (tries < 40) {
	        window.setTimeout(initBrandsSlider, 150);
	      }
	      return;
	    }

	    var $ = window.jQuery;
	    var $slider = $('.js-bu-product-brands-slider');
	    if (!$slider.length || $slider.hasClass('slick-initialized')) return;

	    $slider.slick({
	      slidesToShow: 5,
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

	  initBrandsSlider();
	});
	</script>
	<?php
endwhile;

get_footer();
