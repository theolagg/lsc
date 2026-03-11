<?php
/**
 * Shared blog archive page markup.
 *
 * @package FlipNewMedia_Child
 */

$upload_dir       = wp_get_upload_dir();
$hero_image_url   = trailingslashit( $upload_dir['baseurl'] ) . '2026/03/1080365813-preview-1.png';
$posts_page_id    = (int) get_option( 'page_for_posts' );
$default_title    = $posts_page_id ? get_the_title( $posts_page_id ) : '';
$archive_title    = is_home() ? $default_title : wp_strip_all_tags( get_the_archive_title() );
$archive_title    = $archive_title ? $archive_title : __( 'Τα νέα μας', 'flipnewmedia' );
$archive_empty    = __( 'Δεν υπάρχουν ακόμη άρθρα.', 'flipnewmedia' );
$archive_aria     = __( 'Blog archive', 'flipnewmedia' );
$archive_tabs     = function_exists( 'lsc_get_blog_archive_tabs' ) ? lsc_get_blog_archive_tabs() : array();
$initial_data     = function_exists( 'lsc_get_blog_archive_posts_markup' ) ? lsc_get_blog_archive_posts_markup( 0, 11, 0 ) : array(
	'html'        => '',
	'count'       => 0,
	'has_more'    => false,
	'next_offset' => 0,
);
$archive_empty_by_category = __( 'Δεν βρέθηκαν άρθρα σε αυτή την κατηγορία.', 'flipnewmedia' );
$archive_load_more         = __( 'Περισσότερα', 'flipnewmedia' );
$archive_nonce             = wp_create_nonce( 'lsc_blog_archive_nonce' );
?>

