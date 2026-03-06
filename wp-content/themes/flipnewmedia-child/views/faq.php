 
<?php

/*Template name:Faqs*/

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

<?php $herodesc = get_field('hero-desc');  ?>


 <section class="hero-two-rows">
  <!-- Row 1 -->
  <div class="hero-row hero-row-1">
    <div class="hero-col hero-1-left">
      <h1 class="hero-title">FAQ’s</h1>
<div class="hero-description">
  <?php echo wp_kses_post($herodesc); ?>
    </div>
</div>
    <div class="hero-col hero-1-right">
     
    </div>
	
	
	 <div class="hero-col hero-1-right-mob">
      
    </div>

    <!-- Absolute text element relative to Row 1 -->
    
  </div>

</section>


<?php
if (!function_exists('have_rows')) {
  echo '<p style="color:#c00">ACF is required for this template.</p>';
  the_content();
  return;
}

// Collect FAQ items and subjects
$faqs = [];
$subjects = []; // slug => label
if (have_rows('faqs')) :
  while (have_rows('faqs')) : the_row();
    $q = trim((string) get_sub_field('question'));
    $a = (string) get_sub_field('answer');
    $s_label = trim((string) get_sub_field('subject'));
    if ($q === '' && $a === '') continue;
    if ($s_label === '') $s_label = 'General';
    $s_slug  = sanitize_title($s_label);

    $faqs[] = [
      'q' => $q,
      'a' => $a,
      's_label' => $s_label,
      's_slug'  => $s_slug,
    ];
    if (!isset($subjects[$s_slug])) $subjects[$s_slug] = $s_label;
  endwhile;
endif;

$initial_per_subject = 7;
$section_id = 'faqsec-' . wp_generate_uuid4();
?>

<section id="<?php echo esc_attr($section_id); ?>" class="faqsec">
  <div class="faqsec__head">
    

    <?php if ($subjects): ?>
      <div class="faqsec__filter">
        <label for="<?php echo esc_attr($section_id); ?>-sel">FAQ Subject:</label>
        <select id="<?php echo esc_attr($section_id); ?>-sel" class="faqsec__select">
          <option value="all">All</option>
          <?php foreach ($subjects as $slug => $label): ?>
            <option value="<?php echo esc_attr($slug); ?>"><?php echo esc_html($label); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>
  </div>

  <div class="faqsec__list" data-per="<?php echo (int)$initial_per_subject; ?>">
    <?php
    // render all items; JS handles subject filter + limiting
    $i = 0;
    foreach ($faqs as $item):
      $is_open   = ($i === 0) ? ' is-open' : '';
      $aria      = ($i === 0) ? 'true' : 'false';
      $ans_attr  = ($i === 0) ? ' data-start-open="1"' : '';
    ?>
      <div class="faqsec__item<?php echo esc_attr($is_open); ?>" data-subject="<?php echo esc_attr($item['s_slug']); ?>">
        <button class="faqsec__q" aria-expanded="<?php echo esc_attr($aria); ?>">
          <span class="faqsec__q-text"><?php echo esc_html($item['q']); ?></span>
          <span aria-hidden="true" class="faqsec__chev"></span>
        </button>
        <div class="faqsec__a"<?php echo $ans_attr; ?>>
          <?php echo wp_kses_post(wpautop($item['a'])); ?>
          <div class="faqsec__tags"><span class="faqsec__tag"><?php echo esc_html($item['s_label']); ?></span></div>
        </div>
      </div>
    <?php $i++; endforeach; ?>
  </div>

  <?php if (!empty($faqs)): ?>
    <div class="faqsec__actions">
      <button type="button" class="faqsec__more">View More</button>
    </div>
  <?php endif; ?>
</section>

<style>

</style>

