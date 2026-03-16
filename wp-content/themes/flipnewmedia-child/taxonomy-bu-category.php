<?php
/**
 * Taxonomy template for BU Categories.
 *
 * @package FlipNewMedia_Child
 */

get_header();

$term = get_queried_object();

if ( ! $term instanceof WP_Term ) {
	get_footer();
	return;
}

$hero_video       = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/1009729562-preview.mp4';
$term_name        = single_term_title( '', false );
$term_description = term_description( $term, 'bu-category' );
$fallback_copy    = sprintf(
	/* translators: %s: taxonomy term name. */
	__( 'Ανακαλύψτε όλα τα BU products που ανήκουν στην κατηγορία %s.', 'flipnewmedia' ),
	$term_name
);
$hero_description = $term_description ? $term_description : wpautop( esc_html( $fallback_copy ) );

$featured_products = new WP_Query(
	array(
		'post_type'           => 'bu-product',
		'post_status'         => 'publish',
		'posts_per_page'      => 10,
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'tax_query'           => array(
			array(
				'taxonomy'         => 'bu-category',
				'field'            => 'term_id',
				'terms'            => array( (int) $term->term_id ),
				'include_children' => true,
			),
		),
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
		'tax_query'           => array(
			array(
				'taxonomy'         => 'bu-category',
				'field'            => 'term_id',
				'terms'            => array( (int) $term->term_id ),
				'include_children' => true,
			),
		),
	)
);

$brand_terms = array();

if ( ! empty( $brand_source_query->posts ) ) {
	$brand_terms = wp_get_object_terms(
		$brand_source_query->posts,
		'bu-brand',
		array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
		)
	);
	$brand_terms = is_wp_error( $brand_terms ) ? array() : array_values( $brand_terms );
}
?>

