<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package FlipNewMedia
 */

get_header();

$upload_dir         = wp_get_upload_dir();
$contact_hero_video = trailingslashit( $upload_dir['baseurl'] ) . '2026/03/3940140663-preview.mp4';
$contact_title      = 'Επικοινωνία';
$contact_copy       = 'Η ομάδα της LSC είναι πάντα δίπλα σας για να προσφέρει καθοδήγηση, υποστήριξη και λύσεις που ανταποκρίνονται στις ανάγκες σας.';
$contact_locations  = array(
	array(
		'slug'    => 'thessaloniki',
		'label'   => 'Θεσσαλονίκη',
		'address' => 'Βιομηχανική Περιοχή Σίνδου, Θεσσαλονίκη',
		'phone'   => '2310 000000',
		'fax'     => '2310 000001',
		'email'   => 'info@lsc.gr',
	),
	array(
		'slug'    => 'athens',
		'label'   => 'Αθήνα',
		'address' => 'Κ. Παλαμά 36, 143 43, Ν. Χαλκηδόνα, Αθήνα',
		'phone'   => '210 2582489',
		'fax'     => '210 2532090',
		'email'   => 'info@lsc.gr',
	),
);

$default_location = end( $contact_locations );
reset( $contact_locations );
?>

<main id="primary" class="site-main contact-template">
  <section class="contact-hero figma-node-709-42" data-node-id="709:42" aria-label="<?php esc_attr_e( 'Contact introduction', 'flipnewmedia' ); ?>">
    <div class="contact-hero__media lsc-video-hero__media">
      <video class="lsc-video-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
        <source src="<?php echo esc_url( $contact_hero_video ); ?>" type="video/mp4">
      </video>
      <div class="contact-hero__overlay" aria-hidden="true"></div>
      <div class="container-ext contact-hero__inner">
        <div class="contact-hero__header">
          <h1 class="contact-hero__title" data-node-id="642:4839"><?php echo esc_html( $contact_title ); ?></h1>
        </div>
        <div class="contact-hero__line" data-node-id="642:4840" aria-hidden="true"></div>
        <div class="contact-hero__copy-wrap">
          <p class="contact-hero__copy" data-node-id="642:4838"><?php echo esc_html( $contact_copy ); ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-locations figma-node-709-43" data-node-id="709:43" aria-label="<?php esc_attr_e( 'Company locations', 'flipnewmedia' ); ?>">
    <div class="contact-locations__panel">
      <div class="container-ext contact-locations__overlay">
        <div class="contact-locations__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Office locations', 'flipnewmedia' ); ?>">
          <?php foreach ( $contact_locations as $location ) : ?>
            <button
              type="button"
              class="contact-locations__tab<?php echo $location['slug'] === $default_location['slug'] ? ' is-active' : ''; ?>"
              role="tab"
              aria-selected="<?php echo $location['slug'] === $default_location['slug'] ? 'true' : 'false'; ?>"
              data-location-trigger
              data-location="<?php echo esc_attr( $location['slug'] ); ?>"
            >
              <span class="contact-locations__tab-label"><?php echo esc_html( $location['label'] ); ?></span>
            </button>
          <?php endforeach; ?>
        </div>

        <div class="contact-locations__card" data-location-card data-current-location="<?php echo esc_attr( $default_location['slug'] ); ?>">
          <h2 class="contact-locations__city" data-location-city><?php echo esc_html( $default_location['label'] ); ?></h2>
          <p class="contact-locations__address" data-location-address><?php echo esc_html( $default_location['address'] ); ?></p>
          <div class="contact-locations__meta">
            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $default_location['phone'] ) ); ?>" class="contact-locations__meta-item">
              <span class="contact-locations__meta-label">T</span>
              <span data-location-phone><?php echo esc_html( $default_location['phone'] ); ?></span>
            </a>
            <span class="contact-locations__meta-item">
              <span class="contact-locations__meta-label">F</span>
              <span data-location-fax><?php echo esc_html( $default_location['fax'] ); ?></span>
            </span>
            <a href="mailto:<?php echo esc_attr( antispambot( $default_location['email'] ) ); ?>" class="contact-locations__meta-item">
              <span class="contact-locations__meta-label">E</span>
              <span data-location-email><?php echo esc_html( $default_location['email'] ); ?></span>
            </a>
          </div>
        </div>
      </div>

      <div class="contact-locations__map-shell">
        <iframe
          class="contact-locations__map"
          title="<?php esc_attr_e( 'Company map', 'flipnewmedia' ); ?>"
          src=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          data-location-map
        ></iframe>
        <div class="contact-locations__fade" aria-hidden="true"></div>
        <div class="contact-locations__zoom" aria-label="<?php esc_attr_e( 'Map zoom controls', 'flipnewmedia' ); ?>">
          <button type="button" class="contact-locations__zoom-button" data-zoom-action="in" aria-label="<?php esc_attr_e( 'Zoom in', 'flipnewmedia' ); ?>">+</button>
          <button type="button" class="contact-locations__zoom-button" data-zoom-action="out" aria-label="<?php esc_attr_e( 'Zoom out', 'flipnewmedia' ); ?>">-</button>
        </div>
      </div>
    </div>
  </section>

  <?php while ( have_posts() ) : the_post(); ?>
    <section class="contact-template__content">
      <div class="container-ext">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var section = document.querySelector('.contact-locations');

  if (!section) {
    return;
  }

  var locations = <?php echo wp_json_encode( $contact_locations ); ?>;
  var tabs = section.querySelectorAll('[data-location-trigger]');
  var city = section.querySelector('[data-location-city]');
  var address = section.querySelector('[data-location-address]');
  var phone = section.querySelector('[data-location-phone]');
  var fax = section.querySelector('[data-location-fax]');
  var email = section.querySelector('[data-location-email]');
  var map = section.querySelector('[data-location-map]');
  var card = section.querySelector('[data-location-card]');
  var zoomButtons = section.querySelectorAll('[data-zoom-action]');
  var zoomLevel = 14;

  function getLocation(slug) {
    return locations.find(function (item) {
      return item.slug === slug;
    });
  }

  function buildMapUrl(addressValue) {
    return 'https://www.google.com/maps?q=' + encodeURIComponent(addressValue) + '&z=' + zoomLevel + '&output=embed';
  }

  function renderLocation(slug) {
    var activeLocation = getLocation(slug);

    if (!activeLocation) {
      return;
    }

    card.setAttribute('data-current-location', activeLocation.slug);
    city.textContent = activeLocation.label;
    address.textContent = activeLocation.address;
    phone.textContent = activeLocation.phone;
    fax.textContent = activeLocation.fax;
    email.textContent = activeLocation.email;

    var phoneLink = phone.closest('a');
    var emailLink = email.closest('a');

    if (phoneLink) {
      phoneLink.href = 'tel:' + activeLocation.phone.replace(/\s+/g, '');
    }

    if (emailLink) {
      emailLink.href = 'mailto:' + activeLocation.email;
    }

    map.src = buildMapUrl(activeLocation.address);

    tabs.forEach(function (tab) {
      var isActive = tab.getAttribute('data-location') === activeLocation.slug;
      tab.classList.toggle('is-active', isActive);
      tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });
  }

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      zoomLevel = 14;
      renderLocation(tab.getAttribute('data-location'));
    });
  });

  zoomButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var direction = button.getAttribute('data-zoom-action');
      var activeLocation = getLocation(card.getAttribute('data-current-location'));

      if (!activeLocation) {
        return;
      }

      zoomLevel = direction === 'in' ? Math.min(18, zoomLevel + 1) : Math.max(10, zoomLevel - 1);
      map.src = buildMapUrl(activeLocation.address);
    });
  });

  renderLocation(card.getAttribute('data-current-location'));
});
</script>

<?php
get_footer();
