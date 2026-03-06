<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


function homeSlider() {
	ob_start();
	$posts_ids = get_field('slide_posts');
	 
	
	$slide_nav = '';
	$slides = '';
	$i = 1;
	if( have_rows('slider') ):
		while( have_rows('slider') ) : the_row();
			$banner   = get_sub_field('banner');
			$icon     = get_sub_field('icon');
			$title    = get_sub_field('title');
			$text     = get_sub_field('text');
			$status   = get_sub_field('status');
			$url      = get_sub_field('url');
			
			
			$url_html = '';
			if(!empty($url)) {
				$url_html = "<div class='slide_btn'><a class='btn transparent' href='$url'>Μάθετε περισσότερα</a></div>";
			}
			 
			 
			if($status!="Draft") {
				$slides .= "<div  data-title='$title' class='home-slide slide-no-$i' >

								<div class='slide_banner'>
									<img  loading='lazy' src='$banner' alt='$title'/>
								</div>
								<div class='home-wrapper-content'>
									<div class='home-col-content'>
										<div class='home-content'>
											<div class='slide_cont_col_1'>
												<div class='slide_icon'><img src='$icon' alt='$title'/></div>
												<div class='slide_title'>$title</div>
												<div class='slide_text'>$text</div>
												$url_html
											</div>

									  </div> 
									</div>	
								</div>								 

							</div>";

				$i++;
			}
	
		endwhile;
	endif;
 
	 
		  $slides_nav = '{"slidesToShow": '.$i.', "slidesToScroll": 1}';
 
		echo "<div class='home-slider-wrapper'>
				  
				  <div class='home-slider-row hide_until_load m-auto mw'>
					 $slides
				  </div>
				  <div class='uc_arrow ms_arrow ms_right'>".$GLOBALS['SLIDER_RIGHT']."</div>
				  <div class='uc_arrow ms_arrow ms_left'>".$GLOBALS['SLIDER_LEFT']."</div>
				   <div class='dots-general dots_home_slider'></div>			  
				</div>";
 
		$output = ob_get_clean();
		return $output;
}


 

