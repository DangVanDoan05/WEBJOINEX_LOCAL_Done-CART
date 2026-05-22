<?php
/*
Plugin Name: Joinex Commerce
Description: Custom Checkout for Joinex
Version: 1.0
Author: M1029_Dang Van Doan DONG DUONG Plastic & Mold 
*/

//#region HƯỚNG DẪN THỨ TỰ CÁC FILE CỦA PLUGIN

    //Thứ tự hợp lý là: Khai báo hằng số → Load assets → Đăng ký shortcode → Require các file logic (includes).
    // CSS/JS cần được enqueue sớm để khi WordPress render frontend, chúng đã sẵn sàng.

//#endregion

//#region ĐỊNH NGHĨA CÁC THÔNG SỐ CỐ ĐỊNH SỬ DỤNG: define trong PHP chính là cách để tạo thông số cố định.

    // CÚ PHÁP: define('TEN_HANG_SO', 'gia_tri');
    //  hàm tiện ích (function) do WordPress cung cấp sẵn.

    define('JOINEX_PLUGIN_URL', plugin_dir_url(__FILE__)); //plugin_dir_url(__FILE__): trả về URL tuyệt đối đến thư mục chứa file plugin hiện tại.
    define('JOINEX_PLUGIN_PATH', plugin_dir_path(__FILE__)); // plugin_dir_path(__FILE__): tương tự, nhưng trả về đường dẫn vật lý trên server (filesystem path).
   
    // chặn truy cập trực tiếp vào file plugin, chỉ cho phép file chạy khi được WordPress load.
    //  Đây là cách bảo vệ plugin khỏi bị khai thác hoặc lộ thông tin.
    if (!defined('ABSPATH')) {
        exit;
    }
//#endregion

//#region LOAD CÁC TIỆN ÍCH (require trực tiếp, không cần hook)
    require_once plugin_dir_path(__FILE__). 'includes/product-utils.php';
//#endregion

//#region   HÀM TẠO RA ICON ĐỂ BIẾT ICON KÍCH HOẠT.
    add_action('admin_menu', 'joinex_admin_menu');

        function joinex_admin_menu() {

            add_menu_page(
                'Joinex Commerce',          // Page title
                'Joinex Commerce',         // Menu title
                'manage_options',           // Permission
                'joinex-commerce',          // Slug
                'joinex_admin_page',        // Function hiển thị trang
                'dashicons-cart',           // Icon
                56                          // Vị trí menu
            );
        }

// #endregion 

/* #region LOAD ASSETS CSS-JS */
    // wp_enqueue_style là một hàm (function) của WordPress
    // wp_enqueue_style là một hàm (function) của WordPress, Nó được dùng để đăng ký và đưa CSS vào hàng chờ (enqueue) để WordPress load ra ngoài.
    // Cú pháp cơ bản:  wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    
       // $handle: tên định danh duy nhất cho stylesheet.

       // $src: đường dẫn URL đến file CSS.

       // $deps: mảng các stylesheet phụ thuộc (nếu có).

       // $ver: version (thường để tránh cache).

      // $media: loại media (screen, print…).
      
        // Hàm “ĐẢM BẢO” để enqueue,tự kiểm tra file trước khi gọi filemtime():
        //#region KHỞI TẠO HÀM ĐỂ LOAD CSS, JS
            function joinex_enqueue_safe_style($handle, $relative_path, $deps = array(), $media = 'all') {
                $file_path = plugin_dir_path(__FILE__) . $relative_path; // Không dùng tham số cố định, đảm bảo gọi hàm plugin_dir_path độc lập với tham số cố định
                $file_url  = plugin_dir_url(__FILE__) . $relative_path;
                if ( file_exists($file_path) ) {
                    wp_enqueue_style(
                        $handle,
                        $file_url,
                        $deps,
                        filemtime($file_path),
                        $media
                    );
                }
            }

            function joinex_enqueue_safe_script($handle, $relative_path, $deps = array('jquery'), $in_footer = true) {
                $file_path = plugin_dir_path(__FILE__) . $relative_path;
                $file_url  = plugin_dir_url(__FILE__) . $relative_path;

                if ( file_exists($file_path) ) {
                    wp_enqueue_script(
                        $handle,
                        $file_url,
                        $deps,
                        filemtime($file_path), // dùng thời gian sửa file làm version để tránh cache
                        $in_footer
                    );
                }
            }
        //#endregion
      
        // BẮT ĐẦU SỬ DỤNG HÀM ĐỂ LOAD CSS VÀ JS

        function joinex_load_assets() {

            //#region LOAD CSS CHO CÁC SHORTCODE
                // LOAD CSS CHO DANH SÁCH SẢN PHẨM Ở TRANG CHỦ
                joinex_enqueue_safe_style('joinex-list-product-homepage', 'assets/css/List-product-HomePage.css', array('elementor-frontend')); 
                // LOAD CSS CHO DANH SÁCH SẢN PHẨM Ở TRANG SẢN PHẨM
                joinex_enqueue_safe_style('joinex-list-product-productpage', 'assets/css/List-product-ProductPage.css', array('elementor-frontend')); 
                // LOAD CSS CHO TRANG CHI TIẾT SẢN PHẨM
                joinex_enqueue_safe_style('joinex-product-detail-page', 'assets/css/product-detail.css', array('elementor-frontend'));
                // LOAD CSS CHO PHẦN SLIDER SẢN PHẨM
                joinex_enqueue_safe_style('joinex-product-slider', 'assets/css/slider-product-detail.css', array('elementor-frontend'));
            //#endregion

            //#region LOAD JS CHO CÁC SHORTCODE
               joinex_enqueue_safe_script('joinex-slider-js', 'assets/js/slider-product-detail.js', array('jquery'), true);
               joinex_enqueue_safe_script('joinex-product-detail-js', 'assets/js/product-detail.js', array('jquery'), true);
            //#endregion

        }

        //add_action() là một HOOK là “điểm móc” (hook) để lập trình viên chen vào.
        // add_action('init', 'joinex_commerce_load_shortcodes'); tức là bạn bảo WordPress: “Đến lúc chạy hook init thì gọi hàm này”.
        add_action('wp_enqueue_scripts', 'joinex_load_assets'); // wp_enqueue_scripts: chạy khi WordPress chuẩn bị in ra HTML, thích hợp để enqueue CSS/JS.

