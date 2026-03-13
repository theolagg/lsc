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

function lsc_register_career_post_type() {
	$labels = array(
		'name'                  => __( 'Careers', 'flipnewmedia' ),
		'singular_name'         => __( 'Career', 'flipnewmedia' ),
		'menu_name'             => __( 'Careers', 'flipnewmedia' ),
		'name_admin_bar'        => __( 'Career', 'flipnewmedia' ),
		'add_new'               => __( 'Add New', 'flipnewmedia' ),
		'add_new_item'          => __( 'Add New Career', 'flipnewmedia' ),
		'new_item'              => __( 'New Career', 'flipnewmedia' ),
		'edit_item'             => __( 'Edit Career', 'flipnewmedia' ),
		'view_item'             => __( 'View Career', 'flipnewmedia' ),
		'all_items'             => __( 'All Careers', 'flipnewmedia' ),
		'search_items'          => __( 'Search Careers', 'flipnewmedia' ),
		'not_found'             => __( 'No careers found.', 'flipnewmedia' ),
		'not_found_in_trash'    => __( 'No careers found in Trash.', 'flipnewmedia' ),
		'archives'              => __( 'Career Archives', 'flipnewmedia' ),
		'attributes'            => __( 'Career Attributes', 'flipnewmedia' ),
		'insert_into_item'      => __( 'Insert into career', 'flipnewmedia' ),
		'uploaded_to_this_item' => __( 'Uploaded to this career', 'flipnewmedia' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-id-alt',
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'rewrite'             => array( 'slug' => 'career', 'with_front' => false ),
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
	);

	register_post_type( 'career', $args );
}
add_action( 'init', 'lsc_register_career_post_type' );

function lsc_register_bu_products_content_types() {
	$post_type_labels = array(
		'name'                  => __( 'BU Products', 'flipnewmedia' ),
		'singular_name'         => __( 'BU Product', 'flipnewmedia' ),
		'menu_name'             => __( 'BU Products', 'flipnewmedia' ),
		'name_admin_bar'        => __( 'BU Product', 'flipnewmedia' ),
		'add_new'               => __( 'Add New', 'flipnewmedia' ),
		'add_new_item'          => __( 'Add New BU Product', 'flipnewmedia' ),
		'new_item'              => __( 'New BU Product', 'flipnewmedia' ),
		'edit_item'             => __( 'Edit BU Product', 'flipnewmedia' ),
		'view_item'             => __( 'View BU Product', 'flipnewmedia' ),
		'all_items'             => __( 'All BU Products', 'flipnewmedia' ),
		'search_items'          => __( 'Search BU Products', 'flipnewmedia' ),
		'not_found'             => __( 'No BU products found.', 'flipnewmedia' ),
		'not_found_in_trash'    => __( 'No BU products found in Trash.', 'flipnewmedia' ),
		'archives'              => __( 'BU Product Archives', 'flipnewmedia' ),
		'attributes'            => __( 'BU Product Attributes', 'flipnewmedia' ),
		'insert_into_item'      => __( 'Insert into BU product', 'flipnewmedia' ),
		'uploaded_to_this_item' => __( 'Uploaded to this BU product', 'flipnewmedia' ),
	);

	$post_type_args = array(
		'labels'              => $post_type_labels,
		'public'              => true,
		'has_archive'         => true,
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-products',
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'rewrite'             => array( 'slug' => 'bu-products', 'with_front' => false ),
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'taxonomies'          => array( 'bu-category', 'bu-brand' ),
	);

	register_post_type( 'bu-product', $post_type_args );

	$category_labels = array(
		'name'              => __( 'BU Categories', 'flipnewmedia' ),
		'singular_name'     => __( 'BU Category', 'flipnewmedia' ),
		'search_items'      => __( 'Search BU Categories', 'flipnewmedia' ),
		'all_items'         => __( 'All BU Categories', 'flipnewmedia' ),
		'parent_item'       => __( 'Parent BU Category', 'flipnewmedia' ),
		'parent_item_colon' => __( 'Parent BU Category:', 'flipnewmedia' ),
		'edit_item'         => __( 'Edit BU Category', 'flipnewmedia' ),
		'update_item'       => __( 'Update BU Category', 'flipnewmedia' ),
		'add_new_item'      => __( 'Add New BU Category', 'flipnewmedia' ),
		'new_item_name'     => __( 'New BU Category Name', 'flipnewmedia' ),
		'menu_name'         => __( 'BU Categories', 'flipnewmedia' ),
	);

	register_taxonomy(
		'bu-category',
		array( 'bu-product' ),
		array(
			'labels'            => $category_labels,
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'bu-categories', 'with_front' => false ),
		)
	);

	$brand_labels = array(
		'name'                       => __( 'BU Brands', 'flipnewmedia' ),
		'singular_name'              => __( 'BU Brand', 'flipnewmedia' ),
		'search_items'               => __( 'Search BU Brands', 'flipnewmedia' ),
		'all_items'                  => __( 'All BU Brands', 'flipnewmedia' ),
		'edit_item'                  => __( 'Edit BU Brand', 'flipnewmedia' ),
		'update_item'                => __( 'Update BU Brand', 'flipnewmedia' ),
		'add_new_item'               => __( 'Add New BU Brand', 'flipnewmedia' ),
		'new_item_name'              => __( 'New BU Brand Name', 'flipnewmedia' ),
		'separate_items_with_commas' => __( 'Separate BU brands with commas', 'flipnewmedia' ),
		'add_or_remove_items'        => __( 'Add or remove BU brands', 'flipnewmedia' ),
		'choose_from_most_used'      => __( 'Choose from the most used BU brands', 'flipnewmedia' ),
		'menu_name'                  => __( 'BU Brands', 'flipnewmedia' ),
	);

	register_taxonomy(
		'bu-brand',
		array( 'bu-product' ),
		array(
			'labels'            => $brand_labels,
			'public'            => true,
			'hierarchical'      => false,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'bu-brand', 'with_front' => false ),
		)
	);
}
add_action( 'init', 'lsc_register_bu_products_content_types' );