<main id="primary" class="site-main bu-category-taxonomy">
	<section class="bu-category-hero figma-node-712-40" data-node-id="712:40" aria-label="<?php echo esc_attr( $term_name ); ?>">
		<div class="bu-category-hero__visual">
			<video class="bu-category-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
				<source src="<?php echo esc_url( $hero_video ); ?>" type="video/mp4">
			</video>
			<div class="bu-category-hero__visual-overlay" aria-hidden="true"></div>
			<div class="container-ext bu-category-hero__visual-inner">
				<h1 class="bu-category-hero__title" data-node-id="642:4488"><?php echo esc_html( $term_name ); ?></h1>
			</div>
			<div class="bu-category-hero__fade" aria-hidden="true"></div>
		</div>

		<div class="container-ext bu-category-hero__inner">
			<div class="bu-category-hero__content">
				<span class="bu-category-hero__line" data-node-id="642:4489" aria-hidden="true"></span>
				<div class="bu-category-hero__description" data-node-id="642:4486">
					<?php echo wp_kses_post( $hero_description ); ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $featured_products->have_posts() ) : ?>
		<section class="bu-category-featured figma-node-712-41" data-node-id="712:41" aria-label="<?php esc_attr_e( 'Recommended BU products', 'flipnewmedia' ); ?>">
			<div class="container-ext">
				<h2 class="bu-category-featured__title" data-node-id="642:4487"><?php esc_html_e( 'Προτεινόμενες Λύσεις', 'flipnewmedia' ); ?></h2>

				<div class="bu-category-featured__viewport">
					<div class="bu-category-featured__slider js-bu-category-featured-slider">
						<?php
						while ( $featured_products->have_posts() ) :
							$featured_products->the_post();

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
							$pdf_url = '';

							if ( function_exists( 'get_field' ) ) {
								$pdf_field = get_field( 'pdf', $product_id ) ?: get_field( 'brochure_pdf', $product_id ) ?: get_field( 'catalog_pdf', $product_id );

								if ( is_array( $pdf_field ) && ! empty( $pdf_field['url'] ) ) {
									$pdf_url = $pdf_field['url'];
								} elseif ( is_string( $pdf_field ) ) {
									$pdf_url = $pdf_field;
								}
							}
							?>
							<article class="bu-category-featured__slide">
								<div class="bu-category-featured__card">
									<a class="bu-category-featured__media" href="<?php echo esc_url( $product_permalink ); ?>">
										<?php if ( $product_image ) : ?>
											<?php echo $product_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<?php endif; ?>
									</a>

									<?php if ( $pdf_url ) : ?>
										<a class="bu-category-featured__bubble" href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" rel="noopener">
											<span class="bu-category-featured__bubble-icon" aria-hidden="true">
												<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M25 11.175C24.987 11.0602 24.9618 10.947 24.925 10.8375V10.725C24.8649 10.5965 24.7847 10.4783 24.6875 10.375L17.1875 2.875C17.0842 2.77777 16.966 2.6976 16.8375 2.6375H16.725L16.325 2.5H8.75C7.75544 2.5 6.80161 2.89509 6.09835 3.59835C5.39509 4.30161 5 5.25544 5 6.25V23.75C5 24.7446 5.39509 25.6984 6.09835 26.4017C6.80161 27.1049 7.75544 27.5 8.75 27.5H21.25C22.2446 27.5 23.1984 27.1049 23.9017 26.4017C24.6049 25.6984 25 24.7446 25 23.75V11.25C25 11.25 25 11.25 25 11.175ZM17.5 6.7625L20.7375 10H17.5V6.7625ZM22.5 23.75C22.5 24.0815 22.3683 24.3995 22.1339 24.6339C21.8995 24.8683 21.5815 25 21.25 25H8.75C8.41848 25 8.10054 24.8683 7.86612 24.6339C7.6317 24.3995 7.5 24.0815 7.5 23.75V6.25C7.5 5.91848 7.6317 5.60054 7.86612 5.36612C8.10054 5.1317 8.41848 5 8.75 5H15V11.25C15 11.5815 15.1317 11.8995 15.3661 12.1339C15.6005 12.3683 15.9185 12.5 16.25 12.5H22.5V23.75Z" fill="white"/>
												</svg>
											</span>
											<span class="sr-only"><?php esc_html_e( 'Download PDF', 'flipnewmedia' ); ?></span>
										</a>
									<?php endif; ?>

									<h3 class="bu-category-featured__item-title"><?php echo esc_html( $product_title ); ?></h3>
								</div>
							</article>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $brand_terms ) ) : ?>
		<section class="bu-category-brands figma-node-712-42" data-node-id="712:42" aria-label="<?php esc_attr_e( 'Brands in this category', 'flipnewmedia' ); ?>">
			<div class="bu-category-brands__track js-bu-category-brands-slider">
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
					<div class="bu-category-brands__item">
						<a class="bu-category-brands__card" href="<?php echo esc_url( $brand_link ); ?>" aria-label="<?php echo esc_attr( $brand_term->name ); ?>">
							<?php if ( $brand_logo_url ) : ?>
								<img class="bu-category-brands__logo" src="<?php echo esc_url( $brand_logo_url ); ?>" alt="<?php echo esc_attr( $brand_term->name ); ?>" loading="lazy" decoding="async" />
							<?php else : ?>
								<span class="bu-category-brands__name"><?php echo esc_html( $brand_term->name ); ?></span>
							<?php endif; ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
</main>

<script>
jQuery(function ($) {
  var $slider = $('.js-bu-category-featured-slider');
  if (!$slider.length) return;
  if (typeof $.fn.slick !== 'function') return;
  if ($slider.hasClass('slick-initialized')) return;

  $slider.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
    variableWidth: false,
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
});
</script>

<script>
jQuery(function ($) {
  var $slider = $('.js-bu-category-brands-slider');
  if (!$slider.length) return;
  if (typeof $.fn.slick !== 'function') return;
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
});
</script>

<?php
get_footer();
