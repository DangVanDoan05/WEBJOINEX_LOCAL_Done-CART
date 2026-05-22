<?php
// Hiển thị dropdown danh mục
function kama_product_filter_dropdown() {
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
    );
    $categories = get_terms($args);

    echo '<form method="get" id="product-filter">';
  //  echo '<label for="product_cat">Chọn loại sản phẩm: </label>';
    echo '<select name="product_cat" id="product_cat" onchange="document.getElementById(\'product-filter\').submit();">';
    echo '<option value="">-- Tất cả sản phẩm --</option>';
    foreach ($categories as $cat) {
        // Lấy ID thay vì slug
        $selected = (isset($_GET['product_cat']) && intval($_GET['product_cat']) == $cat->term_id) ? 'selected' : '';
        echo '<option value="' . $cat->term_id . '" ' . $selected . '>' . $cat->name . '</option>';
    }
    echo '</select>';
    echo '</form>';
}
add_shortcode('product_filter_dropdown', 'kama_product_filter_dropdown');

