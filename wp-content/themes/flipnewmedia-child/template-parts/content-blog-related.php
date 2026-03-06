<?php
	$category_detail = get_the_category( $post->ID );
	$cat_id          = $category_detail[0]->term_id;
	$cat_name        = get_cat_name( $cat_id );
	$category_link   = get_category_link( $cat_id );

	$category_detail = get_the_category($post->ID);
	$cats_array = array();
	foreach($category_detail as $cd) {
		$cats_array[] = $cd->term_id;
	}

	$args = array(
		'numberposts' => 4,
		'category'  => $cats_array, 
		'post_type' => 'post',
		'post_status' => 'publish',
		'exclude'      => array(get_the_id()),
		'orderby'   => 'date',
		'order'     => 'DESC',
	);
	$posts = get_posts($args);
	
	?>		
	
	<?php
	foreach($posts as $post) : setup_postdata($post); 
		get_template_part( 'template-parts/content', 'blogs' );		
	endforeach;
	wp_reset_query();
	?>