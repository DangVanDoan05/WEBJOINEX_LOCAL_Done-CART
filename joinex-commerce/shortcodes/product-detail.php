<?php
// Shortcode: [joinex_product_detail]
function joinex_product_detail_shortcode() { 

    // #region PHẦN LOGIC ĐỂ LẤY ĐƯỢC SẢN PHẨM TỪ URL

        // lấy ra giá trị slug(Đường dẫn) sản phẩm từ URL

        $product_slug = get_query_var('product_slug');

        if ( ! $product_slug ) {
            return '<p>Không tìm thấy sản phẩm theo như đường dẫn Slug.</p>';
        }

        // Tìm ID sản phẩm theo slug
        global $wpdb;
        // Đây này câu lệnh để lấy ID sản phẩm đây này.
        $product_id = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'product'",$product_slug));

        if ( ! $product_id ) {
            return '<p>Không tìm thấy sản phẩm theo ID sản phẩm.</p>';
        }
 
        $product = wc_get_product( $product_id );
        if ( ! $product ) {
            return '<p>Không tìm thấy sản phẩm theo ID sản phẩm.</p>';
        }

    // #endregion

    ob_start();
    // ... phần HTML giữ nguyên như bạn đã viết ...
   ?>

    <!-- #region KHỐI HTML SHOW SẢN PHẨM -->
        <div class="joinex-product-detail-wrap">
            <div class="joinex-product-detail">
                <!--#region KHỐI HÌNH ẢNH SẢN PHẨM MÔ TẢ NGẮN -->   
                    <div class="images-short-description-product"> 
                        <!--#region KHỐI HÌNH ẢNH SẢN PHẨM -->
                            <div class="images-product-container">   <!-- KHỐI HÌNH ẢNH SẢN PHẨM -->

                                <!-- ẢNH CHÍNH -->
                                <div class="main-image-container">
                                    <?php
                                        $product     = wc_get_product( $product_id );
                                        $main_img_id = $product->get_image_id(); // ảnh sản phẩm chính
                                        $gallery_ids = $product->get_gallery_image_ids(); // thư viện ảnh

                                        if ( $main_img_id ) {
                                            echo wp_get_attachment_image( $main_img_id, 'large', false, array( 'id' => 'current-main-image' ));
                                        }
                                    ?>
                                </div>            

                                <!-- GALLERY THUMBNAIL--HÌNH ẢNH LIÊN QUAN SẢN PHẨM -->
                                <div class="images-gallery-product-container">
                                    <?php
                                        if ( $main_img_id || $gallery_ids ) {
                                            $all_ids = array(); 
                                            if ( $main_img_id ) {
                                                $all_ids[] = $main_img_id; // đưa ảnh chính lên đầu
                                            }
                                            if ( $gallery_ids ) {
                                                $all_ids = array_merge( $all_ids, $gallery_ids );
                                            }

                                            $max_show = 4;
                                            $total    = count( $all_ids );

                                            if ( $total > $max_show ) {
                                                // Nếu nhiều hơn 4 ảnh thì hiển thị slider với mũi tên
                                                ?>
                                                <div class="gallery-container">
                                                    <button class="btn-prev"><</button>
                                                    <div class="images-gallery-product slider">
                                                        <?php foreach ( $all_ids as $index => $img_id ) : ?>
                                                            <div class="gallery-thumb">
                                                                <?php 
                                                                    $class = $index === 0 ? 'thumb-image active' : 'thumb-image';
                                                                    echo wp_get_attachment_image( $img_id, 'thumbnail', false, array( 'class' => $class ));
                                                                ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <button class="btn-next">></button>
                                                </div>
                                                <?php
                                            } else {
                                                // Nếu ≤4 ảnh thì hiển thị bình thường
                                                ?>
                                                <div class="images-gallery-product">
                                                    <?php foreach ( $all_ids as $index => $img_id ) : ?>
                                                        <div class="gallery-thumb">
                                                            <?php 
                                                                $class = $index === 0 ? 'thumb-image active' : 'thumb-image';
                                                                echo wp_get_attachment_image( $img_id, 'thumbnail', false, array( 'class' => $class ));
                                                            ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        <!--#endregion -->
                        <!--#region KHỐI TIÊU ĐỀ VÀ MÔ TẢ NGẮN  --> 
                            <div class="title-short-description-product">  
                                <!--#region  TIÊU ĐỀ SẢN PHẨM VÀ MÔ TẢ NGẮN  --> 
                                    <div class="product-detail-page-title-joinex">
                                        <h1 id="product-detail-page-title-joinex"><?php echo esc_html($product->get_name()); ?></h1>
                                        <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                                    </div> 
                                    <div class="product-price-wrap">            
                                        <div class="product-price">  
                                            <?php // à lại phải ốp khối vào đây
                                                if ( $product->is_on_sale() ) {
                                                    echo '<span class="sale-price">' . wc_price( $product->get_sale_price() ) . '</span>';
                                                    echo '<span class="regular-price">' . wc_price( $product->get_regular_price() ) . '</span>';
                                                }
                                                else {
                                                    echo '<span class="regular-price-no-sale">' . wc_price( $product->get_regular_price() ) . '</span>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="product-short-description">                 
                                        <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() );?>
                                    </div>
                                <!-- endregion--> 
                                <!--#region ĐƯỜNG PHÂN CÁCH--> 
                                   <div class="divider"></div>
                                <!-- endregion-->                                                           
                                <!--#region KHỐI THUỘC TÍNH SẢN PHẨM -->                         
                                   <div class="product-variation"> 
    <?php
    if ( $product ) {
        if ( $product->is_type('simple') ) {
            echo '<p>Sản phẩm này là sản phẩm đơn giản.</p>';
            echo '<div id="variation-price">' . $product->get_price_html() . '</div>';
        } elseif ( $product->is_type('variable') ) {
            echo '<p>Sản phẩm này là sản phẩm biến thể (có nhiều lựa chọn thuộc tính).</p>';                                                  

            // Nếu là biến thể thì tìm sản phẩm mẹ
            if ( $product->is_type('variation') ) {
                $parent_id      = $product->get_parent_id();
                $parent_product = wc_get_product($parent_id);
            } else {
                $parent_product = $product;
            }

            if ( $parent_product ) {
                // Lấy dữ liệu biến thể để JS dùng
                $variations = $parent_product->get_children();
                $variation_data = [];
                foreach ( $variations as $variation_id ) {
                    $variation = wc_get_product($variation_id);
                    if ( ! $variation ) continue;
                    $variation_data[$variation_id] = [
                        'attributes' => $variation->get_attributes(),
                        'price_html' => $variation->get_price_html(),
                    ];
                }
                echo '<script>var variationData = ' . wp_json_encode($variation_data) . ';</script>';

                // Render thuộc tính
                $attributes = $parent_product->get_attributes();                            
                echo '<div class="cc-variation-container">';
                foreach ( $attributes as $attribute ) {
                    $name = wc_attribute_label($attribute->get_name());
                    echo '<div class="variation-group">';
                        echo '<div class="label-variation">' . esc_html($name) . ':</div>';              

                        if ( $attribute->is_taxonomy() ) {
                            $terms = wc_get_product_terms(
                                $parent_product->get_id(),
                                $attribute->get_name(),
                                array('fields' => 'names')
                            );
                            sort($terms, SORT_NATURAL | SORT_FLAG_CASE);

                            echo '<div class="button-variation-container">';
                            foreach ($terms as $index => $term) {
                                $active_class = ($index === 0) ? ' active' : '';
                                echo '<button class="attr-btn' . $active_class . '" data-attr="' . esc_attr($term) . '" data-attr-name="' . esc_attr($attribute->get_name()) . '">' . esc_html($term) . '</button>';
                            }
                            echo '</div>';
                        } else {
                            $options = $attribute->get_options();
                            sort($options, SORT_NATURAL | SORT_FLAG_CASE);

                            echo '<div class="button-variation-container">';
                            foreach ($options as $index => $option) {
                                $active_class = ($index === 0) ? ' active' : '';
                                echo '<button class="attr-btn' . $active_class . '" data-attr="' . esc_attr($option) . '" data-attr-name="' . esc_attr($attribute->get_name()) . '">' . esc_html($option) . '</button>';
                            }
                            echo '</div>';
                        }           
                    echo '</div>';
                }
                echo '</div>';

                // Vùng hiển thị giá
                echo '<div id="variation-price"></div>';
            } else {
                echo '<p>Không tìm thấy sản phẩm mẹ.</p>';
            }

        } elseif ( $product->is_type('variation') ) {
            echo '<p>Sản phẩm này là một biến thể con của sản phẩm mẹ.</p>';
            echo '<div id="variation-price">' . $product->get_price_html() . '</div>';
        } else {
            echo '<p>Loại sản phẩm khác: ' . esc_html( $product->get_type() ) . '</p>';
        }
    }
    ?>
</div>
                                <!-- endregion--> 
                                <!--#region CÁC HÀNH ĐỘNG SẢN PHẨM THÊM VÀO GIỎ HÀNG, MUA NGAY --> 
                                    <div class="product-actions">  
                                        <div class="quantity-joinex">
                                            <button class="qty-btn-joinex minus-joinex">-</button>
                                            <input type="number" class="qty-input-joinex" value="1" min="1">
                                            <button class="qty-btn-joinex plus-joinex">+</button>
                                        </div>
                                        <div class="action-buttons-joinex">
                                            <button class="cart-btn-joinex">                          
                                                <img class="cart-icon-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/CartIMG.png'; ?>" alt="Cart">                          
                                            <!-- <img src="/assets/img/ProductDetailPageIMG/CartIMG.png" alt="" class="cart-icon-joinex"> -->
                                                Thêm vào giỏ hàng
                                            </button>
                                            <button class="buy-btn-joinex">
                                            <img class="buy-icon-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/BuyNowIMG.png'; ?>" alt="Cart"> 
                                                Mua ngay</button>
                                        </div>                                         
                                    </div>
                                <!-- endregion--> 
                                <!-- #region KHỐI THÔNG TIN DỊCH VỤ --> 
                                    <div class="service-info-joinex"> 
                                            <div class="service-item-joinex">
                                                <div class="service-img">
                                                <img class="support-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/NutLienHeIMG.png'; ?>" alt="Cart">
                                                </div>  
                                                <div class="service-text-joinex">
                                                    <h4>Lắp đặt tận nơi</h4>
                                                    <p>Hướng dẫn và hỗ trợ lắp đặt tại nhà. <a href="#">Xem chi tiết</a></p>
                                                </div>
                                            </div>
                                            <div class="service-divider"></div> <!-- ĐƯỜNG PHÂN CÁCH--> 
                                            <div class="service-item-joinex">
                                                <div class="service-img">
                                                    <img class="transport-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/XeTaiIMG.png'; ?>" alt="Cart">
                                                </div>  
                                                <div class="service-text-joinex">
                                                    <h4>Giao hàng miễn phí</h4>
                                                    <p>Miễn phí giao hàng cho đơn từ 500.000đ.</p>
                                                </div>
                                            </div>
                                            <div class="service-divider"></div> <!-- ĐƯỜNG PHÂN CÁCH--> 
                                            <div class="service-item-joinex">
                                                <div class="service-img">
                                                    <img class="return-product-joinex"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductDetailPageIMG/HoanHangIMG.png'; ?>" alt="Cart">
                                                </div> 
                                                <div class="service-text-joinex">
                                                    <h4>Trả hàng</h4>
                                                    <p>Miễn phí trả hàng trong vòng 30 ngày. <a href="#">Xem thêm</a></p>
                                                </div>
                                            </div>
                                    </div>
                                <!-- endregion--> 
                            </div>
                        <!-- endregion--> 
                    </div>  
                <!--#endregion -->  
                <!--#region KHỐI MÔ TẢ DÀI -->
                    <div class="long-description-product">  <!-- KHỐI MÔ TẢ DÀI.  --> 
                        <!-- PHẦN MÔ TẢ DÀI SẢN PHẨM  --> 
                        <!-- <?php echo wpautop($product->get_description()); ?> --> 
                        <div class="product-tabs-joinex">

                            <ul class="tab-header-joinex">
                                <li class="tab-link-joinex active" data-tab="desc">Mô tả sản phẩm</li>
                                <li class="tab-link-joinex" data-tab="specs">Thông số kỹ thuật</li>
                                <li class="tab-link-joinex" data-tab="guide">Hướng dẫn lắp đặt</li>
                            </ul>

                            <div class="tab-content-joinex"> <!-- TAB ĐẦU TIÊN --> 
                                <p>ĐÂY LÀ PHẦN MÔ TẢ DÀI SẢN PHẨM </p>
                            </div>

                            <div id="specs" class="tab-pane-joinex"> <!-- TAB GIỮA --> 
                                <p>ĐÂY LÀ PHẦN THÔNG SỐ KỸ THUẬT SẢN PHẨM </p>
                            </div>

                            <div id="guide" class="tab-pane-joinex"> <!-- TAB CUỐI --> 
                                <p>Hướng dẫn chi tiết cách lắp đặt sản phẩm tại nhà...</p>
                            
                            </div>
                        </div>
                    </div>
                <!--#endregion -->                  
                <!--#region KHỐI REVIEW SẢN PHẨM  --> 
                    <div id="reviews" class="customer-review-product">  <!-- KHỐI REVIEW SẢN PHẨM  --> 
                        <div><p>ĐÂY LÀ KHỐI KẾT QUẢ ĐÁNH GIÁ SẢN PHẨM</p></div>          
                    </div>  
                <!--#endregion -->      
            </div>
        </div>  
    <!-- #endregion -->

    
    <?php
    // KHÔNG CẦN HIỂU SÂU, ĐÂY ĐƠN GIẢN LÀ CÚ PHÁP CỦA PHP TRONG WORDPRESS THÔI, NÊN TUÂN THỦ.
    // // Quay lại PHP để kết thúc hàm Thực ra đây là cách viết chuẩn trong WordPress/PHP:    
    // Shortcode trong WordPress bắt buộc phải trả về một chuỗi (string). 
    // Nếu bạn không mở lại PHP để viết return ob_get_clean();,
    //  thì hàm sẽ không trả về gì cả → shortcode khi gọi ra sẽ trống, không hiển thị HTML.
    // HTML ở bước 2 có, nhưng nếu thiếu bước 3 thì shortcode không “xuất” được HTML đó ra ngoài. 
    // Bước 3 chính là cầu nối để WordPress nhận nội dung và hiển thị.
    return ob_get_clean();
    

}

add_shortcode('joinex_product_detail', 'joinex_product_detail_shortcode');

    
