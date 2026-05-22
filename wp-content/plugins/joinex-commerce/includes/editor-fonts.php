<?php
if (!defined('ABSPATH')) exit;

// Enqueue font Be Vietnam cho admin
function joinex_enqueue_fonts() {
    wp_enqueue_style(
        'be-vietnam-font',
        'https://fonts.googleapis.com/css2?family=Be+Vietnam:wght@400;700&display=swap',
        false
    );
}
add_action('admin_enqueue_scripts', 'joinex_enqueue_fonts');

// Thêm font vào TinyMCE dropdown
function joinex_add_custom_fonts($init) {
    $init['font_formats'] = 'Arial=arial,helvetica,sans-serif;'
        .'Comic Sans MS=comic sans ms,sans-serif;'
        .'Courier New=courier new,courier,monospace;'
        .'Georgia=georgia,serif;'
        .'Helvetica=helvetica,sans-serif;'
        .'Impact=impact,sans-serif;'
        .'Tahoma=tahoma,sans-serif;'
        .'Times New Roman=times new roman,times,serif;'
        .'Trebuchet MS=trebuchet ms,sans-serif;'
        .'Verdana=verdana,sans-serif;'
        .'Be Vietnam="Be Vietnam",sans-serif;';
    return $init;
}
add_filter('tiny_mce_before_init', 'joinex_add_custom_fonts');

// Đảm bảo font load trong iframe editor
function joinex_mce_css($mce_css) {
    $font_url = 'https://fonts.googleapis.com/css2?family=Be+Vietnam:wght@400;700&display=swap';
    if (!empty($mce_css)) {
        $mce_css .= ',';
    }
    $mce_css .= $font_url;
    return $mce_css;
}
add_filter('mce_css', 'joinex_mce_css');