/* #endregin */  

//#region PHẦN LOAD CÁC SHORTCODE

    function joinex_require_safe_shortcode($relative_path) {
        $file_path = plugin_dir_path(__FILE__) . $relative_path;
        if ( file_exists($file_path) )
            {
                require_once $file_path;
            }
        else 
            {
            // Có thể log hoặc thông báo lỗi nhẹ để dễ debug
            error_log("Thiếu file shortcode trong thư mục ShortCode: " . $file_path);
            }    
    }

    function joinex_commerce_load_shortcodes() {
        joinex_require_safe_shortcode('shortcodes/List-product-HomePage.php');
        joinex_require_safe_shortcode('shortcodes/List-product-ProductPage.php');
        joinex_require_safe_shortcode('shortcodes/product_filter_dropdown.php');
        joinex_require_safe_shortcode('shortcodes/product-detail.php');
        joinex_require_safe_shortcode('shortcodes/slider-product-detail.php');
    }
    // init: chạy sau khi WordPress đã load xong core, thích hợp để đăng ký shortcode, custom post type.
    add_action('init', 'joinex_commerce_load_shortcodes');


//#endregion

// #region TẠO THÊM ĐƯỜNG DẪN MỚI, DÙNG SLUG ĐỂ DẪN ĐẾN TRANG CHI TIẾT SẢN PHẨM TỰ TẠO

    // =============================
    // 🔥 Rewrite rule cho trang chi tiết sản phẩm custom
    // =============================
    //  Khi người dùng truy cập URL này, WordPress sẽ hiểu:
    // → Nạp trang có slug chi-tiet-san-pham (trang bạn tạo riêng).
    // → Gắn thêm biến product_slug để bạn lấy ra sản phẩm tương ứng. 
    // Từ slug này, bạn query database để tìm ra ID sản phẩm tương ứng.

    // Sau đó dùng wc_get_product($product_id) để lấy object sản phẩm.
    // Hai đoạn code đó thực chất là hai phần bổ sung cho nhau
    
    function joinex_add_rewrite_rules() //add_rewrite_rule(...) → đây là phần khai báo đường dẫn, nói với WordPress:
      //“Nếu URL có dạng /chi-tiet-san-pham/{slug}, thì hãy nạp trang chi-tiet-san-pham và đồng thời gắn thêm biến product_slug bằng giá trị {slug}.”
     { 
        add_rewrite_rule(
            '^chi-tiet-san-pham/([^/]+)/?',
            'index.php?pagename=chi-tiet-san-pham&product_slug=$matches[1]',
            'top'
        );
    }
    add_action('init', 'joinex_add_rewrite_rules');  

    function joinex_add_query_vars( $vars ) 
    // add_query_vars(...) → đây là phần khai báo biến. 
    // cho WordPress biết rằng product_slug là một biến hợp lệ trong hệ thống query vars, để sau đó bạn có thể gọi get_query_var('product_slug') trong shortcode hoặc template.
     {
        $vars[] = 'product_slug';
        return $vars;
     }
    add_filter('query_vars', 'joinex_add_query_vars');

//#endregion

