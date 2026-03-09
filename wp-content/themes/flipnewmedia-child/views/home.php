<?php
/**
 * Template Name: Home
 * Template Post Type: page
 *
 * @package FlipNewMedia
 */

get_header();

$upload_dir = wp_get_upload_dir();
$hero_bg    = trailingslashit( $upload_dir['baseurl'] ) . '2026/03/1080365813-preview-1.png';
$hero_slides = [
  [
    'number'      => '01',
    'title'       => "ΕΞΟΠΛΙΖΟΥΜΕ\nΤΟ ΑΥΡΙΟ",
    'description' => 'Τεχνολογίες που εξελίσσουν τα εργαστήρια και την έρευνα. Εξοπλισμός με αξιοπιστία, απόδοση και επιστημονική συνέπεια. Λύσεις που υποστηρίζουν την πρόοδο.',
    'button'      => 'Περισσότερα',
    'url'         => '#',
  ],
  [
    'number'      => '02',
    'title'       => "ΠΡΟΪΟΝΤΑ\n& ΛΥΣΕΙΣ",
    'description' => 'Ανακαλύψτε ολοκληρωμένες λύσεις για κάθε ανάγκη σε εξοπλισμό και αναλώσιμα. Επιλέγουμε τεχνολογία που ανταποκρίνεται στις απαιτήσεις σας.',
    'button'      => 'Περισσότερα',
    'url'         => '#',
  ],
  [
    'number'      => '03',
    'title'       => "ΣΤΗΡΙΖΟΥΜΕ\nΤΗΝ ΕΠΙΣΤΗΜΗ",
    'description' => 'Με τεχνική υποστήριξη και εξειδίκευση, δημιουργούμε μακροχρόνιες συνεργασίες με κέντρα έρευνας, εργαστήρια και οργανισμούς υγείας.',
    'button'      => 'Περισσότερα',
    'url'         => '#',
  ],
];

$stats_items = [
  [
    'value'       => '20',
    'title'       => 'χρόνια λειτουργίας',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
    'node'        => '76:191',
  ],
  [
    'value'       => '200',
    'title'       => 'εργαστήρια μας εμπιστεύονται',
    'description' => 'Lorem ipsum dolor sit amet, consectetur',
    'node'        => '76:203',
  ],
  [
    'value'       => '140',
    'title'       => 'στρατηγικοί συνεργάτες',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut lab',
    'node'        => '76:195',
  ],
  [
    'value'       => '550',
    'title'       => 'Lorem ipsum dolor',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmodua.',
    'node'        => '76:199',
  ],
];

$solutions_bg = 'https://www.figma.com/api/mcp/asset/deb79124-eb26-42a9-b5b8-b0a5e4023a56';
$solutions_cards = [
  [
    'title' => 'Χημικά - Αναλώσιμα εργαστηρίου',
    'node'  => '84:358',
    'active' => false,
  ],
  [
    'title' => "Υποβοηθούμενης αναπαραγωγής,\nΓυναικολογίας, Μαιευτικής",
    'node'  => '84:339',
    'active' => false,
  ],
  [
    'title' => 'Διαγνωστικών εργαστηρίων (IVD)',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis t enminim veniam, quis nostrud ncididunt ut labore et dolore magna',
    'node'  => '84:360',
    'desc_node' => '84:361',
    'active' => true,
  ],
  [
    'title' => 'Εξοπλισμός - Επιστημονικά όργανα',
    'node'  => '84:384',
    'active' => false,
  ],
];
?>
test
<main id="primary" class="site-main home-template">
  <section class="hero-slider-wrap figma-node-76-43" data-node-id="76:43" style="background-image:url('<?php echo esc_url( $hero_bg ); ?>');">
    <div class="hero-slider js-hero-slider">
      <?php foreach ( $hero_slides as $slide_index => $slide ) : ?>
        <article class="hero-slide">
          <div class="hero-slide-inner container-ext">
            <div class="hero-content">
              <span class="hero-number"><?php echo esc_html( $slide['number'] ); ?></span>
              <?php if ( 0 === $slide_index ) : ?>
                <h1 class="hero-title" data-node-id="77:1016">ΕΞΟΠΛΙΖΟΥΜΕ<br>ΤΟ ΑΥΡΙΟ</h1>
              <?php else : ?>
                <h1 class="hero-title"><?php echo nl2br( esc_html( $slide['title'] ) ); ?></h1>
              <?php endif; ?>
              <div class="hero-progress" aria-hidden="true"></div>
              <p class="hero-description"><?php echo esc_html( $slide['description'] ); ?></p>
              <div class="hero-actions">
                <a class="hero-btn" href="<?php echo esc_url( $slide['url'] ); ?>">
                  <?php echo esc_html( $slide['button'] ); ?>
                </a>
                <a class="hero-btn-arrow" href="<?php echo esc_url( $slide['url'] ); ?>" aria-label="<?php esc_attr_e( 'More', 'flipnewmedia' ); ?>">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 11H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M12 5L18 11L12 17" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>
              </div>
            </div>
            <a class="hero-contact-chip" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
              <span class="hero-contact-icon">+</span>
              <span><?php esc_html_e( 'Επικοινωνήστε μαζί μας', 'flipnewmedia' ); ?></span>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <img
      class="hero-bottom-badge"
      src="<?php echo esc_url( trailingslashit( $upload_dir['baseurl'] ) . '2026/03/Group-1450.svg' ); ?>"
      alt=""
      aria-hidden="true"
    />
  </section>

  <section class="home-stats figma-node-686-117" data-node-id="686:117" aria-label="<?php esc_attr_e( 'Company statistics', 'flipnewmedia' ); ?>">
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
    <div class="container-ext home-solutions-grid">
      <div class="home-solutions-copy">
        <h2 class="home-solutions-title" data-node-id="77:1048">ΚΑΙΝΟΤΟΜΕΣ<br>ΛΥΣΕΙΣ ΓΙΑ ΣΥΓΧΡΟΝΑ<br>ΕΡΓΑΣΤΗΡΙΑ</h2>
        <span class="home-solutions-divider" data-node-id="77:1055" aria-hidden="true"></span>
        <p class="home-solutions-description" data-node-id="77:1056">Προσφέρουμε ολοκληρωμένες λύσεις και προηγμένο εξοπλισμό που καλύπτουν τις ανάγκες των σύγχρονων εργαστηρίων. Από μικροσκόπηση και χημικά αναλώσιμα έως διαγνωστικά συστήματα και επιστημονικά όργανα υψηλής ακρίβειας.</p>
      </div>

      <div class="home-solutions-cards">
        <?php foreach ( $solutions_cards as $card ) : ?>
          <article class="home-solutions-card<?php echo ! empty( $card['active'] ) ? ' is-active' : ''; ?>" data-node-id="<?php echo esc_attr( $card['node'] ); ?>">
            <h3 class="home-solutions-card-title"><?php echo nl2br( esc_html( $card['title'] ) ); ?></h3>
            <?php if ( ! empty( $card['description'] ) ) : ?>
              <p class="home-solutions-card-description" data-node-id="<?php echo esc_attr( $card['desc_node'] ); ?>"><?php echo esc_html( $card['description'] ); ?></p>
            <?php endif; ?>
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

      $hero.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        speed: 650,
        fade: false,
        arrows: true,
        dots: true,
        adaptiveHeight: false,
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

      moveDotsToCurrentSlide();
      $hero.on('afterChange', moveDotsToCurrentSlide);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initHeroSliderInline);
    } else {
      initHeroSliderInline();
    }
  })();
</script>

<?php
get_footer();