<script>
(function(sectionId){
  function expand(panel){
    panel.style.display = '';           // ensure visible for measurement
    const start = panel.offsetHeight;   // current height
    panel.style.height = start + 'px';
    panel.style.transition = 'height .28s ease';
    const end = panel.scrollHeight;     // target height
    requestAnimationFrame(()=>{
      panel.style.height = end + 'px';
    });
    function onEnd(e){
      if(e.propertyName !== 'height') return;
      panel.style.transition = '';
      panel.style.height = 'auto';      // keep natural height after animation
      panel.removeEventListener('transitionend', onEnd);
    }
    panel.addEventListener('transitionend', onEnd);
  }

  function collapse(panel){
    const start = panel.offsetHeight;   // current auto height
    panel.style.height = start + 'px';  // set fixed height first
    panel.style.transition = 'height .28s ease';
    requestAnimationFrame(()=>{
      panel.style.height = '0px';
    });
    function onEnd(e){
      if(e.propertyName !== 'height') return;
      panel.style.transition = '';
      // keep display default; height=0 makes it visually collapsed
      panel.removeEventListener('transitionend', onEnd);
    }
    panel.addEventListener('transitionend', onEnd);
  }

  function init(){
    const wrap = document.getElementById(sectionId);
    if(!wrap) return;

    const list = wrap.querySelector('.faqsec__list');
    const per  = parseInt(list?.dataset.per || '7', 10);
    const select = wrap.querySelector('.faqsec__select');
    const actionsWrap = wrap.querySelector('.faqsec__actions') || wrap;

    let currentFilter = 'all';
    const allItems = Array.from(list.querySelectorAll('.faqsec__item'));

    function closeAll(){
      allItems.forEach(i=>{
        i.classList.remove('is-open');
        const a = i.querySelector('.faqsec__a');
        if(a) collapse(a);
        const b = i.querySelector('.faqsec__q');
        if(b) b.setAttribute('aria-expanded','false');
      });
    }

    function applyFilter(){
      const filtered = allItems.filter(i => currentFilter === 'all' || i.getAttribute('data-subject') === currentFilter);

      // hide everything first (no animation here)
      allItems.forEach(i => i.style.display = 'none');

      // show up to `per`
      filtered.forEach((i, idx) => {
        if (idx < per) i.style.display = '';
      });

      // open first visible (animated)
      closeAll();
      if (filtered[0]) {
        const first = filtered[0];
        first.style.display = '';
        first.classList.add('is-open');
        const a = first.querySelector('.faqsec__a');
        const b = first.querySelector('.faqsec__q');
        if(a){
          // ensure we start from 0 if not marked start-open
          if (!a.hasAttribute('data-start-open')) {
            a.style.height = '0px';
          }
          expand(a);
          a.removeAttribute('data-start-open');
        }
        if(b) b.setAttribute('aria-expanded','true');
      }

      // View More
      const existing = actionsWrap.querySelector('.faqsec__more');
      if (existing) existing.remove();

      if (filtered.length > per) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'faqsec__more';
        btn.textContent = 'View More';
        btn.addEventListener('click', function(){
          filtered.forEach(i => { i.style.display = ''; });
          const again = actionsWrap.querySelector('.faqsec__more');
          if (again) again.remove();
        });
        actionsWrap.appendChild(btn);
      }
    }

    // initial setup: set all panels to 0 height, except those marked data-start-open
    allItems.forEach(i=>{
      const a = i.querySelector('.faqsec__a');
      if(!a) return;
      if (a.hasAttribute('data-start-open')) {
        // open first one immediately without a jump
        a.style.height = a.scrollHeight + 'px';
        // allow the layout to settle, then set to auto
        requestAnimationFrame(()=>{ a.style.height = 'auto'; });
      } else {
        a.style.height = '0px';
      }
    });

    applyFilter();

    // accordion toggle
    list.addEventListener('click', (e)=>{
      const btn = e.target.closest('.faqsec__q');
      if(!btn) return;
      const item = btn.closest('.faqsec__item');
      const ans  = item.querySelector('.faqsec__a');
      const open = item.classList.contains('is-open');

      // close others
      allItems.forEach(i=>{
        if(i !== item){
          i.classList.remove('is-open');
          const a = i.querySelector('.faqsec__a');
          if(a) collapse(a);
          const b = i.querySelector('.faqsec__q');
          if(b) b.setAttribute('aria-expanded','false');
        }
      });

      // toggle clicked
      item.classList.toggle('is-open', !open);
      btn.setAttribute('aria-expanded', String(!open));
      if(!open){ expand(ans); } else { collapse(ans); }
    });

    // subject filter
    if(select){
      select.addEventListener('change', function(){
        currentFilter = this.value || 'all';
        applyFilter();
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})('<?php echo esc_js($section_id); ?>');
</script>




<?php get_footer(); ?>

