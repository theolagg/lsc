<?php
/**
 * Shared blog archive page markup.
 *
 * @package FlipNewMedia_Child
 */

$posts_page_id    = (int) get_option( 'page_for_posts' );
$default_title    = $posts_page_id ? get_the_title( $posts_page_id ) : '';
$archive_title    = is_home() ? $default_title : wp_strip_all_tags( get_the_archive_title() );
$archive_title    = $archive_title ? $archive_title : __( 'Τα νέα μας', 'flipnewmedia' );
$archive_empty    = __( 'Δεν υπάρχουν ακόμη άρθρα.', 'flipnewmedia' );
$archive_aria     = __( 'Blog archive', 'flipnewmedia' );
$archive_tabs     = function_exists( 'lsc_get_blog_archive_tabs' ) ? lsc_get_blog_archive_tabs() : array();
$archive_initial_payloads = array();

if ( function_exists( 'lsc_get_blog_archive_posts_markup' ) && ! empty( $archive_tabs ) ) {
	foreach ( $archive_tabs as $tab ) {
		$term_id = isset( $tab['id'] ) ? (int) $tab['id'] : 0;
		$archive_initial_payloads[ (string) $term_id ] = lsc_get_blog_archive_posts_markup( $term_id, 11, 0 );
	}
}