function getServicesHome($cat_id, $number_posts) {
 
            $args = array(
                'posts_per_page' => $number_posts,
                'cat'            => $cat_id,
                'post_type'      => 'post',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $posts = get_posts($args);

            if (empty($posts)) {
                return ''; // Optionally, return a message indicating no services found
            }

            // Process and store relevant data
            $services_data = array();
            foreach ($posts as $post) {
                setup_postdata($post);
                $post_id = $post->ID;
                $title   = get_the_title($post_id);
                $link    = get_permalink($post_id);
                $price   = get_field('price', $post_id);
                $icon    = get_field('service_icon', $post_id);
                $icons   = category_icon_svg($icon, 'services');

                // Store processed data
                $services_data[] = array(
                    'title'         => $title,
                    'link'          => $link,
                    'icon_svg'      => $icons['white'],
                    'icon_svg_blue' => $icons['blue'],
                    'price'         => $price,
                );
            }

            // Reset post data
            wp_reset_postdata();
 
        // Generate HTML from data
        if (!empty($services_data)) {
            $service_html = '<div class="services_wrapper hide_until_load">';

            foreach ($services_data as $service) {
                $service_html .= '<a href="' . esc_url($service['link']) . '" class="single_service">';
                $service_html .= '<div class="serv_icon">' . $service['icon_svg'] . ' ' . $service['icon_svg_blue'] . '</div>';
                $service_html .= '<h2>' . esc_html($service['title']) . '</h2>';
                $service_html .= '<div><span>' . __('από', 'your-text-domain') . ' </span>' . esc_html($service['price']) . '€</div>';
                $service_html .= '<button class="btn grey">' . __('Δείτε τη υπηρεσία', 'your-text-domain') . '</button>';
                $service_html .= '</a>';
            }

            

            // Append the ETISIA category
            $etisia_category_id = isset($GLOBALS['ETISIA']) ? $GLOBALS['ETISIA'] : '';
            if ($etisia_category_id) {
                $etisia_category = get_term($etisia_category_id, 'product_cat');

                if (!is_wp_error($etisia_category) && $etisia_category) {
					$icon = get_field('category_icon', 'product_cat_' . $etisia_category->term_id);    
					$icon_to_use = category_icon_svg($icon,'service');
                    $etisia_link = get_term_link($etisia_category);
					
					$service_html .= '<a href="' . esc_url($etisia_link) . '" class="single_service">';
					$service_html .= '<div class="serv_icon">' . $icon_to_use['white'] . ' ' . $icon_to_use['blue'] . '</div>';
					$service_html .= '<h2>' .  esc_html($etisia_category->name) . '</h2>';
					$service_html .= '<div><span>' . __('από', 'your-text-domain') . ' </span>200€</div>';
					$service_html .= '<button class="btn grey">' . __('Δείτε τις υπηρεσίες', 'your-text-domain') . '</button>';
					$service_html .= '</a>';
                }
            }
			
			$service_html .= '</div>';

            $service_html .= '<div class="dots-general dots-blue dots_services"></div>';

            
        }
 

    return $service_html;
}


function getOffers($cat_id, $number_posts) {
	
            $args = array(
                'posts_per_page' => $number_posts,
                'cat'            => $cat_id,
                'post_type'      => 'post',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $posts = get_posts($args);

            if (empty($posts)) {
                return ''; // Optionally, return a message indicating no services found
            }

            // Process and store relevant data
            $offer_html = '<div class="offers_carousel hide_until_load">';
			
            foreach ($posts as $post) {
                setup_postdata($post);
               		$post_id = $post->ID;
					$title   = get_the_title($post_id);
					$link    = get_permalink($post_id);
					$subtitle   = get_field('subtitle', $post_id);
					$icon    = get_field('service_icon', $post_id);
					$icons   = category_icon_svg($icon, 'services');
					$feat_image_lazy = wp_get_attachment_image(get_post_thumbnail_id($post_id),'full',false,array('class'=>'blog_image','alt'=>$title));

					
					$offer_html .= '<div class="offer_wrapper">';
					$offer_html .= '	<div class="offer_banner">' . $feat_image_lazy . '</div>';
					$offer_html .= '	<div class="blue_textbox">';
					$offer_html .= '		<div class="offer_icon">' . $icons['blue'] . '</div>';
					$offer_html .= '		<h2>' . esc_html($title) . '</h2>';
					$offer_html .= '    	<p>' . $subtitle . '</p>';
					$offer_html .= '		<a href="' . esc_url($link) . '" class="btn wht">Πάρε προσφορά</a>';
					$offer_html .= '	</div>';
					$offer_html .= '</div>';

            }
			$offer_html .= '</div>';
			$offer_html .= '<div class="dots-general dots-blue dots_offers"></div>';
            // Reset post data
            wp_reset_postdata();
 

    return $offer_html;
}

 
/**
 * Generates product tab categories with caching.
 *
 * @param string $field             The ACF field name containing product categories.
 * @param string $slick_slider_type The type of Slick slider ('col' or other).
 */
function product_tab_categories($field, $slick_slider_type) {
    // Define unique cache keys based on function parameters
    $transient_key    = 'FNM_product_tab_categories_html_field_' . $field . '_slick_' . $slick_slider_type;
    $object_cache_key = 'FNM_product_tab_categories_data_field_' . $field . '_slick_' . $slick_slider_type;

    // Attempt to retrieve cached HTML from Transient
    $tab_html = get_transient($transient_key);
	$tab_html = false;
    if (false === $tab_html) {
        // Transient not found; attempt to retrieve data from Object Cache
        $cached_data = wp_cache_get($object_cache_key, 'product_tabs');
		$cached_data = false;
        if (false === $cached_data) {
            // Object Cache miss; fetch data from ACF fields
            $prod_cats = get_field($field);
            $on_sale   = get_field('on_sale_products');   // Ensure the field name is correct
            $popular   = get_field('popular_products');   // Ensure the field name is correct

            // Validate that $prod_cats is an array
            if (!is_array($prod_cats)) {
                $prod_cats = array();
            }

            // Store data in Object Cache for 12 hours
            $cached_data = array(
                'prod_cats' => $prod_cats,
                'on_sale'   => $on_sale,
                'popular'   => $popular,
            );

            wp_cache_set($object_cache_key, $cached_data, 'product_tabs', 36 * HOUR_IN_SECONDS);
        }

        // Correctly extract individual elements from cached data
        $prod_cats = isset($cached_data['prod_cats']) ? $cached_data['prod_cats'] : array();
        $on_sale   = isset($cached_data['on_sale']) ? $cached_data['on_sale'] : false;
        $popular   = isset($cached_data['popular']) ? $cached_data['popular'] : false;

        // Initialize HTML components
        $tabs_title  = '';
        $tab_content = '';
        $i           = 1;

        if (!empty($prod_cats)) {
            foreach ($prod_cats as $category_id) {
                $category = get_term($category_id, 'product_cat');
                if (!is_wp_error($category)) {
                    $category_name = esc_html($category->name);
                    $category_slug = esc_attr($category->slug);
                   
					$category_url = '';
					$parent_object =  get_parent_product_category($category_id);
					//print_r($parent_object);
					if($parent_object) {
						$parent_url = get_term_link( $parent_object );
						$category_url = add_query_arg( '_product_categories', $category->slug, $parent_url );
					}
					else {
						 $category_url  = esc_url(get_term_link($category));
					}
					

                    $active = ($i === 1) ? 'active' : '';

                    // Conditional attributes
                    $on_sale_cond = $on_sale ? 'on_sale="true"' : '';
                    $popular_cond = $popular ? 'best_selling="true"' : '';

                    // Determine Slick slider classes and additional HTML based on slider type
                    $slick_js   = ($slick_slider_type === "col") ? 'products_col_slick' : 'products_fw_slick';
                    $tab_bullet = ($slick_slider_type === "col") ? 'tab_bullet' : '';
					
					 
					
                    $cta_cat    =  "<div class='cta_cta right'><a href='{$category_url}'><span></span>Όλα τα προϊόντα</a></div>"  ;

                    // Build tabs title
                    $tabs_title .= "<div data-url='tab{$i}' data-attr='tab{$i}' class='prod_tab {$active} {$tab_bullet}'>{$category_name}</div>";

                    // Generate products shortcode
                    $products_shortcode = do_shortcode("[products limit='4' orderby='menu_order' category='{$category_slug}' {$on_sale_cond} {$popular_cond}]");

                    // Build tab content
                    $tab_content .= "<div class='products_carousel products_carousel_slick {$slick_js} tab{$i} {$active}'>
                                        {$products_shortcode}
                                        <div class='arros_single'>
                                            <div class='arrow-prev'>{$GLOBALS['SLIDER_RIGHT']}</div>
                                            <div class='arrow-next'>{$GLOBALS['SLIDER_LEFT']}</div>
                                        </div>
                                        <div class='bottom_slider'>
                                            <div class='dots-general dots-blue dots_circle dots_col_prod'></div>
                                            {$cta_cat}
                                        </div>
                                        <div class='best_seller_bottom'>
                                            <div class='progress_wrap'>
                                                <div class='progressbar-inner'></div>
                                            </div>
                                        </div>
                                     </div>";
                    $i++;
                }
            }

            // Assemble the final HTML
            $tab_html = "
                <div class=\"main_wrapper_fw products_main_slider\">  
                    <div class=\"products_slider_row\">
                        <div class=\"products_slider\">
                            <div class='product_tabs_wrapper'>
                                <div class='prod_tabs_wrapper'>
                                    <div class=\"prod_tabs_wrap\">
                                        <div class=\"product_tabs\">{$tabs_title}</div>
                                    </div>
                                    <div class=\"prod_cont_wrap\">
                                        {$tab_content}
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            ";
        } else {
            // Optional: Display a message if no product categories are found
            $tab_html = '<p>' . __('No product categories found.', 'your-text-domain') . '</p>';
        }

        // Store the generated HTML in Transient for 12 hours
        set_transient($transient_key, $tab_html, 12 * HOUR_IN_SECONDS);
    }

    // Echo the HTML
    echo $tab_html;
}



function getBlogHome($cat_id, $number_posts) {
   
	/*
    $transient_key = 'FNM_blog_home_html_cat_' . $cat_id . '_posts_' . $number_posts;
    $object_cache_key = 'FNM_blog_home_html_cat_' . $cat_id . '_posts_' . $number_posts;
    $blog_html = get_transient($transient_key);
	
    if (false === $blog_html) { */
        // Transient not found; attempt to retrieve data from Object Cache
        /*$blog_data = wp_cache_get($object_cache_key, 'services'); */

        /*if (false === $blog_data) { */
            // Object Cache miss; fetch data from the database
            $args = array(
                'posts_per_page' => $number_posts,
                'cat'            => $cat_id,
                'post_type'      => 'post',
                'orderby'        => 'date',
                'order'          => 'DESC',
				'post__not_in'   => array(get_the_ID()),
            );

            $posts = get_posts($args);

            if (empty($posts)) {
                return ''; // Optionally, return a message indicating no services found
            }

            // Process and store relevant data
            $blog_data = array();
            foreach ($posts as $post) {
                setup_postdata($post);
                $post_id = $post->ID;
                $title   = get_the_title($post_id);
                $link    = get_permalink($post_id);
				$feat_image_lazy = wp_get_attachment_image(get_post_thumbnail_id($post_id),'full',false,array('class'=>'blog_image','alt'=>$title));
				
				$my_post_categories = get_the_category($post_id);
				//$my_post_child_cats = array();
				$sub_cat = '';
				foreach ( $my_post_categories as $post_cat ) {
					if ( 0 != $post_cat->category_parent ) {
						//$my_post_child_cats[] = $post_cat->cat_name;
						$sub_cat = $post_cat->cat_name;
						break;
					}
				}
				//$list_cats = implode(', ', $my_post_child_cats);
 
                // Store processed data
                $blog_data[] = array(
                    'title' => $title,
                    'link'  => $link,
					'image' => $feat_image_lazy,
					'sub_cat' => $sub_cat,
                );
            }

            // Reset post data
            wp_reset_postdata();

            // Store data in Object Cache for 12 hours
        /*    wp_cache_set($object_cache_key, $services_data, 'blog', 12 * HOUR_IN_SECONDS);
        } */

        // Generate HTML from data
        if (!empty($blog_data)) {
            $blog_html = '<div class="blog_wrapper blog_carousel">';
 
            foreach ($blog_data as $blog) {
				$blog_html .= '<div class="blog_wrap hover_img">';
                $blog_html .= '<a href="' . esc_url($blog['link']) . '" class="blog_cta ">';
				$blog_html .= '<div class="gh_img">';
				$blog_html .= 		$blog['image'];
				$blog_html .= '<div class="subcat">'.$blog['sub_cat'].'</div>';
				$blog_html .= '</div>';
                 
                $blog_html .= '<h2>' . esc_html($blog['title']) . '</h2>';
 				
                $blog_html .= '</a>';
				$blog_html .= '<div class="cta_cta"><a href="' . esc_url($blog['link']) . '">Διαβάστε περισσότερα</a></div>';
				$blog_html .= '</div>';
            }

            $blog_html .= '</div>';
            $blog_html .= '<div class="dots-general dots-blue dots_blog"></div>';

            // Store the generated HTML in Transient for 12 hours
           /* set_transient($transient_key, $blog_html, 36 * HOUR_IN_SECONDS); */
        } 
   /* } */

    return $blog_html;
}
 

function getEfarmoges($cat_id, $number_posts, $tags = array()) {
   
 
            $args = array(
                'posts_per_page' => $number_posts,
                'cat'            => $cat_id,
                'post_type'      => 'post',
                'orderby'        => 'date',
                'order'          => 'DESC',
				'post__not_in'   => array(get_the_ID()),
            );
	 
			if (!empty($tags) && is_array($tags)) {
				$args['tag_slug__in'] = $tags;
			}
            $posts = get_posts($args);

            if (empty($posts)) {
                return ''; // Optionally, return a message indicating no services found
            }

            // Process and store relevant data
            $blog_data = array();
            foreach ($posts as $post) {
                setup_postdata($post);
                $post_id = $post->ID;
                $title   = get_the_title($post_id);
                $link    = get_permalink($post_id);
				$feat_image_lazy = wp_get_attachment_image(get_post_thumbnail_id($post_id),'full',false,array('class'=>'blog_image','alt'=>$title));
				
				$my_post_categories = get_the_category($post_id);
				//$my_post_child_cats = array();
				 
				$tags_html = '';
				$tags_terms = get_the_tags($post_id);
				if ( $tags_terms ) {
					$tag_names = array();
					foreach ( $tags_terms as $tag ) {
						$tags_html .= esc_html( $tag->name );
						break;
					}
					
				}
				//$list_cats = implode(', ', $my_post_child_cats);
 
                // Store processed data
                $blog_data[] = array(
                    'title' => $title,
                    'link'  => $link,
					'image' => $feat_image_lazy,
					'sub_cat' => $tags_html,
                );
            }

            // Reset post data
            wp_reset_postdata();
 

        // Generate HTML from data
        if (!empty($blog_data)) {
            $blog_html = '<div class="blog_wrapper blog_carousel">';
 
            foreach ($blog_data as $blog) {
				$blog_html .= '<div class="blog_wrap hover_img">';
                $blog_html .= '<a href="' . esc_url($blog['link']) . '" class="blog_cta ">';
				$blog_html .= '<div class="gh_img">';
				$blog_html .= 		$blog['image'];
				$blog_html .= '<div class="subcat">'.$blog['sub_cat'].'</div>';
				$blog_html .= '</div>';
                 
                $blog_html .= '<h2>' . esc_html($blog['title']) . '</h2>';
 				
                $blog_html .= '</a>';
				$blog_html .= '<div class="cta_cta"><a href="' . esc_url($blog['link']) . '">Διαβάστε περισσότερα</a></div>';
				$blog_html .= '</div>';
            }

            $blog_html .= '</div>';
            $blog_html .= '<div class="dots-general dots-blue dots_blog"></div>';
 
        } 
 

    return $blog_html;
}

function faqs($faqs_array) {
		$btn = '<svg xmlns="http://www.w3.org/2000/svg" width="13.793" height="13.793" viewBox="0 0 13.793 13.793"><path id="Path_7528" data-name="Path 7528" d="M0,0H7.751V7.754" transform="translate(12.378 6.897) rotate(135)" fill="none" stroke="#0063cc" stroke-linecap="round" stroke-width="2"/></svg>';
	$faqs_html = '';
	$i = 1;
	foreach ( $faqs_array as $faq ) {
			$title   = $faq['title'];
			$content = $faq['text'];
			 
			$faqs_html .= "<div class='set'>
							<a class='' href='#'>  <span class='faq_title'>$title</span> <span class='toggle-btn'>$btn</span></a>
							<div style='display: none;' class='content'>$content</div>
					 	   </div>";
			$i++;
	}
	return $faqs_html;
}

function generate_gallery_html($field) {
    $gallery_html = '';
    $gallery_car_ids = get_field($field);

    if ($gallery_car_ids) {
        $i = 1;
        $gallery_html = '';

        foreach ($gallery_car_ids as $image_id) {
            $img_small = wp_get_attachment_image($image_id, 'full', false, array('class' => 'car_image_slide'));
			 $img_small2 = wp_get_attachment_image_src($image_id, 'large');
            $img_big = wp_get_attachment_image_src($image_id, 'full');
            //$gallery_html .= "<div class='car_gallery_slide' data-src='" . $img_big[0] . "'>$img_small</div>";
			  $gallery_html .= '<a  href="'.$img_big[0].'" class="general_slide"> 
									  	<img src="'.$img_small2[0].'"/>
									  </a>';
            $i++;
        }
    }

    return $gallery_html;
}


function offer_packages($field, $id) {
	$package_html = '';
	if( have_rows($field, $id) ):
    	while( have_rows($field, $id) ): the_row(); 
			$title    = get_sub_field('title');
			$price    = get_sub_field('price');
			$subtitle = get_sub_field('subtitle');
			$atts_html = '';
			if( have_rows('attributes') ): 
				while ( have_rows('attributes') ) : the_row(); 
					$att_title    =  get_sub_field('title');
					$att_inactive =  get_sub_field('inactive');
					$atts_html .= "<div class='general_tyle_$att_inactive'>$att_title</div>";
				endwhile; 
			endif;
			$package_html .= "<div class='package_inner'>
								<div class='package_top'>
									<h1>$title</h2>
									<h2><span>$price</span>€</h2>
									<h3>$subtitle</h3>
								
									<div class='attributes_wrapper'>
										$atts_html
										<a style='display:none;' class='more_package' href='#'>Περισσόστερα</a>
									</div>
								</div>
								<a href='#' data-price='$price' class='btn dark select_package'>Επιλογή πακέτου</a>
							  </div>";
    	endwhile; 
	endif;	
	return $package_html;
}

function newsletter_footer() {
	ob_start();
	$nl_title         = 'Newsletter';
$mail_placeholder = 'Ονοματεπώνυμο';
$terms_label      = 'Όροι Χρήσης';
$terms            = 'Αποδέχομαι τους <a style="text-decoration:underline;" target="_blank" href=" ">όρους χρήσης</a>';
$submit           = 'Αποστολή';
?>
	<div class="newsletter_form_wrapper">
	  <form name="newsletter_form" id="newsletter_form" class="newsletter_form">
		<div class="nl_icon_title">
			<div class="nl_icon_wrap">
		
				<span><?=$nl_title;?></span>
			</div>	
		</div>
		<div class="email_submit">
			<div class="nl_wrap">
				<div class="nl_input">
					<label for="newsletter_email" style="display:none"><?=$nl_title;?></label>
					<input type="email" id="newsletter_email" class="email" placeholder="<?=$mail_placeholder;?>" name="email">
				</div>
				<div class="newsletter_error"></div>	
			</div>
			
		</div>
		<div class="ch-bt">
			<div class="nl_check">
					<label class="chk_container">
						<label for="newsletter_oroi" style="display:none"><?=$terms_label;?></label>
						<input id="newsletter_oroi" type="checkbox" name="oroi" value="1">
						<span class="checkmark"></span>
						<span class="chk_text" style="display: block;text-align: left;"> <?=$terms;?> </span>
					</label>
					
					
			</div>  
			<div class="nl_submit"><button class='submit_nl submit_newsletter button-hover' type="submit"  value="ΥΠΟΒΟΛΗ">ΥΠΟΒΟΛΗ</button> </div>
	  </div>
<div class="newsletter_success"></div>

	  </form>
	</div>

<?php
		$output = ob_get_clean();
		return $output;
}
add_shortcode('display_newsletter_footer','newsletter_footer');

function social() {
	ob_start();
	$fb = '<svg xmlns="http://www.w3.org/2000/svg" width="10.608" height="21.215" viewBox="0 0 10.608 21.215">
  <path id="facebook" d="M14.858,3.523H16.8V.149A25.007,25.007,0,0,0,13.974,0C11.181,0,9.268,1.756,9.268,4.985V7.956H6.187v3.771H9.268v9.489h3.778V11.728H16l.469-3.771H13.045v-2.6c0-1.09.294-1.836,1.813-1.836Z" transform="translate(-6.187)" fill="#fff"/>
</svg>';
	$ig = '<svg xmlns="http://www.w3.org/2000/svg" width="20.854" height="20.856" viewBox="0 0 20.854 20.856">
  <path id="instagram" d="M10.633,20.857h-.208c-1.635,0-3.145-.038-4.614-.127a6.168,6.168,0,0,1-3.555-1.346,5.707,5.707,0,0,1-1.918-3.1,13.72,13.72,0,0,1-.315-3.276C.013,12.251,0,11.349,0,10.431S.013,8.608.024,7.846A13.721,13.721,0,0,1,.339,4.57a5.707,5.707,0,0,1,1.918-3.1A6.168,6.168,0,0,1,5.811.129C7.28.039,8.791,0,10.429,0s3.145.038,4.614.127A6.168,6.168,0,0,1,18.6,1.474a5.706,5.706,0,0,1,1.918,3.1,13.72,13.72,0,0,1,.315,3.276c.011.761.021,1.664.024,2.581v0c0,.917-.013,1.82-.024,2.581a13.713,13.713,0,0,1-.315,3.276,5.706,5.706,0,0,1-1.918,3.1,6.168,6.168,0,0,1-3.555,1.346c-1.407.086-2.852.127-4.41.127Zm-.208-1.63c1.608,0,3.085-.037,4.519-.124a4.488,4.488,0,0,0,2.625-.982,4.114,4.114,0,0,0,1.369-2.236,12.482,12.482,0,0,0,.264-2.9c.01-.756.021-1.652.023-2.561s-.013-1.8-.023-2.561a12.484,12.484,0,0,0-.264-2.9,4.114,4.114,0,0,0-1.369-2.236,4.489,4.489,0,0,0-2.625-.982c-1.434-.087-2.911-.128-4.515-.124s-3.085.037-4.519.124a4.489,4.489,0,0,0-2.625.982A4.114,4.114,0,0,0,1.917,4.973a12.483,12.483,0,0,0-.264,2.9c-.01.757-.021,1.653-.023,2.563s.013,1.8.023,2.559a12.482,12.482,0,0,0,.264,2.9,4.114,4.114,0,0,0,1.369,2.236A4.489,4.489,0,0,0,5.91,19.1C7.345,19.191,8.822,19.232,10.425,19.228Zm-.039-3.707a5.092,5.092,0,1,1,5.092-5.092A5.1,5.1,0,0,1,10.387,15.521Zm0-8.554a3.462,3.462,0,1,0,3.462,3.462A3.466,3.466,0,0,0,10.387,6.967Zm5.662-3.259A1.222,1.222,0,1,0,17.27,4.93,1.222,1.222,0,0,0,16.048,3.708Zm0,0" transform="translate(0 -0.001)" fill="#fff"/>
</svg>';
$tw = '<svg xmlns="http://www.w3.org/2000/svg" width="21.197" height="21.215" viewBox="0 0 21.197 21.215">
  <path id="X_logo_2023_original" d="M12.617,8.984,20.51,0H18.64L11.784,7.8,6.313,0H0L8.276,11.795,0,21.215H1.87L9.1,12.977l5.78,8.238H21.2M2.544,1.381H5.417L18.639,19.9H15.766" fill="#fff"/>
</svg>';
$yt = '<svg xmlns="http://www.w3.org/2000/svg" width="25.432" height="17.805" viewBox="0 0 25.432 17.805">
  <path id="youtube_1_2" data-name="youtube(1)2" d="M24.906-3.3a3.186,3.186,0,0,0-2.241-2.241c-1.99-.544-9.95-.544-9.95-.544s-7.96,0-9.95.524A3.248,3.248,0,0,0,.524-3.3,33.57,33.57,0,0,0,0,2.821,33.446,33.446,0,0,0,.524,8.937a3.187,3.187,0,0,0,2.241,2.241c2.01.544,9.95.544,9.95.544s7.96,0,9.95-.524a3.186,3.186,0,0,0,2.241-2.241,33.58,33.58,0,0,0,.523-6.117A31.866,31.866,0,0,0,24.9-3.3ZM10.181,6.633V-.992L16.8,2.821Zm0,0" transform="translate(0.001 6.082)" fill="#fff"/>
</svg>';
$tt = '<svg xmlns="http://www.w3.org/2000/svg" width="19.132" height="23.254" viewBox="0 0 19.132 23.254">
  <path id="Path_15422" data-name="Path 15422" d="M1824.97,84.52c0,2.7.014,5.3,0,7.9a7.252,7.252,0,0,1-6.114,7.334,6.971,6.971,0,0,1-7.181-2.93,6.863,6.863,0,0,1-.4-7.956,6.957,6.957,0,0,1,6.833-3.648c.363.02.546.1.537.509-.022,1.042-.024,2.086,0,3.128.011.451-.152.445-.534.392a3.3,3.3,0,0,0-1.25,6.482,3.293,3.293,0,0,0,3.937-2.366,3.575,3.575,0,0,0,.094-1.058c0-4.939.012-9.878-.011-14.818,0-.616.117-.817.792-.847,1.33-.059,2.267.007,2.839,1.624a4.708,4.708,0,0,0,4.266,2.992c.428.041.553.158.546.577-.022,1.262-.017,2.524,0,3.787,0,.412-.048.558-.544.471a10.768,10.768,0,0,1-3.81-1.569" transform="translate(-1810.195 -76.625)" fill="#fefefe"/>
</svg>';
 
	?>

	<div class="social_wrapper">
		<div class="social_inner">
			<a href="https://www.instagram.com/lambertsgreece/" target="_blank"><?=$ig;?></a>
			<a href="https://www.facebook.com/LambertsGreece/" target="_blank"><?=$fb;?></a>
			<a href="https://x.com/LambertsGreece" target="_blank"><?=$tw;?></a>
			<a href="https://www.youtube.com/user/greenimportgr" target="_blank"><?=$yt;?></a>
			<a href="https://www.tiktok.com/@lambertsgreece?lang=en" target="_blank"><?=$tt;?></a>
		</div>
	</div>
	<?php
	$output = ob_get_clean();
	return $output;	
}
add_shortcode('display_social','social');


function page_outside_content(){
	do_action('page_outside_content');	
}
function pages_outside_action(){
	 
}
add_action('page_outside_content','pages_outside_action',1);
 
 


function produc_cats() {   
  $taxonomy     = 'product_cat';
  $orderby      = 'menu_order';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 1;

  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty,
	     'exclude' => array($GLOBALS['ETISIA']),
  );
 $all_categories = get_categories( $args );
 $arrow = $GLOBALS['ARROW_CATS'];	
 $main_cats = '';
	
	$show_more = 'Δείτε τα όλα';
	
	foreach ($all_categories as $cat) {
		if($cat->category_parent == 0) {
			$category_id = $cat->term_id;       

			$cat_link = get_term_link($cat->slug, 'product_cat');
			$cat_name = $cat->name;
			$color =  get_field('category_color',$cat);
			$main_cats .= "<div class='main_cat_box'>
							  <a class='main_cat_link' href='$cat_link'>	 
								<div class='main_cat_title'>$cat_name</div>
							  </a>";

			$main_cats .= child_cats($category_id);
			$main_cats .= "<a class='btn dark' href='$cat_link'>$show_more</a>";				
			$main_cats .= '</div>';

		}       
	}
 
	echo "<div class='prod_cats_wrapper'>$main_cats</div>";

 
 
}

function child_cats($category_id) {
	  $taxonomy     = 'product_cat';
	  $orderby      = 'name';  
	  $show_count   = 0;      // 1 for yes, 0 for no
	  $pad_counts   = 0;      // 1 for yes, 0 for no
	  $hierarchical = 1;      // 1 for yes, 0 for no  
	  $title        = '';  
	  $empty        = 0;
	  $arrow = $GLOBALS['ARROW_CATS'];
	
	
	
	$args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $sub_cats = get_categories( $args2 );
		$sub_cats_html = '';
	
 
			if($sub_cats) {
				$i=0;
				foreach($sub_cats as $sub_category) {
					 
						$sub_category_id = $sub_category->term_id;       
						$parent_url = get_term_link( $category_id );
						$modified_url = add_query_arg( '_product_categories', $sub_category->slug, $parent_url );

						$sub_cats_html .= '<li><a href="'. $modified_url .'">'. $sub_category->name .  $arrow . ' </a>';
						 
						$sub_cats_html .='</li>';
						$i++;	
					 

				}   
			}
 
	return "<ul>$sub_cats_html</ul>";
}



function hardcopy_password()
{
    ob_start();
    echo
     "<div class='status-display'></div>
	 <div class='pdf-link' style='display:none;'>Διαβάστε την τελευταία εκδοση του βιβλίου μας πατώντας <a href='https://lamberts.gr/book-neutraceuticals-online-edition.pdf' target='_blank'>εδώ</a> </div>
	 <form method='post' action='' id='unique_code_form' novalidate>
     <div id='password-field' class='password-field'>
        <label for='number'>ΕΙΣΑΓΕΤΕ ΤΟΝ ΚΩΔΙΚΟ ΓΙΑ ΤΗΝ ΗΛΕΚΤΡΟΝΙΚΗ ΕΚΔΟΣΗ ΤΟΥ ΒΙΒΛΙΟΥ</label>
        <input type='number' placeholder='Κωδικός Βιβλίου' name='number' id='number' />
        <div class='err-dspl'></div>
        <div class='psd-submit'>
            <input type='submit' value='ΥΠΟΒΟΛΗ' id='submit'/>
        </div>
    </div>
   </form>
   <div class='success-msg'></div>
    <form method='post' action='' id='additional-fields' style='display:none;' accept-charset='UTF-8'  novalidate>
    <div class='additional-fields'>
	   <input type='number' name='hidden-psd' id='hidden-psd' style='visibility:hidden;' />
	   <div class='pair-block-one'>
	   <div class='name-block'>
        <label for='name'>Όνομα</label>
        <input type='text' name='name' id='name'/>
		 <div class='nameError'></div>
		</div>
		<div class='lname-block'>
        <label for='last-name'>Επίθετο</label>
        <input type='text' name='last-name' id='last-name'/>
		<div class='lastNameError'></div>
		</div>
	   </div>
	   <div class='pair-block-two'>
	   <div class='prof-block'>
        <label for='profession'>Ιδιότητα</label>
        <input type='text' name='profession' id='profession'/>
		  <div class='professionError'></div>
		</div>
		<div class='mail-block'>
        <label for='mail'>Email</label>
        <input type='email' name='mail' id='mail'/>
		<div class='emailError'></div>
		</div>
		</div>
    </div>
    <div class='additional-submit'>
        <input type='submit' value='Καταχώρηση' id='additional-submit'/>
    </div>
    </form>";
    $output = ob_get_clean();
    return $output;
	
}
add_shortcode('password_shortcode', 'hardcopy_password');




function reset_password_page(){
	ob_start();
?>

<div id="reset-password-page">
    <h2>Reset Password</h2>
    <form id="reset-password-form">
        <input type="email" name="user_login" placeholder="Enter your email" required>
        <input type="submit" value="Reset Password">
    </form>
    <div class="reset-password-message"></div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#reset-password-form').on('submit', function(e) {
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                'action': 'custom_reset_password',
                'data': data
            },
            success: function(response) {
                $('.reset-password-message').html(response.message);
            }
        });
    });
});
</script>

