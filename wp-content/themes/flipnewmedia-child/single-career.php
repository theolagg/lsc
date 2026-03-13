<?php
/**
 * Single career template.
 *
 * @package FlipNewMedia
 */

get_header();

$career_return_url      = get_post_type_archive_link( 'career' ) ? get_post_type_archive_link( 'career' ) : home_url( '/career/' );
$career_form_status     = isset( $_GET['career_form_status'] ) ? sanitize_key( wp_unslash( $_GET['career_form_status'] ) ) : '';
?>

<main id="primary" class="site-main single-career">
	<div class="container-ext single-career__breadcrumbs">
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		}
		?>
	</div>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$career_permalink    = get_permalink();
		$career_title        = get_the_title();
		$career_intro        = get_the_excerpt();
		if ( ! $career_intro ) {
			$career_intro = wp_trim_words( wp_strip_all_tags( get_the_content() ), 30, '...' );
		}
		$career_share_links  = array(
			array(
				'label' => 'Facebook',
				'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $career_permalink ),
			),
			array(
				'label' => 'LinkedIn',
				'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode( $career_permalink ),
			),
			array(
				'label' => 'Email',
				'url'   => 'mailto:?subject=' . rawurlencode( $career_title ) . '&body=' . rawurlencode( $career_permalink ),
			),
		);
		?>
		<?php
		echo lsc_render_video_hero(
			array(
				'title'         => get_the_title(),
				'copy'          => $career_intro,
				'aria_label'    => __( 'Career hero', 'flipnewmedia' ),
				'section_class' => 'single-career__hero figma-node-710-211',
				'inner_class'   => 'single-career__hero-inner',
			)
		);
		?>

		<section class="single-career__details figma-node-710-212" data-node-id="710:212">
			<div class="container-ext">
				<div class="single-career__toolbar">
					<a href="<?php echo esc_url( $career_return_url ); ?>" class="single-career__back">
						<span class="single-career__back-icon" aria-hidden="true">←</span>
						<span class="single-career__back-label"><?php esc_html_e( 'Back', 'flipnewmedia' ); ?></span>
					</a>
					<p class="single-career__date">
						<?php esc_html_e( 'Ημερομηνία δημιουργίας:', 'flipnewmedia' ); ?>
						<span><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
					</p>
				</div>

				<div class="single-career__body">
					<div class="single-career__entry entry-content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="single-career__pages">' . esc_html__( 'Pages:', 'flipnewmedia' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>

					<div class="single-career__share">
						<button type="button" class="single-career__share-trigger" aria-expanded="false">
							<span class="single-career__share-icon" aria-hidden="true">⤴</span>
							<span class="single-career__share-label"><?php esc_html_e( 'Μοιραστείτε το', 'flipnewmedia' ); ?></span>
						</button>
						<div class="single-career__share-menu">
							<?php foreach ( $career_share_links as $share_item ) : ?>
								<a href="<?php echo esc_url( $share_item['url'] ); ?>" class="single-career__share-link" target="_blank" rel="noopener noreferrer">
									<?php echo esc_html( $share_item['label'] ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>

					<div id="career-application" class="single-career__form-card">
						<h2 class="single-career__form-title"><?php esc_html_e( 'Συμπληρώστε τα στοιχεία σας', 'flipnewmedia' ); ?></h2>

						<?php if ( 'ok' === $career_form_status ) : ?>
							<p class="single-career__form-notice is-success"><?php esc_html_e( 'Η αίτησή σας στάλθηκε με επιτυχία.', 'flipnewmedia' ); ?></p>
						<?php elseif ( 'error' === $career_form_status ) : ?>
							<p class="single-career__form-notice is-error"><?php esc_html_e( 'Υπήρξε πρόβλημα κατά την αποστολή. Ελέγξτε τα στοιχεία σας και δοκιμάστε ξανά.', 'flipnewmedia' ); ?></p>
						<?php endif; ?>

						<form class="single-career__form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="lsc_career_application_submit">
							<input type="hidden" name="career_post_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
							<?php wp_nonce_field( 'lsc_career_application_submit', 'lsc_career_application_nonce' ); ?>

							<label class="single-career__field">
								<span class="single-career__field-label"><?php esc_html_e( 'Ονοματεπώνυμο:', 'flipnewmedia' ); ?></span>
								<input type="text" name="career_full_name" required>
							</label>

							<label class="single-career__field">
								<span class="single-career__field-label"><?php esc_html_e( 'Τηλέφωνο:', 'flipnewmedia' ); ?></span>
								<input type="tel" name="career_phone">
							</label>

							<label class="single-career__field">
								<span class="single-career__field-label"><?php esc_html_e( 'Email:', 'flipnewmedia' ); ?></span>
								<input type="email" name="career_email" required>
							</label>

							<label class="single-career__field single-career__field--textarea">
								<span class="single-career__field-label"><?php esc_html_e( 'Μήνυμα:', 'flipnewmedia' ); ?></span>
								<textarea name="career_message" rows="4"></textarea>
							</label>

							<div class="single-career__upload-row">
								<label class="single-career__upload-label">
									<input type="file" name="career_cv" class="single-career__file-input" accept=".pdf,.doc,.docx">
									<span class="single-career__upload-name" data-career-file-name><?php esc_html_e( 'Δεν έχει επιλεγεί αρχείο', 'flipnewmedia' ); ?></span>
									<span class="single-career__upload-button"><?php esc_html_e( 'Επισύναψη αρχείου', 'flipnewmedia' ); ?></span>
								</label>
							</div>

							<div class="single-career__form-footer">
								<label class="single-career__consent">
									<input type="checkbox" name="career_terms" value="1" required>
									<span class="single-career__consent-toggle" aria-hidden="true"></span>
									<span class="single-career__consent-copy"><?php esc_html_e( 'Με τη συμπλήρωση και αποστολή των στοιχείων σας, αποδέχεστε την Πολιτική Απορρήτου.', 'flipnewmedia' ); ?></span>
								</label>

								<button type="submit" class="single-career__submit">
									<span class="single-career__submit-label"><?php esc_html_e( 'Αποστολή', 'flipnewmedia' ); ?></span>
									<span class="single-career__submit-icon" aria-hidden="true">→</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var input = document.querySelector('.single-career__file-input');
  var output = document.querySelector('[data-career-file-name]');

  if (!input || !output) {
    return;
  }

  input.addEventListener('change', function () {
    output.textContent = input.files && input.files.length ? input.files[0].name : 'Δεν έχει επιλεγεί αρχείο';
  });
});
</script>

<?php
get_footer();
