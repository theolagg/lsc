<?php

global  $product;


$hero_image = get_field('hero-image');
$hero_image_url = $hero_image ? esc_url($hero_image['url']) : '';

?>

<article class="single_product " data-postid="<?php the_ID(); ?>"  id="post-<?php the_ID(); ?>">

<div class="container-hero" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">
    <div class="container m-auto pt-10">
        <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
    <div class="container m-auto pt-10">
        <div class="row">
            <div class="col text-center">
                <h1 class=""><?php the_title(); ?><span>.</span></h1>
				<?php echo  whatapp_trip(); ?>
            </div>
        </div>
    </div>
</div>

<div class="subnav-wrapper ">
    <nav class="product-subnav container">
        <ul>
            <li><a href="#highlights">Highlights</a></li>
            <li><a href="#description">Description</a></li>
            <li><a href="#specifications">Specifications</a></li>
            <li><a href="#our-crew">Our Crew</a></li>
            <li><a href="#sample-menu">Sample Menu</a></li>
            <li><a href="#water-toys">Water Toys</a></li>
        </ul>
    </nav>
</div>



<section id="highlights" class="yacht-highlights-section ">
    <div class="highlights-wrapper">
        <div class="highlights-left">
            <p class="yacht-specs"><?php the_field('yacht_specs'); ?></p>
            <div class="yacht-intro">
                <?php the_field('yacht_intro_text'); ?>
            </div>

            <h3 class="highlight-title">Yacht highlights</h3>

           <div class="highlight-items">
    <?php if( have_rows('yacht_highlights') ): ?>
        <?php $index = 0; ?>
        <?php while( have_rows('yacht_highlights') ): the_row(); 
            $icon = get_sub_field('highlight_icon');
            $title = get_sub_field('highlight_title');
            $desc = get_sub_field('highlight_description');
            $index++;
        ?>
            <div class="highlight-item <?php echo ($index > 4) ? 'hidden-highlight' : ''; ?>">
                <?php if ($icon): ?>
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="highlight-icon" />
                <?php endif; ?>
                <div class="highlight-texts">
                    <strong><?php echo esc_html($title); ?></strong>
                    <p><?php echo esc_html($desc); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

        <div class="view-more">
    <a href="javascript:void(0);" id="view-more-button">
        View more
        <span class="arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-126.svg"></span>
    </a>
</div>
        </div>
        <div class="highlights-right">
    <?php if( have_rows('yacht_gallery_slides') ): ?>
    <div class="yacht-gallery-slider">
        <?php while( have_rows('yacht_gallery_slides') ): the_row();
            $img_left = get_sub_field('slide_image_left');
            $img_top = get_sub_field('slide_image_top_right');
            $img_bottom = get_sub_field('slide_image_bottom_right');
        ?>
        <div class="gallery-slide">
            <div class="gallery-left">
                <?php if ($img_left): ?>
                    <a href="<?php echo esc_url($img_left['url']); ?>" class="glightbox" data-gallery="yacht-gallery">
                        <img src="<?php echo esc_url($img_left['url']); ?>" alt="">
                    </a>
                <?php endif; ?>
            </div>
            <div class="gallery-right">
                <div class="top-img">
                    <?php if ($img_top): ?>
                        <a href="<?php echo esc_url($img_top['url']); ?>" class="glightbox" data-gallery="yacht-gallery">
                            <img src="<?php echo esc_url($img_top['url']); ?>" alt="">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="bottom-img">
                    <?php if ($img_bottom): ?>
                        <a href="<?php echo esc_url($img_bottom['url']); ?>" class="glightbox" data-gallery="yacht-gallery">
                            <img src="<?php echo esc_url($img_bottom['url']); ?>" alt="">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
			
        </div>
		
        <?php endwhile; ?>
		
    </div>
<?php endif; ?>
<div class="row mt-2">
<div class="col-6">
<div class="custom-dots-container custom-dots-7"></div>
        </div>
		<div class="col-6 icons-gal">
