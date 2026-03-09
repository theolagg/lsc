<?php
/**
 * Theme footer
 *
 * @package FlipNewMedia
 */

$lsc_footer_status = isset( $_GET['lsc_footer_status'] ) ? sanitize_key( wp_unslash( $_GET['lsc_footer_status'] ) ) : '';
$lsc_footer_form   = isset( $_GET['lsc_footer_form'] ) ? sanitize_key( wp_unslash( $_GET['lsc_footer_form'] ) ) : '';
$lsc_notice_class  = '';
$lsc_notice_text   = '';
$lsc_asset_newsletter = 'http://localhost:8080/wp-content/uploads/2026/03/image-8.png';
$lsc_asset_linkedin   = 'http://localhost:8080/wp-content/uploads/2026/03/image-9liinkedin.svg';
$lsc_asset_facebook   = 'http://localhost:8080/wp-content/uploads/2026/03/facebook.svg';
$lsc_asset_phone      = 'http://localhost:8080/wp-content/uploads/2026/03/Vectorphone.svg';
$lsc_asset_logo       = 'http://localhost:8080/wp-content/uploads/2026/03/logofooter.png';

if ( 'ok' === $lsc_footer_status && 'newsletter' === $lsc_footer_form ) {
	$lsc_notice_class = 'is-success';
	$lsc_notice_text  = __( 'Newsletter request submitted successfully.', 'flipnewmedia-child' );
} elseif ( 'ok' === $lsc_footer_status && 'contact' === $lsc_footer_form ) {
	$lsc_notice_class = 'is-success';
	$lsc_notice_text  = __( 'Contact request submitted successfully.', 'flipnewmedia-child' );
} elseif ( 'error' === $lsc_footer_status ) {
	$lsc_notice_class = 'is-error';
	$lsc_notice_text  = __( 'Something went wrong. Please try again.', 'flipnewmedia-child' );
}
?>
    <footer class="lsc-footer" id="contact-footer">
      <section class="lsc-footer__newsletter" aria-label="<?php esc_attr_e( 'Newsletter', 'flipnewmedia-child' ); ?>">
        <div class="container lsc-footer__newsletter-inner">
          <?php if ( ! empty( $lsc_notice_text ) ) : ?>
            <p class="lsc-footer__notice <?php echo esc_attr( $lsc_notice_class ); ?>"><?php echo esc_html( $lsc_notice_text ); ?></p>
          <?php endif; ?>
          <div class="lsc-footer__newsletter-icon" aria-hidden="true">
            <img src="<?php echo esc_url( $lsc_asset_newsletter ); ?>" alt="">
          </div>
          <form class="lsc-footer__newsletter-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
            <input type="hidden" name="action" value="lsc_footer_newsletter_submit">
            <?php wp_nonce_field( 'lsc_footer_newsletter_submit', 'lsc_footer_newsletter_nonce' ); ?>
            <label class="screen-reader-text" for="lsc-newsletter-email"><?php esc_html_e( 'Your Email', 'flipnewmedia-child' ); ?></label>
            <input id="lsc-newsletter-email" type="email" name="newsletter_email" placeholder="Your Email*" required>
            <button class="lsc-footer__newsletter-submit" type="submit"><?php esc_html_e( 'Αποστολή', 'flipnewmedia-child' ); ?></button>
            <button class="lsc-footer__newsletter-arrow" type="submit" aria-label="<?php esc_attr_e( 'Submit', 'flipnewmedia-child' ); ?>">
              <span aria-hidden="true">&rarr;</span>
            </button>
          </form>
          <label class="lsc-footer__consent lsc-footer__consent--light">
            <input class="lsc-footer__switch-input" type="checkbox" name="newsletter_terms" value="1" required>
            <span class="lsc-footer__switch" aria-hidden="true"><span></span></span>
            <p>
              <?php esc_html_e( 'Με τη συμπλήρωση και αποστολή των στοιχείων σας, αποδέχεστε τους Όρους Χρήσης.', 'flipnewmedia-child' ); ?>
            </p>
          </label>
        </div>
      </section>

      <section class="lsc-footer__main">
        <div class="container lsc-footer__main-inner">
          <div class="lsc-footer__top">
            <div class="lsc-footer__intro">
              <h2>
                <span><?php esc_html_e( 'Επικοινωνήστε', 'flipnewmedia-child' ); ?></span>
                <?php esc_html_e( ' μαζί μας για περισσότερες πληροφορίες', 'flipnewmedia-child' ); ?>
              </h2>
              <div class="lsc-footer__phones">
                <p><small><?php esc_html_e( 'Αθήνα', 'flipnewmedia-child' ); ?></small> <img src="<?php echo esc_url( $lsc_asset_phone ); ?>" alt="" aria-hidden="true"> <a href="tel:+302102582489">210 2582489</a></p>
                <p><small><?php esc_html_e( 'Θεσσαλονίκη', 'flipnewmedia-child' ); ?></small> <img src="<?php echo esc_url( $lsc_asset_phone ); ?>" alt="" aria-hidden="true"> <a href="tel:+302310650660">2310 650660</a></p>
              </div>
              <div class="lsc-footer__social">
                <p><?php esc_html_e( 'Ακολουθήστε μας', 'flipnewmedia-child' ); ?></p>
                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><img src="<?php echo esc_url( $lsc_asset_linkedin ); ?>" alt="" aria-hidden="true"></a>
                <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><img src="<?php echo esc_url( $lsc_asset_facebook ); ?>" alt="" aria-hidden="true"></a>
              </div>
            </div>

            <div class="lsc-footer__form-wrap">
              <form class="lsc-footer__contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="lsc_footer_contact_submit">
                <?php wp_nonce_field( 'lsc_footer_contact_submit', 'lsc_footer_contact_nonce' ); ?>
                <label>
                  <span><?php esc_html_e( 'Ονοματεπώνυμο:', 'flipnewmedia-child' ); ?></span>
                  <input type="text" name="full_name" required>
                </label>
                <label>
                  <span><?php esc_html_e( 'Τηλέφωνο:', 'flipnewmedia-child' ); ?></span>
                  <input type="tel" name="phone">
                </label>
                <label>
                  <span><?php esc_html_e( 'Email:', 'flipnewmedia-child' ); ?></span>
                  <input type="email" name="email" required>
                </label>
                <label>
                  <span><?php esc_html_e( 'Μήνυμα:', 'flipnewmedia-child' ); ?></span>
                  <textarea name="message" rows="2"></textarea>
                </label>
                <div class="lsc-footer__form-actions">
                  <label class="lsc-footer__consent lsc-footer__consent--dark">
                    <input class="lsc-footer__switch-input" type="checkbox" name="contact_terms" value="1" required>
                    <span class="lsc-footer__switch" aria-hidden="true"><span></span></span>
                    <p>
                      <?php esc_html_e( 'Με τη συμπλήρωση και αποστολή των στοιχείων σας, αποδέχεστε τους Όρους Χρήσης.', 'flipnewmedia-child' ); ?>
                    </p>
                  </label>
                  <div class="lsc-footer__send">
                    <button class="lsc-footer__send-btn" type="submit"><?php esc_html_e( 'Αποστολή', 'flipnewmedia-child' ); ?></button>
                    <button class="lsc-footer__send-arrow" type="submit" aria-label="<?php esc_attr_e( 'Submit', 'flipnewmedia-child' ); ?>">
                      <span aria-hidden="true">&rarr;</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="lsc-footer__middle">
            <div class="lsc-footer__logo">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Home', 'flipnewmedia-child' ); ?>">
                <img src="<?php echo esc_url( $lsc_asset_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
              </a>
            </div>
            <div class="lsc-footer__office">
              <h3><?php esc_html_e( 'Αθήνα', 'flipnewmedia-child' ); ?></h3>
              <p><?php esc_html_e( 'Κ. Παλαμά 36, 143 43, Ν. Χαλκηδόνα, Αθήνα', 'flipnewmedia-child' ); ?></p>
              <p><span>Τ</span> 210 2582489 <span>F</span> 210 2532090 <span>M</span> info@lsc.gr</p>
            </div>
            <div class="lsc-footer__office">
              <h3><?php esc_html_e( 'Θεσσαλονίκη', 'flipnewmedia-child' ); ?></h3>
              <p><?php esc_html_e( 'Αμαράντου 33, 56 431, Άνω Ηλιούπολη, Θεσσαλονίκη', 'flipnewmedia-child' ); ?></p>
              <p><span>Τ</span> 2310 650660 <span>F</span> 2310 650655 <span>M</span> customercare@lsc.gr</p>
            </div>
          </div>
        </div>
        <div class="lsc-footer__bottom">
          <div class="container lsc-footer__bottom-inner">
            <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>, Life Science Chemilab - All rights reserved</p>
            <p><?php esc_html_e( 'Made by Flipnewmedia', 'flipnewmedia-child' ); ?></p>
          </div>
        </div>
      </section>
    </footer>

    </div><!-- #page -->

    <?php wp_footer(); ?>
  </body>
</html>
