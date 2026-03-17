<?php
/**
 * Template Name: Home
 * Template Post Type: page
 *
 * @package FlipNewMedia
 */

get_header();

if ( ! function_exists( 'lsc_home_template_image_url' ) ) {
	function lsc_home_template_image_url( $value, $default = '' ) {
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

$upload_dir = wp_get_upload_dir();
$hero_video = trailingslashit( $upload_dir['baseurl'] ) . '2026/03/3940140663-preview.mp4';
$solutions_video = trailingslashit( $upload_dir['baseurl'] ) . '2026/03/1009729562-preview.mp4';

$default_hero_slides = array(
	array(
		'number'       => '01',
		'title'        => "ΕΞΟΠΛΙΖΟΥΜΕ\nΤΟ ΑΥΡΙΟ",
		'description'  => 'Τεχνολογίες που εξελίσσουν τα εργαστήρια και την έρευνα. Εξοπλισμός με αξιοπιστία, απόδοση και επιστημονική συνέπεια. Λύσεις που υποστηρίζουν την πρόοδο.',
		'button_label' => 'Περισσότερα',
		'button_url'   => '#',
	),
	array(
		'number'       => '02',
		'title'        => "ΠΡΟΪΟΝΤΑ\n& ΛΥΣΕΙΣ",
		'description'  => 'Ανακαλύψτε ολοκληρωμένες λύσεις για κάθε ανάγκη σε εξοπλισμό και αναλώσιμα. Επιλέγουμε τεχνολογία που ανταποκρίνεται στις απαιτήσεις σας.',
		'button_label' => 'Περισσότερα',
		'button_url'   => '#',
	),
	array(
		'number'       => '03',
		'title'        => "ΣΤΗΡΙΖΟΥΜΕ\nΤΗΝ ΕΠΙΣΤΗΜΗ",
		'description'  => 'Με τεχνική υποστήριξη και εξειδίκευση, δημιουργούμε μακροχρόνιες συνεργασίες με κέντρα έρευνας, εργαστήρια και οργανισμούς υγείας.',
		'button_label' => 'Περισσότερα',
		'button_url'   => '#',
	),
);

$default_stats_items = array(
	array(
		'value'       => '20',
		'title'       => 'χρόνια λειτουργίας',
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
		'node'        => '76:191',
	),
	array(
		'value'       => '200',
		'title'       => 'εργαστήρια μας εμπιστεύονται',
		'description' => 'Lorem ipsum dolor sit amet, consectetur',
		'node'        => '76:203',
	),
	array(
		'value'       => '140',
		'title'       => 'στρατηγικοί συνεργάτες',
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut lab',
		'node'        => '76:195',
	),
	array(
		'value'       => '550',
		'title'       => 'Lorem ipsum dolor',
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmodua.',
		'node'        => '76:199',
	),
);

$default_solutions_title = "ΚΑΙΝΟΤΟΜΕΣ\nΛΥΣΕΙΣ ΓΙΑ ΣΥΓΧΡΟΝΑ\nΕΡΓΑΣΤΗΡΙΑ";
$default_solutions_desc  = 'Προσφέρουμε ολοκληρωμένες λύσεις και προηγμένο εξοπλισμό που καλύπτουν τις ανάγκες των σύγχρονων εργαστηρίων. Από μικροσκόπηση και χημικά αναλώσιμα έως διαγνωστικά συστήματα και επιστημονικά όργανα υψηλής ακρίβειας.';
$default_solutions_bg    = 'https://www.figma.com/api/mcp/asset/deb79124-eb26-42a9-b5b8-b0a5e4023a56';
$default_solutions_cards = array(
	array(
		'title'       => 'Χημικά - Αναλώσιμα εργαστηρίου',
		'description' => '',
		'active'      => false,
		'more_label'  => 'Περισσότερα',
		'more_url'    => '#',
		'node'        => '84:358',
		'desc_node'   => '',
	),
	array(
		'title'       => "Υποβοηθούμενης αναπαραγωγής,\nΓυναικολογίας, Μαιευτικής",
		'description' => '',
		'active'      => false,
		'more_label'  => 'Περισσότερα',
		'more_url'    => '#',
		'node'        => '84:339',
		'desc_node'   => '',
	),
	array(
		'title'       => 'Διαγνωστικών εργαστηρίων (IVD)',
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'active'      => true,
		'more_label'  => 'Περισσότερα',
		'more_url'    => '#',
		'node'        => '84:360',
		'desc_node'   => '84:361',
	),
	array(
		'title'       => 'Εξοπλισμός - Επιστημονικά όργανα',
		'description' => '',
		'active'      => false,
		'more_label'  => 'Περισσότερα',
		'more_url'    => '#',
		'node'        => '84:384',
		'desc_node'   => '',
	),
);

$default_partners_title  = 'ΟΙ ΣΤΡΑΤΗΓΙΚΟΙ ΜΑΣ ΣΥΝΕΡΓΑΤΕΣ';
$default_partners_slides = array(
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

$default_partner_logo_cards = array(
	'https://www.figma.com/api/mcp/asset/7d75d17e-d437-420c-b9bf-086701a6fdc1',
	'https://www.figma.com/api/mcp/asset/d14b55ff-acca-4eb6-bd36-e8c66e97c570',
	'https://www.figma.com/api/mcp/asset/f6604b86-5e58-4bb8-881c-0f6a4454ad7f',
	'https://www.figma.com/api/mcp/asset/efabd33a-edaa-48c0-80b3-cb87ba90544d',
	'https://www.figma.com/api/mcp/asset/2c647df7-3e4e-4c71-ab67-9f2305ba67c9',
	'https://www.figma.com/api/mcp/asset/959de01a-bdde-451d-bd72-72088ed2d575',
);

$hero_slides        = $default_hero_slides;
$stats_items        = $default_stats_items;
$solutions_title    = $default_solutions_title;
$solutions_desc     = $default_solutions_desc;
$solutions_bg       = $default_solutions_bg;
$solutions_cards    = $default_solutions_cards;
$partners_title     = $default_partners_title;
$partners_slides    = $default_partners_slides;
$partner_logo_cards = $default_partner_logo_cards;

if ( function_exists( 'get_field' ) ) {
	$acf_hero_slides = get_field( 'home_hero_slides' );
	if ( is_array( $acf_hero_slides ) && ! empty( $acf_hero_slides ) ) {
		$hero_slides = array();
		foreach ( $acf_hero_slides as $index => $slide ) {
			if ( empty( $slide['title'] ) && empty( $slide['description'] ) ) {
				continue;
			}

			$hero_slides[] = array(
				'number'       => (string) ( $slide['number'] ?? sprintf( '%02d', $index + 1 ) ),
				'title'        => (string) ( $slide['title'] ?? '' ),
				'description'  => (string) ( $slide['description'] ?? '' ),
				'button_label' => (string) ( $slide['button_label'] ?? 'Περισσότερα' ),
				'button_url'   => (string) ( $slide['button_url'] ?? '#' ),
			);
		}

		if ( empty( $hero_slides ) ) {
			$hero_slides = $default_hero_slides;
		}
	}

	$acf_stats_items = get_field( 'home_stats_items' );
	if ( is_array( $acf_stats_items ) && ! empty( $acf_stats_items ) ) {
		$stats_items = array();
		foreach ( $acf_stats_items as $index => $item ) {
			if ( empty( $item['value'] ) && empty( $item['title'] ) && empty( $item['description'] ) ) {
				continue;
			}

			$stats_items[] = array(
				'value'       => (string) ( $item['value'] ?? '' ),
				'title'       => (string) ( $item['title'] ?? '' ),
				'description' => (string) ( $item['description'] ?? '' ),
				'node'        => 'stat-' . $index,
			);
		}

		if ( empty( $stats_items ) ) {
			$stats_items = $default_stats_items;
		}
	}

	$solutions_title = (string) ( get_field( 'home_solutions_title' ) ?: $default_solutions_title );
	$solutions_desc  = (string) ( get_field( 'home_solutions_description' ) ?: $default_solutions_desc );
	$solutions_bg    = lsc_home_template_image_url( get_field( 'home_solutions_background' ), $default_solutions_bg );

	$acf_solution_cards = get_field( 'home_solutions_cards' );
	if ( is_array( $acf_solution_cards ) && ! empty( $acf_solution_cards ) ) {
		$solutions_cards = array();
		foreach ( $acf_solution_cards as $index => $card ) {
			if ( empty( $card['title'] ) && empty( $card['description'] ) ) {
				continue;
			}

			$solutions_cards[] = array(
				'title'       => (string) ( $card['title'] ?? '' ),
				'description' => (string) ( $card['description'] ?? '' ),
				'active'      => ! empty( $card['is_active'] ),
				'more_label'  => (string) ( $card['more_label'] ?? 'Περισσότερα' ),
				'more_url'    => (string) ( $card['more_url'] ?? '#' ),
				'node'        => 'solution-card-' . $index,
				'desc_node'   => 'solution-card-desc-' . $index,
			);
		}

		if ( empty( $solutions_cards ) ) {
			$solutions_cards = $default_solutions_cards;
		}
	}

	$partners_title = (string) ( get_field( 'home_partners_title' ) ?: $default_partners_title );

	$acf_partners_slides = get_field( 'home_partners_slides' );
	if ( is_array( $acf_partners_slides ) && ! empty( $acf_partners_slides ) ) {
		$partners_slides = array();
		foreach ( $acf_partners_slides as $slide ) {
			$left_bg  = lsc_home_template_image_url( $slide['left_bg'] ?? '' );
			$right_bg = lsc_home_template_image_url( $slide['right_bg'] ?? '' );
			$logo     = lsc_home_template_image_url( $slide['logo'] ?? '' );

			if ( '' === $left_bg && '' === $right_bg && '' === $logo ) {
				continue;
			}

			$partners_slides[] = array(
				'left_bg'    => $left_bg,
				'right_bg'   => $right_bg,
				'logo'       => $logo,
				'more_url'   => (string) ( $slide['more_url'] ?? '#' ),
				'more_label' => (string) ( $slide['more_label'] ?? 'Περισσότερα' ),
			);
		}

		if ( empty( $partners_slides ) ) {
			$partners_slides = $default_partners_slides;
		}
	}

	$acf_partner_logos = get_field( 'home_partner_logos' );
	if ( is_array( $acf_partner_logos ) && ! empty( $acf_partner_logos ) ) {
		$partner_logo_cards = array();
		foreach ( $acf_partner_logos as $item ) {
			$logo_url = lsc_home_template_image_url( $item['logo'] ?? '' );
			if ( '' !== $logo_url ) {
				$partner_logo_cards[] = $logo_url;
			}
		}

		if ( empty( $partner_logo_cards ) ) {
			$partner_logo_cards = $default_partner_logo_cards;
		}
	}
}

$news_query_builder = static function ( $category_id = 0 ) {
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
	);

	if ( $category_id > 0 ) {
		$args['cat'] = (int) $category_id;
	}

	$query = new WP_Query( $args );
	$cards = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$excerpt = wp_strip_all_tags( get_the_excerpt() );
			if ( '' === $excerpt ) {
				$excerpt = get_the_title();
			}

			$cards[] = array(
				'url'     => get_permalink(),
				'title'   => get_the_title(),
				'excerpt' => wp_trim_words( $excerpt, 18, '...' ),
				'image'   => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
			);
		}
	}

	wp_reset_postdata();

	return $cards;
};

