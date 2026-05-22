<div class="cc-checkout-container">

        <!-- Tiêu đề chính -->
        <h1 class="cc-main-title">Thông tin giao hàng</h1>
        <!-- Tiêu đề phụ -->
        <p class="cc-sub-title">Vui lòng nhập thông tin nhận hàng của bạn</p>


        <!-- Khối 2 cột -->
        <div class="cc-checkout-wrap"> <!-- Đây là khối bao ngoài cùng 2 khối thanh toán. -->

         

            <div class="cc-left">
                <!-- ĐÂY LÀ FORM NHẬP THÔNG TIN KHÁCH HÀNG. -->
                    <form class="cc-form" method="post">

                        <!-- Hàng họ tên + số điện thoại -->
                        <div class="cc-row cc-row--two">
                            <label class="cc-field">
                                <span class="cc-label">Họ và tên *</span>
                                <input type="text" name="cc_fullname" required placeholder="Nhập họ tên">
                            </label>

                            <label class="cc-field">
                                <span class="cc-label">Số điện thoại *</span>
                                <input type="tel" name="cc_phone" required placeholder="Nhập số điện thoại"
                                    pattern="[0-9]{9,11}">
                            </label>
                        </div>

                            <!-- Email -->
                            <div class="cc-row">
                                <label class="cc-field">
                                    <span class="cc-label">Email <small class="cc-optional">(Tùy chọn)</small></span>
                                    <input type="email" name="cc_email" placeholder="example@gmail.com">
                                </label>
                            </div>

                            <!-- Load tỉnh và thành phố -->
                            <div class="cc-row cc-row--two">
                                <label class="cc-field">
                                    <span class="cc-label">Tỉnh/Thành phố *</span>
                                    <select id="province" name="cc_province" required>
                                        <option value="">Chọn Tỉnh/TP</option>
                                    </select>
                                </label>

                                <label class="cc-field">
                                    <span class="cc-label">Xã/Phường *</span>
                                    <select id="ward" name="cc_ward" required>
                                        <option value="">Chọn Xã/Phường</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Địa chỉ cụ thể --> 
                            <div class="cc-row">
                                            <label class="cc-field">
                                <span class="cc-label">Địa chỉ cụ thể *</span>
                                <textarea 
                                    name="cc_address"
                                    class="cc-address"
                                    required
                                    placeholder="Số nhà, đường, phường, quận..."
                                ></textarea>
                                </label>
                            </div>

                            <div class="cc-row-checkbox">
                                <label class="cc-checkbox1">       
                                    <label class="cc-checkbox">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="cc-label-invoice">Xuất hóa đơn GTGT</span>
                                </label>
                            </div>

                            <!-- Vĩ độ và Kinh độ --> 
                            <!--<div class="cc-row cc-row--two"> 
                                <label class="cc-field">
                                    <span class="cc-label">Vĩ độ (Latitude)</span>
                                    <input type="text" id="lat" name="cc_lat" readonly>
                                </label>

                                <label class="cc-field">
                                    <span class="cc-label">Kinh độ (Longitude)</span>
                                    <input type="text" id="lng" name="cc_lng" readonly> 
                                </label>
                            </div> -->

                            <!-- Nút lấy tọa độ -->
                            <!--<button type="button" id="getCoords">Lấy tọa độ</button>

                            <button type="button" id="findNearestStore">Tìm cửa hàng gần nhất</button>-->

                            <!-- NÚT ĐẶT HÀNG -->

                            <!--<div class="cc-row">
                                <button type="submit" class="cc-btn">Đặt hàng</button>
                            </div>-->

                            <input type="hidden" name="nearest_store_manager" id="nearest_store_manager">
                        
                        </form>
                 <!-- ĐÂY LÀ FORM NHẬP THÔNG TIN KHÁCH HÀNG. -->
                    <div class="cc-install-box">

                        <!-- KHỐI ICON -->
                        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

                        <div class="cc-icon-box">
                            <div class="cc-install-icon">
                            <span class="material-icons">build</span>
                            </div>
                        </div>

                        <div class="cc-install-content">
                            <div class="cc-install-title">
                                Dịch vụ lắp đặt tại nhà
                                <span class="cc-install-badge">Bạn thuộc vùng hỗ trợ lắp đặt kỹ thuật</span>
                            </div>

                            <div class="cc-install-desc">
                                Phí lắp đặt sẽ được đại lý tư vấn và thu trực tiếp sau khi khách hàng đồng ý sử dụng dịch vụ lắp đặt tại nhà
                            </div>
                        </div>

                    </div>

                <!-- ĐÂY LÀ KHỐI PHƯƠNG THỨC THANH TOÁN. -->

                    <div class="cc-payment-box">

                        <div class="cc-payment-title">
                            <img src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/CheckoutIMG/payment.png'; ?>" alt="">
                            <span class="cc-payment-title-text">Phương thức thanh toán</span>
                        </div>

                        <div class="cc-payment-item">
                            <div class="cc-payment-item-truck">                                                         
                                <img class="cc-img-truck"  src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/CheckoutIMG/XeTai.png'; ?>" alt="COD">                              
                                <div class="cc-payment-content">
                                    <div class="cc-payment-name">
                                        Thanh toán khi nhận hàng (COD)
                                    </div>
                                    <div class="cc-payment-desc">
                                        Thanh toán tiền mặt khi nhận hàng
                                    </div>
                                </div>
                            </div>
                            <div class="cc-payment-item-check">
                                <!--INPUT NÀY ĐỂ CẢI BIÊN SAU TẠM THỜI ĐỂ HÌNH ẢNH VÀO ĐÃ.-->
                                <!--<input type="radio" name="payment_method" checked> -->                                
                                <img class="cc-img-check" src="<?php echo JOINEX_PLUGIN_URL . 'assets/img/CheckoutIMG/DauTich.png'; ?>" alt="">                                     
                            </div>
                        </div>

                    </div>

                    <div class="cc-checkout-bottom">

                  
              <!-- ĐÂY LÀ KHỐI ĐIỀU KHOẢN DỊCH VỤ.-->

                <div class="cc-agree">
                    <label>
                        <label class="cc-checkbox">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                        </label>
                        Tôi đồng ý với 
                        <a href="#">Điều khoản dịch vụ</a> 
                        và 
                        <a href="#">Chính sách bảo mật</a> 
                        của website Joinex
                    </label>
                </div>

                <div class="cc-checkout-actions">

                    <a href="#" class="cc-back-cart">
                        &lt; Quay lại giỏ hàng
                    </a>

                    <button class="cc-btn-order">
                        Xác nhận đơn hàng →
                    </button>

                </div>

                </div>    

            </div> 

                <!-- Đoạn script chạy tổng thể -->

                <script>

                jQuery(document).ready(function($) {
                    const provinceSelect = document.getElementById("province");
                    const wardSelect = document.getElementById("ward");

                    // Load JSON
                    fetch("<?php echo plugin_dir_url(__FILE__); ?>vn_locations.json?v=" + Date.now())
                        .then(res => res.json())
                        .then(data => {
                        window.vnLocations = data;

                        // Render provinces
                        provinceSelect.innerHTML = '<option value="">Chọn Tỉnh/TP</option>';
                        Object.keys(data).forEach(provinceName => {
                            provinceSelect.appendChild(new Option(provinceName, provinceName));
                        });

                        // Init Select2 cho province
                        const $p = $('#province');
                        $p.select2({ placeholder: 'Chọn Tỉnh/TP', allowClear: true, width: '100%' });
                        });

                    // Khi chọn tỉnh
                    $('#province').on('change', function() {
                        wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';
                        const selectedProvince = this.value;
                        const wards = window.vnLocations[selectedProvince] || [];
                        wards.forEach(w => wardSelect.appendChild(new Option(w, w)));

                        // Init Select2 cho ward
                        const $w = $('#ward');
                        $w.select2({ placeholder: 'Chọn Xã/Phường', allowClear: true, width: '100%' });
                    });
                    });

                </script>

                <!-- Đoạn script gán user quản lý.-->

                <script>

                    document.getElementById("nearest_store_manager").value = nearestStore.manager;

                </script>

                 <!-- Đoạn script lấy ra được tọa độ của nơi khách hàng nhập -->

                 <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const btn = document.getElementById("getCoords");

                        if (!btn) {
                            console.log("❌ Không tìm thấy nút getCoords");
                            return;
                        }

                        function geocodeAddress(address) {
                            const url = "https://nominatim.openstreetmap.org/search?format=json&limit=1&countrycodes=vn&q=" 
                                    + encodeURIComponent(address);

                            return fetch(url, {
                                headers: {
                                    "User-Agent": "KamaShop/1.0 (contact@yourdomain.com)"
                                }
                            }).then(res => res.json());
                        }

                        btn.addEventListener("click", function () {
                            const citySelect = document.getElementById("province");
                            const wardSelect = document.getElementById("ward");
                            const addressInput = document.querySelector('input[name="cc_address"]');
                            const latInput = document.getElementById("lat");
                            const lngInput = document.getElementById("lng");

                            if (!citySelect || !wardSelect || !addressInput || !latInput || !lngInput) {
                                console.log("❌ Thiếu field địa chỉ hoặc lat/lng");
                                return;
                            }

                            const city = citySelect.options[citySelect.selectedIndex].text;
                            const ward = wardSelect.options[wardSelect.selectedIndex].text;
                            const address = addressInput.value.trim();

                            if (!address) {
                                alert("Vui lòng nhập địa chỉ cụ thể");
                                return;
                            }

                            const fullAddress = address + ", " + ward + ", " + city + ", Việt Nam";
                            console.log("🔎 Try full:", fullAddress);

                            // clear tọa độ cũ
                            latInput.value = "";
                            lngInput.value = "";

                            geocodeAddress(fullAddress).then(data => {
                                console.log("📦 API result:", data);

                                if (data.length > 0) {
                                    latInput.value = data[0].lat;
                                    lngInput.value = data[0].lon;
                                } else {
                                    // fallback: bỏ số nhà
                                    const shortAddress = ward + ", " + city + ", Việt Nam";
                                    console.log("🔁 Fallback:", shortAddress);

                                    geocodeAddress(shortAddress).then(data2 => {
                                        console.log("📦 Fallback result:", data2);

                                        if (data2.length > 0) {
                                            latInput.value = data2[0].lat;
                                            lngInput.value = data2[0].lon;
                                        } else {
                                            alert("Không tìm được tọa độ cho khu vực này");
                                        }
                                    });
                                }
                            }).catch(err => {
                                console.error("❌ Lỗi fetch:", err);
                                alert("Lỗi khi gọi API lấy tọa độ");
                            });
                        });
                    });
                    </script>
                                                            
                    <!-- Thêm thanh tìm kiếm gõ tên tỉnh thành. -->                      
                        <script>
                            $(document).ready(function() {
                            $('#province').select2({
                                dropdownParent: $('#province').parent(),
                                dropdownPosition: 'below',
                                placeholder: "Chọn Tỉnh/TP",
                                allowClear: true
                            });
                            });
                        </script>
                        <!-- Đoạn để đổ Dropdown xuống phía bên dưới. -->
                        <script>
                            jQuery(document).ready(function($) {
                                $('#province').select2({
                                    placeholder: "Chọn Tỉnh/TP",
                                    dropdownParent: $('#province').parent(),
                                    dropdownPosition: 'below',
                                    allowClear: true
                                });
                            });

                            jQuery(document).ready(function($) {
                            $('#ward').select2({
                                placeholder: "Chọn Xã/Phường",
                                dropdownParent: $('#ward').parent(),
                                dropdownPosition: 'below',
                                allowClear: true
                            });
                         });

                        </script>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const provinceSelect = document.getElementById("province");
                                const wardSelect = document.getElementById("ward");                   
                            });
                        </script>

             <!-- KHỐI HIỂN THỊ CÁC SẢN PHẨM KHÁCH ĐẶT -->

             <div class="cc-right">

                            <div class="cc-cart-title">Đơn hàng của bạn </div> 
                                                          
                                <?php

                                    $cart = WC()->cart;

                                    if ( ! $cart || $cart->is_empty() ) {

                                        echo '<p class="cc-cart-title">Giỏ hàng trống.</p>';

                                    } else {

                                        // Lặp qua các sản phẩm trong giỏ
                                        foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {

                                            $product = $cart_item['data'];
                                            $product_id = $cart_item['product_id'];

                                            $product_name  = $product->get_name();
                                            $product_price = $product->get_price();
                                            $product_image = $product->get_image( 'thumbnail' );

                                            $qty = $cart_item['quantity'];

                                            // =========================
                                            // LẤY THUỘC TÍNH SẢN PHẨM
                                            // =========================

                                            $length   = '';
                                            $diameter = '';

                                    if ( ! empty( $cart_item['variation'] ) ) {

                                        // Thuộc tính chiều dài dây vòi
                                        if ( isset( $cart_item['variation']['attribute_pa_chieu-dai-day-voi'] ) ) {

                                            $length_slug = $cart_item['variation']['attribute_pa_chieu-dai-day-voi'];

                                            $term = get_term_by(
                                                'slug',
                                                $length_slug,
                                                'pa_chieu-dai-day-voi'
                                            );

                                            if ( $term ) {
                                                $length = $term->name;
                                            }

                                        }

                                        // Thuộc tính đường kính trong
                                        if ( isset( $cart_item['variation']['attribute_pa_duong-kinh-trong'] ) ) {

                                            $diameter_slug = $cart_item['variation']['attribute_pa_duong-kinh-trong'];

                                            $term = get_term_by(
                                                'slug',
                                                $diameter_slug,
                                                'pa_duong-kinh-trong'
                                            );

                                            if ( $term ) {
                                                $diameter = $term->name;
                                            }
                                        }
                                    }
                                    ?>
                                

                            <div class="cc-cart-item-wrap">

                                <div class="cc-cart-item" style="display:flex;gap:10px;margin-bottom:15px;">
                                     <!-- ĐÂY LÀ PHẦN HÌNH ẢNH SẢN PHẨM. -->

                                     <div class="cc-cart-img">

                                        <div class="cc-so-luon-SP">

                                            <!-- ĐÂY LÀ PHẦN SỐ LƯỢNG SẢN PHẨM. -->

                                            x<?php echo $qty; ?>

                                        </div>

                                    <?php echo $product_image; ?>

                                    </div>

                                    <div class="cc-cart-info">

                                        <div class="cc-product-name">
                                            <?php echo $product_name; ?>
                                        </div>

                                        <div class="cc-product-attributes">

                                            <?php if ( $length ) { ?>
                                                <div>Độ dài dây: <?php echo $length; ?> | </div>
                                            <?php } ?>

                                            <?php if ( $diameter ) { ?>
                                                <div>Đường kính trong: <?php echo $diameter; ?></div>
                                            <?php } ?>

                                        </div>
                                            <!-- Chỗ này hiển thị ra giá tiền sản phẩm. -->
                                        <div  class="cc-cart-price"><?php echo wc_price( $product_price ); ?></div>

                                    </div>

                                </div>
                            </div>

                            <?php
                        }

                        $subtotal = $cart->get_subtotal();
                        $total    = $cart->get_total();
                        ?>

                        <!-- Đây rồi, thẻ HR là thẻ tạo ra đường phân cách.-->
                        <!-- <hr> -->

                        <!-- KHỐI NHẬP LIỆU MÃ GIẢM GIÁ.-->
                         
                        <div class="cc-coupon-box">
                            <input 
                                type="text" 
                                class="cc-coupon-input" 
                                placeholder="Mã giảm giá"
                            >
                            <button class="cc-coupon-btn">
                                Áp dụng
                            </button>
                        </div>

                            <div class="cc-total-wrap">

                                <div class="cc-total">

                                    <!-- <div>Tạm tính: <?php echo $subtotal; ?></div> -->

                                      <!-- Quên mất không nhét giá động vào đây-->

                                      <!-- GIÁ TẠM TÍNH.-->

                                    <div class="row-subtotal">
                                        <div class="title-subtotal">Tạm tính</div>
                                        <div class="subtotal-price"><?php echo wc_price($subtotal); ?></div>
                                    </div>

                                    <!-- <div>Phí vận chuyển: <?php echo wc_price(0); ?></div> -->

                                     <!-- PHÍ VẬN CHUYỂN -->
                                    <div class="row-ship-price">
                                        <div class="title-ship-price">Phí vận chuyển: </div>
                                        <div class="ship-price">Miễn phí</div>
                                    </div>

                                    <hr>

                                    <!--<div style="margin-top:10px;font-weight:bold;font-size:18px;">
                                        Tổng: <?php echo $total; ?>
                                    </div> -->

                                    <div class="row-total-price">
                                        <div class="title-total-price">Tổng cộng:</div>
                                        <div class="total-price"><?php echo $total; ?></div>
                                    </div>

                                </div>

                            </div>

                    <?php } ?>

                </div>
            
        </div>
    </div>