$initial_data     = isset( $archive_initial_payloads['0'] ) ? $archive_initial_payloads['0'] : array(
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
  <?php
  echo lsc_render_video_hero(
    array(
      'title'         => $archive_title,
      'copy'          => '',
      'aria_label'    => $archive_aria,
      'section_class' => 'blog-archive-hero figma-node-642-4916',
      'inner_class'   => 'blog-archive-hero__inner',
    )
  );
  ?>

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
  var tabCache = <?php echo wp_json_encode( $archive_initial_payloads ); ?> || {};
  var activeRequestId = 0;
  if (!grid || !loadMoreButton || !ajaxUrl) return;

  function drawWrappedText(ctx, text, x, y, maxWidth, lineHeight, maxLines) {
    if (!text) return y;

    var words = String(text).trim().split(/\s+/);
    var line = '';
    var lines = [];

    words.forEach(function (word) {
      var testLine = line ? line + ' ' + word : word;
      if (ctx.measureText(testLine).width > maxWidth && line) {
        lines.push(line);
        line = word;
      } else {
        line = testLine;
      }
    });

    if (line) {
      lines.push(line);
    }

    if (typeof maxLines === 'number' && lines.length > maxLines) {
      lines = lines.slice(0, maxLines);
      var last = lines[lines.length - 1] || '';
      while (ctx.measureText(last + '...').width > maxWidth && last.length > 0) {
        last = last.slice(0, -1);
      }
      lines[lines.length - 1] = last + '...';
    }

    lines.forEach(function (entry, index) {
      ctx.fillText(entry, x, y + index * lineHeight);
    });

    return y + lines.length * lineHeight;
  }

  function createCardSnapshot(card) {
    var rect = card.getBoundingClientRect();
    var width = Math.max(1, Math.round(rect.width));
    var height = Math.max(1, Math.round(rect.height));
    var media = card.querySelector('.blog-archive-card__media');
    var mediaImg = media ? media.querySelector('img') : null;
    var copy = card.querySelector('.blog-archive-card__copy');
    var title = card.querySelector('.blog-archive-card__title');
    var excerpt = card.querySelector('.blog-archive-card__excerpt');
    var titleLink = title ? title.querySelector('a') : null;
    var mediaRect = media ? media.getBoundingClientRect() : null;
    var copyRect = copy ? copy.getBoundingClientRect() : null;
    var titleRect = title ? title.getBoundingClientRect() : null;
    var excerptRect = excerpt ? excerpt.getBoundingClientRect() : null;
    var cardStyle = window.getComputedStyle(card);
    var titleStyle = window.getComputedStyle(titleLink || title || card);
    var excerptStyle = window.getComputedStyle(excerpt || card);
    var offscreen = document.createElement('canvas');
    offscreen.width = width;
    offscreen.height = height;
    var offCtx = offscreen.getContext('2d');

    if (!offCtx) {
      return Promise.resolve(null);
    }

    offCtx.fillStyle = cardStyle.backgroundColor && cardStyle.backgroundColor !== 'rgba(0, 0, 0, 0)' ? cardStyle.backgroundColor : '#ffffff';
    offCtx.fillRect(0, 0, width, height);

    function drawTextLayers() {
      if (!copyRect) {
        return {
          canvas: offscreen,
          width: width,
          height: height
        };
      }

      var copyX = copyRect.left - rect.left;
      var titleX = titleRect ? titleRect.left - rect.left : copyX;
      var titleY = titleRect ? titleRect.top - rect.top : copyRect.top - rect.top;
      var excerptX = excerptRect ? excerptRect.left - rect.left : copyX;
      var excerptY = excerptRect ? excerptRect.top - rect.top : titleY + 52;
      var titleMaxWidth = titleRect ? titleRect.width : copyRect.width;
      var excerptMaxWidth = excerptRect ? excerptRect.width : copyRect.width;
      var titleFontSize = parseFloat(titleStyle.fontSize || '22');
      var excerptFontSize = parseFloat(excerptStyle.fontSize || '18');

      offCtx.textBaseline = 'top';
      offCtx.fillStyle = titleStyle.color || '#283e78';
      offCtx.font = (titleStyle.fontWeight || '700') + ' ' + titleFontSize + 'px ' + (titleStyle.fontFamily || 'sans-serif');
      drawWrappedText(offCtx, title ? title.textContent : '', titleX, titleY, titleMaxWidth, titleFontSize * 1.18, 3);

      if (excerpt) {
        offCtx.fillStyle = excerptStyle.color || '#283e78';
        offCtx.font = (excerptStyle.fontWeight || '400') + ' ' + excerptFontSize + 'px ' + (excerptStyle.fontFamily || 'sans-serif');
        drawWrappedText(offCtx, excerpt.textContent, excerptX, excerptY, excerptMaxWidth, excerptFontSize * 1.35, 4);
      }

      return {
        canvas: offscreen,
        width: width,
        height: height
      };
    }

    if (!mediaRect || !mediaImg || !mediaImg.complete) {
      return Promise.resolve(drawTextLayers());
    }

    var mediaX = mediaRect.left - rect.left;
    var mediaY = mediaRect.top - rect.top;
    var mediaW = mediaRect.width;
    var mediaH = mediaRect.height;
    var naturalW = mediaImg.naturalWidth || mediaW;
    var naturalH = mediaImg.naturalHeight || mediaH;
    var scale = Math.max(mediaW / naturalW, mediaH / naturalH);
    var drawW = naturalW * scale;
    var drawH = naturalH * scale;
    var drawX = mediaX + (mediaW - drawW) / 2;
    var drawY = mediaY + (mediaH - drawH) / 2;

    offCtx.save();
    offCtx.beginPath();
    offCtx.rect(mediaX, mediaY, mediaW, mediaH);
    offCtx.clip();
    offCtx.drawImage(mediaImg, drawX, drawY, drawW, drawH);
    offCtx.restore();

    return Promise.resolve(drawTextLayers());
  }

  function bindCardCursor() {
    return;
    var cards = grid.querySelectorAll('.blog-archive-card');

    cards.forEach(function (card) {
      if (card.dataset.cursorBound === 'true') return;
      card.dataset.cursorBound = 'true';

      var cursor = card.querySelector('.blog-archive-card__cursor');
      var canvas = card.querySelector('.blog-archive-card__cursor-canvas');
      if (!cursor || !canvas) return;

      var ctx = canvas && canvas.getContext ? canvas.getContext('2d') : null;
      var dpr = Math.max(1, window.devicePixelRatio || 1);
      var snapshot = null;
      var snapshotPromise = null;
      var scratchCanvas = document.createElement('canvas');
      var scratchCtx = scratchCanvas.getContext ? scratchCanvas.getContext('2d') : null;
      var outputCanvas = document.createElement('canvas');
      var outputCtx = outputCanvas.getContext ? outputCanvas.getContext('2d') : null;
      var renderScale = 0.42;
      var renderWidth = 0;
      var renderHeight = 0;
      var pendingEvent = null;
      var rafId = 0;

      function resizeCanvas() {
        if (!canvas || !ctx) return;
        var width = cursor.offsetWidth || 147;
        var height = cursor.offsetHeight || 151;
        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        renderWidth = Math.max(36, Math.round(width * renderScale));
        renderHeight = Math.max(38, Math.round(height * renderScale));
        scratchCanvas.width = renderWidth;
        scratchCanvas.height = renderHeight;
        outputCanvas.width = renderWidth;
        outputCanvas.height = renderHeight;
      }

      function clearCanvas() {
        if (!ctx || !canvas) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
      }

      function ensureSnapshot() {
        if (snapshot) return Promise.resolve(snapshot);
        if (snapshotPromise) return snapshotPromise;

        snapshotPromise = createCardSnapshot(card).then(function (result) {
          snapshot = result;
          snapshotPromise = null;
          return result;
        }).catch(function () {
          snapshotPromise = null;
          return null;
        });

        return snapshotPromise;
      }

      function drawLens(event) {
        if (!ctx || !canvas || !snapshot || !snapshot.canvas || !scratchCtx || !outputCtx) return;

        var cardRect = card.getBoundingClientRect();
        var localX = event.clientX - cardRect.left;
        var localY = event.clientY - cardRect.top;
        var lensW = cursor.offsetWidth || 147;
        var lensH = cursor.offsetHeight || 151;
        var workW = renderWidth || lensW;
        var workH = renderHeight || lensH;
        var safeX = Math.max(0, Math.min(cardRect.width, localX));
        var safeY = Math.max(0, Math.min(cardRect.height, localY));
        var ratioX = cardRect.width > 0 ? safeX / cardRect.width : 0.5;
        var ratioY = cardRect.height > 0 ? safeY / cardRect.height : 0.5;
        var naturalW = snapshot.width || cardRect.width || lensW;
        var naturalH = snapshot.height || cardRect.height || lensH;
        var sourceX = ratioX * naturalW;
        var sourceY = ratioY * naturalH;
        var centerX = workW / 2;
        var centerY = workH / 2;
        var radiusX = workW / 2;
        var radiusY = workH / 2;
        var captureW = Math.min(naturalW, lensW + 28);
        var captureH = Math.min(naturalH, lensH + 28);
        var captureX = Math.max(0, Math.min(naturalW - captureW, sourceX - captureW / 2));
        var captureY = Math.max(0, Math.min(naturalH - captureH, sourceY - captureH / 2));

        clearCanvas();
        scratchCtx.clearRect(0, 0, workW, workH);
        outputCtx.clearRect(0, 0, workW, workH);

        scratchCtx.drawImage(
          snapshot.canvas,
          captureX,
          captureY,
          captureW,
          captureH,
          0,
          0,
          workW,
          workH
        );

        var sourceFrame = scratchCtx.getImageData(0, 0, workW, workH);
        var targetFrame = outputCtx.createImageData(workW, workH);
        var src = sourceFrame.data;
        var dst = targetFrame.data;

        function sampleChannel(px, py, channelOffset) {
          var x = Math.max(0, Math.min(workW - 1, Math.round(px)));
          var y = Math.max(0, Math.min(workH - 1, Math.round(py)));
          return src[(y * workW + x) * 4 + channelOffset];
        }

        for (var py = 0; py < workH; py += 1) {
          for (var px = 0; px < workW; px += 1) {
            var dx = (px - centerX) / radiusX;
            var dy = (py - centerY) / radiusY;
            var r = Math.sqrt(dx * dx + dy * dy);
            var outIndex = (py * workW + px) * 4;

            if (r > 1) {
              dst[outIndex + 3] = 0;
              continue;
            }

            var angle = Math.atan2(dy, dx);
            var edge = Math.pow(r, 1.55);
            var vortex = Math.pow(1 - r, 1.25) * 0.18;
            var refraction = edge * 12.5;
            var twistedAngle = angle + vortex;
            var sx = centerX + Math.cos(twistedAngle) * (r * radiusX - refraction);
            var sy = centerY + Math.sin(twistedAngle) * (r * radiusY - refraction * 0.92);
            var disperse = Math.max(0, r - 0.18) * 9.5;
            var blurOffset = Math.max(0, r - 0.08) * 2.2;

            var red = (
              sampleChannel(sx - disperse - blurOffset, sy - blurOffset * 0.35, 0) +
              sampleChannel(sx - disperse * 0.4, sy, 0)
            ) / 2;
            var green = (
              sampleChannel(sx, sy, 1) +
              sampleChannel(sx + blurOffset * 0.2, sy + blurOffset * 0.2, 1)
            ) / 2;
            var blue = (
              sampleChannel(sx + disperse + blurOffset, sy + blurOffset * 0.35, 2) +
              sampleChannel(sx + disperse * 0.4, sy, 2)
            ) / 2;

            // Saturation boost.
            var avg = (red + green + blue) / 3;
            var sat = 1.28 + edge * 0.72;
            red = avg + (red - avg) * sat;
            green = avg + (green - avg) * sat;
            blue = avg + (blue - avg) * sat;

            dst[outIndex] = Math.max(0, Math.min(255, red));
            dst[outIndex + 1] = Math.max(0, Math.min(255, green));
            dst[outIndex + 2] = Math.max(0, Math.min(255, blue));
            dst[outIndex + 3] = 255;
          }
        }

        outputCtx.putImageData(targetFrame, 0, 0);

        ctx.save();
        ctx.beginPath();
        ctx.ellipse(lensW / 2, lensH / 2, lensW / 2, lensH / 2, 0, 0, Math.PI * 2);
        ctx.clip();
        ctx.filter = 'blur(1.8px)';
        ctx.drawImage(outputCanvas, 0, 0, workW, workH, 0, 0, lensW, lensH);
        ctx.filter = 'none';

        // Glass layers.
        var ringGradient = ctx.createRadialGradient(centerX, centerY, lensW * 0.2, centerX, centerY, lensW * 0.74);
        ringGradient.addColorStop(0, 'rgba(255,255,255,0)');
        ringGradient.addColorStop(0.5, 'rgba(255,255,255,0)');
        ringGradient.addColorStop(0.78, 'rgba(255,255,255,0.12)');
        ringGradient.addColorStop(1, 'rgba(42,65,124,0.24)');
        ctx.fillStyle = ringGradient;
        ctx.fillRect(0, 0, lensW, lensH);

        ctx.fillStyle = 'rgba(255,255,255,0.045)';
        ctx.fillRect(0, 0, lensW, lensH);

        var gloss = ctx.createRadialGradient(
          centerX * 0.7,
          centerY * 0.56,
          8,
          centerX,
          centerY,
          lensW * 0.72
        );
        gloss.addColorStop(0, 'rgba(255,255,255,0.32)');
        gloss.addColorStop(0.28, 'rgba(255,255,255,0.12)');
        gloss.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.fillStyle = gloss;
        ctx.fillRect(0, 0, lensW, lensH);

        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(-0.78539816339);
        var streak = ctx.createLinearGradient(-lensW * 0.42, 0, lensW * 0.42, 0);
        streak.addColorStop(0, 'rgba(255,255,255,0)');
        streak.addColorStop(0.42, 'rgba(255,255,255,0.02)');
        streak.addColorStop(0.5, 'rgba(255,255,255,0.14)');
        streak.addColorStop(0.58, 'rgba(255,255,255,0.03)');
        streak.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.fillStyle = streak;
        ctx.fillRect(-lensW * 0.58, -lensH * 0.09, lensW * 1.16, lensH * 0.18);
        ctx.restore();
        ctx.restore();
      }

      resizeCanvas();

      function setCursorPosition(event) {
        var cardRect = card.getBoundingClientRect();
        var x = event.clientX - cardRect.left;
        var y = event.clientY - cardRect.top;
        var pad = 28;

        x = Math.max(pad, Math.min(cardRect.width - pad, x));
        y = Math.max(pad, Math.min(cardRect.height - pad, y));

        cursor.style.left = x + 'px';
        cursor.style.top = y + 'px';
        pendingEvent = event;
        if (!rafId) {
          rafId = window.requestAnimationFrame(function () {
            rafId = 0;
            if (pendingEvent) {
              drawLens(pendingEvent);
            }
          });
        }
      }

      card.addEventListener('mouseenter', function (event) {
        card.classList.add('is-cursor-active');
        resizeCanvas();
        ensureSnapshot().then(function () {
          setCursorPosition(event);
        });
      });

      card.addEventListener('mousemove', function (event) {
        setCursorPosition(event);
      });

      card.addEventListener('mouseleave', function () {
        card.classList.remove('is-cursor-active');
        pendingEvent = null;
        if (rafId) {
          window.cancelAnimationFrame(rafId);
          rafId = 0;
        }
        clearCanvas();
      });

      window.addEventListener('resize', function () {
        snapshot = null;
        resizeCanvas();
      });
    });
  }

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

  function renderPayload(data, fallbackToEmpty) {
    if (!data || !data.html) {
      if (fallbackToEmpty) {
        renderEmpty();
      }
      return false;
    }

    grid.innerHTML = data.html;
    bindCardCursor();
    updateLoadMoreState(!!data.has_more, data.next_offset || 0);
    return true;
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
    var cacheKey = String(termId);
    activateTab(button);
    grid.setAttribute('data-term-id', String(termId));

    if (tabCache[cacheKey]) {
      renderPayload(tabCache[cacheKey], true);
      return;
    }

    activeRequestId += 1;
    var requestId = activeRequestId;
    setButtonLoading(true);

    requestPosts({
      termId: termId,
      offset: 0,
      limit: initialLimit
    }).then(function (payload) {
      if (requestId !== activeRequestId) return;
      var data = payload && payload.success ? payload.data : null;
      if (!data || !data.html) {
        renderEmpty();
        tabCache[cacheKey] = {
          html: '',
          has_more: false,
          next_offset: 0
        };
        return;
      }
      tabCache[cacheKey] = {
        html: data.html,
        has_more: !!data.has_more,
        next_offset: data.next_offset || 0
      };
      renderPayload(data, true);
    }).catch(function () {
      if (requestId !== activeRequestId) return;
      renderEmpty();
    }).finally(function () {
      if (requestId !== activeRequestId) return;
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
      bindCardCursor();
      updateLoadMoreState(!!data.has_more, data.next_offset || offset);
      tabCache[String(termId)] = {
        html: grid.innerHTML,
        has_more: !!data.has_more,
        next_offset: data.next_offset || offset
      };
    }).catch(function () {
      updateLoadMoreState(false, offset);
    }).finally(function () {
      setButtonLoading(false);
    });
  });

  bindCardCursor();
});
</script>
