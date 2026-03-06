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

<header id="masthead" class="site-header">
  <div class="container-ext">
    <div class="row items-center">
      <div class="col logo-col">

        <div class="site-branding">
          <a class="logo-link" href="https://wallypass.com">
            <!-- YOUR SVG LOGO (unchanged) -->
            <svg width="297" height="51" viewBox="0 0 297 51" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_601_1594)">
                <path d="M41.8004 13.8483L55.6131 27.5935L69.4259 13.8483L55.5097 0" fill="#750035"/>
                <path d="M27.7635 27.6279L13.9162 13.8483L0 27.6794L18.2618 45.852C20.8829 48.4603 24.3146 49.7645 27.7635 49.7645C31.2123 49.7645 34.644 48.4603 37.2651 45.852L41.7142 41.4246L27.9014 27.6794" fill="#750035"/>
                <path d="M83.4111 0L55.6476 27.6279L55.6131 27.5935L41.6969 41.4418L46.146 45.8691C48.7671 48.4775 52.1987 49.7816 55.6476 49.7816C59.0965 49.7816 62.5281 48.4775 65.1493 45.8691L97.3101 13.8483L83.4111 0Z" fill="#FF0000"/>
                <path d="M41.8156 13.8406L27.9027 27.6856L41.7181 41.4335L55.631 27.5885L41.8156 13.8406Z" fill="#F3796F"/>
                <path d="M105.432 13.8311H111.45L117.003 35.2642L123.056 13.8311H127.953L134.058 35.2642L139.611 13.8311H145.629L137.489 42.7288H130.971L125.487 23.6639L120.055 42.7288H113.537L105.398 13.8311H105.432Z" fill="#750035"/>
                <path d="M167.322 22.0851V42.7288H161.976V40.2921C160.476 42.1454 158.234 43.3123 155.217 43.3123C149.698 43.3123 145.129 38.5589 145.129 32.4156C145.129 26.2722 149.698 21.5189 155.217 21.5189C158.252 21.5189 160.493 22.6686 161.976 24.539V22.1023H167.322V22.0851ZM161.976 32.4156C161.976 28.9492 159.528 26.5983 156.217 26.5983C152.906 26.5983 150.492 28.9492 150.492 32.4156C150.492 35.8819 152.94 38.2329 156.217 38.2329C159.493 38.2329 161.976 35.8819 161.976 32.4156Z" fill="#750035"/>
                <path d="M172.185 12.5956H177.531V42.7288H172.185V12.5956Z" fill="#750035"/>
                <path d="M182.428 12.5956H187.774V42.7288H182.428V12.5956Z" fill="#750035"/>
                <path d="M211.916 22.0851L204.363 42.7288C202.208 48.6662 198.673 51.2746 193.413 50.9829V46.0236C196.362 46.0579 197.845 44.8224 198.845 42.0596L190.344 22.0851H196.189L201.587 35.9506L206.191 22.0851H211.916Z" fill="#750035"/>
                <path d="M235.438 23.5266C235.438 28.9321 231.126 33.2221 225.522 33.2221H220.418V42.7117H214.693V13.8311H225.522C231.126 13.8311 235.438 18.1212 235.438 23.5266ZM229.764 23.5266C229.764 21.0041 227.988 19.1508 225.539 19.1508H220.435V27.9024H225.539C227.988 27.9024 229.764 25.9977 229.764 23.5266Z" fill="#750035"/>
                <path d="M258.666 22.0851V42.7288H253.32V40.2921C251.82 42.1454 249.578 43.3123 246.56 43.3123C241.042 43.3123 236.472 38.5589 236.472 32.4156C236.472 26.2722 241.042 21.5189 246.56 21.5189C249.595 21.5189 251.837 22.6686 253.32 24.539V22.1023H258.666V22.0851ZM253.32 32.4156C253.32 28.9492 250.871 26.5983 247.56 26.5983C244.249 26.5983 241.835 28.9492 241.835 32.4156C241.835 35.8819 244.284 38.2329 247.56 38.2329C250.837 38.2329 253.32 35.8819 253.32 32.4156Z" fill="#750035"/>
                <path d="M278.997 36.7056C278.997 41.1673 275.1 43.3123 270.651 43.3123C266.495 43.3123 263.425 41.5791 261.942 38.4045L266.581 35.7961C267.167 37.495 268.564 38.4731 270.651 38.4731C272.358 38.4731 273.513 37.8897 273.513 36.7056C273.513 33.6854 262.804 35.35 262.804 28.0741C262.804 23.8698 266.409 21.5017 270.685 21.5017C274.048 21.5017 276.945 23.029 278.566 25.8776L273.996 28.3486C273.375 27.0273 272.22 26.2379 270.685 26.2379C269.357 26.2379 268.271 26.8214 268.271 27.9368C268.271 30.9913 278.98 29.0865 278.98 36.6885L278.997 36.7056Z" fill="#750035"/>
                <path d="M297 36.7056C297 41.1673 293.103 43.3123 288.654 43.3123C284.498 43.3123 281.428 41.5791 279.945 38.4045L284.584 35.7961C285.17 37.495 286.567 38.4731 288.654 38.4731C290.361 38.4731 291.516 37.8897 291.516 36.7056C291.516 33.6854 280.808 35.35 280.808 28.0741C280.808 23.8698 284.412 21.5017 288.688 21.5017C292.051 21.5017 294.948 23.029 296.569 25.8776L291.999 28.3486C291.378 27.0273 290.223 26.2379 288.688 26.2379C287.36 26.2379 286.274 26.8214 286.274 27.9368C286.274 30.9913 296.983 29.0865 296.983 36.6885L297 36.7056Z" fill="#750035"/>
              </g>
              <defs>
                <clipPath id="clip0_601_1594">
                  <rect width="297" height="51" fill="white"/>
                </clipPath>
              </defs>
            </svg>
          </a>
        </div>

        <!-- Mobile toggle (shows at <= 991px) -->
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Open menu">
          <span class="sr-only">Menu</span>
          <svg width="33" height="14" viewBox="0 0 33 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="33" height="12.5779" transform="translate(0 1)" fill="white"/>
            <line y1="0.5" x2="33" y2="0.5" stroke="#750035"/>
            <line y1="13.0779" x2="33" y2="13.0779" stroke="#750035"/>
            <line y1="6.78894" x2="33" y2="6.78894" stroke="#750035"/>
          </svg>
        </button>

        <!-- Nav wrapper (DESKTOP + MOBILE inside, without changing header) -->
        <nav id="primary-menu" class="primary-nav" role="navigation" aria-hidden="true">
          <button class="menu-close" aria-label="Close menu">
            <svg width="33" height="25" viewBox="0 0 33 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="33" height="12.5779" transform="translate(0 7)" fill="white"/>
              <line x1="4.64645" y1="24.0686" x2="27.981" y2="0.734042" stroke="#750035"/>
              <line x1="5.35355" y1="1.06857" x2="28.6881" y2="24.4031" stroke="#750035"/>
            </svg>
          </button>

          <!-- DESKTOP MENU (unchanged: uses theme_location=primary) -->
          <div class="nav-desktop">
            <?php
              wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'offcanvas-menu',
                'container'      => false,
                'depth'          => 2,
              ]);
            ?>
          </div>

          <!-- MOBILE OFFCANVAS (2 columns: new locations) -->
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

      </div>
    </div>
  </div>
</header>

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
  if(!btn || !nav || !closeBtn) return;

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

  document.addEventListener('click', function(e){
    if(!document.body.classList.contains('nav-open')) return;
    if(nav.contains(e.target) || btn.contains(e.target)) return;
    closeNav();
  });

  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && document.body.classList.contains('nav-open')) closeNav();
  });
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
