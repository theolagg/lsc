<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_filter( 'widget_text', 'do_shortcode' );

$GLOBALS['PATH_WP_CONTENT'] = WP_CONTENT_DIR . "/";
 

include('shortcodes.php');


/*CF7 REMOVE TAGS*/
add_filter('wpcf7_autop_or_not', '__return_false');




add_action('get_header', 'my_filter_head');
function my_filter_head() { remove_action('wp_head', '_admin_bar_bump_cb'); }
function my_admin_css() {
        if ( is_user_logged_in() ) {
        ?>
        <style type="text/css">
            #wpadminbar {opacity:0;transition:200ms;max-width:100px;}
            #wpadminbar:hover {opacity:1;transition:200ms;max-width:100%;overflow: auto;}
			html{margin-top:0px !important;}
			@media screen and (max-width: 600px) { #wpadminbar {position: fixed;} }
        </style>
        <?php }
}
add_action('wp_head', 'my_admin_css');



function breadcrumbs_html() {
	echo '<div class="breadcrumbs_wrap">
			<div class="breadcrumbs_header m-auto mw">
				<div class="breadcrumbs-wrapper">
					<div>' . do_shortcode("[wpseo_breadcrumb]") .'</div>
				</div>
				</div>
			</div>';
}


/*ADD CUSTOMS TO THEME*/
function my_scripts_method() {
	
	//wp_enqueue_style( 'animate.min.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
	wp_enqueue_style( 'slick.css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css');
	wp_enqueue_style( 'slick-lightbox.css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css');
	//wp_enqueue_style( 'slickTheme.css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css');
	wp_enqueue_style( 'jssocials.css', 'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css');
	wp_enqueue_style( 'jssocials-theme-flat.css', 'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css');
	wp_enqueue_style( 'font-awesome.min.css', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'select2.min.css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css');
	//wp_enqueue_style( 'fancybox.min.css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
	//wp_enqueue_style( 'animate.min.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
	wp_enqueue_style( 'website.css', get_stylesheet_directory_uri() . '/css/website.css?v=1.60');
	wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri() . '/js/my-ajax-script.js', array('jquery') );
	wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_style( 'custom-style', 'https://use.typekit.net/ycj4dqx.css' );
	wp_enqueue_style( 'simplebar.css', 'https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css');
	 wp_localize_script('product-comparison', 'product_comparison_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
	
	
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

function enqueue_scripts_to_footer() {
	wp_enqueue_script('jquery');
	//wp_enqueue_script('sticky.js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js');
	wp_enqueue_script('slick.js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js');
	wp_enqueue_script('slick-lightbox.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js');
	wp_enqueue_script('website.js', get_stylesheet_directory_uri() . '/js/website.js?v=1.20', array( 'jquery' ));
	wp_enqueue_script('jssocials.js', 'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js');
	//wp_enqueue_script('select2.min.js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js');
	//wp_enqueue_script('fancybox.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');
	//wp_enqueue_script('gsap.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js');
	//wp_enqueue_script('ScrollTrigger.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/ScrollTrigger.min.js');
	wp_enqueue_script('simplebar.min.js', 'https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js');
	//wp_enqueue_script('minicart', get_stylesheet_directory_uri() . '/js/minicart.js', array( 'jquery' ));
	//wp_enqueue_script('rangeslider', get_stylesheet_directory_uri() . '/js/rangeslider.js', array( 'jquery' ));
}
add_action( 'wp_footer', 'enqueue_scripts_to_footer' );


 function footer_widgets() {
    //Footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Column 1', 'widget_area' ),
        'id' => 'fw1',
        'description' => __( 'Footer Widget Area', 'widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title w-big-title">',
        'after_title' => '</h1>',
    ) );
	register_sidebar( array(
        'name' => __( 'Footer Widget Column 2', 'widget_area' ),
        'id' => 'fw2',
        'description' => __( 'Footer Widget Area', 'widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title w-small-title ">',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => __( 'Footer Widget Column 3', 'widget_area' ),
        'id' => 'fw3',
        'description' => __( 'Footer Widget Area', 'widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title w-small-title">',
        'after_title' => '</h3>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer Widget Column 4', 'widget_area' ),
        'id' => 'fw4',
        'description' => __( 'Footer Widget Area', 'widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title w-small-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer_widgets' );

/*SVG UPLOAD SUPPORT*/
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


 /*DISABLE GUTEMBERG*/
 add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

add_action('after_setup_theme', function () {
  register_nav_menus([
    'primary'               => __('Primary (Desktop)', 'flipnewmedia'),
    'header_utility'        => __('Header Utility (Desktop Right)', 'flipnewmedia'),
    'offcanvas_left'        => __('Offcanvas Mobile - Left Column', 'flipnewmedia'),
    'offcanvas_right'       => __('Offcanvas Mobile - Right Column', 'flipnewmedia'),
  ]);
});


add_action('wp_head', 'your_function_name');
function your_function_name(){
?>
<script>
// Define dataLayer and the gtag function.
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
// Set default consent to 'denied' as a placeholder
// Determine actual values based on your own requirements
gtag('consent', 'default', {
'ad_storage': 'denied',
'ad_user_data': 'denied',
'ad_personalization': 'denied',
'analytics_storage': 'denied',
'personalization_storage': 'denied',
'functionality_storage': 'denied',
'security_storage': 'denied',
});
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','');</script>
<!-- End Google Tag Manager -->
<?php
};

/**
 * Normalize internal URLs so they always follow the current site domain/permalink style.
 */
function fnm_make_url_dynamic( $url ) {
	if ( ! is_string( $url ) || '' === $url ) {
		return $url;
	}

	$home_root = untrailingslashit( home_url( '/' ) );
	$origins   = array(
		untrailingslashit( home_url() ),
		untrailingslashit( site_url() ),
	);

	// Convert absolute localhost links to the current site domain.
	if ( preg_match( '~^https?://(?:localhost|127\.0\.0\.1)(?::\d+)?(?P<path>/[^?#]*)?(?P<query>\?[^#]*)?(?P<frag>#.*)?$~i', $url, $m ) ) {
		$path = isset( $m['path'] ) ? $m['path'] : '';
		$query = isset( $m['query'] ) ? $m['query'] : '';
		$frag = isset( $m['frag'] ) ? $m['frag'] : '';
		$url = $home_root . $path . $query . $frag;
	}

	// Remove /index.php from absolute internal URLs.
	foreach ( $origins as $origin ) {
		$prefix = $origin . '/index.php';
		if ( 0 === strpos( $url, $prefix . '/' ) ) {
			return $origin . '/' . ltrim( substr( $url, strlen( $prefix ) + 1 ), '/' );
		}
		if ( 0 === strpos( $url, $prefix . '?' ) ) {
			return $origin . '/?' . substr( $url, strlen( $prefix ) + 1 );
		}
		if ( $url === $prefix ) {
			return $origin . '/';
		}
	}

	// Remove /index.php from relative internal URLs.
	if ( 0 === strpos( $url, '/index.php/' ) ) {
		return home_url( '/' . ltrim( substr( $url, 11 ), '/' ) );
	}
	if ( 0 === strpos( $url, '/index.php?' ) ) {
		return home_url( '/?' . substr( $url, 11 ) );
	}
	if ( '/index.php' === $url ) {
		return home_url( '/' );
	}

	return $url;
}

add_filter(
	'nav_menu_link_attributes',
	function( $atts ) {
		if ( isset( $atts['href'] ) ) {
			$atts['href'] = fnm_make_url_dynamic( $atts['href'] );
		}
		return $atts;
	}
);

function fnm_normalize_content_urls( $content ) {
	return preg_replace_callback(
		'~\b(href|src|action)=(["\'])([^"\']+)\2~i',
		function( $matches ) {
			return $matches[1] . '=' . $matches[2] . esc_url( fnm_make_url_dynamic( $matches[3] ) ) . $matches[2];
		},
		$content
	);
}
add_filter( 'the_content', 'fnm_normalize_content_urls', 20 );

/**
 * Build a safe return URL for footer forms.
 */
function lsc_footer_return_url() {
	$referer = wp_get_referer();
	$target  = $referer ? $referer : home_url( '/' );
	return add_query_arg(
		array(
			'lsc_footer_status' => null,
			'lsc_footer_form'   => null,
		),
		$target
	) . '#contact-footer';
}

function lsc_footer_redirect_with_status( $status, $form ) {
	$url = add_query_arg(
		array(
			'lsc_footer_status' => sanitize_key( $status ),
			'lsc_footer_form'   => sanitize_key( $form ),
		),
		lsc_footer_return_url()
	);

	wp_safe_redirect( $url );
	exit;
}

function lsc_footer_handle_newsletter_submit() {
	if ( ! isset( $_POST['lsc_footer_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsc_footer_newsletter_nonce'] ) ), 'lsc_footer_newsletter_submit' ) ) {
		lsc_footer_redirect_with_status( 'error', 'newsletter' );
	}

	$email = isset( $_POST['newsletter_email'] ) ? sanitize_email( wp_unslash( $_POST['newsletter_email'] ) ) : '';
	$terms = isset( $_POST['newsletter_terms'] ) ? sanitize_text_field( wp_unslash( $_POST['newsletter_terms'] ) ) : '';

	if ( empty( $email ) || ! is_email( $email ) || '1' !== $terms ) {
		lsc_footer_redirect_with_status( 'error', 'newsletter' );
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[%s] Newsletter Signup', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$message = "New newsletter signup from footer:\n\nEmail: {$email}\n";
	$headers = array( 'Reply-To: ' . $email );

	$sent = wp_mail( $to, $subject, $message, $headers );

	lsc_footer_redirect_with_status( $sent ? 'ok' : 'error', 'newsletter' );
}
add_action( 'admin_post_lsc_footer_newsletter_submit', 'lsc_footer_handle_newsletter_submit' );
add_action( 'admin_post_nopriv_lsc_footer_newsletter_submit', 'lsc_footer_handle_newsletter_submit' );

function lsc_footer_handle_contact_submit() {
	if ( ! isset( $_POST['lsc_footer_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsc_footer_contact_nonce'] ) ), 'lsc_footer_contact_submit' ) ) {
		lsc_footer_redirect_with_status( 'error', 'contact' );
	}

	$full_name = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
	$phone     = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$message   = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$terms     = isset( $_POST['contact_terms'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_terms'] ) ) : '';

	if ( empty( $full_name ) || empty( $email ) || ! is_email( $email ) || '1' !== $terms ) {
		lsc_footer_redirect_with_status( 'error', 'contact' );
	}

	$to          = get_option( 'admin_email' );
	$mail_subject = sprintf( '[%s] Footer Contact Request', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$mail_body    = "New contact request from footer:\n\n";
	$mail_body   .= "Name: {$full_name}\n";
	$mail_body   .= "Phone: {$phone}\n";
	$mail_body   .= "Email: {$email}\n";
	$mail_body   .= "Message:\n{$message}\n";
	$headers      = array( 'Reply-To: ' . $email );

	$sent = wp_mail( $to, $mail_subject, $mail_body, $headers );

	lsc_footer_redirect_with_status( $sent ? 'ok' : 'error', 'contact' );
}
add_action( 'admin_post_lsc_footer_contact_submit', 'lsc_footer_handle_contact_submit' );
add_action( 'admin_post_nopriv_lsc_footer_contact_submit', 'lsc_footer_handle_contact_submit' );
