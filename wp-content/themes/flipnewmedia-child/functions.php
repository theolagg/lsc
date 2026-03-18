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
	wp_enqueue_script( 'slick.js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'slick-lightbox.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js', array( 'jquery', 'slick.js' ), null, true );
	wp_enqueue_script( 'website.js', get_stylesheet_directory_uri() . '/js/website.js?v=1.20', array( 'jquery', 'slick.js' ), null, true );
	wp_enqueue_script( 'jssocials.js', 'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'simplebar.min.js', 'https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js', array(), null, true );
	 wp_localize_script('product-comparison', 'product_comparison_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
	
	
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


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
		</a>
		<span class="blog-archive-card__cursor" aria-hidden="true">
			<canvas class="blog-archive-card__cursor-canvas"></canvas>
			<span class="blog-archive-card__cursor-text"><?php echo esc_html__( 'Περισσότερα', 'flipnewmedia' ); ?></span>
		</span>

		<div class="home-news-card-copy blog-archive-card__copy">
			<h2 class="home-news-card-title blog-archive-card__title">
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
			</h2>
			<?php if ( $excerpt ) : ?>
				<p class="home-news-card-excerpt blog-archive-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
			<?php endif; ?>
			<div class="home-news-card-footer blog-archive-card__footer">
				<a class="home-news-card-arrow" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr__( 'Read more', 'flipnewmedia' ); ?>"></a>
			</div>
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

function lsc_get_google_maps_api_key() {
	$key = '';

	if ( defined( 'GOOGLE_MAPS_API_KEY' ) && GOOGLE_MAPS_API_KEY ) {
		$key = (string) GOOGLE_MAPS_API_KEY;
	}

	if ( '' === $key ) {
		$env_key = getenv( 'GOOGLE_MAPS_API_KEY' );
		if ( false !== $env_key && '' !== $env_key ) {
			$key = (string) $env_key;
		}
	}

	return trim( $key );
}

function lsc_render_global_lens_cursor_script() {
	if ( is_admin() ) {
		return;
	}
	?>
	<script>
	(function () {
		if (!window.matchMedia || !window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;

		var imageCache = new Map();
		var snapshotCache = new WeakMap();

		function loadImage(src) {
			if (!src) return Promise.resolve(null);
			if (imageCache.has(src)) return imageCache.get(src);

			var promise = new Promise(function (resolve) {
				var img = new Image();
				img.decoding = 'async';
				img.onload = function () { resolve(img); };
				img.onerror = function () { resolve(null); };
				img.src = src;
			});

			imageCache.set(src, promise);
			return promise;
		}

		function parseBackgroundUrl(value) {
			if (!value || value === 'none') return '';
			var match = value.match(/url\((['"]?)(.*?)\1\)/);
			return match ? match[2] : '';
		}

		function ensureLensCanvas(cursor) {
			var canvas = cursor.querySelector('.lsc-lens-canvas');
			if (canvas) return canvas;

			canvas = document.createElement('canvas');
			canvas.className = 'lsc-lens-canvas';
			cursor.insertBefore(canvas, cursor.firstChild);
			return canvas;
		}

		function drawWrappedText(ctx, text, x, y, maxWidth, lineHeight, maxLines) {
			if (!text) return;
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

			if (line) lines.push(line);
			if (typeof maxLines === 'number' && lines.length > maxLines) {
				lines = lines.slice(0, maxLines);
			}

			lines.forEach(function (entry, index) {
				ctx.fillText(entry, x, y + index * lineHeight);
			});
		}

		function drawImageLike(ctx, image, drawBox, fit) {
			if (!image || !drawBox.width || !drawBox.height) return;
			var naturalW = image.naturalWidth || drawBox.width;
			var naturalH = image.naturalHeight || drawBox.height;
			var scale = (fit === 'contain')
				? Math.min(drawBox.width / naturalW, drawBox.height / naturalH)
				: Math.max(drawBox.width / naturalW, drawBox.height / naturalH);
			var drawW = naturalW * scale;
			var drawH = naturalH * scale;
			var drawX = drawBox.x + (drawBox.width - drawW) / 2;
			var drawY = drawBox.y + (drawBox.height - drawH) / 2;

			ctx.save();
			ctx.beginPath();
			ctx.rect(drawBox.x, drawBox.y, drawBox.width, drawBox.height);
			ctx.clip();
			ctx.drawImage(image, drawX, drawY, drawW, drawH);
			ctx.restore();
		}

		function createSnapshot(target, config) {
			var rect = target.getBoundingClientRect();
			var width = Math.max(1, Math.round(rect.width));
			var height = Math.max(1, Math.round(rect.height));
			var canvas = document.createElement('canvas');
			canvas.width = width;
			canvas.height = height;
			var ctx = canvas.getContext('2d');
			if (!ctx) return Promise.resolve(null);

			var targetStyle = window.getComputedStyle(target);
			var bgColor = targetStyle.backgroundColor && targetStyle.backgroundColor !== 'rgba(0, 0, 0, 0)' ? targetStyle.backgroundColor : '#ffffff';
			ctx.fillStyle = bgColor;
			ctx.fillRect(0, 0, width, height);

			var drawPromises = [];

			(config.backgroundSelectors || []).forEach(function (selector) {
				var el = target.querySelector(selector);
				if (!el) return;
				var style = window.getComputedStyle(el);
				var src = parseBackgroundUrl(style.backgroundImage);
				var box = el.getBoundingClientRect();
				var drawBox = {
					x: box.left - rect.left,
					y: box.top - rect.top,
					width: box.width,
					height: box.height
				};
				drawPromises.push(
					loadImage(src).then(function (img) {
						drawImageLike(ctx, img, drawBox, 'cover');
					})
				);
			});

			(config.imageSelectors || []).forEach(function (selector) {
				var el = target.querySelector(selector);
				if (!el) return;
				var box = el.getBoundingClientRect();
				var drawBox = {
					x: box.left - rect.left,
					y: box.top - rect.top,
					width: box.width,
					height: box.height
				};
				var fit = window.getComputedStyle(el).objectFit || 'cover';
				drawPromises.push(
					loadImage(el.currentSrc || el.src).then(function (img) {
						drawImageLike(ctx, img, drawBox, fit === 'contain' ? 'contain' : 'cover');
					})
				);
			});

			return Promise.all(drawPromises).then(function () {
				(config.textSelectors || []).forEach(function (selector) {
					var el = target.querySelector(selector);
					if (!el) return;
					var box = el.getBoundingClientRect();
					var style = window.getComputedStyle(el);
					var x = box.left - rect.left;
					var y = box.top - rect.top;
					var maxWidth = box.width;
					var fontSize = parseFloat(style.fontSize || '18');
					ctx.textBaseline = 'top';
					ctx.fillStyle = style.color || '#2a417c';
					ctx.font = (style.fontWeight || '400') + ' ' + fontSize + 'px ' + (style.fontFamily || 'sans-serif');
					drawWrappedText(ctx, el.textContent || '', x, y, maxWidth, fontSize * 1.25, selector.indexOf('excerpt') !== -1 ? 4 : 3);
				});

				return { canvas: canvas, width: width, height: height };
			});
		}

		function renderLens(state, event) {
			if (!state.ctx || !state.snapshot || !state.snapshot.canvas) return;

			var targetRect = state.target.getBoundingClientRect();
			var lensW = state.cursor.offsetWidth || 147;
			var lensH = state.cursor.offsetHeight || 151;
			var workW = state.renderWidth || lensW;
			var workH = state.renderHeight || lensH;
			var safeX = Math.max(0, Math.min(targetRect.width, event.clientX - targetRect.left));
			var safeY = Math.max(0, Math.min(targetRect.height, event.clientY - targetRect.top));
			var ratioX = targetRect.width > 0 ? safeX / targetRect.width : 0.5;
			var ratioY = targetRect.height > 0 ? safeY / targetRect.height : 0.5;
			var naturalW = state.snapshot.width || targetRect.width || lensW;
			var naturalH = state.snapshot.height || targetRect.height || lensH;
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

			state.ctx.clearRect(0, 0, state.canvas.width, state.canvas.height);
			state.scratchCtx.clearRect(0, 0, workW, workH);
			state.outputCtx.clearRect(0, 0, workW, workH);

			state.scratchCtx.drawImage(state.snapshot.canvas, captureX, captureY, captureW, captureH, 0, 0, workW, workH);
			var sourceFrame = state.scratchCtx.getImageData(0, 0, workW, workH);
			var targetFrame = state.outputCtx.createImageData(workW, workH);
			var src = sourceFrame.data;
			var dst = targetFrame.data;

			function sample(px, py, channel) {
				var x = Math.max(0, Math.min(workW - 1, Math.round(px)));
				var y = Math.max(0, Math.min(workH - 1, Math.round(py)));
				return src[(y * workW + x) * 4 + channel];
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
					var twisted = angle + vortex;
					var sx = centerX + Math.cos(twisted) * (r * radiusX - refraction);
					var sy = centerY + Math.sin(twisted) * (r * radiusY - refraction * 0.92);
					var disperse = Math.max(0, r - 0.18) * 9.5;
					var blurOffset = Math.max(0, r - 0.08) * 2.2;
					var red = (sample(sx - disperse - blurOffset, sy - blurOffset * 0.35, 0) + sample(sx - disperse * 0.4, sy, 0)) / 2;
					var green = (sample(sx, sy, 1) + sample(sx + blurOffset * 0.2, sy + blurOffset * 0.2, 1)) / 2;
					var blue = (sample(sx + disperse + blurOffset, sy + blurOffset * 0.35, 2) + sample(sx + disperse * 0.4, sy, 2)) / 2;
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

			state.outputCtx.putImageData(targetFrame, 0, 0);

			state.ctx.save();
			state.ctx.beginPath();
			state.ctx.ellipse(lensW / 2, lensH / 2, lensW / 2, lensH / 2, 0, 0, Math.PI * 2);
			state.ctx.clip();
			state.ctx.filter = 'blur(1.8px)';
			state.ctx.drawImage(state.outputCanvas, 0, 0, workW, workH, 0, 0, lensW, lensH);
			state.ctx.filter = 'none';

			var ringGradient = state.ctx.createRadialGradient(lensW / 2, lensH / 2, lensW * 0.2, lensW / 2, lensH / 2, lensW * 0.74);
			ringGradient.addColorStop(0, 'rgba(255,255,255,0)');
			ringGradient.addColorStop(0.5, 'rgba(255,255,255,0)');
			ringGradient.addColorStop(0.78, 'rgba(255,255,255,0.12)');
			ringGradient.addColorStop(1, 'rgba(42,65,124,0.24)');
			state.ctx.fillStyle = ringGradient;
			state.ctx.fillRect(0, 0, lensW, lensH);
			state.ctx.fillStyle = 'rgba(255,255,255,0.045)';
			state.ctx.fillRect(0, 0, lensW, lensH);
			state.ctx.restore();
		}

		function bindLens(config) {
			document.querySelectorAll(config.target).forEach(function (target) {
				if (target.dataset.lensBound === 'true') return;
				target.dataset.lensBound = 'true';

				var cursor = target.querySelector(config.cursor);
				if (!cursor) return;

				var canvas = ensureLensCanvas(cursor);
				var ctx = canvas.getContext ? canvas.getContext('2d') : null;
				var scratchCanvas = document.createElement('canvas');
				var scratchCtx = scratchCanvas.getContext ? scratchCanvas.getContext('2d') : null;
				var outputCanvas = document.createElement('canvas');
				var outputCtx = outputCanvas.getContext ? outputCanvas.getContext('2d') : null;
				var state = {
					target: target,
					cursor: cursor,
					canvas: canvas,
					ctx: ctx,
					scratchCanvas: scratchCanvas,
					scratchCtx: scratchCtx,
					outputCanvas: outputCanvas,
					outputCtx: outputCtx,
					snapshot: null,
					pendingEvent: null,
					rafId: 0,
					renderWidth: 0,
					renderHeight: 0,
					renderScale: 0.42
				};
				if (!ctx || !scratchCtx || !outputCtx) return;

				function resizeCanvas() {
					var dpr = Math.max(1, window.devicePixelRatio || 1);
					var width = cursor.offsetWidth || 147;
					var height = cursor.offsetHeight || 151;
					canvas.width = Math.round(width * dpr);
					canvas.height = Math.round(height * dpr);
					ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
					state.renderWidth = Math.max(36, Math.round(width * state.renderScale));
					state.renderHeight = Math.max(38, Math.round(height * state.renderScale));
					scratchCanvas.width = state.renderWidth;
					scratchCanvas.height = state.renderHeight;
					outputCanvas.width = state.renderWidth;
					outputCanvas.height = state.renderHeight;
				}

				function ensureSnapshot() {
					var cached = snapshotCache.get(target);
					if (cached) {
						state.snapshot = cached;
						return Promise.resolve(cached);
					}
					return createSnapshot(target, config).then(function (shot) {
						if (shot) {
							snapshotCache.set(target, shot);
							state.snapshot = shot;
						}
						return shot;
					});
				}

				function updatePosition(event) {
					var rect = target.getBoundingClientRect();
					var pad = 28;
					var x = Math.max(pad, Math.min(rect.width - pad, event.clientX - rect.left));
					var y = Math.max(pad, Math.min(rect.height - pad, event.clientY - rect.top));
					cursor.style.left = x + 'px';
					cursor.style.top = y + 'px';
					state.pendingEvent = event;
					if (!state.rafId) {
						state.rafId = window.requestAnimationFrame(function () {
							state.rafId = 0;
							if (state.pendingEvent) renderLens(state, state.pendingEvent);
						});
					}
				}

				resizeCanvas();

				target.addEventListener('mouseenter', function (event) {
					target.classList.add('is-cursor-active');
					resizeCanvas();
					ensureSnapshot().then(function () {
						updatePosition(event);
					});
				});
				target.addEventListener('mousemove', updatePosition);
				target.addEventListener('mouseleave', function () {
					target.classList.remove('is-cursor-active');
					state.pendingEvent = null;
					if (state.rafId) {
						window.cancelAnimationFrame(state.rafId);
						state.rafId = 0;
					}
					ctx.clearRect(0, 0, canvas.width, canvas.height);
				});
				window.addEventListener('resize', function () {
					snapshotCache.delete(target);
					state.snapshot = null;
					resizeCanvas();
				});
			});
		}

		var lensConfigs = [
			{
				target: '.blog-archive-card',
				cursor: '.blog-archive-card__cursor',
				imageSelectors: ['.blog-archive-card__media img'],
				textSelectors: ['.blog-archive-card__title', '.blog-archive-card__excerpt']
			},
			{
				target: '.bu-products-latest__media',
				cursor: '.bu-products-latest__bubble',
				imageSelectors: ['img'],
				textSelectors: []
			},
			{
				target: '.bu-brand-categories__media',
				cursor: '.bu-brand-categories__bubble',
				imageSelectors: ['img'],
				textSelectors: []
			},
			{
				target: '.bu-product-related__card',
				cursor: '.bu-product-related__more',
				imageSelectors: ['.bu-product-related__media img'],
				textSelectors: ['.bu-product-related__item-title']
			},
			{
				target: '.bu-category-featured__card',
				cursor: '.bu-category-featured__bubble',
				imageSelectors: ['.bu-category-featured__media img'],
				textSelectors: ['.bu-category-featured__item-title']
			},
			{
				target: '.home-partners-media',
				cursor: '.home-partners-more',
				backgroundSelectors: ['.home-partners-bg--left', '.home-partners-bg--right'],
				imageSelectors: ['.home-partners-logo'],
				textSelectors: []
			},
			{
				target: '.home-solutions-card',
				cursor: '.home-solutions-card-cursor',
				imageSelectors: [],
				textSelectors: ['.home-solutions-card-title', '.home-solutions-card-description']
			}
		];

		function bindAllLenses() {
			lensConfigs.forEach(bindLens);
		}

		window.lscRefreshLensCursors = bindAllLenses;
		bindAllLenses();
	}());
	</script>
	<?php
}
add_action( 'wp_footer', 'lsc_render_global_lens_cursor_script', 100 );
