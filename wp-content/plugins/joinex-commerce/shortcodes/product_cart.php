<?php
function joinex_product_cart_shortcode() {
    ob_start(); // mở bộ đệm

    // BẮT ĐẦU NỘI DUNG HTML
?>
    <div class="cart-page-joinex-wrap">
        <!-- Danh sách sản phẩm trong giỏ -->
        <div class="cart-title">
            <h2>Giỏ hàng của bạn</h2>
            
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div class="cart-detail">
            <h3>Tóm tắt đơn hàng</h3>
            <p>Tạm tính: <span>1,380,000₫</span></p>
            <p>Giảm giá: <span>-0₫</span></p>
            <p>Phí vận chuyển: <span>Miễn phí</span></p>
            <p><strong>Tổng cộng: <span>1,380,000₫</span></strong></p>
            <button class="checkout-btn">Tiến hành thanh toán</button>
        </div>

        <!-- Gợi ý sản phẩm -->
        
    </div>
<?php
    return ob_get_clean(); // trả về nội dung đã ghi
}
add_shortcode('joinex_product_cart', 'joinex_product_cart_shortcode');
