<?php
function joinex_product_cart_shortcode() {
    ob_start(); // mở bộ đệm

    // Lấy dữ liệu giỏ hàng từ WooCommerce
    $cart = WC()->cart;

    ?>
    <div class="cart-page-joinex-container">
        <div class="cart-page-joinex-wrap">
            <!--#region KHỐI TIÊU ĐỀ GIỎ HÀNG -->
                <div class="joinex-cart-title">
                    <h2>Giỏ hàng của bạn</h2>
                    <?php
                        $cart_count = WC()->cart->get_cart_contents_count();
                        if ( $cart_count > 0 ) {
                            echo '<div class="joinex-cart-notice">Bạn có ' . $cart_count . ' sản phẩm trong giỏ hàng</div>';
                        } else {
                            echo '<div class="joinex-cart-notice">Giỏ hàng của bạn đang trống</div>';
                        }
                    ?>
                </div>
            <!-- #endregion -->
            <!--#region KHỐI THÔNG TIN GIỎ HÀNG -->
                <div class="joinex-cart-detail">

                    <!--#region DANH SÁCH SẢN PHẨM TRONG GIỎ -->
                        <div class="joinex-cart-items-container">                     
                        <?php
                            if ( $cart && ! $cart->is_empty() )
                            {
                                foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $product    = $cart_item['data'];
                                    $quantity   = $cart_item['quantity'];
                                    $line_total = $cart_item['line_total'];
                                    $thumbnail  = $product->get_image( 'thumbnail' );
                                    ?>
                                    <div class="cart-item">
                                        <!--#region KHỐI HÌNH ẢNH SẢN PHẨM -->
                                            <div class="item-thumb"><?php echo $thumbnail; ?></div>
                                        <!--#endregion-->
                                        <!--#region KHỐI TIÊU ĐỀ, THUỘC TÍNH, GIÁ SẢN PHẨM -->
                                            <div class="item-info-button-container">
                                                <div class="item-info">
                                                    <!--#TIÊU ĐỀ SẢN PHẨM-->
                                                    <div class="item-name-variation-wrap">
                                                        <div class="item-name"><?php echo esc_html( $product->get_name() ); ?></div>
                                                        <!--#region KHỐI THUỘC TÍNH SẢN PHẨM -->
                                                            <?php if ( ! empty( $cart_item['variation'] ) ) : ?>
                                                                <ul class="item-attributes">
                                                                    <?php foreach ( $cart_item['variation'] as $attr_name => $attr_value ) : ?>
                                                                        <li>
                                                                            <?php 
                                                                            // Lấy tên taxonomy từ key (ví dụ: attribute_pa_chieu-dai-day-voi -> pa_chieu-dai-day-voi)
                                                                            $taxonomy = str_replace( 'attribute_', '', $attr_name );

                                                                            // Lấy nhãn hiển thị của attribute
                                                                            $label = wc_attribute_label( $taxonomy );

                                                                            // In nhãn
                                                                            echo esc_html( $label ) . ': ';

                                                                            // Nếu là taxonomy thì đổi slug thành tên term
                                                                            $term = get_term_by( 'slug', $attr_value, $taxonomy );
                                                                            if ( $term ) {
                                                                                echo esc_html( $term->name );
                                                                            } else {
                                                                                echo esc_html( $attr_value );
                                                                            }

                                                                            // Debug log để kiểm tra
                                                                            error_log("Attr key: $attr_name | Taxonomy: $taxonomy | Label: $label | Value: $attr_value");
                                                                            ?>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <!--#endregion-->
                                                    </div>
                                                    <div class="item-price-qty-wrap">
                                                        
                                                        <div class="item-total"><?php echo wc_price( $line_total ); ?>
                                                        </div>

                                                        <div class="quantity-box">
                                                            <button class="qty-btn minus">−</button>
                                                            <input type="number" 
                                                                class="qty-input" 
                                                                value="<?php echo esc_attr( $quantity ); ?>" 
                                                                min="1">
                                                            <button class="qty-btn plus">+</button>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                <div class="image-button-remove-product-wrap">
                                                <img class="cc-img-CartRemoveProduct" 
                                                    src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/CartIMG/RemoveCart.png'; ?>" 
                                                    alt="Xóa sản phẩm khỏi giỏ hàng">  
                                                </div>
                                            </div>                            
                                        <!--#endregion-->
                                    </div>
                                    <?php
                                }
                            } 
                            else
                            {
                                echo '<p>Giỏ hàng trống.</p>';
                            }
                        ?>                     
                        </div>
                    <!--#endregion-->

                    <!--#region TÓM TẮT ĐƠN HÀNG GIÁ TIỀN THANH TOÁN-->
                        <div class="joinex-cart-price-container">
                            <h3>Tổng đơn hàng</h3>
                            <div class="subtotal-price-container">
                                <p>Tạm tính:</p>
                                <div class="subtotal-price"><?php echo wc_price( $cart->get_subtotal() ); ?></div>
                            </div>
                            <div class="discount-total-price-container">
                                <p>Giảm giá:</p>
                                <div class="discount-total-price"><?php echo wc_price( $cart->get_discount_total() ); ?></div>
                            </div>
                            <div class="shipping-total-price-container">
                                <p>Phí vận chuyển:</p>
                                <div class="shipping-total-price"><?php echo $cart->get_shipping_total() > 0 ? wc_price( $cart->get_shipping_total() ) : 'Miễn phí'; ?></div>
                            </div>
                            <div class="total-price-container">
                                <p>Tổng cộng:</p>
                                <div class="total-price"><?php echo wc_price( $cart->get_total('edit') ); ?></div>
                            </div>                      
                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-btn">Tiến hành thanh toán</a>
                        </div>
                    <!--#endregion-->   

                </div>
            <!-- #endregion -->
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
