<?php
function joinex_product_cart_shortcode() {
    ob_start(); // mở bộ đệm

    // Lấy dữ liệu giỏ hàng từ WooCommerce
    $cart = WC()->cart;

    ?>
    <div class="cart-page-joinex-container">
        <div class="cart-page-joinex-wrap">
            <!-- Tiêu đề -->
            <div class="joinex-cart-title">
                <h2>Giỏ hàng của bạn</h2>
            </div>
            <div class="joinex-cart-detail">
                <!-- Danh sách sản phẩm trong giỏ -->
                <div class="joinex-cart-items">
<?php
if ( $cart && ! $cart->is_empty() ) {
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product   = $cart_item['data'];
        $quantity  = $cart_item['quantity'];
        $line_total = $cart_item['line_total'];
        $thumbnail = $product->get_image( 'thumbnail' );

        ?>
        <div class="cart-item">
            <div class="item-thumb"><?php echo $thumbnail; ?></div>
            <div class="item-info">
                <span class="item-name"><?php echo esc_html( $product->get_name() ); ?></span>

                <?php if ( ! empty( $cart_item['variation'] ) ) : ?>
                    <ul class="item-attributes">
                        <?php foreach ( $cart_item['variation'] as $attr_name => $attr_value ) : ?>
                            <li>
                                <?php 
                                // Lấy nhãn thuộc tính (ví dụ: "Chiều dài dây vòi")
                                echo wc_attribute_label( $attr_name ) . ': ';

                                // Nếu là taxonomy thì đổi slug thành tên term
                                $taxonomy = str_replace( 'attribute_', '', $attr_name );
                                $term = get_term_by( 'slug', $attr_value, $taxonomy );
                                if ( $term ) {
                                    echo esc_html( $term->name );
                                } else {
                                    echo esc_html( $attr_value );
                                }
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <span class="item-qty">Số lượng: <?php echo esc_html( $quantity ); ?></span>
                <span class="item-total">Thành tiền: <?php echo wc_price( $line_total ); ?></span>
            </div>
        </div>
        <?php
    }
} else {
    echo '<p>Giỏ hàng trống.</p>';
}
?>




                </div>

                <!-- Tóm tắt đơn hàng -->
                <div class="joinex-cart-price">
                    <h3>Tóm tắt đơn hàng</h3>
                    <p>Tạm tính: <span><?php echo wc_price( $cart->get_subtotal() ); ?></span></p>
                    <p>Giảm giá: <span><?php echo wc_price( $cart->get_discount_total() ); ?></span></p>
                    <p>Phí vận chuyển: <span><?php echo $cart->get_shipping_total() > 0 ? wc_price( $cart->get_shipping_total() ) : 'Miễn phí'; ?></span></p>
                    <strong>Tổng cộng: <span><?php echo wc_price( $cart->get_total('edit') ); ?></span></strong>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-btn">Tiến hành thanh toán</a>
                </div>
            </div>
            <!-- Gợi ý sản phẩm -->
            <div class="joinex-cart-suggestions">
                <h3>Có thể bạn sẽ thích</h3>
                <?php
                // Ví dụ: lấy 4 sản phẩm ngẫu nhiên
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'orderby' => 'rand'
                );
                $suggestions = new WP_Query( $args );
                if ( $suggestions->have_posts() ) {
                    echo '<ul class="suggest-list">';
                    while ( $suggestions->have_posts() ) {
                        $suggestions->the_post();
                        global $product;
                        echo '<li>';
                        echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                        echo '<span class="price">' . $product->get_price_html() . '</span>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean(); 
}
add_shortcode('joinex_product_cart', 'joinex_product_cart_shortcode');
