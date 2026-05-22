<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package XShop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function xshop_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'xshop_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function xshop_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'xshop_pingback_header');


if (!function_exists('xshop_is_woocommerce_activated')) {
	function xshop_is_woocommerce_activated()
	{
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			return true;
		}
		return false;
	}
}
/**
 * Check if there are any products in the WooCommerce store.
 *
 * @return bool
 */
function xshop_has_woocommerce_products()
{
	// Define the query arguments
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 1,
		'post_status'    => 'publish'
	);

	// Get the products
	$products = new WP_Query($args);

	// Check if there are products
	$has_products = $products->have_posts();

	// Reset the post data
	wp_reset_postdata();

	// Check product
	if ($has_products) {
		return true;
	}
	return false;
}
