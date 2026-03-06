<?php
/*
Template Name: Pricing
*/
get_header();
?>

<?php 

$herotitle    = get_field('hero-title');  
$herodescription = get_field('hero-description');    

?>

<?php
// Breadcrumbs (Yoast)
if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
  <section class="cs-breadcrumbs" role="navigation" aria-label="Breadcrumb">
    <div class="cs-breadcrumbs__inner">
      <?php yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); ?>
    </div>
  </section>
<?php endif; ?>

<section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title"><?php echo wp_kses_post($herotitle); ?></h1>
<div class="hero-description">
<?php echo wp_kses_post($herodescription); ?>
    </div>
</div>
    <div class="hero-col hero-1-right">
      <img src="https://wallypass.com/wp-content/uploads/2025/09/home-banner-image.png" alt="Digital passes preview" loading="eager" />
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      <img src="https://wallypass.com/wp-content/uploads/2025/10/home-banner-image.png" alt="Digital passes preview" loading="eager" />
    </div>

    
    
  </div>

</section>

<?php
/**
 * Pricing / Plans – 4 cards
 * Driven by ACF repeater `pp_plans`
 */

$heading  = get_field('pp_heading');
$subtext  = get_field('pp_subtext');

if (have_rows('pp_plans')): ?>
<section class="pp">
  <div class="pp__inner">

    <?php
$themeLabels = [
  'starter'  => 'Starter',
  'basic'    => 'Basic', // note: your "basic" theme maps to "Business" option
  'advanced' => 'Advanced',
  'premium'  => 'Premium',
];
?>

    <div class="pp__grid">
      <?php while (have_rows('pp_plans')): the_row();
        $name     = get_sub_field('plan_name');
        $volLbl   = get_sub_field('plan_volume_label');
        $range    = get_sub_field('plan_range');
		$subrange    = get_sub_field('sub_range');
        $unitLbl  = get_sub_field('plan_unit_label');
        $price    = get_sub_field('plan_price');
        $btnText  = get_sub_field('plan_button_text');
        $btnUrl   = get_sub_field('plan_button_url');
        $theme    = get_sub_field('plan_theme'); // starter|basic|advanced|premium
        $theme    = $theme ?: 'starter';
		$planLabel = $themeLabels[$theme] ?? ucfirst($theme);
      ?>
	  
	  
	  
 <article class="pp-card pp-card--<?php echo esc_attr($theme); ?>">
  <!-- FRONT -->
  <div class="pp-card__face pp-card__front">
    <?php if ($name): ?><h3 class="pp-card__name"><?php echo esc_html($name); ?></h3><?php endif; ?>

    <?php if ($volLbl): ?>
      <div class="pp-card__vol"><?php echo esc_html($volLbl); ?></div>
    <?php endif; ?>
<div class="pp-sep pp-sep-back"></div>
<div class="range-wrapper">
    <?php if ($range): ?>
     <div class="pp-card__range"><?php echo esc_html($range); ?></div>
    <?php endif; ?>
	 <?php if ($subrange): ?>
      <div class="pp-card__subrange"><?php echo esc_html($subrange); ?></div>
    <?php endif; ?>
</div>
    <?php if ($unitLbl || $price): ?>
      <div class="pp-sep pp-sep-back"></div>
      <div class="pp-card__unit"><?php echo esc_html($unitLbl); ?></div>
      <?php if ($price): ?><div class="pp-card__price"><?php echo esc_html($price); ?></div><?php endif; ?>
    <?php endif; ?>

    <?php if ($btnText): ?>
      <a class="pp-card__btn"
         href="#pricing"
         data-plan="<?php echo esc_attr($planLabel); ?>">
        <?php echo esc_html($btnText); ?>
      </a>
    <?php endif; ?>
  </div>

  <!-- BACK -->
  <div class="pp-card__face pp-card__back">
    <?php
      $backTitle  = get_sub_field('plan_back_title') ?: 'Το UI περιλαμβάνει';
      $hasBullets = have_rows('plan_bullets');
    ?>
    <h4 class="pp-card__back-title"><?php echo esc_html($backTitle); ?></h4>

    <div class="pp-card__back-scroll">
      <?php if ($hasBullets): ?>
        <ul class="pp-card__bullets">
          <?php while (have_rows('plan_bullets')): the_row();
            $bullet = get_sub_field('bullet_text');
            if (!$bullet) continue; ?>
            <li><?php echo esc_html($bullet); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <p class="pp-card__no-bullets">Προς το παρόν δεν έχουν καταχωρηθεί στοιχεία.</p>
      <?php endif; ?>
    </div>
	 <?php if ($btnText): ?>
      <a class="pp-card__btn"
         href="#pricing"
         data-plan="<?php echo esc_attr($planLabel); ?>">
        <?php echo esc_html($btnText); ?>
      </a>
    <?php endif; ?>
	
	
  </div>