<img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/04/Group-122.svg">
<img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/04/Group-180.svg">
<img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/04/Group-182.svg">
        </div>
		
		
		</div>
		 </div>
    </div>
</section>

<section  class="yacht-description-section container">
    <div class="desc-container">
        <div class="desc-left">
            <!-- Video Carousel -->
           <?php if ( have_rows('yacht_videos') ): ?>
    <h2 class="highlight-title" >Yacht Videos</h2>
    <div class="video-carousel">
        <?php while ( have_rows('yacht_videos') ): the_row(); 
            $video_url = get_sub_field('video_url'); 
        ?>
            <div class="video-slide">
                <?php 
                // If it's a local file (MP4), use wp_video_shortcode
                if ( $video_url ) {
                    echo wp_video_shortcode( array( 'src' => $video_url ) );
                }
                ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
<div class="custom-dots-container custom-dots-6"></div>

            <!-- Description Text -->
			
			
            <div id="description" class="yacht-full-description">
			<h2 class="highlight-title">Description</h2>
                <?php the_field('yacht_description_text'); ?>
            </div>

            <!-- Interior Bento Carousel -->
       <?php if( have_rows('interior_gallery') ): ?>
	   <div class="row justify-between items-center mt-8">
    <h2 class="highlight-title" >Interior</h2>
	<div class="custom-dots-container custom-dots-5"></div>
	
	</div>
    <div class="bento-slider interior">
        <?php while( have_rows('interior_gallery') ): the_row(); ?>
            <div class="bento-slide">
                <?php
                $images = [];
                for ($i = 1; $i <= 6; $i++) {
                    $img = get_sub_field("image_$i");
                    $images[] = $img ? $img : '';
                }
                ?>
                <div class="bento-layout">
                    <div class="row-1-outer">
                        <div class="col-1">
                            <?php if ($images[0]): ?>
                                <a href="<?php echo esc_url($images[0]['url']); ?>" class="glightbox" data-gallery="interior-gallery">
                                    <img src="<?php echo esc_url($images[0]['url']); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-2">
                            <div class="row-inner">
                                <div class="col-leftt">
                                    <?php if ($images[1]): ?>
                                        <a href="<?php echo esc_url($images[1]['url']); ?>" class="glightbox" data-gallery="interior-gallery">
                                            <img src="<?php echo esc_url($images[1]['url']); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-rightt">
                                    <?php if ($images[2]): ?>
                                        <a href="<?php echo esc_url($images[2]['url']); ?>" class="glightbox" data-gallery="interior-gallery">
                                            <img src="<?php echo esc_url($images[2]['url']); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row-inner full-width">
                                <?php if ($images[3]): ?>
                                    <a href="<?php echo esc_url($images[3]['url']); ?>" class="glightbox" data-gallery="interior-gallery">
                                        <img src="<?php echo esc_url($images[3]['url']); ?>" alt="">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row-1-outer">
                        <div class="col-leftt two-thirds">
                            <?php if ($images[4]): ?>
                                <a href="<?php echo esc_url($images[4]['url']); ?>" class="glightbox" data-gallery="interior-gallery">
                                    <img src="<?php echo esc_url($images[4]['url']); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-rightt one-third">
                            <?php if ($images[5]): ?>
                                <a href="<?php echo esc_url($images[5]['url']); ?>" class="glightbox" data-gallery="interior-gallery">
                                    <img src="<?php echo esc_url($images[5]['url']); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

            <!-- Our Crew Section -->
            <?php if( have_rows('crew_members') ): ?>
    <h2 id="our-crew" class="mt-10 highlight-title">Our Crew</h2>
    <div class="crew-list">
        <?php while( have_rows('crew_members') ): the_row();
            $image = get_sub_field('crew_image');
            $position = get_sub_field('crew_position');
            $name = get_sub_field('crew_name');
            $bio = get_sub_field('crew_bio');
            $short = get_sub_field('crew_bio_collapsed');
        ?>
            <div class="crew-member">
                <?php if ($image): ?>
			 <div class="crew-image">
                    <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-gallery="crew-gallery" title="<?php echo esc_attr($name); ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($name); ?>" />
                    </a>
					</div>
                <?php endif; ?>
				<div class="crew-details">
                <h4><?php echo esc_html($position); ?></h4>
                <h5><?php echo esc_html($name); ?></h5>
                <div class="crew-bio-short"><?php echo esc_html($short); ?></div>
                <div class="crew-bio-full" style="display:none;"><?php echo $bio; ?></div>
                <a href="javascript:void(0);" class="toggle-crew">View more <span class="arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-126.svg"></span></a>
				</div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
			