function lsc_career_application_redirect_url( $status, $post_id ) {
	$target = $post_id ? get_permalink( $post_id ) : home_url( '/career/' );

	return add_query_arg(
		array(
			'career_form_status' => sanitize_key( $status ),
		),
		$target
	) . '#career-application';
}

function lsc_handle_career_application_submit() {
	if ( ! isset( $_POST['lsc_career_application_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lsc_career_application_nonce'] ) ), 'lsc_career_application_submit' ) ) {
		wp_safe_redirect( lsc_career_application_redirect_url( 'error', 0 ) );
		exit;
	}

	$post_id   = isset( $_POST['career_post_id'] ) ? absint( wp_unslash( $_POST['career_post_id'] ) ) : 0;
	$full_name = isset( $_POST['career_full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['career_full_name'] ) ) : '';
	$phone     = isset( $_POST['career_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['career_phone'] ) ) : '';
	$email     = isset( $_POST['career_email'] ) ? sanitize_email( wp_unslash( $_POST['career_email'] ) ) : '';
	$message   = isset( $_POST['career_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['career_message'] ) ) : '';
	$terms     = isset( $_POST['career_terms'] ) ? sanitize_text_field( wp_unslash( $_POST['career_terms'] ) ) : '';

	if ( empty( $post_id ) || 'career' !== get_post_type( $post_id ) || empty( $full_name ) || empty( $email ) || ! is_email( $email ) || '1' !== $terms ) {
		wp_safe_redirect( lsc_career_application_redirect_url( 'error', $post_id ) );
		exit;
	}

	$attachment_path = '';
	if ( ! empty( $_FILES['career_cv']['name'] ) && ! empty( $_FILES['career_cv']['tmp_name'] ) ) {
		$allowed_mimes = array(
			'pdf'  => 'application/pdf',
			'doc'  => 'application/msword',
			'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		);

		require_once ABSPATH . 'wp-admin/includes/file.php';

		$filename       = isset( $_FILES['career_cv']['name'] ) ? sanitize_file_name( wp_unslash( $_FILES['career_cv']['name'] ) ) : '';
		$validated_type = wp_check_filetype( $filename, $allowed_mimes );

		if ( empty( $validated_type['ext'] ) || empty( $validated_type['type'] ) ) {
			wp_safe_redirect( lsc_career_application_redirect_url( 'error', $post_id ) );
			exit;
		}

		$uploaded = wp_handle_upload(
			$_FILES['career_cv'],
			array(
				'test_form' => false,
				'mimes'     => $allowed_mimes,
			)
		);

		if ( isset( $uploaded['error'] ) ) {
			wp_safe_redirect( lsc_career_application_redirect_url( 'error', $post_id ) );
			exit;
		}

		if ( ! empty( $uploaded['file'] ) ) {
			$attachment_path = $uploaded['file'];
		}
	}

	$to       = get_option( 'admin_email' );
	$subject  = sprintf( '[%s] Career Application - %s', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), get_the_title( $post_id ) );
	$body     = "Career application submitted.\n\n";
	$body    .= 'Position: ' . get_the_title( $post_id ) . "\n";
	$body    .= 'Name: ' . $full_name . "\n";
	$body    .= 'Phone: ' . $phone . "\n";
	$body    .= 'Email: ' . $email . "\n";
	$body    .= "Message:\n" . $message . "\n";
	$headers  = array( 'Reply-To: ' . $email );
	$attachments = $attachment_path ? array( $attachment_path ) : array();

	$sent = wp_mail( $to, $subject, $body, $headers, $attachments );

	if ( $attachment_path && file_exists( $attachment_path ) ) {
		wp_delete_file( $attachment_path );
	}

	wp_safe_redirect( lsc_career_application_redirect_url( $sent ? 'ok' : 'error', $post_id ) );
	exit;
}
add_action( 'admin_post_lsc_career_application_submit', 'lsc_handle_career_application_submit' );
add_action( 'admin_post_nopriv_lsc_career_application_submit', 'lsc_handle_career_application_submit' );

/**
 * Blog archive helpers.
 */
function lsc_get_blog_archive_tabs() {
	$terms = get_categories(
		array(
			'taxonomy'   => 'category',
			'hide_empty' => true,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	$tabs = array(
		array(
			'slug'  => 'all',
			'label' => __( 'Όλα', 'flipnewmedia' ),
			'id'    => 0,
		),
	);

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return $tabs;
	}

	foreach ( $terms as $term ) {
		$tabs[] = array(
			'slug'  => 'cat-' . (int) $term->term_id,
			'label' => $term->name,
			'id'    => (int) $term->term_id,
		);
	}

	return $tabs;
}

function lsc_get_blog_archive_query_args( $term_id = 0, $posts_per_page = 11, $offset = 0 ) {
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'posts_per_page'      => max( 1, (int) $posts_per_page ),
		'offset'              => max( 0, (int) $offset ),
	);

	if ( $term_id > 0 ) {
		$args['cat'] = (int) $term_id;
	}

	return $args;
}

function lsc_render_blog_archive_card( $post_id, $is_featured = false ) {
	$post_id      = (int) $post_id;
	$title        = get_the_title( $post_id );
	$permalink    = get_permalink( $post_id );
	$excerpt      = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post_id ) ), $is_featured ? 18 : 14, '...' );
	$image_markup = get_the_post_thumbnail(
		$post_id,
		'full',
		array(
			'alt'      => esc_attr( $title ),
			'loading'  => 'lazy',
			'decoding' => 'async',
		)
	);
	$classes = 'home-news-card blog-archive-card';
	$classes .= $is_featured ? ' blog-archive-card--featured' : ' blog-archive-card--regular';

	ob_start();
	?>
	<article <?php post_class( $classes, $post_id ); ?>>
		<a class="home-news-card-media blog-archive-card__media" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr__( 'Read more', 'flipnewmedia' ); ?>">
			<?php if ( $image_markup ) : ?>
				<?php echo $image_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php endif; ?>
			<span class="home-news-card-arrow" aria-hidden="true"></span>
		</a>

		<div class="home-news-card-copy blog-archive-card__copy">
			<h2 class="home-news-card-title blog-archive-card__title">
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
			</h2>
			<?php if ( $excerpt ) : ?>
				<p class="home-news-card-excerpt blog-archive-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
			<?php endif; ?>
		</div>
	</article>
	<?php

	return (string) ob_get_clean();
}

function lsc_get_blog_archive_posts_markup( $term_id = 0, $limit = 11, $offset = 0 ) {
	$query = new WP_Query( lsc_get_blog_archive_query_args( $term_id, $limit, $offset ) );

	if ( ! $query->have_posts() ) {
		return array(
			'html'       => '',
			'count'      => 0,
			'has_more'   => false,
			'total'      => 0,
			'next_offset'=> max( 0, (int) $offset ),
		);
	}

	$html = '';
	foreach ( $query->posts as $index => $post ) {
		$is_featured = 0 === (int) $offset && 0 === $index;
		$html       .= lsc_render_blog_archive_card( $post->ID, $is_featured );
	}

	$count       = count( $query->posts );
	$total       = (int) $query->found_posts;
	$next_offset = (int) $offset + $count;
	wp_reset_postdata();

	return array(
		'html'        => $html,
		'count'       => $count,
		'has_more'    => $next_offset < $total,
		'total'       => $total,
		'next_offset' => $next_offset,
	);
}

function lsc_ajax_load_blog_archive_posts() {
	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'lsc_blog_archive_nonce' ) ) {
		wp_send_json_error(
			array(
				'message' => __( 'Invalid request.', 'flipnewmedia' ),
			),
			403
		);
	}

	$term_id = isset( $_POST['term_id'] ) ? absint( wp_unslash( $_POST['term_id'] ) ) : 0;
	$offset  = isset( $_POST['offset'] ) ? absint( wp_unslash( $_POST['offset'] ) ) : 0;
	$limit   = isset( $_POST['limit'] ) ? absint( wp_unslash( $_POST['limit'] ) ) : 8;

	$result = lsc_get_blog_archive_posts_markup( $term_id, $limit, $offset );

	wp_send_json_success(
		array(
			'html'        => $result['html'],
			'has_more'    => $result['has_more'],
			'next_offset' => $result['next_offset'],
			'count'       => $result['count'],
		)
	);
}
add_action( 'wp_ajax_lsc_load_blog_archive_posts', 'lsc_ajax_load_blog_archive_posts' );
add_action( 'wp_ajax_nopriv_lsc_load_blog_archive_posts', 'lsc_ajax_load_blog_archive_posts' );

