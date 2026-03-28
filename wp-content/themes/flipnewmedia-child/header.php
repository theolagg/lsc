<?php
/**
 * The header for our theme
 *
 * @package FlipNewMedia
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.typekit.net/rwx6wlu.css">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
<?php $upload_dir = wp_get_upload_dir(); ?>

<header id="masthead" class="site-header">
  <div class="container-ext header-container">
    <div class="header-shell">
      <div class="site-branding">
        <?php if ( has_custom_logo() ) : ?>
          <div class="logo-link"><?php the_custom_logo(); ?></div>
        <?php else : ?>
          <a class="logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img
              src="<?php echo esc_url( trailingslashit( $upload_dir['baseurl'] ) . '2026/03/logo-2.svg' ); ?>"
              alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
              width="297"
              height="51"
            />
          </a>
        <?php endif; ?>
      </div>

      <div class="header-mobile-actions">
        <a class="mobile-search-link" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'flipnewmedia' ); ?>">
          <img
            src="<?php echo esc_url( trailingslashit( $upload_dir['baseurl'] ) . '2026/03/Vector.svg' ); ?>"
            alt="<?php esc_attr_e( 'Search', 'flipnewmedia' ); ?>"
            width="18"
            height="18"
          />
        </a>
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Open menu">
          <span class="sr-only">Menu</span>
          <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="33" height="12.5779" transform="translate(0 1)" fill="white"/>
            <line y1="0.5" x2="33" y2="0.5" stroke="#1D356B"/>
            <line y1="13.0779" x2="33" y2="13.0779" stroke="#1D356B"/>
            <line y1="6.78894" x2="33" y2="6.78894" stroke="#1D356B"/>
          </svg>
        </button>
      </div>

      <nav id="primary-menu" class="primary-nav" role="navigation" aria-hidden="false">
        <button class="menu-close" aria-label="Close menu">
          <svg width="33" height="25" viewBox="0 0 33 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="33" height="12.5779" transform="translate(0 7)" fill="white"/>
            <line x1="4.64645" y1="24.0686" x2="27.981" y2="0.734042" stroke="#1D356B"/>
            <line x1="5.35355" y1="1.06857" x2="28.6881" y2="24.4031" stroke="#1D356B"/>
          </svg>
        </button>

        <div class="nav-desktop">
          <?php
            wp_nav_menu([
              'theme_location' => 'primary',
              'menu_class'     => 'offcanvas-menu header-main-menu',
              'container'      => false,
              'depth'          => 2,
            ]);
          ?>
        </div>

        <div class="header-tools">
          <?php
            wp_nav_menu([
              'theme_location' => 'header_utility',
              'menu_class'     => 'header-utility-menu',
              'container'      => false,
              'depth'          => 1,
              'fallback_cb'    => false,
            ]);
          ?>
          <div class="header-search" data-header-search>
            <button class="header-search-link" type="button" aria-label="<?php esc_attr_e( 'Search', 'flipnewmedia' ); ?>" aria-expanded="false" aria-controls="desktop-header-search-form">
              <img
                src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/Vector.svg' ); ?>"
                alt="<?php esc_attr_e( 'Search', 'flipnewmedia' ); ?>"
                width="18"
                height="18"
              />
            </button>
            <form id="desktop-header-search-form" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
              <label class="sr-only" for="desktop-header-search-input"><?php esc_html_e( 'Search', 'flipnewmedia' ); ?></label>
              <input id="desktop-header-search-input" class="header-search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'Αναζήτηση', 'flipnewmedia' ); ?>" autocomplete="off" />
            </form>
          </div>
        </div>

        <div class="nav-mobile">
          <?php $has_mobile_offcanvas_menus = has_nav_menu( 'offcanvas_left' ) || has_nav_menu( 'offcanvas_right' ); ?>

          <?php if ( $has_mobile_offcanvas_menus ) : ?>
            <div class="offcanvas-grid">
              <div class="offcanvas-col offcanvas-col-left">
                <?php
                  wp_nav_menu([
                    'theme_location' => 'offcanvas_left',
                    'menu_class'     => 'offcanvas-menu offcanvas-menu-left',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                  ]);
                ?>
              </div>

              <div class="offcanvas-col offcanvas-col-right">
                <?php
                  wp_nav_menu([
                    'theme_location' => 'offcanvas_right',
                    'menu_class'     => 'offcanvas-menu offcanvas-menu-right',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                  ]);
                ?>
              </div>
            </div>
          <?php else : ?>
            <div class="mobile-menu-fallback">
              <?php
                wp_nav_menu([
                  'theme_location' => 'primary',
                  'menu_class'     => 'offcanvas-menu mobile-main-menu',
                  'container'      => false,
                  'depth'          => 2,
                  'fallback_cb'    => false,
                ]);
              ?>

              <?php
                wp_nav_menu([
                  'theme_location' => 'header_utility',
                  'menu_class'     => 'offcanvas-menu mobile-utility-menu',
                  'container'      => false,
                  'depth'          => 1,
                  'fallback_cb'    => false,
                ]);
              ?>
            </div>
          <?php endif; ?>

          <div class="offcanvas-social">
            <a class="social-btn" href="https://www.facebook.com/digitalwallypass" aria-label="Facebook"><svg width="13" height="20" viewBox="0 0 13 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.917 0.710999V4.09088H9.00391C8.04633 4.09111 7.27051 4.86764 7.27051 5.82526V8.02643C7.27067 8.30863 7.49904 8.53703 7.78125 8.53717H11.4248L11.3086 9.34967L11.0283 11.3057L10.9414 11.9171H7.78125C7.49895 11.9172 7.27051 12.1464 7.27051 12.4288V19.0089H3.89062V12.4288C3.89062 12.1463 3.66133 11.9171 3.37891 11.9171H0.710938V8.53717H3.37891C3.66123 8.53717 3.89047 8.30872 3.89062 8.02643V5.82526C3.89062 3.00124 6.17994 0.711227 9.00391 0.710999H11.917Z" stroke="white" stroke-width="1.42292"/>
</svg>
</a>
            <a class="social-btn" href="https://www.instagram.com/wallypass_com/" aria-label="Instagram"><svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.25009 4.36766C10.1261 4.36766 11.6471 5.88866 11.6471 7.76471C11.6471 9.64077 10.1261 11.1618 8.25009 11.1618C6.37403 11.1618 4.85303 9.64077 4.85303 7.76471C4.85303 5.88866 6.37403 4.36766 8.25009 4.36766Z" fill="white"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 0C6.40888 0 5.12559 0.00141144 4.13047 0.0915871C3.15535 0.179998 2.60098 0.344294 2.18382 0.585176C1.51985 0.96847 0.968489 1.51994 0.585159 2.18382C0.344312 2.601 0.179964 3.15529 0.0915877 4.13047C0.00139362 5.12559 0 6.40888 0 8.25C0 10.0911 0.00139362 11.3744 0.0915877 12.3695C0.179964 13.3447 0.344312 13.899 0.585159 14.3162C0.968489 14.9801 1.51985 15.5315 2.18382 15.9148C2.60098 16.1557 3.15535 16.32 4.13047 16.4084C5.12559 16.4986 6.40888 16.5 8.25 16.5C10.0911 16.5 11.3744 16.4986 12.3695 16.4084C13.3447 16.32 13.899 16.1557 14.3162 15.9148C14.9801 15.5315 15.5315 14.9801 15.9148 14.3162C16.1557 13.899 16.32 13.3447 16.4084 12.3695C16.4986 11.3744 16.5 10.0911 16.5 8.25C16.5 6.40888 16.4986 5.12559 16.4084 4.13047C16.32 3.15529 16.1557 2.601 15.9148 2.18382C15.5315 1.51994 14.9801 0.96847 14.3162 0.585176C13.899 0.344294 13.3447 0.179998 12.3695 0.0915871C11.3744 0.00141144 10.0911 0 8.25 0ZM14.0735 13.5882C14.0735 12.7842 13.4216 12.1324 12.6176 12.1324C11.8136 12.1324 11.1618 12.7842 11.1618 13.5882C11.1618 14.3923 11.8136 15.0441 12.6176 15.0441C13.4216 15.0441 14.0735 14.3923 14.0735 13.5882ZM8.25 2.91176C10.9302 2.91176 13.1029 5.08447 13.1029 7.76471C13.1029 10.4449 10.9302 12.6176 8.25 12.6176C5.56977 12.6176 3.39706 10.4449 3.39706 7.76471C3.39706 5.08447 5.56977 2.91176 8.25 2.91176Z" fill="white"/>
</svg>
</a>
          </div>
        </div>

      </nav>
      <button class="nav-backdrop" aria-label="<?php esc_attr_e( 'Close menu', 'flipnewmedia' ); ?>" tabindex="-1"></button>
    </div>
  </div>
</header>

<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
  <div class="site-breadcrumbs">
    <div class="container-ext">
      <?php yoast_breadcrumb( '<nav class="site-breadcrumbs__trail" aria-label="' . esc_attr__( 'Breadcrumb', 'flipnewmedia' ) . '">', '</nav>' ); ?>
    </div>
  </div>
<?php endif; ?>

<a class="global-contact-chip" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
  <span class="hero-contact-icon" aria-hidden="true">
    <svg width="88" height="80" viewBox="0 0 88 80" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <rect width="87.0423" height="80" transform="matrix(-1 0 0 1 87.0422 0)" fill="url(#hero-contact-pattern)"/>
      <defs>
        <pattern id="hero-contact-pattern" patternContentUnits="objectBoundingBox" width="1" height="1">
          <use xlink:href="#hero-contact-image" transform="matrix(0.00195312 0 0 0.00212505 0 -0.0440141)"/>
        </pattern>
        <image id="hero-contact-image" width="512" height="512" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
      </defs>
    </svg>
  </span>
  <span><?php esc_html_e( 'Επικοινωνήστε μαζί μας', 'flipnewmedia' ); ?></span>
</a>

<script>
  (function() {
    var header = document.getElementById('masthead');
    if (!header) return;

    function onScroll() {
      if (window.scrollY > 10) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
    }

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  })();
</script>

<script>
(function(){
  var btn = document.querySelector('.menu-toggle');
  var nav = document.getElementById('primary-menu');
  var closeBtn = document.querySelector('.menu-close');
  var backdrop = document.querySelector('.nav-backdrop');
  if(!btn || !nav || !closeBtn) return;

  function isMobile(){
    return window.matchMedia('(max-width: 991px)').matches;
  }

  function syncNavState(){
    if (!isMobile()) {
      document.body.classList.remove('nav-open');
      nav.setAttribute('aria-hidden', 'false');
      btn.setAttribute('aria-expanded', 'false');
      return;
    }

    if (!document.body.classList.contains('nav-open')) {
      nav.setAttribute('aria-hidden', 'true');
      btn.setAttribute('aria-expanded', 'false');
      return;
    }
    nav.setAttribute('aria-hidden', 'false');
  }

  function openNav(){
    document.body.classList.add('nav-open');
    btn.setAttribute('aria-expanded', 'true');
    nav.setAttribute('aria-hidden', 'false');
    closeBtn.focus({ preventScroll: true });
  }
  function closeNav(){
    document.body.classList.remove('nav-open');
    btn.setAttribute('aria-expanded', 'false');
    nav.setAttribute('aria-hidden', 'true');
    btn.focus({ preventScroll: true });
  }
  function toggleNav(){
    if(document.body.classList.contains('nav-open')) closeNav(); else openNav();
  }

  btn.addEventListener('click', toggleNav);
  closeBtn.addEventListener('click', closeNav);
  if (backdrop) backdrop.addEventListener('click', closeNav);
  window.addEventListener('resize', syncNavState);

  document.addEventListener('click', function(e){
    if(!document.body.classList.contains('nav-open')) return;
    if(nav.contains(e.target) || btn.contains(e.target)) return;
    closeNav();
  });

  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && document.body.classList.contains('nav-open')) closeNav();
  });

  syncNavState();
})();
</script>

<script>
(function(){
  var searchWrap = document.querySelector('[data-header-search]');
  var backdrop = document.querySelector('.nav-backdrop');
  if (!searchWrap) return;

  var button = searchWrap.querySelector('.header-search-link');
  var input = searchWrap.querySelector('.header-search-input');
  if (!button || !input) return;

  function isDesktop(){
    return window.matchMedia('(min-width: 992px)').matches;
  }

  function openSearch(){
    if (!isDesktop()) return;
    searchWrap.classList.add('is-open');
    document.body.classList.add('search-open');
    button.setAttribute('aria-expanded', 'true');
    window.setTimeout(function(){
      input.focus({ preventScroll: true });
    }, 140);
  }

  function closeSearch(){
    searchWrap.classList.remove('is-open');
    document.body.classList.remove('search-open');
    button.setAttribute('aria-expanded', 'false');
  }

  button.addEventListener('click', function(){
    if (searchWrap.classList.contains('is-open')) closeSearch(); else openSearch();
  });

  document.addEventListener('click', function(e){
    if (!isDesktop() || !searchWrap.classList.contains('is-open')) return;
    if (searchWrap.contains(e.target)) return;
    closeSearch();
  });

  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape' && searchWrap.classList.contains('is-open')) {
      closeSearch();
      button.focus({ preventScroll: true });
    }
  });

  if (backdrop) {
    backdrop.addEventListener('click', function(){
      if (document.body.classList.contains('search-open')) closeSearch();
    });
  }

  window.addEventListener('resize', function(){
    if (!isDesktop()) closeSearch();
  });
})();
</script>


<script>
(function () {
  const TOGGLER_ZONE_WIDTH = 44;
  const ROOT = document;
  const MOBILE_BREAKPOINT = '(max-width: 991px)';

  function setupOffcanvasAccordion() {
	   if (window.matchMedia('(max-width: 991px)').matches) return;
    // μόνο στο desktop container
    const desktopWrap = ROOT.querySelector('.nav-desktop');
    if (!desktopWrap) return;

    desktopWrap.querySelectorAll('.offcanvas-menu > li.menu-item-has-children').forEach(li => {
      const link = li.querySelector(':scope > a');
      const submenu = li.querySelector(':scope > .sub-menu');
      if (!link || !submenu) return;

      if (!submenu.id) submenu.id = 'sub-' + Math.random().toString(36).slice(2, 9);
      link.setAttribute('aria-controls', submenu.id);
      link.setAttribute('aria-expanded', 'false');

      link.addEventListener('click', function (e) {
        const rect = link.getBoundingClientRect();
        const clickX = e.clientX;
        const clickedRight = (rect.right - clickX) <= TOGGLER_ZONE_WIDTH;

        if (clickedRight) {
          e.preventDefault();
          const isOpen = li.classList.toggle('is-open');
          link.setAttribute('aria-expanded', String(isOpen));
          closeSiblings(li);
        } else {
          if (!li.classList.contains('is-open')) {
            e.preventDefault();
            li.classList.add('is-open');
            link.setAttribute('aria-expanded', 'true');
            closeSiblings(li);
          }
        }
      }, { passive: false });
    });
  }

  function closeSiblings(li) {
    const parent = li.parentElement;
    parent.querySelectorAll(':scope > li.is-open').forEach(el => {
      if (el !== li) {
        el.classList.remove('is-open');
        const a = el.querySelector(':scope > a[aria-expanded]');
        if (a) a.setAttribute('aria-expanded', 'false');
      }
    });
  }

  if (document.readyState !== 'loading') setupOffcanvasAccordion();
  else document.addEventListener('DOMContentLoaded', setupOffcanvasAccordion);
})();
</script>
