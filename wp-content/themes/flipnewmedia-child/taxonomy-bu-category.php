<?php
/**
 * Taxonomy template for BU Categories.
 *
 * @package FlipNewMedia_Child
 */

get_header();
global $wp_query;

$term = get_queried_object();

if ( ! $term instanceof WP_Term ) {
	get_footer();
	return;
}

$hero_image        = trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/1080365813-preview-1.png';
$term_name         = single_term_title( '', false );
$term_description  = term_description( $term, 'bu-category' );
$fallback_copy     = sprintf(
	/* translators: %s: taxonomy term name. */
	__( 'Ανακαλύψτε όλα τα BU products που ανήκουν στην κατηγορία %s.', 'flipnewmedia' ),
	$term_name
);
$hero_description  = $term_description ? $term_description : wpautop( esc_html( $fallback_copy ) );
$products_label    = sprintf(
	/* translators: %s: number of posts. */
	_n( '%s προϊόν', '%s προϊόντα', (int) $wp_query->found_posts, 'flipnewmedia' ),
	number_format_i18n( (int) $wp_query->found_posts )
);
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
		<div class="bu-category-hero__visual" style="background-image:url('<?php echo esc_url( $hero_image ); ?>');" aria-hidden="true"></div>
		<div class="bu-category-hero__fade" aria-hidden="true"></div>

		<div class="container-ext bu-category-hero__inner">
			<div class="bu-category-hero__content">
				<h1 class="bu-category-hero__title" data-node-id="642:4488"><?php echo esc_html( $term_name ); ?></h1>
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
											<span class="bu-category-featured__bubble-text"><?php esc_html_e( 'view pdf', 'flipnewmedia' ); ?></span>
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

	<section class="bu-category-products" aria-label="<?php esc_attr_e( 'BU products list', 'flipnewmedia' ); ?>">
		<div class="container-ext">
			<div class="bu-category-products__head">
				<p class="bu-category-products__count"><?php echo esc_html( $products_label ); ?></p>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="bu-category-products__grid">
					<?php
					while ( have_posts() ) :
						the_post();

						$product_image = get_the_post_thumbnail(
							get_the_ID(),
							'large',
							array(
								'alt'      => esc_attr( get_the_title() ),
								'loading'  => 'lazy',
								'decoding' => 'async',
							)
						);
						?>
						<article <?php post_class( 'bu-category-products__item' ); ?>>
							<a class="bu-category-products__card" href="<?php the_permalink(); ?>">
								<div class="bu-category-products__media">
									<?php if ( $product_image ) : ?>
										<?php echo $product_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php endif; ?>
								</div>
								<h2 class="bu-category-products__title"><?php the_title(); ?></h2>
							</a>
						</article>
					<?php endwhile; ?>
				</div>

				<div class="bu-category-products__pagination">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 1,
							'prev_text' => __( 'Προηγούμενα', 'flipnewmedia' ),
							'next_text' => __( 'Επόμενα', 'flipnewmedia' ),
						)
					);
					?>
				</div>
			<?php else : ?>
				<p class="bu-category-products__empty"><?php esc_html_e( 'Δεν υπάρχουν διαθέσιμα προϊόντα σε αυτή την κατηγορία.', 'flipnewmedia' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

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

  $slider.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: false,
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
});
</script>

<?php
get_footer();
