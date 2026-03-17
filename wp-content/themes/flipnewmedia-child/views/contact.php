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
$google_maps_api_key = function_exists( 'lsc_get_google_maps_api_key' ) ? lsc_get_google_maps_api_key() : '';
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
      <div class="container-ext position-relative">
      <div class=" contact-locations__overlay">
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
 </div>
      <div class="contact-locations__map-shell">
        <?php if ( $google_maps_api_key ) : ?>
        <div
          class="contact-locations__map"
          title="<?php esc_attr_e( 'Company map', 'flipnewmedia' ); ?>"
          data-location-map
          data-map-mode="google-js"
        ></div>
        <?php else : ?>
        <iframe
          class="contact-locations__map"
          title="<?php esc_attr_e( 'Company map', 'flipnewmedia' ); ?>"
          src=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          data-location-map
          data-map-mode="iframe"
        ></iframe>
        <?php endif; ?>
        <div class="contact-locations__marker" aria-hidden="true">
          <svg width="46" height="56" viewBox="0 0 46 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.69465 6.69477C15.621 -2.23159 30.0935 -2.23159 39.0198 6.69477C47.9461 15.6211 47.9462 30.0936 39.0198 39.02L22.8577 55.1821L6.69465 39.02C-2.23163 30.0937 -2.23147 15.6212 6.69465 6.69477ZM22.8001 10.3403C15.9374 10.3404 10.3745 15.9033 10.3743 22.7661C10.3743 29.6289 15.9373 35.1927 22.8001 35.1928C29.663 35.1928 35.2269 29.629 35.2269 22.7661C35.2267 15.9033 29.663 10.3403 22.8001 10.3403Z" fill="#2A417C"/>
          </svg>
        </div>
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
  var overlay = section.querySelector('.contact-locations__overlay');
  var tabsWrap = section.querySelector('.contact-locations__tabs');
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
  var isGoogleJsMap = map && map.getAttribute('data-map-mode') === 'google-js';
  var googleMap = null;
  var googleMarker = null;
  var googleGeocoder = null;

  function positionCard(activeTab) {
    if (!card || !activeTab || !overlay || !tabsWrap) {
      return;
    }

    card.style.left = activeTab.offsetLeft + 'px';
    card.style.width = activeTab.offsetWidth + 'px';
  }

  function getLocation(slug) {
    return locations.find(function (item) {
      return item.slug === slug;
    });
  }

  function buildMapUrl(addressValue) {
    return 'https://www.google.com/maps?q=' + encodeURIComponent(addressValue) + '&z=' + zoomLevel + '&output=embed';
  }

  function ensureGoogleMap() {
    if (!isGoogleJsMap || !window.google || !window.google.maps || googleMap) {
      return;
    }

    googleMap = new window.google.maps.Map(map, {
      zoom: zoomLevel,
      center: { lat: 37.9838, lng: 23.7275 },
      disableDefaultUI: true,
      zoomControl: false,
      mapTypeControl: false,
      streetViewControl: false,
      fullscreenControl: false,
      styles: [
        { elementType: 'geometry', stylers: [{ color: '#ececec' }] },
        { elementType: 'labels.text.fill', stylers: [{ color: '#445a93' }] },
        { elementType: 'labels.text.stroke', stylers: [{ color: '#f5f5f5' }] },
        { featureType: 'poi', stylers: [{ visibility: 'off' }] },
        { featureType: 'transit', stylers: [{ visibility: 'off' }] },
        { featureType: 'road', elementType: 'geometry', stylers: [{ color: '#d9d9d9' }] },
        { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#dce4f2' }] }
      ]
    });

    googleGeocoder = new window.google.maps.Geocoder();
    googleMarker = new window.google.maps.Marker({
      map: googleMap,
      icon: {
        path: 'M6.69465 6.69477C15.621 -2.23159 30.0935 -2.23159 39.0198 6.69477C47.9461 15.6211 47.9462 30.0936 39.0198 39.02L22.8577 55.1821L6.69465 39.02C-2.23163 30.0937 -2.23147 15.6212 6.69465 6.69477ZM22.8001 10.3403C15.9374 10.3404 10.3745 15.9033 10.3743 22.7661C10.3743 29.6289 15.9373 35.1927 22.8001 35.1928C29.663 35.1928 35.2269 29.629 35.2269 22.7661C35.2267 15.9033 29.663 10.3403 22.8001 10.3403Z',
        fillColor: '#2A417C',
        fillOpacity: 1,
        strokeWeight: 0,
        scale: 1,
        anchor: new window.google.maps.Point(23, 56)
      }
    });
  }

  function renderGoogleLocation(activeLocation) {
    ensureGoogleMap();

    if (!googleMap || !googleGeocoder || !activeLocation) {
      return;
    }

    googleMap.setZoom(zoomLevel);
    googleGeocoder.geocode({ address: activeLocation.address }, function (results, status) {
      if (status !== 'OK' || !results || !results.length) {
        return;
      }

      var location = results[0].geometry.location;
      googleMap.setCenter(location);

      if (googleMarker) {
        googleMarker.setPosition(location);
      }
    });
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

    if (isGoogleJsMap) {
      renderGoogleLocation(activeLocation);
    } else {
      map.src = buildMapUrl(activeLocation.address);
    }

    tabs.forEach(function (tab) {
      var isActive = tab.getAttribute('data-location') === activeLocation.slug;
      tab.classList.toggle('is-active', isActive);
      tab.setAttribute('aria-selected', isActive ? 'true' : 'false');

      if (isActive) {
        positionCard(tab);
      }
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

      if (isGoogleJsMap) {
        renderGoogleLocation(activeLocation);
      } else {
        map.src = buildMapUrl(activeLocation.address);
      }
    });
  });

  renderLocation(card.getAttribute('data-current-location'));

  window.addEventListener('resize', function () {
    var activeTab = section.querySelector('[data-location-trigger].is-active');

    if (activeTab) {
      positionCard(activeTab);
    }
  });
});
</script>

<?php if ( $google_maps_api_key ) : ?>
<script async defer src="<?php echo esc_url( 'https://maps.googleapis.com/maps/api/js?key=' . rawurlencode( $google_maps_api_key ) ); ?>"></script>
<?php endif; ?>

<?php
get_footer();
