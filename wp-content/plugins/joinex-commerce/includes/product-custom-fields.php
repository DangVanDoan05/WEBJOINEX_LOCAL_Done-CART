<?php
if (!defined('ABSPATH')) exit;

// =======================
// 1. Thêm Meta Box
// =======================
add_action('add_meta_boxes', function () {
    add_meta_box(
        'joinex_product_fields',
        'Thông tin bổ sung',
        'joinex_render_product_fields',
        'product',
        'normal',
        'high'
    );
});

function joinex_render_product_fields($post) {
    $thong_so = get_post_meta($post->ID, '_thong_so_ky_thuat', true);
    $huong_dan = get_post_meta($post->ID, '_huong_dan_lap_dat', true);

    echo '<h3>Thông số kỹ thuật</h3>';
    wp_editor($thong_so, 'joinex_thong_so', [
        'textarea_name' => 'thong_so_ky_thuat',
        'textarea_rows' => 5
    ]);

    echo '<h3 style="margin-top:20px;">Hướng dẫn lắp đặt</h3>';
    wp_editor($huong_dan, 'joinex_huong_dan', [
        'textarea_name' => 'huong_dan_lap_dat',
        'textarea_rows' => 5
    ]);
}

// =======================
// 2. Lưu dữ liệu
// =======================
add_action('save_post', function ($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['thong_so_ky_thuat'])) {
        update_post_meta($post_id, '_thong_so_ky_thuat', $_POST['thong_so_ky_thuat']);
    }

    if (isset($_POST['huong_dan_lap_dat'])) {
        update_post_meta($post_id, '_huong_dan_lap_dat', $_POST['huong_dan_lap_dat']);
    }
});