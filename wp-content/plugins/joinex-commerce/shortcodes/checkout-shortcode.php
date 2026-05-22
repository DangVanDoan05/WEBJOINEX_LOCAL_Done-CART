<?php

function joinex_checkout_shortcode(){

ob_start();

include plugin_dir_path(__FILE__) . '../templates/checkout-page.php';

return ob_get_clean();

}

add_shortcode('joinex_checkout','joinex_checkout_shortcode');