 
<?php

get_header(); ?>

<?php
// Breadcrumbs (Yoast)
if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
  <section class="cs-breadcrumbs" role="navigation" aria-label="Breadcrumb">
    <div class="cs-breadcrumbs__inner">
      <?php yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); ?>
    </div>
  </section>
<?php endif; ?>

<?php $herodesc = get_field('hero-desc');
$herotitledesk = get_field('hero-title-desk');
$herotitlemob = get_field('hero-title-mob');
  ?>


 <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title desk">  <?php echo wp_kses_post($herotitledesk); ?></h1>
	  <h1 class="hero-title mob">  <?php echo wp_kses_post($herotitlemob); ?></h1>

</div>
    <div class="hero-col hero-1-right">
     <div class="hero-description">
  <?php echo wp_kses_post($herodesc); ?>
    </div>
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>
    
  </div>

</section>


<!-- <section class="img-solutions-sections">
<div class="img-sol-inner"> <img class="sol-img-desk" src="https://wallypass.com/wp-content/uploads/2025/10/Rectangle-74-1.jpg"> <img class="sol-img-mob" src="https://wallypass.com/wp-content/uploads/2025/11/Mask-group.jpg"> </div>
<a class="mouse-tele"><img src="https://wallypass.com/wp-content/uploads/2025/10/Group-1450.png"></a>

</section> -->
<?php
// Get ACF fields
$img   = function_exists('get_field') ? (get_field('benefits_image') ?: '') : '';
$head  = function_exists('get_field') ? (get_field('benefits_heading') ?: '') : '';
$tabs  = function_exists('have_rows') && have_rows('benefits_tabs');
$uid   = 'benefits-'.wp_generate_uuid4();
?>

<section id="<?php echo esc_attr($uid); ?>" class="bnf">
  <div class="bnf__wrap">
    <div class="bnf__media">
      <?php if ($img): ?>
        <img src="<?php echo esc_url(is_array($img)?($img['url']??''):$img); ?>"
             alt="<?php echo esc_attr(is_array($img)?($img['alt']??''):''); ?>">
      <?php endif; ?>
    </div>

    <div class="bnf__content">
      <?php if ($head): ?>
        <div class="bnf__heading"><?php echo wp_kses_post($head); ?></div>
      <?php endif; ?>
<div class="tabs-wrapper" >
      <?php if ($tabs): ?>
        <div class="bnf__tabs" role="tablist" aria-label="Benefits tabs">
          <?php
          $i = 0;
          // First pass: render tab buttons
          while (have_rows('benefits_tabs')): the_row();
            $label = trim((string) get_sub_field('tab_label'));
            $tab_id = $uid.'-tab-'.$i;
            $panel_id = $uid.'-panel-'.$i;
            ?>
            <button
              id="<?php echo esc_attr($tab_id); ?>"
              class="bnf__tab<?php echo $i===0?' is-active':''; ?>"
              role="tab"
              aria-selected="<?php echo $i===0?'true':'false'; ?>"
              aria-controls="<?php echo esc_attr($panel_id); ?>"
              tabindex="<?php echo $i===0?'0':'-1'; ?>">
              <?php echo esc_html($label ?: ('Tab '.($i+1))); ?>
            </button>
          <?php $i++; endwhile; ?>
        </div>
 </div>
        <div class="bnf__panels">
          <?php
          // Second pass: render panels
          $i = 0; reset_rows(); // move pointer back to first row
          while (have_rows('benefits_tabs')): the_row();
            $title   = trim((string) get_sub_field('tab_title'));
            $text    = get_sub_field('tab_text');
            $btn_txt = trim((string) get_sub_field('tab_btn_text'));
            $btn_url = trim((string) get_sub_field('tab_btn_url'));
            $panel_id = $uid.'-panel-'.$i;
            $tab_id   = $uid.'-tab-'.$i;
            ?>
            <div
              id="<?php echo esc_attr($panel_id); ?>"
              class="bnf__panel<?php echo $i===0?' is-active':''; ?>"
              role="tabpanel"
              aria-labelledby="<?php echo esc_attr($tab_id); ?>"
              <?php echo $i===0?'':'hidden'; ?>>
              <?php if ($title): ?>
                <h3 class="bnf__panel-title"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>
              <?php if ($text): ?>
                <div class="bnf__panel-text"><?php echo wp_kses_post($text); ?></div>
              <?php endif; ?>
              <?php if ($btn_txt && $btn_url): ?>
                <a class="bnf__btn" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($btn_txt); ?></a>
              <?php endif; ?>
            </div>
          <?php $i++; endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
// Read ACF (raw values)
$cs_title_desk  = function_exists('get_field') ? (get_field('cs_title_desk') ?: '') : '';
$cs_title_mob   = function_exists('get_field') ? (get_field('cs_title_mob')  ?: '') : '';
$cs_right_title = function_exists('get_field') ? (get_field('cs_right_title') ?: '') : '';
$cs_right_text  = function_exists('get_field') ? (get_field('cs_right_text')  ?: '') : '';
$cs_phone_img   = function_exists('get_field') ? (get_field('cs_phone_img')    ?: '') : '';
$cs_ellipse_img = function_exists('get_field') ? (get_field('cs_ellipse_img')  ?: '') : '';