<?php //<!-- 						<img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/04/Path-184.svg">  --> ?>
<div id="specifications" class="specs">
    <!-- Detailed Specifications -->
    <h2 class="highlight-title" >Detailed Specifications</h2>
	
	 
     <div class="specs-list">
		<?php if( have_rows('detailed_specs_left') ): ?>
		 	<div class="specs_wrap spec_part_1">
				<h3 class="highlight-subtitle spec_title" >Characteristics</h3>
				<ul class="spec_list specs_char" id="specs-left">
					<?php while( have_rows('detailed_specs_left') ): the_row(); ?>
						<li><strong><?php the_sub_field('title'); ?></strong><br> <span><?php the_sub_field('item'); ?></span></li>
					<?php endwhile; ?>
				</ul>
			</div>	
		<?php  endif; ?>
		<?php if( have_rows('detailed_specs_right') ): ?>
		 	<div class="specs_wrap spec_part_2">
				<h3 class="highlight-subtitle spec_title" >Capacity and layout</h3>
				<ul class="spec_list specs_char" id="specs-left">
					<?php while( have_rows('detailed_specs_right') ): the_row(); ?>
						<li><strong><?php the_sub_field('title'); ?></strong><br> <span><?php the_sub_field('item'); ?></span></li>
					<?php endwhile; ?>
				</ul>
			</div>	
		<?php  endif; ?>
		<?php if( have_rows('specifications_comfort_amenities') ): ?>
		 	<div class="specs_wrap spec_part_3">
				<h3 class="highlight-subtitle spec_title" >Comfort & Amenities</h3>
				<ul class="spec_list specs_char" id="specs-left">
					<?php while( have_rows('specifications_comfort_amenities') ): the_row(); ?>
						<li><strong><?php the_sub_field('title'); ?></strong><br> <span><?php the_sub_field('item'); ?></span></li>
					<?php endwhile; ?>
				</ul>
			</div>	
		<?php  endif; ?>
    </div>
	<button id="loadMoreSpecs" style="display:block;">
	  View More  <span class="arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-126.svg"></span>
	</button>
     