$news_terms = get_categories(
	array(
		'taxonomy'   => 'category',
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);

$news_tabs = array(
	array(
		'slug'  => 'all',
		'label' => __( 'Όλα', 'flipnewmedia' ),
	),
);

if ( ! empty( $news_terms ) ) {
	foreach ( $news_terms as $term ) {
		$news_tabs[] = array(
			'slug'    => 'cat-' . (int) $term->term_id,
			'label'   => $term->name,
			'term_id' => (int) $term->term_id,
		);
	}
}

$news_data_by_tab        = array();
$news_data_by_tab['all'] = $news_query_builder();

foreach ( $news_tabs as $tab ) {
	if ( empty( $tab['term_id'] ) ) {
		continue;
	}

	$news_data_by_tab[ $tab['slug'] ] = $news_query_builder( (int) $tab['term_id'] );
}

$news_cards = array();
if ( ! empty( $news_data_by_tab['all'] ) ) {
	foreach ( $news_data_by_tab['all'] as $idx => $card ) {
		$card['size'] = 0 === $idx ? 'featured' : 'regular';
		$news_cards[] = $card;
	}
}

$news_archive_url = get_permalink( (int) get_option( 'page_for_posts' ) );
if ( ! $news_archive_url ) {
	$news_archive_url = get_post_type_archive_link( 'post' );
}
if ( ! $news_archive_url ) {
	$news_archive_url = home_url( '/' );
}
?>
<main id="primary" class="site-main home-template">
	<section class="hero-slider-wrap figma-node-76-43" data-node-id="76:43">
		<video class="hero-slider-video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
			<source src="<?php echo esc_url( $hero_video ); ?>" type="video/mp4">
		</video>
		<div class="hero-slider js-hero-slider">
			<?php foreach ( $hero_slides as $slide_index => $slide ) : ?>
				<article class="hero-slide">
					<div class="hero-slide-inner container-ext">
						<div class="hero-content">
							<span class="hero-number"><?php echo esc_html( $slide['number'] ); ?></span>
							<?php if ( 0 === $slide_index ) : ?>
								<h1 class="hero-title home-display-title" data-node-id="77:1016"><?php echo nl2br( esc_html( $slide['title'] ) ); ?></h1>
							<?php else : ?>
								<h1 class="hero-title home-display-title"><?php echo nl2br( esc_html( $slide['title'] ) ); ?></h1>
							<?php endif; ?>
							<div class="hero-progress" aria-hidden="true"></div>
							<p class="hero-description home-body-copy"><?php echo esc_html( $slide['description'] ); ?></p>
							<div class="hero-actions">
								<a class="hero-btn home-pill-btn" href="<?php echo esc_url( $slide['button_url'] ); ?>">
									<?php echo esc_html( $slide['button_label'] ); ?>
								</a>
								<a class="hero-btn-arrow home-pill-btn home-pill-btn--icon" href="<?php echo esc_url( $slide['button_url'] ); ?>" aria-label="<?php esc_attr_e( 'Περισσότερα', 'flipnewmedia' ); ?>">
									<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4 11H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
										<path d="M12 5L18 11L12 17" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</a>
							</div>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<a class="hero-bottom-badge" href="#home-stats" aria-label="<?php esc_attr_e( 'Scroll to next section', 'flipnewmedia' ); ?>">
			<img
				src="<?php echo esc_url( trailingslashit( $upload_dir['baseurl'] ) . '2026/03/Group-1450.svg' ); ?>"
				alt=""
				aria-hidden="true"
			/>
		</a>
	</section>

	<section id="home-stats" class="home-stats figma-node-686-117" data-node-id="686:117" aria-label="<?php esc_attr_e( 'Company statistics', 'flipnewmedia' ); ?>">
		<div class="container-ext home-stats-grid" data-node-id="686:116">
			<?php foreach ( $stats_items as $item ) : ?>
				<article class="home-stats-item" data-node-id="<?php echo esc_attr( $item['node'] ); ?>">
					<p class="home-stats-value">
						<span><?php echo esc_html( $item['value'] ); ?></span><span class="plus">+</span>
					</p>
					<h3 class="home-stats-title"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="home-stats-description"><?php echo esc_html( $item['description'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section
		class="home-solutions figma-node-686-118"
		data-node-id="686:118"
		style="background-image:url('<?php echo esc_url( $solutions_bg ); ?>');"
		aria-label="<?php esc_attr_e( 'Solutions', 'flipnewmedia' ); ?>"
	>
		<video class="home-solutions-video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
			<source src="<?php echo esc_url( $solutions_video ); ?>" type="video/mp4">
		</video>
		<div class="container-ext home-solutions-grid">
			<div class="home-solutions-copy">
				<h2 class="home-solutions-title home-section-heading home-section-heading--inverse" data-node-id="77:1048"><?php echo nl2br( esc_html( $solutions_title ) ); ?></h2>
				<span class="home-solutions-divider" data-node-id="77:1055" aria-hidden="true"></span>
				<p class="home-solutions-description home-body-copy home-body-copy--inverse" data-node-id="77:1056"><?php echo esc_html( $solutions_desc ); ?></p>
			</div>

			<div class="home-solutions-cards js-home-solutions-accordion">
				<?php foreach ( $solutions_cards as $index => $card ) : ?>
					<?php
					$is_open  = ! empty( $card['active'] );
					$panel_id = 'home-solution-panel-' . $index;
					?>
					<article class="home-solutions-card home-elevated-card<?php echo $is_open ? ' is-active' : ''; ?>" data-node-id="<?php echo esc_attr( $card['node'] ); ?>">
						<button
							class="home-solutions-card-toggle"
							type="button"
							aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
							aria-controls="<?php echo esc_attr( $panel_id ); ?>"
						>
							<span class="home-solutions-card-title"><?php echo nl2br( esc_html( $card['title'] ) ); ?></span>
							<span class="home-solutions-card-arrow" aria-hidden="true"></span>
						</button>
						<span class="home-solutions-card-cursor" aria-hidden="true"></span>
						<div
							class="home-solutions-card-panel"
							id="<?php echo esc_attr( $panel_id ); ?>"
							<?php echo $is_open ? '' : 'hidden'; ?>
						>
							<?php if ( ! empty( $card['description'] ) ) : ?>
								<p class="home-solutions-card-description" data-node-id="<?php echo esc_attr( $card['desc_node'] ); ?>"><?php echo esc_html( $card['description'] ); ?></p>
							<?php endif; ?>
							<div class="home-solutions-card-footer">
								<a class="home-solutions-card-cta" href="<?php echo esc_url( $card['more_url'] ); ?>">
									<span class="home-solutions-card-cta-text"><?php echo esc_html( $card['more_label'] ); ?></span>
									<span class="home-solutions-card-cta-arrow" aria-hidden="true"></span>
								</a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>

	<section class="home-news figma-node-695-93" data-node-id="695:93" aria-label="<?php esc_attr_e( 'News', 'flipnewmedia' ); ?>">
		<div class="container-ext">
			<div class="home-news-head">
				<h2 class="home-news-title home-section-heading"><?php esc_html_e( 'ΤΑ ΝΕΑ ΜΑΣ', 'flipnewmedia' ); ?></h2>
				<div class="home-news-filters" role="tablist" aria-label="<?php esc_attr_e( 'News categories', 'flipnewmedia' ); ?>">
					<?php foreach ( $news_tabs as $index => $tab ) : ?>
						<button
							class="home-news-filter home-filter-pill<?php echo 0 === $index ? ' is-active' : ''; ?>"
							type="button"
							role="tab"
							data-tab="<?php echo esc_attr( $tab['slug'] ); ?>"
							aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
						>
							<?php echo esc_html( $tab['label'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="home-news-grid js-home-news-grid">
				<?php foreach ( $news_cards as $index => $card ) : ?>
					<article class="home-news-card home-elevated-card home-news-card--<?php echo 0 === $index ? 'featured' : 'regular'; ?>">
						<a class="home-news-card-media" href="<?php echo esc_url( $card['url'] ); ?>" aria-label="<?php esc_attr_e( 'Read more', 'flipnewmedia' ); ?>">
							<?php if ( ! empty( $card['image'] ) ) : ?>
								<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy" decoding="async" />
							<?php endif; ?>
						</a>
						<div class="home-news-card-copy">
							<h3 class="home-news-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
							<?php if ( ! empty( $card['excerpt'] ) ) : ?>
								<p class="home-news-card-excerpt"><?php echo esc_html( $card['excerpt'] ); ?></p>
							<?php endif; ?>
							<div class="home-news-card-footer">
								<a class="home-news-card-arrow" href="<?php echo esc_url( $card['url'] ); ?>" aria-label="<?php esc_attr_e( 'Read more', 'flipnewmedia' ); ?>"></a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="home-news-cta-wrap">
				<a class="home-news-cta" href="<?php echo esc_url( $news_archive_url ); ?>">
					<span class="home-news-cta-text"><?php esc_html_e( 'Περισσότερα', 'flipnewmedia' ); ?></span>
					<span class="home-news-cta-arrow" aria-hidden="true"></span>
				</a>
			</div>
		</div>
	</section>

	<section class="home-partners figma-node-700-95" data-node-id="700:95" aria-label="<?php esc_attr_e( 'Strategic partners', 'flipnewmedia' ); ?>">
		<div class="container-ext">
			<h2 class="home-partners-title home-section-heading" data-node-id="642:4138"><?php echo esc_html( $partners_title ); ?></h2>
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
						<a class="home-partners-more home-elevated-orb" href="<?php echo esc_url( $slide['more_url'] ); ?>">
							<span><?php echo esc_html( $slide['more_label'] ); ?></span>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="home-partner-logos figma-node-642-3974" data-node-id="642:3974" aria-label="<?php esc_attr_e( 'Partner brands', 'flipnewmedia' ); ?>">
		<div class="home-partner-logos-slider js-home-partner-logos-slider">
			<?php foreach ( $partner_logo_cards as $logo_src ) : ?>
				<article class="home-partner-logos-slide">
					<div class="home-partner-logos-card home-elevated-card home-logo-card">
						<img src="<?php echo esc_url( $logo_src ); ?>" alt="<?php esc_attr_e( 'Partner brand', 'flipnewmedia' ); ?>" loading="lazy" decoding="async" />
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<script type="application/json" id="home-news-data"><?php echo wp_json_encode( $news_data_by_tab ); ?></script>
</main>

<script>
	(function () {
		function initHeroSliderInline() {
			if (typeof window.jQuery === 'undefined') return;
			var $ = window.jQuery;
			if (typeof $.fn.slick !== 'function') return;

			var $hero = $('.js-hero-slider');
			if (!$hero.length) return;

			if ($hero.hasClass('slick-initialized')) {
				$hero.slick('unslick');
			}

			$hero.removeClass('is-ready');

			$hero.on('init', function () {
				moveDotsToCurrentSlide();
				$hero.addClass('is-ready');
			});

			$hero.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				speed: 650,
				fade: false,
				arrows: true,
				dots: true,
				adaptiveHeight: false,
				appendDots: $hero.find('.hero-slide').first().find('.hero-progress'),
				customPaging: function (slider, i) {
					return '<button type="button" aria-label="Go to slide ' + (i + 1) + '"></button>';
				},
				prevArrow: '<button type="button" class="slick-prev" aria-label="Previous slide"></button>',
				nextArrow: '<button type="button" class="slick-next" aria-label="Next slide"></button>'
			});

			function moveDotsToCurrentSlide() {
				var $dots = $hero.find('.slick-dots');
				var $target = $hero.find('.slick-current .hero-progress').first();
				if ($dots.length && $target.length) {
					$target.append($dots);
				}
			}

			$hero.on('afterChange', moveDotsToCurrentSlide);
		}

		function initHomeNewsTabs() {
			var section = document.querySelector('.home-news');
			var grid = document.querySelector('.js-home-news-grid');
			var payloadNode = document.getElementById('home-news-data');
			if (!section || !grid || !payloadNode) return;

			var newsMap = {};
			try {
				newsMap = JSON.parse(payloadNode.textContent || '{}');
			} catch (e) {
				newsMap = {};
			}

			var tabs = section.querySelectorAll('.home-news-filter[data-tab]');
			if (!tabs.length) return;

			function escapeHtml(value) {
				return String(value || '')
					.replace(/&/g, '&amp;')
					.replace(/</g, '&lt;')
					.replace(/>/g, '&gt;')
					.replace(/"/g, '&quot;')
					.replace(/'/g, '&#39;');
			}

			function renderCards(tabKey) {
				var cards = Array.isArray(newsMap[tabKey]) ? newsMap[tabKey] : [];
				if (!cards.length) {
					grid.innerHTML = '<p class="home-news-empty"><?php echo esc_js( __( 'Δεν βρέθηκαν άρθρα σε αυτή την κατηγορία.', 'flipnewmedia' ) ); ?></p>';
					return;
				}

				grid.innerHTML = cards.map(function (card, index) {
					var sizeClass = index === 0 ? 'featured' : 'regular';
					var imageHtml = card.image ? '<img src="' + escapeHtml(card.image) + '" alt="' + escapeHtml(card.title) + '" loading="lazy" decoding="async" />' : '';
					var excerptHtml = card.excerpt ? '<p class="home-news-card-excerpt">' + escapeHtml(card.excerpt) + '</p>' : '';
					return (
						'<article class="home-news-card home-elevated-card home-news-card--' + sizeClass + '">' +
							'<a class="home-news-card-media" href="' + escapeHtml(card.url) + '" aria-label="<?php echo esc_js( __( 'Read more', 'flipnewmedia' ) ); ?>">' +
								imageHtml +
							'</a>' +
							'<div class="home-news-card-copy">' +
								'<h3 class="home-news-card-title">' + escapeHtml(card.title) + '</h3>' +
								excerptHtml +
								'<div class="home-news-card-footer">' +
									'<a class="home-news-card-arrow" href="' + escapeHtml(card.url) + '" aria-label="<?php echo esc_js( __( 'Read more', 'flipnewmedia' ) ); ?>"></a>' +
								'</div>' +
							'</div>' +
						'</article>'
					);
				}).join('');
			}

			tabs.forEach(function (tab) {
				tab.addEventListener('click', function () {
					tabs.forEach(function (btn) {
						btn.classList.remove('is-active');
						btn.setAttribute('aria-selected', 'false');
					});
					tab.classList.add('is-active');
					tab.setAttribute('aria-selected', 'true');
					renderCards(tab.getAttribute('data-tab') || 'all');
				});
			});
		}

		function initHomeSolutionsAccordion() {
			var section = document.querySelector('.home-solutions');
			if (!section) return;

			var cards = Array.prototype.slice.call(section.querySelectorAll('.home-solutions-card'));
			if (!cards.length) return;

			function closeCard(card) {
				var toggle = card.querySelector('.home-solutions-card-toggle');
				var panel = card.querySelector('.home-solutions-card-panel');
				card.classList.remove('is-active');
				if (toggle) toggle.setAttribute('aria-expanded', 'false');
				if (panel) panel.hidden = true;
			}

			function openCard(card) {
				var toggle = card.querySelector('.home-solutions-card-toggle');
				var panel = card.querySelector('.home-solutions-card-panel');
				card.classList.add('is-active');
				if (toggle) toggle.setAttribute('aria-expanded', 'true');
				if (panel) panel.hidden = false;
			}

			if (!cards.some(function (card) { return card.classList.contains('is-active'); })) {
				openCard(cards[0]);
			}

			cards.forEach(function (card) {
				var toggle = card.querySelector('.home-solutions-card-toggle');
				var cursor = card.querySelector('.home-solutions-card-cursor');
				if (!toggle) return;

				toggle.addEventListener('click', function () {
					var isOpen = card.classList.contains('is-active');

					cards.forEach(function (item) {
						if (item !== card) {
							closeCard(item);
						}
					});

					if (isOpen) {
						closeCard(card);
					} else {
						openCard(card);
					}
				});

				card.addEventListener('mouseenter', function () {
					if (cursor) {
						card.classList.add('is-cursor-active');
						cursor.classList.add('is-visible');
					}
				});

				card.addEventListener('mousemove', function (event) {
					if (!cursor) return;

					var rect = card.getBoundingClientRect();
					var x = event.clientX - rect.left;
					var y = event.clientY - rect.top;

					cursor.style.left = x + 'px';
					cursor.style.top = y + 'px';
				});

				card.addEventListener('mouseleave', function () {
					card.classList.remove('is-cursor-active');
					if (cursor) {
						cursor.classList.remove('is-visible');
					}
				});
			});
		}

		function initHomePartnersSlider() {
			if (typeof window.jQuery === 'undefined') return;
			var $ = window.jQuery;
			if (typeof $.fn.slick !== 'function') return;

			var $slider = $('.js-home-partners-slider');
			if (!$slider.length) return;

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
		}

		function initHomePartnerLogosSlider() {
			if (typeof window.jQuery === 'undefined') return;
			var $ = window.jQuery;
			if (typeof $.fn.slick !== 'function') return;

			var $slider = $('.js-home-partner-logos-slider');
			if (!$slider.length) return;

			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			$slider.slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: true,
				arrows: false,
				dots: false,
				speed: 500,
				autoplay: true,
				autoplaySpeed: 2800,
				pauseOnHover: true,
				variableWidth: true,
				responsive: [
					{
						breakpoint: 1400,
						settings: { slidesToShow: 4, variableWidth: true }
					},
					{
						breakpoint: 1100,
						settings: { slidesToShow: 3, variableWidth: false }
					},
					{
						breakpoint: 768,
						settings: { slidesToShow: 2, variableWidth: false }
					},
					{
						breakpoint: 520,
						settings: { slidesToShow: 1.2, variableWidth: false }
					}
				]
			});
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', function () {
				initHeroSliderInline();
				initHomeSolutionsAccordion();
				initHomeNewsTabs();
				initHomePartnersSlider();
				initHomePartnerLogosSlider();
			});
		} else {
			initHeroSliderInline();
			initHomeSolutionsAccordion();
			initHomeNewsTabs();
			initHomePartnersSlider();
			initHomePartnerLogosSlider();
		}
	})();
</script>

<?php
get_footer();
