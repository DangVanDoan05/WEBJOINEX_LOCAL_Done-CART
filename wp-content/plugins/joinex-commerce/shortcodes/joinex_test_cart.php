<?php
function joinex_test_cart_shortcode() {
    // Xử lý thêm sản phẩm
 
   echo '<pre>';
    print_r(WC()->cart->get_cart());
    echo '</pre>';

}
add_shortcode('joinex_test_cart', 'joinex_test_cart_shortcode');