</div>
            <!-- Sample Menu Bento -->
           <?php if( have_rows('sample_menu_gallery') ): ?>
    
	   <div class="row justify-between items-center mt-8">
   <h2 class="highlight-title" >Sample Menu</h2>
	<div class="custom-dots-container custom-dots-4"></div>
	
	</div>
	
	
    <div id="sample-menu" class="bento-slider sample-menu">
        <?php while( have_rows('sample_menu_gallery') ): the_row(); ?>
            <div class="bento-slide">
                <?php
                $images = [];
                for ($i = 1; $i <= 6; $i++) {
                    $img = get_sub_field("image_$i");
                    $images[] = $img ? $img : '';
                }
                ?>
                <div class="bento-layout">
                    <div class="row-1-outer">
                        <div class="col-1">
                            <?php if ($images[0]): ?>
                                <a href="<?php echo esc_url($images[0]['url']); ?>" class="glightbox" data-gallery="sample-menu-gallery">
                                    <img src="<?php echo esc_url($images[0]['url']); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-2">
                            <div class="row-inner">
                                <div class="col-leftt">
                                    <?php if ($images[1]): ?>
                                        <a href="<?php echo esc_url($images[1]['url']); ?>" class="glightbox" data-gallery="sample-menu-gallery">
                                            <img src="<?php echo esc_url($images[1]['url']); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-rightt">
                                    <?php if ($images[2]): ?>
                                        <a href="<?php echo esc_url($images[2]['url']); ?>" class="glightbox" data-gallery="sample-menu-gallery">
                                            <img src="<?php echo esc_url($images[2]['url']); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row-inner full-width">
                                <?php if ($images[3]): ?>
                                    <a href="<?php echo esc_url($images[3]['url']); ?>" class="glightbox" data-gallery="sample-menu-gallery">
                                        <img src="<?php echo esc_url($images[3]['url']); ?>" alt="">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row-1-outer">
                        <div class="col-leftt two-thirds">
                            <?php if ($images[4]): ?>
                                <a href="<?php echo esc_url($images[4]['url']); ?>" class="glightbox" data-gallery="sample-menu-gallery">
                                    <img src="<?php echo esc_url($images[4]['url']); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-rightt one-third">
                            <?php if ($images[5]): ?>
                                <a href="<?php echo esc_url($images[5]['url']); ?>" class="glightbox" data-gallery="sample-menu-gallery">
                                    <img src="<?php echo esc_url($images[5]['url']); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

        

        <!-- Sticky Right Column -->
       
   




        <!-- Left Column -->
      
             <div class="row-wt">
            <!-- Title & Description -->
            <h2 class="highlight-title" >Water Toys</h2>
            <p><?php the_field('water_toys_description'); ?></p>
</div>
         <?php
// Fetch the entire repeater as an array
$water_toys = get_field('water_toys_tabs'); 
if( $water_toys ):
?>
<div class="water-toys-tabs">

    <!-- 1) Tab Buttons -->
    <div class="water-toys-button-row">
        <?php foreach( $water_toys as $index => $toy_tab ): ?>
            <?php 
                // Tab image for the button
                $tab_img = $toy_tab['tab_image']; 
            ?>
            <div class="water-toys-button <?php echo ($index === 0) ? 'active' : ''; ?>" 
                 data-wt-tab="<?php echo $index; ?>">
                <?php if (!empty($tab_img)): ?>
                    <img src="<?php echo esc_url($tab_img['url']); ?>" alt="Tab" />
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- /water-toys-button-row -->

    <!-- 2) Tab Content / Sliders -->
    <div class="water-toys-content-row">
        <?php foreach( $water_toys as $index => $toy_tab ): ?>
            <div class="water-toys-content" 
                 data-wt-content="<?php echo $index; ?>" 
                 style="<?php echo ($index === 0) ? 'display:block;' : 'display:none;'; ?>">

                <!-- This slider container will be initialized by Slick -->
                <div class="toys-slider toys-slider-<?php echo $index; ?>">

                    <?php 
                    // Each tab has its own 'tab_slides' sub-repeater
                    if(!empty($toy_tab['tab_slides'])):
                        foreach($toy_tab['tab_slides'] as $slide):
                            $img_top_left  = $slide['image_top_left'];
                            $img_top_right = $slide['image_top_right'];
                            $img_bottom    = $slide['image_bottom_full'];
                    ?>
                            <div class="slide">
                                <div class="slide-top">
                                    <div class="slide-top-left">
                                        <?php if ($img_top_left): ?>
                                            <a href="<?php echo esc_url($img_top_left['url']); ?>" 
                                               class="glightbox" 
                                               data-gallery="water-toys-gallery-<?php echo $index; ?>">
                                                <img src="<?php echo esc_url($img_top_left['url']); ?>" alt="">
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="slide-top-right">
                                        <?php if ($img_top_right): ?>
                                            <a href="<?php echo esc_url($img_top_right['url']); ?>" 
                                               class="glightbox" 
                                               data-gallery="water-toys-gallery-<?php echo $index; ?>">
                                                <img src="<?php echo esc_url($img_top_right['url']); ?>" alt="">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div><!-- .slide-top -->

                                <div class="slide-bottom">
                                    <div class="slide-bottom-col">
                                        <?php if ($img_bottom): ?>
                                            <a href="<?php echo esc_url($img_bottom['url']); ?>" 
                                               class="glightbox" 
                                               data-gallery="water-toys-gallery-<?php echo $index; ?>">
                                                <img src="<?php echo esc_url($img_bottom['url']); ?>" alt="">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div><!-- .slide-bottom -->
                            </div><!-- .slide -->
                    <?php
                        endforeach; 
                    endif; // end if tab_slides
                    ?>
                </div><!-- .toys-slider -->

            </div><!-- .water-toys-content -->
        <?php endforeach; ?>
    </div><!-- .water-toys-content-row -->