<main id="primary" class="site-main blog-archive-page">
  <section class="blog-archive-hero figma-node-642-4916" data-node-id="642:4916" aria-label="<?php echo esc_attr( $archive_aria ); ?>">
    <div class="blog-archive-hero__media" style="background-image:url('<?php echo esc_url( $hero_image_url ); ?>');">
      <div class="blog-archive-hero__overlay figma-node-642-4918" data-node-id="642:4918" aria-hidden="true"></div>
      <div class="container-ext blog-archive-hero__inner">
        <h1 class="blog-archive-hero__title" data-node-id="642:4919"><?php echo esc_html( $archive_title ); ?></h1>
        <div class="blog-archive-hero__line" data-node-id="642:4920" aria-hidden="true"></div>
      </div>
    </div>
  </section>

  <section class="blog-archive-feed" aria-label="<?php echo esc_attr( $archive_aria ); ?>">
    <div class="container-ext">
      <div class="blog-archive-toolbar">
        <?php if ( ! empty( $archive_tabs ) ) : ?>
          <div class="blog-archive-filters" role="tablist" aria-label="<?php esc_attr_e( 'News categories', 'flipnewmedia' ); ?>">
            <?php foreach ( $archive_tabs as $index => $tab ) : ?>
              <button
                class="blog-archive-filter<?php echo 0 === $index ? ' is-active' : ''; ?>"
                type="button"
                role="tab"
                data-term-id="<?php echo esc_attr( (string) $tab['id'] ); ?>"
                data-tab="<?php echo esc_attr( $tab['slug'] ); ?>"
                aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
              >
                <?php echo esc_html( $tab['label'] ); ?>
              </button>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div
        class="blog-archive-grid js-blog-archive-grid"
        data-initial-limit="11"
        data-load-limit="8"
        data-offset="<?php echo esc_attr( (string) $initial_data['next_offset'] ); ?>"
        data-term-id="0"
      >
        <?php if ( ! empty( $initial_data['html'] ) ) : ?>
          <?php echo $initial_data['html']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php else : ?>
          <p class="home-news-empty blog-archive-empty"><?php echo esc_html( $archive_empty ); ?></p>
        <?php endif; ?>
      </div>

      <div class="blog-archive-load-more-wrap<?php echo empty( $initial_data['has_more'] ) ? ' is-hidden' : ''; ?>">
        <button
          class="blog-archive-load-more js-blog-archive-load-more"
          type="button"
          data-label-default="<?php echo esc_attr( $archive_load_more ); ?>"
          data-label-loading="<?php echo esc_attr__( 'Φόρτωση...', 'flipnewmedia' ); ?>"
        >
          <span class="blog-archive-load-more__text"><?php echo esc_html( $archive_load_more ); ?></span>
          <span class="blog-archive-load-more__icon" aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var section = document.querySelector('.blog-archive-page');
  if (!section) return;

  var grid = section.querySelector('.js-blog-archive-grid');
  var filters = section.querySelectorAll('.blog-archive-filter[data-term-id]');
  var loadMoreWrap = section.querySelector('.blog-archive-load-more-wrap');
  var loadMoreButton = section.querySelector('.js-blog-archive-load-more');
  var ajaxUrl = window.my_ajax_object && window.my_ajax_object.ajax_url ? window.my_ajax_object.ajax_url : '';
  var nonce = '<?php echo esc_js( $archive_nonce ); ?>';
  var emptyMessage = '<?php echo esc_js( $archive_empty_by_category ); ?>';
  if (!grid || !loadMoreButton || !ajaxUrl) return;

  function setButtonLoading(isLoading) {
    var label = isLoading ? loadMoreButton.getAttribute('data-label-loading') : loadMoreButton.getAttribute('data-label-default');
    loadMoreButton.disabled = isLoading;
    loadMoreButton.classList.toggle('is-loading', isLoading);
    var textNode = loadMoreButton.querySelector('.blog-archive-load-more__text');
    if (textNode) {
      textNode.textContent = label || '';
    }
  }

  function updateLoadMoreState(hasMore, nextOffset) {
    grid.setAttribute('data-offset', String(nextOffset || 0));
    if (!loadMoreWrap) return;
    loadMoreWrap.classList.toggle('is-hidden', !hasMore);
  }

  function renderEmpty() {
    grid.innerHTML = '<p class="home-news-empty blog-archive-empty">' + emptyMessage + '</p>';
    updateLoadMoreState(false, 0);
  }

  function requestPosts(options) {
    var formData = new FormData();
    formData.append('action', 'lsc_load_blog_archive_posts');
    formData.append('nonce', nonce);
    formData.append('term_id', String(options.termId || 0));
    formData.append('offset', String(options.offset || 0));
    formData.append('limit', String(options.limit || 8));

    return fetch(ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      body: formData
    }).then(function (response) {
      if (!response.ok) {
        throw new Error('Request failed');
      }
      return response.json();
    });
  }

  function activateTab(activeButton) {
    filters.forEach(function (button) {
      var isActive = button === activeButton;
      button.classList.toggle('is-active', isActive);
      button.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });
  }

  function loadTab(button) {
    var termId = parseInt(button.getAttribute('data-term-id') || '0', 10);
    var initialLimit = parseInt(grid.getAttribute('data-initial-limit') || '11', 10);
    activateTab(button);
    grid.setAttribute('data-term-id', String(termId));
    setButtonLoading(true);

    requestPosts({
      termId: termId,
      offset: 0,
      limit: initialLimit
    }).then(function (payload) {
      var data = payload && payload.success ? payload.data : null;
      if (!data || !data.html) {
        renderEmpty();
        return;
      }
      grid.innerHTML = data.html;
      updateLoadMoreState(!!data.has_more, data.next_offset || 0);
    }).catch(function () {
      renderEmpty();
    }).finally(function () {
      setButtonLoading(false);
    });
  }

  filters.forEach(function (button) {
    button.addEventListener('click', function () {
      if (button.classList.contains('is-active')) return;
      loadTab(button);
    });
  });

  loadMoreButton.addEventListener('click', function () {
    var termId = parseInt(grid.getAttribute('data-term-id') || '0', 10);
    var offset = parseInt(grid.getAttribute('data-offset') || '0', 10);
    var limit = parseInt(grid.getAttribute('data-load-limit') || '8', 10);
    setButtonLoading(true);

    requestPosts({
      termId: termId,
      offset: offset,
      limit: limit
    }).then(function (payload) {
      var data = payload && payload.success ? payload.data : null;
      if (!data || !data.html) {
        updateLoadMoreState(false, offset);
        return;
      }
      grid.insertAdjacentHTML('beforeend', data.html);
      updateLoadMoreState(!!data.has_more, data.next_offset || offset);
    }).catch(function () {
      updateLoadMoreState(false, offset);
    }).finally(function () {
      setButtonLoading(false);
    });
  });
});
</script>
