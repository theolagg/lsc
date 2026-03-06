 
<?php

/*Template name:Telecomunications*/

get_header(); ?>


<?php $herodesc = get_field('hero-desc');  ?>


 <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title">Telecommunications</h1>
<div class="hero-description">
  <?php echo wp_kses_post($herodesc); ?>
    </div>
</div>
    <div class="hero-col hero-1-right">
     
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>
    
  </div>

</section>


<section class="img-solutions-sections">
<div> <img src="https://wallypass.com/wp-content/uploads/2025/10/Rectangle-74-1.jpg"> </div>
<a class="mouse-tele"><img src="https://wallypass.com/wp-content/uploads/2025/10/Group-1450.png"></a>

</section>

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
// Read ACF
$cs_title       = function_exists('get_field') ? (get_field('cs_title') ?: '') : '';
$cs_right_title = function_exists('get_field') ? (get_field('cs_right_title') ?: '') : '';
$cs_right_text  = function_exists('get_field') ? (get_field('cs_right_text') ?: '') : '';
$cs_phone_img   = function_exists('get_field') ? (get_field('cs_phone_img') ?: '') : '';
$cs_ellipse_img = function_exists('get_field') ? (get_field('cs_ellipse_img') ?: '') : '';

// Fallbacks to your provided assets
$phone_fallback   = 'https://wallypass.com/wp-content/uploads/2025/10/Group-1580.png';
$ellipse_fallback = 'https://wallypass.com/wp-content/uploads/2025/10/Ellipse-3.png';

$phone_url   = $cs_phone_img   ? (is_array($cs_phone_img)   ? ($cs_phone_img['url'] ?? '')   : $cs_phone_img)   : $phone_fallback;
$ellipse_url = $cs_ellipse_img ? (is_array($cs_ellipse_img) ? ($cs_ellipse_img['url'] ?? '') : $cs_ellipse_img) : $ellipse_fallback;
?>

<section class="cs-hero">
  <div class="cs-hero__wrap">
    <!-- Left: big red title + hairline -->
    <div class="cs-hero__left">
      <?php if ($cs_title): ?>
        <h2 class="cs-hero__title"><?php echo nl2br(esc_html($cs_title)); ?></h2>
      <?php endif; ?>
    </div>
<hr class="cs-hero__rule">
    <!-- Center: phone with ellipse glow -->
    <div class="cs-hero__center" aria-hidden="true">
      <div class="cs-hero__stage">
        <img class="cs-hero__ellipse" src="<?php echo esc_url($ellipse_url); ?>" alt="">
        <img class="cs-hero__phone" src="<?php echo esc_url($phone_url); ?>" alt="">
      </div>
    </div>

    <!-- Right: small heading + paragraph -->
    <div class="cs-hero__right">
      <?php if ($cs_right_title): ?>
        <h3 class="cs-hero__brand"><?php echo esc_html($cs_right_title); ?></h3>
      <?php endif; ?>
      <?php if ($cs_right_text): ?>
        <div class="cs-hero__text">
          <?php echo wp_kses_post($cs_right_text); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="cta-banner">
  <div class="cta-banner__overlay">
    <div class="cta-banner__content">
      <h2 class="cta-banner__title">Lorem ipsum dolor sit</h2>
      <a href="#" class="cta-banner__btn">Ζητήστε demo 45’</a>
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