</div><!-- .water-toys-tabs -->
<?php endif; // end if $water_toys ?>
<div class=" custom-dots-container custom-dots-2"></div>



            <!-- Yacht Location -->
            <h2 class="highlight-title mt-9" ><?php the_field('yacht_location_title'); ?></h2>
         <div class="yacht-location-map">
    <?php 
    $map_code = get_field('yacht_location_map_embed');
    echo $map_code; // or echo wp_kses_post($map_code);
    ?>
</div>

            <!-- Guestbook -->
		<?php
// Retrieve repeater field 'guestbook_slides' with subfields 'slide_title' and 'slide_images'
if( have_rows('guestbook_slides') ): ?>

    <div class="guestbook-slider">
        <?php while( have_rows('guestbook_slides') ): the_row();
            // Get dynamic slide title and images
            $title  = get_sub_field('slide_title');
            $images = get_sub_field('slide_images'); // expects a gallery field
            
            if( $images ): ?>
            <div class="guestbook-slide">
                <!-- Dynamic highlighted title -->
                <h2 class="highlight-title"><?php echo esc_html( $title ); ?></h2>
                <div class="guestbook-grid">
                    <?php foreach( $images as $image ): ?>
                        <a href="<?php echo esc_url( $image['url'] ); ?>" class="glightbox" data-gallery="guestbook-gallery">
                            <img src="<?php echo esc_url( $image['sizes']['medium'] ?: $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; endwhile; ?>
    </div>

<?php endif; ?>


   </div>
       
    



  <div id="request-offer" class="water-toys-right sticky-sidebar">



<div>
   <?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

<?php /*
        // Print any WC notices (errors, “added to cart”, coupon messages, etc.)
        if ( function_exists('wc_print_notices') ) {
            wc_print_notices();
        } */
    ?>
   
</div>
</div>

</section>

<?php $home_id = 19; ?>

