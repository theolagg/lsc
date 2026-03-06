<?php
global $post;
$post_id = $post->ID;
$title   = get_the_title($post_id);
$link    = get_permalink($post_id);
$feat_image_lazy = get_the_post_thumbnail($post_id, 'full', ['class' => 'blog_image', 'alt' => esc_attr($title)]);

$my_post_categories = get_the_category($post_id);
$selected_category = null;
$category_color = '';

// Get the selected category from the URL
$selected_category_slug = isset($_GET['_post_category']) ? sanitize_text_field($_GET['_post_category']) : '';

// Check if the post has the selected category
foreach ($my_post_categories as $post_cat) {
    if (!empty($selected_category_slug) && $post_cat->slug === $selected_category_slug) {
        $selected_category = $post_cat;
        break;
    }
}

// If no selected category is found, find the first child category of parent ID 152
if (!$selected_category) {
    foreach ($my_post_categories as $post_cat) {
        if ($post_cat->parent == 3) {
            $selected_category = $post_cat;
            break;
        }
    }
}

// If no valid category is found, fall back to the first available category
if (!$selected_category && !empty($my_post_categories)) {
    $selected_category = $my_post_categories[0];
}

// Get category color from ACF
if ($selected_category) {
    $category_color = get_field('category_color', 'category_' . $selected_category->term_id) ?: '#333'; // Default color fallback
    $cat_name = $selected_category->name;
} else {
    $cat_name = 'Uncategorized';
}
?>

<div class="col col-md col-news col-first mb-5">
    <div class="card">
        <a href="<?php echo esc_url($link); ?>">
            <div class="image-container position-relative">
                <div class="image-container-overlay position-absolute w-100 h-100"
                     style="background-color: <?php echo esc_attr($category_color); ?>;"></div>
                <?php if (has_post_thumbnail()) : ?>
                    <?php echo $feat_image_lazy; ?>
                    <div class="image-overlay position-absolute"></div>
                    <div class="badge-overlay position-absolute text-light px-3 py-2">
                        <span class="badge px-2 py-1">
                            #<?php echo esc_html($cat_name); ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </a>
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
