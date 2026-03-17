<?php
/**
 * Template Name: Landing Page
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

$default_landing_intro = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

$default_landing_cards = array(
	array(
		'image'   => 'https://www.figma.com/api/mcp/asset/cdfefbe9-c03a-4c89-8863-ff820e290a60',
		'caption' => 'Lorem ipsum dolor sit amet, consectetur adipisci',
		'class'   => 'is-wide',
	),
	array(
		'image'   => 'https://www.figma.com/api/mcp/asset/0fe266c4-8715-4116-93bb-41e79b315a04',
		'caption' => 'Lorem ipsum dolor sit amet, consectetur adipisci',
		'class'   => 'is-medium',
	),
	array(
		'image'   => 'https://www.figma.com/api/mcp/asset/0ea0f24b-084e-4e2c-94ed-602a177900e0',
		'caption' => 'Lorem ipsum dolor sit amet,',
		'class'   => 'is-narrow',
	),
	array(
		'image'   => 'https://www.figma.com/api/mcp/asset/43428d78-7f4e-444c-b458-b9dfb463b53e',
		'caption' => 'Lorem ipsum dolor sit amet,',
		'class'   => 'is-wide',
	),
);

$default_landing_feature_sections = array(
	array(
		'layout' => 'default',
		'image'  => 'https://www.figma.com/api/mcp/asset/5a810c25-a159-4dc1-b47e-f18e2cb199b0',
		'title'  => 'Lorem ipsum dolor sit amet,',
		'copy'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
	),
	array(
		'layout' => 'reverse',
		'image'  => 'https://www.figma.com/api/mcp/asset/d399f219-9352-4ad2-a0a3-7827ebb4799a',
		'title'  => 'Lorem ipsum dolor sit amet,',
		'copy'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
	),
	array(
		'layout' => 'default',
		'image'  => 'https://www.figma.com/api/mcp/asset/f83220e8-d5a9-4f40-9751-7ff152636738',
		'title'  => 'Lorem ipsum dolor sit amet,',
		'copy'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
	),
);

$landing_hero_title       = function_exists( 'get_field' ) ? ( get_field( 'landing_hero_title' ) ?: 'Lorem ipsum dolor sit' ) : 'Lorem ipsum dolor sit';
$landing_intro            = function_exists( 'get_field' ) ? ( get_field( 'landing_hero_intro' ) ?: $default_landing_intro ) : $default_landing_intro;
$landing_contact_label    = function_exists( 'get_field' ) ? ( get_field( 'landing_contact_label' ) ?: 'Επικοινωνήστε μαζί μας' ) : 'Επικοινωνήστε μαζί μας';
$landing_contact_url      = function_exists( 'get_field' ) ? ( get_field( 'landing_contact_url' ) ?: home_url( '/contact' ) ) : home_url( '/contact' );
$landing_contact_icon     = function_exists( 'get_field' ) ? $image_url( get_field( 'landing_contact_icon' ) ) : '';
$landing_center_copy      = function_exists( 'get_field' ) ? ( get_field( 'landing_center_copy' ) ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.' ) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.';
$landing_cards            = array();
$landing_feature_sections = array();

if ( ! $landing_contact_icon ) {
	$landing_contact_icon = 'https://www.figma.com/api/mcp/asset/17885700-e41c-473c-83e0-e768c4c6e062';
}

if ( function_exists( 'have_rows' ) && have_rows( 'landing_hero_cards' ) ) {
	while ( have_rows( 'landing_hero_cards' ) ) {
		the_row();

		$landing_cards[] = array(
			'image'   => $image_url( get_sub_field( 'image' ) ),
			'caption' => (string) get_sub_field( 'caption' ),
			'class'   => (string) ( get_sub_field( 'width_class' ) ?: 'is-wide' ),
		);
	}
}

if ( empty( $landing_cards ) ) {
	$landing_cards = $default_landing_cards;
}

if ( function_exists( 'have_rows' ) && have_rows( 'landing_feature_sections' ) ) {
	while ( have_rows( 'landing_feature_sections' ) ) {
		the_row();

		$landing_feature_sections[] = array(
			'layout' => (string) ( get_sub_field( 'layout' ) ?: 'default' ),
			'image'  => $image_url( get_sub_field( 'image' ) ),
			'title'  => (string) get_sub_field( 'title' ),
			'copy'   => (string) get_sub_field( 'copy' ),
		);
	}
}

if ( empty( $landing_feature_sections ) ) {
	$landing_feature_sections = $default_landing_feature_sections;
}
?>

<main id="primary" class="site-main landing-page-template">
	<?php
	echo lsc_render_video_hero(
		array(
			'title'         => $landing_hero_title,
			'copy'          => $landing_intro,
			'aria_label'    => __( 'Landing page hero', 'flipnewmedia' ),
			'section_class' => 'landing-page-video-hero figma-node-721-30',
			'inner_class'   => 'landing-page-video-hero__inner',
		)
	);
	?>

	<section class="landing-page-hero-stage" aria-label="<?php esc_attr_e( 'Landing page gallery', 'flipnewmedia' ); ?>">
		<div class="container-ext">
			<div class="landing-page-hero-progress">
				<span class="landing-page-hero__line" data-node-id="642:5741" aria-hidden="true"></span>
			</div>
		</div>
		<div class="landing-page-hero__stage">
			<div class="container-ext">
				<div class="landing-page-hero__gallery js-landing-page-slider">
					<?php foreach ( $landing_cards as $card ) : ?>
						<article class="landing-page-hero__card <?php echo esc_attr( $card['class'] ); ?>">
							<div class="landing-page-hero__media">
								<img src="<?php echo esc_url( $card['image'] ); ?>" alt="" loading="lazy" decoding="async" />
							</div>
							<?php if ( $card['caption'] ) : ?>
								<p class="landing-page-hero__caption"><?php echo esc_html( $card['caption'] ); ?></p>
							<?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $landing_center_copy ) : ?>
		<section class="landing-page-center-copy" aria-label="<?php esc_attr_e( 'Landing page highlight text', 'flipnewmedia' ); ?>">
			<div class="container-ext">
				<p class="landing-page-center-copy__text" data-node-id="642:5713"><?php echo esc_html( $landing_center_copy ); ?></p>
			</div>
		</section>
	<?php endif; ?>

	<?php foreach ( $landing_feature_sections as $section_index => $section ) : ?>
		<?php
		$is_reverse   = 'reverse' === $section['layout'];
		$section_node = 0 === $section_index ? '721:32' : ( 1 === $section_index ? '721:33' : '721:34' );
		$title_node   = 0 === $section_index ? '642:5717' : ( 1 === $section_index ? '642:5719' : '642:5718' );
		$copy_node    = 0 === $section_index ? '642:5714' : ( 1 === $section_index ? '642:5716' : '642:5715' );
		$image_node   = 0 === $section_index ? '642:5700' : ( 1 === $section_index ? '642:5702' : '642:5701' );
		?>
		<section class="landing-page-feature<?php echo $is_reverse ? ' landing-page-feature--reverse' : ''; ?> figma-node-<?php echo esc_attr( str_replace( ':', '-', $section_node ) ); ?>" data-node-id="<?php echo esc_attr( $section_node ); ?>" aria-label="<?php esc_attr_e( 'Landing page feature section', 'flipnewmedia' ); ?>">
			<div class="container-ext">
				<div class="landing-page-feature__grid">
					<?php if ( ! $is_reverse ) : ?>
						<div class="landing-page-feature__media" data-node-id="<?php echo esc_attr( $image_node ); ?>">
							<img src="<?php echo esc_url( $section['image'] ); ?>" alt="" loading="lazy" decoding="async" />
						</div>
					<?php endif; ?>
					<div class="landing-page-feature__copy">
						<h2 class="landing-page-feature__title" data-node-id="<?php echo esc_attr( $title_node ); ?>"><?php echo esc_html( $section['title'] ); ?></h2>
						<div class="landing-page-feature__body" data-node-id="<?php echo esc_attr( $copy_node ); ?>">
							<?php echo wpautop( esc_html( $section['copy'] ) ); ?>
						</div>
					</div>
					<?php if ( $is_reverse ) : ?>
						<div class="landing-page-feature__media" data-node-id="<?php echo esc_attr( $image_node ); ?>">
							<img src="<?php echo esc_url( $section['image'] ); ?>" alt="" loading="lazy" decoding="async" />
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<section class="landing-page-template__content">
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

	var $slider = $('.js-landing-page-slider');
	if (!$slider.length) {
		return;
	}

	if ($slider.hasClass('slick-initialized')) {
		$slider.slick('unslick');
	}

	var progressLine = document.querySelector('.landing-page-hero__line');

	function updateHeroProgress(slick, currentSlide) {
		if (!progressLine || !slick) {
			return;
		}

		var total = slick.slideCount || 1;
		var index = Math.max(0, Math.min(total - 1, currentSlide || 0));
		var progress = total > 1 ? (((index + 1) / total) * 100) : 100;

		progressLine.style.setProperty('--landing-hero-progress', progress + '%');
	}

	$slider.on('init', function (event, slick) {
		updateHeroProgress(slick, slick.currentSlide || 0);
	});

	$slider.on('afterChange', function (event, slick, currentSlide) {
		updateHeroProgress(slick, currentSlide);
	});

	$slider.slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		variableWidth: true,
		infinite: true,
		speed: 550,
		arrows: true,
		dots: false,
		adaptiveHeight: false,
		prevArrow: '<button type="button" class="landing-page-hero__arrow landing-page-hero__arrow--prev" aria-label="Previous slide"></button>',
		nextArrow: '<button type="button" class="landing-page-hero__arrow landing-page-hero__arrow--next" aria-label="Next slide"></button>',
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					variableWidth: false,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 768,
				settings: {
					variableWidth: false,
					slidesToShow: 1
				}
			}
		]
	});
});
</script>

<?php
get_footer();