</article>

      <?php endwhile; ?>
    </div>
	
	<?php if ($heading || $subtext): ?>
      <header class="pp__head">
        <?php if ($heading): ?><h2 class="pp__title"><?php echo esc_html($heading); ?></h2><?php endif; ?>
        <?php if ($subtext): ?><p class="pp__sub"><?php echo wp_kses_post($subtext); ?></p><?php endif; ?>
      </header>
    <?php endif; ?>
	
	
  </div>
</section>
<?php endif; ?>

<section id="pricing" class="contact-section">
  <div class="contact-inner">
    <?php echo do_shortcode('[contact-form-7 id="f88a71f" title="Pricing"]'); ?>
  </div>
</section>


<?php get_footer(); ?>



<script>
document.addEventListener('DOMContentLoaded', function () {
  const select = document.getElementById('cf7-plan');

  function setPlan(label) {
    if (!select || !label) return;
    const opts = Array.from(select.options);
    const match = opts.find(o =>
      o.text.trim().toLowerCase() === label.trim().toLowerCase() ||
      (o.value && o.value.trim().toLowerCase() === label.trim().toLowerCase())
    );
    if (match) {
      select.value = match.value;
      select.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }

  // Handle clicks from pricing cards
  document.querySelectorAll('.pp-card__btn[data-plan]').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      setPlan(this.dataset.plan);
      document.getElementById('pricing')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      history.replaceState(null, '', '#pricing');
    });
  });

  // Support direct links e.g. ?plan=Basic#pricing
  const qsPlan = new URLSearchParams(window.location.search).get('plan');
  if (qsPlan) {
    setPlan(qsPlan);
    if (location.hash !== '#pricing') {
      document.getElementById('pricing')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }
  if (location.hash.includes('plan=')) {
    const hashQuery = location.hash.split('?')[1] || '';
    const hp = new URLSearchParams(hashQuery);
    const hashPlan = hp.get('plan');
    if (hashPlan) setPlan(hashPlan);
  }
});
</script>