<div class="testimonials-outer" >
    <div class="testimonials-section container mt-8" style="background-image:url('<?php echo esc_url(get_field('section_image', $home_id)); ?>')">
        <div class="row">
            <!-- Left Column -->
            <div class="col-left">
                <?php if( get_field('testimonials_subtitle', $home_id) ): ?>
                    <h4 class="title-gold pb-2"><?php echo get_field('testimonials_subtitle', $home_id); ?></h4>
                <?php endif; ?>

                <?php if( get_field('testimonials_title', $home_id) ): ?>
                    <h2 class="title-black"><?php echo get_field('testimonials_title', $home_id); ?><span>.</span></h2>
                <?php endif; ?>

                <?php if( have_rows('testimonial_tabs', $home_id) ): ?>
                    <div class="testimonial-tabs-buttons">
                        <?php $tab_index = 0; ?>
                        <?php while( have_rows('testimonial_tabs', $home_id) ): the_row(); ?>
                            <?php $tab_button_label = get_sub_field('tab_button_label'); ?>
                            <button class="tab-button" data-tab="<?php echo $tab_index; ?>">
                                <?php echo esc_html($tab_button_label); ?>
                            </button>
                            <?php $tab_index++; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
				<?php
				//45 alice
				//30 elvira
				$product_id = $product->get_id();
				$total_comments = 0;
				if($product_id==521) { //alice
					$total_comments = 45;
				}
				else if($product_id==584) { //elivira
					$total_comments = 30;
				}
				?>
                <div class="comments">
                    <p class="grade">5.0</p>
                    <p class="count"><?=$total_comments;?> <br> comments</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-right">
                <?php if( have_rows('testimonial_tabs', $home_id) ): ?>
                    <?php $tab_index = 0; ?>
                    <?php while( have_rows('testimonial_tabs', $home_id) ): the_row(); ?>
                        <div class="testimonial-slider-wrapper" data-tab-content="<?php echo $tab_index; ?>" style="<?php echo $tab_index === 0 ? '' : 'display:none;'; ?>">
                            <?php if( have_rows('tab_testimonials') ): ?>
                                <div class="testimonial-slider">
                                    <?php while( have_rows('tab_testimonials') ): the_row(); ?>
                                        <div class="testimonial-slide">
                                            <div class="slide-row icon-stars">
                                                <?php if( get_sub_field('testimonial_icon') ): ?>
                                                    <div class="testimonial-icon">
                                                        <img src="<?php the_sub_field('testimonial_icon'); ?>" alt="Icon">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if( get_sub_field('testimonial_stars') ): ?>
                                                    <div class="testimonial-stars">
                                                        <?php 
                                                        $stars = get_sub_field('testimonial_stars');
                                                        for($i = 0; $i < $stars; $i++){
                                                            echo '<span class="star">&#9733;</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="slide-row testimonial-title">
                                                <h3><?php the_sub_field('testimonial_title'); ?></h3>
                                            </div>
                                            <div class="slide-row testimonial-date">
                                                <span><?php the_sub_field('testimonial_date'); ?></span>
                                            </div>
                                            <div class="slide-row testimonial-text">
                                                <p><?php the_sub_field('testimonial_text'); ?></p>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $tab_index++; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>




<section class="follow-on-instagram my-10">
<div class="row">
<div class="col d-flex justify-center items-center">
<a href="https://www.instagram.com/Exclusive_Vip_Catamarans/" target="_blank" class=" d-flex justify-center items-center" > <img class="inst-image" src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/04/Group-152.svg"> <p> FOLLOW US IN INSTAGRAM </p></a> 
</div>
</div>
</section>

</article>

<!-- #post-<?php the_ID(); ?> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const viewMoreBtn = document.getElementById('view-more-button');
    const hiddenHighlights = document.querySelectorAll('.hidden-highlight');

    viewMoreBtn.addEventListener('click', function() {
        let count = 0;
        hiddenHighlights.forEach((item) => {
            if (item.style.display !== 'flex' && count < 5) {
                item.style.display = 'flex'; // match layout from .highlight-item
                count++;
            }
        });

        // If no more are hidden, hide the button
        const remaining = Array.from(hiddenHighlights).filter(i => i.style.display !== 'flex');
        if (remaining.length === 0) {
            viewMoreBtn.style.display = 'none';
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    jQuery('.yacht-gallery-slider').slick({
        infinite: true,
        arrows: true,
		prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
        dots: true,
		 appendDots: '.custom-dots-7', // or jQuery('.custom-dots-container')
    });
});


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-crew').forEach(button => {
        button.addEventListener('click', function() {
            const fullBio = this.previousElementSibling;
            if (fullBio.style.display === 'none' || fullBio.style.display === '') {
                fullBio.style.display = 'block';
                this.innerHTML = 'View less <span class="arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-386.svg"></span>';
            } else {
                fullBio.style.display = 'none';
                this.innerHTML = 'View more <span class="arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-126.svg"></span>';
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Yacht Videos
    jQuery('.video-carousel').slick({
        dots: true,
		 appendDots: '.custom-dots-6', // or jQuery('.custom-dots-container')
        arrows: true,
		prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true
    });

    // Interior Bento Slider
    jQuery('.bento-slider.interior').slick({
        dots: true,
		 appendDots: '.custom-dots-5', // or jQuery('.custom-dots-container')
        arrows: true,
		prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });

    // Sample Menu Bento Slider
    jQuery('.bento-slider.sample-menu').slick({
        dots: true,
		 appendDots: '.custom-dots-4', // or jQuery('.custom-dots-container')
        arrows: true,
		prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const lightbox = GLightbox({
        selector: '.glightbox'
    });
});

jQuery(document).ready(function($){

    // Hide all slider wrappers except the first one on page load.
    $('.testimonial-slider-wrapper').hide();
    $('.testimonial-slider-wrapper').first().show();

    // Optionally, set an active class on the first tab button.
    $('.tab-button').removeClass('active');
    $('.tab-button').first().addClass('active');

    // Function to apply custom class to every second slide's inner card.
    function applyEvenClass(slick) {
        slick.$slides.not('.slick-cloned').each(function(index) {
            // Remove the class first to avoid duplicates.
            $(this).find('.testimonial-slide').removeClass('even-slide');
            // Add the class to every second slide (index+1 for 1-based counting).
            if ((index + 1) % 2 === 0) {
                $(this).find('.testimonial-slide').addClass('even-slide');
            }
        });
    }

    // Bind events so that every time the slider is initialized or changed, we update classes.
    $('.testimonial-slider').on('init reInit afterChange', function(event, slick) {
        applyEvenClass(slick);
    });

    // Initialize slick slider for the currently visible slider wrapper (first tab).
    $('.testimonial-slider-wrapper:visible .testimonial-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
		infinite: false,
        arrows: true,
		prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // When a tab button is clicked, update the slider.
    $('.tab-button').on('click', function(){
        var tabIndex = $(this).data('tab');

        // Remove active class from all tab buttons and add it to the clicked one.
        $('.tab-button').removeClass('active');
        $(this).addClass('active');

        // Unslick any existing slider and hide all slider wrappers.
        $('.testimonial-slider-wrapper').each(function(){
            var $slider = $(this).find('.testimonial-slider');
            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }
            $(this).hide();
        });

        // Show the selected slider wrapper and initialize its slider.
        var $selectedWrapper = $('.testimonial-slider-wrapper[data-tab-content="'+ tabIndex +'"]');
        $selectedWrapper.show();
        $selectedWrapper.find('.testimonial-slider').slick({
            slidesToShow: 2,
			infinite: false,
            slidesToScroll: 1,
            dots: true,
           arrows: true,
		prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    

    jQuery('.guestbook-slider').slick({
        dots: true,
		 appendDots: '.custom-dots-1', // or jQuery('.custom-dots-container')
        arrows: true,
		 prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
        infinite: false,
        slidesToShow: 1
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Select water-toys tab buttons & contents
    const wtButtons  = document.querySelectorAll('.water-toys-button');
    const wtContents = document.querySelectorAll('.water-toys-content');

    // Safety check
    if (!wtButtons.length || !wtContents.length) return;

    // Show the first tab by default
    wtButtons[0].classList.add('active');
    wtContents.forEach((content, idx) => {
        content.style.display = (idx === 0) ? 'block' : 'none';
    });

    // Initialize Slick on first tab
    const firstSlider = wtContents[0].querySelector('.toys-slider');
    if (firstSlider && !jQuery(firstSlider).hasClass('slick-initialized')) {
        jQuery(firstSlider).slick({
            dots: true,
			 appendDots: '.custom-dots-2', // or jQuery('.custom-dots-container')
            arrows: true,
			prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
            infinite: false,
            slidesToShow: 1
        });
    }

    // Tab click logic
    wtButtons.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            // Deactivate all
            wtButtons.forEach(b => b.classList.remove('active'));
            wtContents.forEach(content => {
                content.style.display = 'none';
                const slider = content.querySelector('.toys-slider');
                if (slider && jQuery(slider).hasClass('slick-initialized')) {
                    jQuery(slider).slick('unslick');
                }
            });

            // Activate this tab
            this.classList.add('active');
            const targetTab = wtContents[index];
            if (!targetTab) return;

            targetTab.style.display = 'block';

            // Re-initialize slick on the newly visible tab
            const newSlider = targetTab.querySelector('.toys-slider');
            if (newSlider && !jQuery(newSlider).hasClass('slick-initialized')) {
                jQuery(newSlider).slick({
                    dots: true,
					 appendDots: '.custom-dots-2', // or jQuery('.custom-dots-container')
                    arrows: true,
					prevArrow: '<button type="button" class="slick-prev custom-prev-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-11.svg" alt="Previous"></button>',
    nextArrow: '<button type="button" class="slick-next custom-next-arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-10.svg" alt="Next"></button>',
                    infinite: false,
                    slidesToShow: 1
                });
            }
        });
    });
});

// document.addEventListener("DOMContentLoaded", function() {
//   // Get the lists
//   const leftItems = document.querySelectorAll('#specs-left li');
//   const rightItems = document.querySelectorAll('#specs-right li');

//   // Hide all items after the first 3
//   leftItems.forEach((li, index) => {
//     if (index >= 3) li.style.display = 'none';
//   });
//   rightItems.forEach((li, index) => {
//     if (index >= 3) li.style.display = 'none';
//   });

//   // Keep track of how many have been revealed so far
//   let leftIndex = 3;
//   let rightIndex = 3;

//   // The button
//   const btn = document.getElementById('specs-view-more-button');
//   if (!btn) return; // safety check if no button

//   btn.addEventListener('click', function() {
//     let showCount = 0;

//     // Reveal 3 more in the left column
//     for (let i = leftIndex; i < leftItems.length; i++) {
//       if (showCount < 3) {
//         leftItems[i].style.display = 'list-item';
//         showCount++;
//       } else {
//         break;
//       }
//     }
//     leftIndex += showCount;

//     // Reset for right column
//     showCount = 0;
//     for (let i = rightIndex; i < rightItems.length; i++) {
//       if (showCount < 3) {
//         rightItems[i].style.display = 'list-item';
//         showCount++;
//       } else {
//         break;
//       }
//     }
//     rightIndex += showCount;

//     // If we've revealed all items in BOTH columns, hide the button
//     if (leftIndex >= leftItems.length && rightIndex >= rightItems.length) {
//       btn.style.display = 'none';
//     }
//   });
// });

jQuery(function($){
  var $parts = jQuery('.specs-list .specs_wrap');
  var $btn   = jQuery('#loadMoreSpecs');

  // track whether we're in "expanded" mode
  $btn.data('collapsed', false);

  // initial hide
  $parts.not('.spec_part_1').hide();

  $btn.on('click', function(e){
    e.preventDefault();

    // if button is in "show less" state, collapse back
    if ( $btn.data('collapsed') ) {
      $parts.not('.spec_part_1').slideUp(200);
      $btn
        .html('View more <span class="arrow"><img src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-126.svg"></span>')
        .data('collapsed', false);
      return;
    }

    // otherwise, reveal the next hidden part
    var $next = $parts.filter(':hidden').first();
    $next.slideDown(400);

    // if that was the last one, switch to "show less"
    if ( $parts.filter(':hidden').length === 0 ) {
      $btn
        .html('Show less <span class="arrow"><img style="transform: rotate(180deg);" src="https://exclusivevipcatamarans.com/wp-content/uploads/2025/03/Group-126.svg"></span>')
        .data('collapsed', true);
    }
  });
});


</script>