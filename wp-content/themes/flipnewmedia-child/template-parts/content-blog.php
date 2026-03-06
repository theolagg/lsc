<article data-postid="<?php the_ID(); ?>" id="post-<?php the_ID(); ?>">

	<?php
	// Ensure we have the post context
	global $post;

	$post_id            = get_the_ID();
	$current_post_link  = get_permalink( $post_id );
	$title              = get_the_title( $post_id );
	$feat_image         = wp_get_attachment_image(
		get_post_thumbnail_id( $post_id ),
		'full',
		false,
		array(
			'class' => 'blog_image',
			'alt'   => esc_attr( $title ),
		)
	);

	// Link to the main Blog archive/category (global holds the Blog category ID)
	$blog_cat_id = isset( $GLOBALS['BLOG'] ) ? (int) $GLOBALS['BLOG'] : 0;
	$cat_link    = $blog_cat_id ? get_category_link( $blog_cat_id ) : home_url( '/' );

	// Detect categories and prefer first child category; fallback to first category
	$my_post_categories = get_the_category( $post_id );
	$my_post_child_cats = array();
	$sub_cat            = '';
	$sub_cat_url        = '';
	$sub_cat_slug       = '';

	if ( ! empty( $my_post_categories ) && ! is_wp_error( $my_post_categories ) ) {
		foreach ( $my_post_categories as $post_cat ) {
			if ( (int) $post_cat->parent !== 0 ) {
				$my_post_child_cats[] = (int) $post_cat->term_id;
				if ( $sub_cat === '' ) {
					$sub_cat      = $post_cat->name;
					$sub_cat_url  = get_category_link( $post_cat->term_id );
					$sub_cat_slug = $post_cat->slug;
				}
			}
		}

		// Fallback to first category if no child category found
		if ( $sub_cat === '' ) {
			$first_cat    = $my_post_categories[0];
			$sub_cat      = $first_cat->name;
			$sub_cat_url  = get_category_link( $first_cat->term_id );
			$sub_cat_slug = $first_cat->slug;
		}
	}

	$print_icon = isset( $GLOBALS['PRINT_BLOG'] ) ? $GLOBALS['PRINT_BLOG'] : '';
	$copy_icon  = isset( $GLOBALS['COPY_BLOG'] ) ? $GLOBALS['COPY_BLOG'] : '';

	// Custom breadcrumbs (assumes your theme function exists)
	echo breadcrumbs_html();
	?>

	<div class="entry-content single_blog_page">

		<div id="section_single_blog_1" class="main_wrapper single_blog_pg">
			<div id="single_blog_1" class="pg_row m-auto mw w1034">
				<div class="single_blog_wrapper">

					<?php if ( $feat_image ) : ?>
						<div class="blog_feature"><?php echo $feat_image; ?></div>
					<?php endif; ?>

					<div class="blog_bottom_information">
						<div class="blog_category_info">
							<?php if ( $sub_cat ) : ?>
								<div><a href="<?php echo esc_url( $sub_cat_url ); ?>"><?php echo esc_html( $sub_cat ); ?></a></div>
							<?php endif; ?>
						</div>

						<div class="blog_actions">
							<div class="share_wrapper single_blog_share">
								<div class="pact_icon"><span class="share_text">Share to Social Media</span></div>
								<div style="display:none" class="page_share"></div>
							</div>
							<div class="copy_btn" data-link="<?php echo esc_url( $current_post_link ); ?>">
								<span class="copy_text">Copy URL</span>
								<span class="copy_icon"><?php echo $copy_icon; ?></span>
								<span style="display:none;" class="copied">Αντιγράφτηκε</span>
							</div>
						</div>

						<div class="print_blog">
							<span class="print_text">Εκτύπωση</span>
							<span class="print_icon"><?php echo $print_icon; ?></span>
						</div>

					</div>

				</div>
			</div>
		</div>

		<div id="section_single_blog_2" class="main_wrapper single_blog_pg">
			<div id="single_blog_2" class="pg_row m-auto mw w1034">
				<div class="single_blog_wrapper">
					<div class="single_blog_tile_wrap">
						<h1 class="single_blog_title"><?php echo esc_html( $title ); ?></h1>
					</div>

					<div id="blog_cont_main" class="blog_main_cont">
						<?php the_content(); // Do NOT echo ?>
					</div>

					<div class="read_more_cat">
						<div class="blog_icon">
							<img src="https://gaztech.myfnm.gr/wp-content/uploads/2024/11/blog_icon.svg" alt="blog icon"/>
						</div>
						<div class="blog_read_txt">
							Βρήκατε ενδιαφέρον το νέο μας άρθρο:<br>
							«<?php echo esc_html( wp_strip_all_tags( $title ) ); ?>»;
						</div>
						<div class="more_cta">
							<p>Διαβάστε περισσότερα κείμενα που σας αφορούν από αυτήν την ενότητα.</p>
							<a class="btn wht" href="<?php echo esc_url( add_query_arg( '_blog_categories', $sub_cat_slug, $cat_link ) ); ?>">
								<?php echo esc_html( $sub_cat ); ?>
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div id="section_blog_home" class="main_wrapper home_pg blog_on_services blog_related">
			<div id="blog_home_row_1" class="_row m-auto mw">
				<h1 class="section_title no_border center">ΣΧΕΤΙΚΑ ΑΡΘΡΑ</h1>
			</div>
			<div id="blog_home_row_2" class="_row m-auto mw">
				<div class="blog_home_inner_row">
					<?php
					// Keep related strictly within blog context
					$blog_cat = $blog_cat_id;
					if ( ! empty( $my_post_child_cats ) ) {
						$blog_cat = $my_post_child_cats;
					}
					// Assumes getBlogHome( $cats, $count ) returns the related posts HTML
					echo getBlogHome( $blog_cat, 4 );
					?>
				</div>
			</div>
		</div><!-- related-posts -->

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->