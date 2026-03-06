(function ($) {
    $(document).on('click', '.categories-filter a', function (e) {
        e.preventDefault();

        var categorySlug = $(this).data('slug'); // Get category slug
        $('.categories-filter a').removeClass('active'); // Remove active class
        $(this).addClass('active'); // Add active class

        // AJAX request
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_posts',
                category: categorySlug,
                nonce: ajax_filter_params.nonce,
            },
            beforeSend: function () {
                $('.news-row').html('<p class="loading">Loading...</p>'); // Show loading message
            },
            success: function (response) {
                $('.news-row').html(response); // Replace content
            },
        });
    });
})(jQuery);
