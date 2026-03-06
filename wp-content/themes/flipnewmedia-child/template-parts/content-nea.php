<?php
global $post;
$post_id = $post->ID;
$title   = get_the_title($post_id);
$link    = get_permalink($post_id);
$feat_image_lazy = get_the_post_thumbnail($post_id, 'full', ['class' => 'blog_image', 'alt' => esc_attr($title)]);

$my_post_categories = get_the_category($post_id);
$sub_cat = '';

foreach ($my_post_categories as $post_cat) {
    if ($post_cat->category_parent != 0) {
        $sub_cat = $post_cat->cat_name;
        break;
    }
}

$tags_html = '';
$tags = get_the_tags($post_id);
if ($tags) {
    foreach ($tags as $tag) {
        $tags_html = esc_html($tag->name); // Only taking the first tag
        break;
    }
}

// Define category color if needed
 $categories = get_the_category();
        $cat_slug = $categories[0]->slug; // Get the first category slug
        $cat_name = $categories[0]->name; 
 



?>

<div class="col col-md col-news mb-5">
<div class="card">
    <div class="image-container">
        <div class="image-container-overlay" style="--category-color: <?php echo esc_attr($category_color); ?>;"></div>
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php echo esc_url($link); ?>">
                <?php echo $feat_image_lazy; ?>
            </a>
           <!-- <div class="badge-overlay position-absolute text-light px-3 py-2">
                #<?php echo esc_html($cat_name); ?>
            </div>-->
        <?php endif; ?>
    </div>
    <div class="card-body">
        <p class="text-muted mb-1"><?php echo get_the_date(); ?></p>
        <h5 class="card-title pb-3">
            <a href="<?php echo esc_url($link); ?>" class="text-dark text-decoration-none">
                <?php echo esc_html($title); ?>
            </a>
        </h5>
        <a href="<?php echo esc_url($link); ?>" class="btn-blog btn-secondary">Read More</a>
    </div>
</div>
 </div>