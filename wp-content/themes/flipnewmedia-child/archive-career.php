<?php
/**
 * Career archive template.
 *
 * @package FlipNewMedia
 */

get_header();

$career_query = new WP_Query(
	array(
		'post_type'      => 'career',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

$has_careers = $career_query->have_posts();
$lang        = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : 'el';

$copy = array(
	'el' => array(
		'eyebrow'     => 'ΚΑΡΙΕΡΑ',
		'title'       => "ΑΝΑΚΑΛΥΨΤΕ ΤΟ\nΜΕΛΛΟΝ ΣΑΣ",
		'lead'        => 'Ως μια συνεχώς αναπτυσσόμενη εταιρεία, η Life Science Chemilab Α.Ε. αναζητά διαρκώς υψηλής ποιότητας προσωπικό με εμπειρία στις πωλήσεις νοσοκομειακού και εργαστηριακού εξοπλισμού και αναλωσίμων.',
		'copy'        => 'Παρακαλούμε όπως αποστείλετε το βιογραφικό σας στη διεύθυνση %s',
		'copy_tail'   => 'Το βιογραφικό σας θα φυλαχθεί σε αρχείο για την αξιολόγησή του μόλις παρουσιαστεί ευκαιρία πλήρωσης θέσεως.',
		'email_label' => 'info@lsc.gr',
		'date_label'  => 'Ημερομηνία δημιουργίας:',
		'empty_title' => 'Δεν υπάρχουν διαθέσιμες θέσεις αυτή τη στιγμή.',
		'empty_copy'  => 'Μπορείτε να μας στείλετε το βιογραφικό σας και θα επικοινωνήσουμε μαζί σας όταν ανοίξει η κατάλληλη θέση.',
	),
	'en' => array(
		'eyebrow'     => 'CAREER',
		'title'       => "DISCOVER YOUR\nFUTURE",
		'lead'        => 'As a continuously growing company, Life Science Chemilab S.A. is consistently looking for high-quality professionals with experience in hospital and laboratory equipment and consumables sales.',
		'copy'        => 'Please send your CV to %s',
		'copy_tail'   => 'Your CV will be kept on file and reviewed as soon as a suitable position becomes available.',
		'email_label' => 'info@lsc.gr',
		'date_label'  => 'Creation date:',
		'empty_title' => 'There are no open positions at the moment.',
		'empty_copy'  => 'You can still send us your CV and we will contact you when a suitable role opens.',
	),
);

$content = isset( $copy[ $lang ] ) ? $copy[ $lang ] : $copy['el'];
?>

<main id="primary" class="site-main career-archive">
	<?php
	echo lsc_render_video_hero(
		array(
			'title'         => $content['eyebrow'],
			'copy'          => '',
			'aria_label'    => __( 'Career archive', 'flipnewmedia' ),
			'section_class' => 'career-archive__hero',
			'inner_class'   => 'career-archive__hero-inner',
		)
	);
	?>

	<section class="career-archive__content-wrap">
		<div class="container-ext career-archive__content">
			<div class="career-archive__layout">
				<div class="career-archive__intro-column">
					<div id="career-archive-intro" class="career-archive__intro">
						<h1 class="career-archive__title"><?php echo nl2br( esc_html( $content['title'] ) ); ?></h1>
						<p class="career-archive__lead"><?php echo esc_html( $content['lead'] ); ?></p>
						<p class="career-archive__copy">
							<?php
							printf(
								wp_kses(
									$content['copy'],
									array(
										'a' => array(
											'href'  => array(),
											'class' => array(),
										),
									)
								),
								sprintf(
									'<a href="mailto:%1$s" class="career-archive__email">%2$s</a>',
									esc_attr( antispambot( $content['email_label'] ) ),
									esc_html( $content['email_label'] )
								)
							);
							?>
						</p>
						<p class="career-archive__copy"><?php echo esc_html( $content['copy_tail'] ); ?></p>
					</div>
				</div>

				<div class="career-archive__list-column <?php echo $has_careers ? 'has-careers' : 'no-careers'; ?>">
					<?php if ( $has_careers ) : ?>
						<div class="career-archive__cards">
							<?php
							while ( $career_query->have_posts() ) :
								$career_query->the_post();

								$summary = get_the_excerpt();
								if ( ! $summary ) {
									$summary = wp_strip_all_tags( get_the_content() );
								}
								$summary = wp_trim_words( wp_strip_all_tags( $summary ), 24, '...' );
								?>
								<a href="<?php the_permalink(); ?>" class="career-card" aria-label="<?php the_title_attribute(); ?>">
									<article class="career-card__inner">
										<svg class="career-card__icon" width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="55" y="55" width="55" height="55" rx="27.5" transform="rotate(180 55 55)" fill="#2A417C"/>
<path d="M29.666 18.8891L38.9994 27.4447L29.666 36.0002" stroke="white" stroke-width="2"/>
<line x1="39" y1="27.6669" x2="18" y2="27.6669" stroke="white" stroke-width="2"/>
</svg>

										<h2 class="career-card__title"><?php the_title(); ?></h2>
										<p class="career-card__summary"><?php echo esc_html( $summary ); ?></p>
										<p class="career-card__date">
											<?php echo esc_html( $content['date_label'] ); ?>
											<span><?php echo esc_html( get_the_date() ); ?></span>
										</p>
									</article>
								</a>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					<?php else : ?>
						<div class="career-archive__empty">
							<h2 class="career-archive__empty-title"><?php echo esc_html( $content['empty_title'] ); ?></h2>
							<p class="career-archive__empty-copy"><?php echo esc_html( $content['empty_copy'] ); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var intro = document.getElementById('career-archive-intro');
  var header = document.querySelector('.site-header');
  var footer = document.querySelector('.site-footer');

  if (!intro || !header || !footer) {
    return;
  }

  var wrapper = intro.parentElement;
  var listColumn = document.querySelector('.career-archive__list-column.has-careers');

  if (!listColumn) {
    intro.classList.remove('is-fixed', 'is-stuck-bottom');
    intro.style.top = '';
    intro.style.width = '';
    return;
  }

  function syncStickyState() {
    if (window.innerWidth < 992) {
      intro.classList.remove('is-fixed', 'is-stuck-bottom');
      intro.style.top = '';
      intro.style.width = '';
      return;
    }

    var headerHeight = header.offsetHeight;
    var wrapperRect = wrapper.getBoundingClientRect();
    var footerRect = footer.getBoundingClientRect();

    if (wrapperRect.top <= headerHeight && footerRect.top > window.innerHeight + 40) {
      intro.classList.add('is-fixed');
      intro.classList.remove('is-stuck-bottom');
      intro.style.top = headerHeight + 24 + 'px';
      intro.style.width = wrapper.offsetWidth + 'px';
      return;
    }

    if (footerRect.top <= window.innerHeight + 40) {
      intro.classList.remove('is-fixed');
      intro.classList.add('is-stuck-bottom');
      intro.style.top = wrapper.offsetHeight - intro.offsetHeight + 'px';
      intro.style.width = wrapper.offsetWidth + 'px';
      return;
    }

    intro.classList.remove('is-fixed', 'is-stuck-bottom');
    intro.style.top = '';
    intro.style.width = '';
  }

  window.addEventListener('scroll', syncStickyState, { passive: true });
  window.addEventListener('resize', syncStickyState);
  syncStickyState();
});
</script>

<?php
get_footer();