<style>

</style>



<?php
	$output = ob_get_clean();
	return $output;
}

add_shortcode('display_reset_password','reset_password_page');




function reset_password_confirm(){
	ob_start();
?>

<div id="reset-password-confirm-page">
    <h2>Set New Password</h2>
    <form id="reset-password-confirm-form">
        <input type="hidden" name="rp_key" value="<?php echo isset($_GET['key']) ? esc_attr($_GET['key']) : ''; ?>">
        <input type="hidden" name="rp_login" value="<?php echo isset($_GET['login']) ? esc_attr($_GET['login']) : ''; ?>">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Reset Password">
    </form>
    <div class="reset-password-confirm-message"></div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#reset-password-confirm-form').on('submit', function(e) {
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                'action': 'custom_reset_password_confirm',
                'data': data
            },
            success: function(response) {
                $('.reset-password-confirm-message').html(response.message);
                if (response.success) {
                    $('#reset-password-confirm-form')[0].reset();
                }
            }
        });
    });
});
</script>

<style>

</style>

<?php
	$output = ob_get_clean();
	return $output;
}

add_shortcode('display_reset_password_confirm','reset_password_confirm');

 
function whatapp_trip() {
	?>
	<div style="display:none;" class="whatapp_trip_wrap">
 	<a href="https://wa.me/306989518606" target="_blank" rel="noopener noreferrer">
      <img src="/wp-content/uploads/2025/05/vecteezy_whatsapp-logo-whatsapp-icon-logo-vector-free-vector_19490736_1-removebg-preview.png" alt="whatsapp">
    </a>
 	<a href="https://www.tripadvisor.com/Attraction_Review-g642168-d25129994-Reviews-Exclusive_Vip_Catamarans-Alimos_Attica.html" target="_blank">
      <img src="/wp-content/uploads/2025/04/images.png" alt="TripAdvisor">
    </a>
	</div>	
	<?php
}