function lsc_render_video_hero( $args = array() ) {
	$upload_dir        = wp_get_upload_dir();
	$default_video_url = trailingslashit( $upload_dir['baseurl'] ) . '2026/03/3940140663-preview.mp4';

	$args = wp_parse_args(
		$args,
		array(
			'title'         => '',
			'copy'          => '',
			'aria_label'    => __( 'Page introduction', 'flipnewmedia' ),
			'section_class' => '',
			'inner_class'   => '',
		)
	);

	$section_class = trim( 'contact-hero lsc-video-hero ' . $args['section_class'] );
	$inner_class   = trim( 'contact-hero__inner ' . $args['inner_class'] );
	$title         = (string) $args['title'];
	$copy          = wp_strip_all_tags( (string) $args['copy'] );

	ob_start();
	?>
	<section class="<?php echo esc_attr( $section_class ); ?>" aria-label="<?php echo esc_attr( $args['aria_label'] ); ?>">
		<div class="contact-hero__media lsc-video-hero__media">
			<video class="lsc-video-hero__video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
				<source src="<?php echo esc_url( $default_video_url ); ?>" type="video/mp4">
			</video>
			<div class="contact-hero__overlay" aria-hidden="true"></div>
			<div class="container-ext <?php echo esc_attr( $inner_class ); ?>">
				<div class="contact-hero__header">
					<h1 class="contact-hero__title"><?php echo esc_html( $title ); ?></h1>
				</div>
				<div class="contact-hero__line" aria-hidden="true"></div>
				<?php if ( '' !== $copy ) : ?>
					<div class="contact-hero__copy-wrap">
						<p class="contact-hero__copy"><?php echo esc_html( $copy ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php

	return (string) ob_get_clean();
}
