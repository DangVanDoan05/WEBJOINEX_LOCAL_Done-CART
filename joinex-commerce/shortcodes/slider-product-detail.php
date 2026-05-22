<?php
// Shortcode: [slider_joinex_product_detail]
function slider_joinex_product_detail_shortcode() {
    // Lấy ID sản phẩm từ query string (?product_id=123)
    $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
    if (!$product_id) return '<p>Không tìm thấy sản phẩm.</p>';

    $product = wc_get_product($product_id);
    if (!$product) return '<p>Không tìm thấy sản phẩm.</p>';

    ob_start(); ?>

    <!-- KHỐI HTML BẮT ĐẦU -->                
        <!-- KHỐI SẢN PHẨM  LIÊN QUAN -->
        <div id="relative-product-slider" class="relative-product-joinex-slider"> <!-- KHỐI SẢN PHẨM  LIÊN QUAN -->
            
            <?php
                $cat_id = isset($_GET['product_cat']) ? intval($_GET['product_cat']) : 0; // DANH MỤC SẢN PHẨM
                $order_by = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : ''; // Tham số để sắp xếp.
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1, // Quy ước của WORDPRESS Nếu bạn đặt -1, WordPress hiểu là “không giới hạn”, tức là lấy ra tất cả các bài viết/sản phẩm phù hợp với query.
                      //tức là lấy ra tất cả các bài viết/sản phẩm phù hợp với query.
                    'post_status'    => 'publish',
                    'orderby'        => 'ID',
                    'order'          => 'DESC',
                );                                  
                $loop = new WP_Query($args);                            
                ob_start();
                if ( $loop->have_posts()) { 
                    echo '<div class="product-list-slider-joinex-container-wrap">';
                        echo '<div class="product-list-slider-container">'; 
                            echo '<button id="prev-joinex-slider"><</button>';
                            echo '<div class="product-list-slider">';                      
                                echo '<div class="product-list-slider-joinex-track">';
                                    // VÒNG LẶP ĐỂ IN RA CÁC KHỐI SẢN PHẨM
                                    while ( $loop->have_posts() ) {
                                        $loop->the_post();
                                
                                        $product = wc_get_product( get_the_ID() );
                                        if ( ! $product ) continue;
                                
                                        // =============================
                                        // 🔥 LẤY GIÁ THẤP NHẤT (FIX FULL)
                                        // =============================
                                        $min_product = null;
                                
                                        if ( $product->is_type( 'variable' ) ) {
                                
                                            $min_price = null;
                                            $variation_ids = $product->get_children();
                                
                                            foreach ( $variation_ids as $vid ) {
                                                $variation = wc_get_product( $vid );
                                                if ( ! $variation ) continue;
                                
                                                $price = $variation->get_price();
                                
                                                if ( $price !== '' && is_numeric( $price ) ) {
                                                    $price = floatval( $price );
                                
                                                    if ( $min_price === null || $price < $min_price ) {
                                                        $min_price = $price;
                                                        $min_product = $variation;
                                                    }
                                                }
                                            }
                                
                                            // fallback nếu không tìm được biến thể
                                            if ( ! $min_product ) {
                                                $min_product = $product;
                                            }
                                
                                        } else {
                                            // 👉 sản phẩm đơn
                                            $min_product = $product;
                                        }
                                
                                        // =============================
                                        // 🔥 LẤY GIÁ AN TOÀN
                                        // =============================
                                        $regular_price = '';
                                        $sale_price    = '';
                                
                                        if ( $min_product && is_a( $min_product, 'WC_Product' ) ) {
                                            $regular_price = $min_product->get_regular_price();
                                            $sale_price    = $min_product->get_sale_price();
                                        }
                                
                                        // =============================
                                        // 🔥 TÍNH % GIẢM GIÁ
                                        // =============================
                                        $discount_percent = null;
                                
                                        if ( $sale_price && $regular_price && $regular_price > 0 ) {
                                            $discount_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                        }
                                        ?>
                                        <!-- PHẦN BẮT ĐẦU SHOW SẢN PHẨM -->
                                        <div class="product-slider-joinex-item">
                                            <a <?php echo joinex_get_product_detail_page_attrs( $product->get_id() ); ?>>
                                                <!--KHỐI HÌNH ẢNH SẢN PHẨM-->
                                                <div class="product-slider-joinex-item-image-container">                                                
                                                    <div class="product-slider-joinex-item-image">
                                                        <?php
                                                            echo $product->get_image();
                                    
                                                            if ( $discount_percent ) {
                                                                echo '<p class="discount-label">- ' . $discount_percent . '%</p>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div> 

                                                <!--KHỐI TIÊU ĐỀ SẢN PHẨM-->                                                                                 
                                                <div class="product-slider-joinex-item-title-container">

                                                        <div class="product-slider-joinex-item-title">
                                                            <h3><?php echo esc_html( get_the_title() ); ?></h3>
                                                        </div>  

                                                        <div class="product-slider-joinex-divider"></div>

                                                        <div class="product-price-add-to-cart-slider-joinex">
                                
                                                            <div class="price-min-real-price">
                                
                                                                <?php
                                                                // 👉 Có giá sale
                                                                if ( $sale_price ) {
                                                                    echo '<p class="HomePage_Sale_Price">' . wc_price( $sale_price ) . '</p>';
                                
                                                                    if ( $regular_price ) {
                                                                        echo '<p class="HomePage_Regular_Price">' . wc_price( $regular_price ) . '</p>';
                                                                    }
                                                                }

                                                                // 👉 Không có sale → giá thường
                                                                else {
                                                                    if ( $regular_price ) {
                                                                        echo '<p class="HomePage_Regular_Price_Sale">' . wc_price( $regular_price ) . '</p>';
                                                                    } else {
                                                                        echo '<p class="joinex_No_Price_Product">Chưa có giá sản phẩm.</p>';
                                                                    }
                                                                }
                                                                ?>
                                
                                                            </div>
                                
                                                            <div class="add-to-cart-joinex">
                                                                <a <?php echo joinex_get_product_detail_page_attrs( $product->get_id() ); ?>>
                                                                    <img class="cc-img-CartHomePage" 
                                                                        src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/ProductHomePageIMG/AddToCart.png'; ?>" 
                                                                        alt="Xem chi tiết sản phẩm">  
                                                                </a>
                                                            </div>
                                                        </div>                                                                      
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                echo '</div>';                       
                                echo '<div class="overlay-block"></div>';                                           
                            echo '</div>';
                            echo '<button id="next-joinex-slider">></button>';
                        echo '</div>';
                    echo '</div>';
                } else {
                    echo '<p class="no-products">Không có sản phẩm.</p>';
                } 
                wp_reset_postdata();
                return ob_get_clean();
            ?>
        </div>
    <?php
    return ob_get_clean();
}

add_shortcode('slider_joinex_product_detail', 'slider_joinex_product_detail_shortcode');

 