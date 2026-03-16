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
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
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
          <a class="header-search-link" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'flipnewmedia' ); ?>">
            <img
              src="<?php echo esc_url( trailingslashit( wp_get_upload_dir()['baseurl'] ) . '2026/03/Vector.svg' ); ?>"
              alt="<?php esc_attr_e( 'Search', 'flipnewmedia' ); ?>"
              width="18"
              height="18"
            />
          </a>
        </div>

        <div class="nav-mobile">
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
  <span class="hero-contact-icon">+</span>
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
    if (isMobile() && !document.body.classList.contains('nav-open')) {
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
(function () {
  const TOGGLER_ZONE_WIDTH = 44;
  const ROOT = document;

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