<script defer>
document.addEventListener('DOMContentLoaded', () => {
  const cards = Array.from(document.querySelectorAll('.pp-card'));
  if (!cards.length) return;

  const mqDesktop = window.matchMedia('(min-width: 992px)');

  // --- State maps ---
  const isAnimating    = new WeakMap();
  const lockUntil      = new WeakMap();
  const pendingUnflip  = new WeakMap();

  // Hover intent + pointer tracking
  const intentTimer    = new WeakMap();
  const lastMoveAt     = new WeakMap();
  const lastPointerPos = new WeakMap(); // { x, y }

  // Config
  const INTENT_DELAY_MS = 0; 
  const STILL_MS        = 30; 

  // Utils
  const now = () => performance.now();
  const isHovered = el => el.matches(':hover');

  // Read --flip-ms (fallback to 600ms if not set)
  function getFlipMs(card) {
    const v = getComputedStyle(card).getPropertyValue('--flip-ms').trim();
    if (!v) return 600;
    if (v.endsWith('ms')) return parseFloat(v);
    if (v.endsWith('s'))  return parseFloat(v) * 1000;
    const n = parseFloat(v);
    return isNaN(n) ? 600 : n;
  }

  // Is (x,y) currently over an interactive element inside this card?
  function interactiveAt(card, x, y) {
    const el = document.elementFromPoint(x, y);
    if (!el) return false;
    const interactive = el.closest('.pp-card__btn, a, button, input, textarea, select, [data-no-flip]');
    return !!(interactive && card.contains(interactive));
  }

  // --- Animation lock helpers ---
  function beginAnimation(card) {
    const ms = Math.max(1, getFlipMs(card));
    isAnimating.set(card, true);
    lockUntil.set(card, now() + ms);
    setTimeout(() => finishAnimation(card), ms);
  }

  function finishAnimation(card) {
    isAnimating.set(card, false);
    const shouldUnflip = pendingUnflip.get(card) && !isHovered(card);
    pendingUnflip.delete(card);
    if (mqDesktop.matches && shouldUnflip) {
      card.classList.remove('is-flipped');
    }
  }

  // --- Mobile click/tap (and keyboard) ---
  function isInteractive(el, card) {
    const m = el.closest('a, button, input, textarea, select, .pp-card__btn, [data-no-flip]');
    return !!(m && m !== card);
  }

  function onActivate(e) {
    const card = e.currentTarget;
    if (mqDesktop.matches) return;                 // mobile-only
    if (isAnimating.get(card)) return;             // ignore during lock
    if (now() < (lockUntil.get(card) || 0)) return;

    if (isInteractive(e.target, card)) return;
    const turnOn = !card.classList.contains('is-flipped');
    card.classList.toggle('is-flipped', turnOn);
    beginAnimation(card);
  }

  function onKey(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      onActivate({ currentTarget: e.currentTarget, target: e.currentTarget });
    }
  }

  // --- Desktop hover intent ---
  function clearIntent(card) {
    const t = intentTimer.get(card);
    if (t) clearTimeout(t);
    intentTimer.delete(card);
  }

  function scheduleIntent(card) {
    clearIntent(card);
    // do not reset lastMoveAt here; it's updated by mousemove
    const t = setTimeout(function intentTick() {
      if (!mqDesktop.matches) return;
      if (isAnimating.get(card) || now() < (lockUntil.get(card) || 0)) return;

      // Get the latest pointer position we tracked
      const pos = lastPointerPos.get(card);
      if (!pos) {
        // No coordinates yet—try again shortly
        intentTimer.set(card, setTimeout(intentTick, 50));
        return;
      }

      // If pointer is over interactive, keep waiting until it leaves
      if (interactiveAt(card, pos.x, pos.y)) {
        intentTimer.set(card, setTimeout(intentTick, 80));
        return;
      }

      // If mouse hasn't been still long enough, check again
      if (performance.now() - (lastMoveAt.get(card) || 0) < STILL_MS) {
        intentTimer.set(card, setTimeout(intentTick, 80));
        return;
      }

      // Flip!
      if (!card.classList.contains('is-flipped')) {
        card.classList.add('is-flipped');
        beginAnimation(card);
      }
    }, INTENT_DELAY_MS);

    intentTimer.set(card, t);
  }

  function onIntentEnter(e) {
    const card = e.currentTarget;
    if (!mqDesktop.matches) return;
    if (isAnimating.get(card) || now() < (lockUntil.get(card) || 0)) return;

    // seed pointer position + movement timestamp on enter
    lastPointerPos.set(card, { x: e.clientX, y: e.clientY });
    lastMoveAt.set(card, performance.now());

    // If currently over interactive on enter, we still schedule intent,
    // but the timer loop will keep deferring until the pointer leaves the button.
    scheduleIntent(card);
  }

  function onIntentLeave(e) {
    const card = e.currentTarget;
    if (!mqDesktop.matches) return;
    clearIntent(card);
  }

  // Immediate unflip logic on leave (respects lock)
  function onLeave(e) {
    const card = e.currentTarget;
    if (!mqDesktop.matches) return;

    if (isAnimating.get(card) || now() < (lockUntil.get(card) || 0)) {
      pendingUnflip.set(card, true);
      return;
    }
    card.classList.remove('is-flipped');
  }

  // --- Wiring per breakpoint ---
  function enableMobile(card) {
    card.addEventListener('pointerup', onActivate, { passive: true });
    card.addEventListener('keydown', onKey);
    card.setAttribute('role', 'button');
    card.setAttribute('tabindex', '0');
    card.style.touchAction = 'manipulation';
  }

  function disableMobile(card) {
    card.removeEventListener('pointerup', onActivate);
    card.removeEventListener('keydown', onKey);
    card.removeAttribute('role');
    card.removeAttribute('tabindex');
    card.style.touchAction = '';
    card.classList.remove('is-flipped'); // start clean on desktop
  }

  function enableDesktop(card) {
    // Track movement: update last position and stillness clock
    const move = (ev) => {
      lastPointerPos.set(card, { x: ev.clientX, y: ev.clientY });
      lastMoveAt.set(card, performance.now());
    };
    card.addEventListener('mousemove', move, { passive: true });
    card.__ppMoveHandler = move;

    // Named leave handler so we can remove later
    const onDesktopLeave = (e) => {
      onIntentLeave(e);
      onLeave(e);
    };
    card.__ppDesktopLeave = onDesktopLeave;

    card.addEventListener('mouseenter', onIntentEnter);
    card.addEventListener('mouseleave', onDesktopLeave);

    // ensure clean start
    card.classList.remove('is-flipped');
  }

  function disableDesktop(card) {
    if (card.__ppMoveHandler) {
      card.removeEventListener('mousemove', card.__ppMoveHandler);
      delete card.__ppMoveHandler;
    }
    if (card.__ppDesktopLeave) {
      card.removeEventListener('mouseleave', card.__ppDesktopLeave);
      delete card.__ppDesktopLeave;
    }
    card.removeEventListener('mouseenter', onIntentEnter);
    clearIntent(card);
  }

  function applyMode() {
    if (mqDesktop.matches) {
      cards.forEach(card => { disableMobile(card); enableDesktop(card); });
    } else {
      cards.forEach(card => { disableDesktop(card); enableMobile(card); });
    }
  }

  applyMode();
  if (mqDesktop.addEventListener) mqDesktop.addEventListener('change', applyMode);
  else if (mqDesktop.addListener) mqDesktop.addListener(applyMode);
});
</script>

<script>
jQuery(function($) {

  function initPricingSlider() {
    const $grid = $('.pp__grid');

    if (!$.fn.slick || !$grid.length) return;

    // Mobile: <= 640px → slider
    if (window.innerWidth <= 640) {
      if (!$grid.hasClass('slick-initialized')) {
        $grid.slick({
          mobileFirst: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
          infinite: false,       // no clones -> safer with your flip logic
          adaptiveHeight: true
        });
      }
    } 
    // Desktop: > 640px → normal grid
    else {
      if ($grid.hasClass('slick-initialized')) {
        $grid.slick('unslick');
      }
    }
  }

  // On load
  initPricingSlider();

  // On resize/orientation change
  $(window).on('resize', function() {
    initPricingSlider();
  });

});
</script>

