<?php

$xshop_woo_layout = get_theme_mod('xshop_woo_layout', 'rightside');


if (is_active_sidebar('shop-sidebar') && $xshop_woo_layout != 'fullwidth' && !is_single()) {
    $xshop_column_set = '3';
} else {
    $xshop_column_set = '4';
}
// Number of products per page
$products_per_page = 12;

// Get the current page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Define the query arguments
$args = array(
    'post_type' => 'product',
    'posts_per_page' => $products_per_page,
    'paged' => $paged
);

// Get the products
$products = new WP_Query($args);

// Start the Loop
if ($products->have_posts()) :
    echo '<div class="woocommerce" ><ul class="products columns-' . esc_attr($xshop_column_set) . ' ?>">';
    while ($products->have_posts()) : $products->the_post();
        wc_get_template_part('content', 'product');
    endwhile;
    echo '</ul>';

    // Pagination
    echo '<nav class="woocommerce-pagination">';
    xshop_products_pagination($products->max_num_pages);
    echo '</nav></div>';
    // Reset the post data
    wp_reset_postdata();
else :
    echo '<p>' . esc_html__('No products found', 'xshop') . '</p>';
endif;
