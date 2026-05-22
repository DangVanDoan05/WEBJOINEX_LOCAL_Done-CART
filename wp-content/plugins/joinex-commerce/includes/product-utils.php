<?php

// Lấy ID trang theo slug

function joinex_get_product_detail_page_id() {
    $page = get_page_by_path('chi-tiet-san-pham'); // slug của trang chi tiết
    if ($page) {
        return $page->ID;
    }
    return null; // nếu chưa tạo trang
}

function joinex_get_product_cart_page_id() {
    $page = get_page_by_path('gio-hang'); // slug của trang giỏ hàng
    if ($page) {
        return $page->ID;
    }
    return null; // nếu chưa tạo trang
}

// Hàm lấy link hoặc báo lỗi
function joinex_get_product_detail_page_attrs( $product_id ) {
    $page_id = joinex_get_product_detail_page_id();

    if ( !$page_id || get_post_status($page_id) !== 'publish' ) {
        $msg = "Trang chi tiết sản phẩm chưa được tạo hoặc chưa publish! Hãy tạo trang với slug 'chi-tiet-san-pham'";
        return 'href="javascript:void(0)" 
                onclick="alert(\'' . esc_js($msg) . '\'); return false;" 
                oncontextmenu="alert(\'' . esc_js($msg) . '\'); return false;"';
    } else {
        $product = wc_get_product( $product_id );
        if ( ! $product ) {
            return 'href="javascript:void(0)"';
        }

        // Lấy slug sản phẩm
        $slug = $product->get_slug();

        // Build URL custom theo slug
        $page_link = get_permalink( $page_id );
        $url = trailingslashit( $page_link ) . $slug;

        return 'href="' . esc_url( $url ) . '"';
    }
}

function joinex_get_product_cart() {
    $page_id = joinex_get_product_cart_page_id();

    if ( !$page_id || get_post_status($page_id) !== 'publish' ) {
        $msg = "Trang giỏ hàng chưa được tạo hoặc chưa publish! Hãy tạo trang với slug 'gio-hang'";
        return 'href="javascript:void(0)" 
                onclick="alert(\'' . esc_js($msg) . '\'); return false;" 
                oncontextmenu="alert(\'' . esc_js($msg) . '\'); return false;"';
    }
    else // LINK ĐẾN TRANG GIỎ HÀNG
    {
       

        // Build URL custom theo slug
        $page_link = get_permalink( $page_id );
        

        return 'href="' . esc_url( $page_link ) . '"';
    }
}











