<?php
/**
 * Single Post template.
 *
 * @package FlipNewMedia_Child
 */

get_header();

if ( ! function_exists( 'lsc_single_post_related_items' ) ) {
	/**
	 * Build related posts list from same categories.
	 *
	 * @param int $post_id Current post ID.
	 * @return array<int, WP_Post>
	 */
	function lsc_single_post_related_items( $post_id ) {
		$post_id = (int) $post_id;
		$cat_ids = wp_get_post_categories( $post_id );

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'post__not_in'        => array( $post_id ),
			'ignore_sticky_posts' => true,
			'orderby'             => 'date',
			'order'               => 'DESC',
		);

		if ( ! empty( $cat_ids ) ) {
			$query_args['category__in'] = $cat_ids;
		}

		$query   = new WP_Query( $query_args );
		$results = $query->posts;
		wp_reset_postdata();

		if ( count( $results ) >= 3 ) {
			return $results;
		}

		$fallback_query = new WP_Query(
			array(
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'posts_per_page'      => 3 - count( $results ),
				'post__not_in'        => array_merge( array( $post_id ), wp_list_pluck( $results, 'ID' ) ),
				'ignore_sticky_posts' => true,
				'orderby'             => 'date',
				'order'               => 'DESC',
			)
		);

		$results = array_merge( $results, $fallback_query->posts );
		wp_reset_postdata();

		return $results;
	}
}
?>

<main id="primary" class="site-main single-post-page">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();

			$post_id         = get_the_ID();
			$back_url        = get_permalink( (int) get_option( 'page_for_posts' ) );
			$back_url        = $back_url ? $back_url : home_url( '/' );
			$related_posts   = lsc_single_post_related_items( $post_id );
			$hero_copy       = get_the_excerpt();
			if ( ! $hero_copy ) {
				$hero_copy = wp_trim_words( wp_strip_all_tags( get_the_content() ), 32, '...' );
			}
			$body_image_html = get_the_post_thumbnail(
				$post_id,
				'full',
				array(
					'alt'      => esc_attr( get_the_title() ),
					'loading'  => 'eager',
					'decoding' => 'async',
				)
			);
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-layout' ); ?>>
				<?php
				echo lsc_render_video_hero(
					array(
						'title'         => get_the_title(),
						'copy'          => $hero_copy,
						'aria_label'    => __( 'Article introduction', 'flipnewmedia' ),
						'section_class' => 'single-post-hero figma-node-712-33',
						'inner_class'   => 'single-post-hero__inner',
					)
				);
				?>

				<section class="single-post-body figma-node-712-34" data-node-id="712:34" aria-label="<?php esc_attr_e( 'Article content', 'flipnewmedia' ); ?>">
					<div class="container-ext">
						<div class="single-post-body__meta">
							<a class="single-post-body__back" href="<?php echo esc_url( $back_url ); ?>">
								<span class="single-post-body__back-icon" aria-hidden="true"></span>
								<span class="single-post-body__back-text"><?php esc_html_e( 'Back', 'flipnewmedia' ); ?></span>
							</a>

							<time class="single-post-body__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" data-node-id="642:5135">
								<?php
								printf(
									/* translators: %s: publish date */
									esc_html__( 'Δημοσιεύτηκε: %s', 'flipnewmedia' ),
									esc_html( get_the_date( 'j F Y' ) )
								);
								?>
							</time>
						</div>

						<?php if ( $body_image_html ) : ?>
							<figure class="single-post-body__figure figma-node-642-5123" data-node-id="642:5123">
								<?php echo $body_image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</figure>
						<?php endif; ?>

						<div class="single-post-body__content entry-content">
							<?php
							the_content();
							wp_link_pages(
								array(
									'before' => '<div class="single-post-body__pages">' . esc_html__( 'Pages:', 'flipnewmedia' ),
									'after'  => '</div>',
								)
							);
							?>
						</div>
					</div>
				</section>

				<?php if ( ! empty( $related_posts ) ) : ?>
					<section class="single-related figma-node-712-35" data-node-id="712:35" aria-label="<?php esc_attr_e( 'Related articles', 'flipnewmedia' ); ?>">
						<div class="container-ext">
							<div class="single-related__head">
								<h2 class="single-related__title" data-node-id="642:5152"><?php esc_html_e( 'ΔΙΑΒΑΣΤΕ ΕΠΙΣΗΣ', 'flipnewmedia' ); ?></h2>
								<p class="single-related__copy" data-node-id="642:5171"><?php esc_html_e( 'Find the latest updates, news, and insights from our industry. Stay informed and ahead of the curve with our expert tips and exclusive content.', 'flipnewmedia' ); ?></p>
							</div>

							<div class="single-related__grid">
								<?php foreach ( $related_posts as $index => $related_post ) : ?>
									<?php
									$related_title   = get_the_title( $related_post->ID );
									$related_url     = get_permalink( $related_post->ID );
									$related_excerpt = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $related_post->ID ) ), $index === 0 ? 18 : 14, '...' );
									$related_image   = get_the_post_thumbnail(
										$related_post->ID,
										'full',
										array(
											'alt'      => esc_attr( $related_title ),
											'loading'  => 'lazy',
											'decoding' => 'async',
										)
									);
									?>
									<article class="single-related-card single-related-card--<?php echo 0 === $index ? 'featured' : 'regular'; ?>">
										<a class="single-related-card__media" href="<?php echo esc_url( $related_url ); ?>" aria-label="<?php echo esc_attr( $related_title ); ?>">
											<?php if ( $related_image ) : ?>
												<?php echo $related_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php endif; ?>
										</a>

										<div class="single-related-card__body">
											<h3 class="single-related-card__title">
												<a href="<?php echo esc_url( $related_url ); ?>"><?php echo esc_html( $related_title ); ?></a>
											</h3>
											<?php if ( $related_excerpt ) : ?>
												<p class="single-related-card__excerpt"><?php echo esc_html( $related_excerpt ); ?></p>
											<?php endif; ?>
											<a class="single-related-card__arrow" href="<?php echo esc_url( $related_url ); ?>" aria-label="<?php esc_attr_e( 'Read more', 'flipnewmedia' ); ?>"></a>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php
get_footer();