// Detect if custom images were provided (not fallbacks)
$has_custom_phone   = is_array($cs_phone_img)   ? !empty($cs_phone_img['url'])   : !empty($cs_phone_img);
$has_custom_ellipse = is_array($cs_ellipse_img) ? !empty($cs_ellipse_img['url']) : !empty($cs_ellipse_img);

// Detect textual content
$has_text = (trim($cs_title_desk) !== '') || (trim($cs_title_mob) !== '') || (trim($cs_right_title) !== '') || (trim($cs_right_text) !== '');

// Should we render this section?
$should_render = $has_text || $has_custom_phone || $has_custom_ellipse;

if ($should_render) :
  // Apply fallbacks only when rendering
  $phone_fallback   = 'https://wallypass.com/wp-content/uploads/2025/10/Group-1580.png';
  $ellipse_fallback = 'https://wallypass.com/wp-content/uploads/2025/10/Ellipse-3.png';

  $phone_url = $has_custom_phone
    ? (is_array($cs_phone_img) ? ($cs_phone_img['url'] ?? '') : $cs_phone_img)
    : $phone_fallback;

  $ellipse_url = $has_custom_ellipse
    ? (is_array($cs_ellipse_img) ? ($cs_ellipse_img['url'] ?? '') : $cs_ellipse_img)
    : $ellipse_fallback;
?>
<section class="cs-hero">
  <div class="cs-hero__wrap">
    <div class="cs-hero__left">
      <?php if (trim($cs_title_desk) !== ''): ?>
        <h2 class="cs-hero__title desk"><?php echo nl2br(esc_html($cs_title_desk)); ?></h2>
      <?php endif; ?>
      <?php if (trim($cs_title_mob) !== ''): ?>
        <h2 class="cs-hero__title mob"><?php echo nl2br(esc_html($cs_title_mob)); ?></h2>
      <?php endif; ?>
    </div>

    <hr class="cs-hero__rule">

    <div class="cs-hero__center" aria-hidden="true">
      <div class="cs-hero__stage">
        <?php if (!empty($ellipse_url)): ?>
          <img class="cs-hero__ellipse" src="<?php echo esc_url($ellipse_url); ?>" alt="">
        <?php endif; ?>
        <?php if (!empty($phone_url)): ?>
          <img class="cs-hero__phone" src="<?php echo esc_url($phone_url); ?>" alt="">
        <?php endif; ?>
      </div>
    </div>

    <div class="cs-hero__right">
      <?php if (trim($cs_right_title) !== ''): ?>
        <h3 class="cs-hero__brand"><?php echo esc_html($cs_right_title); ?></h3>
      <?php endif; ?>
      <?php if (trim($cs_right_text) !== ''): ?>
        <div class="cs-hero__text">
          <?php echo wp_kses_post($cs_right_text); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; // $should_render ?>

<section class="cta-banner">
  <div class="cta-banner__overlay">
    <div class="cta-banner__content">
      <h2 class="cta-banner__title">Το Wallet είναι το νέο κανάλι επικοινωνίας σας.</h2>
      <a href="https://wallypass.com/contact/" class="cta-banner__btn">Ζητήστε demo 45’</a>
    </div>
  </div>
</section>


<?php get_footer(); ?>



<script>
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.bnf').forEach(function(sec){
    const tabs = Array.from(sec.querySelectorAll('.bnf__tab'));
    const panels = Array.from(sec.querySelectorAll('.bnf__panel'));
    function activate(idx){
      tabs.forEach((t,i)=>{
        t.classList.toggle('is-active', i===idx);
        t.setAttribute('aria-selected', i===idx ? 'true' : 'false');
        t.setAttribute('tabindex', i===idx ? '0' : '-1');
      });
      panels.forEach((p,i)=>{
        const active = i===idx;
        p.classList.toggle('is-active', active);
        if(active){ p.removeAttribute('hidden'); } else { p.setAttribute('hidden',''); }
      });
    }
    tabs.forEach((t,i)=>{
      t.addEventListener('click', ()=>activate(i));
      t.addEventListener('keydown', (e)=>{
        if(e.key==='ArrowRight'||e.key==='ArrowLeft'){
          e.preventDefault();
          const dir = e.key==='ArrowRight' ? 1 : -1;
          let ni = (i + dir + tabs.length) % tabs.length;
          tabs[ni].focus();
          activate(ni);
        }
      });
    });
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded',()=> {
  document.querySelectorAll('.cs-hero__stage').forEach(s=>{
    requestAnimationFrame(()=> s.classList.add('is-in'));
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.bnf__heading').forEach(heading => {
    const h6s = heading.querySelectorAll('h6');
    if (!h6s.length) return;

    const more = document.createElement('div');
    more.className = 'bnf__more';

    h6s.forEach(h6 => more.appendChild(h6));
    heading.appendChild(more);

    const btn = document.createElement('div');
    btn.className = 'bnf__readmore';
    btn.innerHTML = `
      Διάβασε περισσότερα
      <svg class="bnf__arrow" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18.126 8.35584L9.509 16.9728" stroke="#FF3B30" stroke-width="2"/>
        <line x1="9.32414" y1="17.6799" x2="0.707166" y2="9.06291" stroke="#FF3B30" stroke-width="2"/>
      </svg>
    `;

    heading.appendChild(btn);

    btn.addEventListener('click', () => {
      const open = more.classList.toggle('is-open');
      btn.classList.toggle('is-open');
      btn.childNodes[0].textContent = open ? 'Διάβασε λιγότερα' : 'Διάβασε περισσότερα';
    });
  });
});
</script>

