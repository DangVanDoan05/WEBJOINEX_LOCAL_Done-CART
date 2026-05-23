//#region thuộc tính phần thư viện hình ảnh sản phẩm
document.addEventListener("DOMContentLoaded", function () {
  const mainImage = document.getElementById("current-main-image");
  const thumbs = document.querySelectorAll(".thumb-image");
  const slider = document.querySelector(".images-gallery-product.slider");
  const btnPrev = document.querySelector(".btn-prev");
  const btnNext = document.querySelector(".btn-next");

  let currentIndex = 0; // ảnh đang active
  let startIndex = 0; // ảnh đầu tiên trong khung
  const maxVisible = 4; // số thumbnail hiển thị

  function showImage(index) {
    mainImage.src = thumbs[index].src.replace("-150x150", "");
    thumbs.forEach((t) => t.classList.remove("active"));
    thumbs[index].classList.add("active");
    currentIndex = index;
  }

  function updateSlider() {
    // dịch slider theo startIndex
    const thumbWidth = thumbs[0].offsetWidth;
    slider.scrollTo({
      left: startIndex * thumbWidth,
      behavior: "smooth",
    });
  }

  btnNext.addEventListener("click", () => {
    if (currentIndex < thumbs.length - 1) {
      currentIndex++;
      // nếu active vượt quá khung hiển thị thì dịch startIndex
      if (currentIndex >= startIndex + maxVisible) {
        startIndex++;
        updateSlider();
      }
      showImage(currentIndex);
    }
  });

  btnPrev.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      // nếu active nhỏ hơn startIndex thì dịch startIndex ngược lại
      if (currentIndex < startIndex) {
        startIndex--;
        updateSlider();
      }
      showImage(currentIndex);
    }
  });

  // click trực tiếp thumbnail
  thumbs.forEach((thumb, index) => {
    thumb.addEventListener("click", () => {
      showImage(index);
    });
  });

  // khởi tạo
  showImage(currentIndex);
  updateSlider();
});
//#endregion



//#region JS CHO PHẦN NÚT BẤM.
document.addEventListener("DOMContentLoaded", function () {
  console.log("✅ JS joinex PHẦN CHỌN SỐ LƯỢNG SẢN PHẨM đã load và đang chạy!");

  const qtyInput = document.querySelector(".qty-input-joinex");
  const minusBtn = document.querySelector(".minus-joinex");
  const plusBtn = document.querySelector(".plus-joinex");

  minusBtn.addEventListener("click", function () {
    let value = parseInt(qtyInput.value);
    if (value > 1) qtyInput.value = value - 1;
    console.log("Số lượng sau khi trừ:", qtyInput.value);
  });

  plusBtn.addEventListener("click", function () {
    let value = parseInt(qtyInput.value);
    qtyInput.value = value + 1;
    console.log("Số lượng sau khi cộng:", qtyInput.value);
  });
});
//#endregion

//#region   MÔ TẢ DÀI SẢN PHẨM

document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".tab-link-joinex");
  const panes = document.querySelectorAll(".tab-pane-joinex");

  tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      // bỏ active cũ
      tabs.forEach((t) => t.classList.remove("active"));
      panes.forEach((p) => p.classList.remove("active"));

      // thêm active mới
      this.classList.add("active");
      const target = this.getAttribute("data-tab");
      document.getElementById(target).classList.add("active");
    });
  });
});

//#endregion

//#region   PHẦN THUỘC TÍNH SẢN PHẨM VÀ THÊM VÀO GIỎ HÀNG
document.addEventListener('DOMContentLoaded', function () {
    console.log("✅ JS JOINEX PHẦN THUỘC TÍNH ĐANG CHẠY");

    const attrButtons = document.querySelectorAll('.attr-btn');
    const variationIdInput = document.getElementById('selected-variation-id'); // hidden variation_id
    const priceDisplay = document.getElementById('block-price'); // Khối hiển thị giá

    function formatCurrency(value) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
    }

    function matchVariation() {
        let selectedAttributes = {};
        const activeButtons = document.querySelectorAll('.attr-btn.active');
        activeButtons.forEach(btn => {
            selectedAttributes[btn.dataset.attrName] = btn.dataset.attr;

            // Cập nhật hidden input attribute
            const hiddenAttrInput = document.querySelector('input[name="attribute_'+btn.dataset.attrName+'"]');
            if (hiddenAttrInput) hiddenAttrInput.value = btn.dataset.attr;
        });

        let matchedId = null;
        let matchedData = null;

        if (typeof variationData !== 'undefined') {
            for (const [vId, data] of Object.entries(variationData)) {
                let isMatch = true;
                for (const [attrName, attrValue] of Object.entries(data.attributes)) {
                    if (attrValue !== '' && selectedAttributes[attrName] !== attrValue) {
                        isMatch = false;
                        break;
                    }
                }
                if (isMatch && Object.keys(selectedAttributes).length === Object.keys(data.attributes).length) {
                    matchedId = vId;
                    matchedData = data;
                    break;
                }
            }
        }

        if (matchedId) {
            // Cập nhật ID biến thể
            variationIdInput.value = matchedId;

            // Cập nhật giá hiển thị
            if (priceDisplay && matchedData) {
                const salePrice = matchedData.sale_price;
                const regularPrice = matchedData.regular_price;

                if (salePrice && salePrice !== "") {
                    priceDisplay.innerHTML = `
                        <span class="sale-price">${formatCurrency(salePrice)}</span>
                        <span class="regular-price"><s>${formatCurrency(regularPrice)}</s></span>
                    `;
                } else {
                    priceDisplay.innerHTML = `
                        <span class="regular-price-no-sale">${formatCurrency(regularPrice)}</span>
                    `;
                }
            }

            console.log("Matched variation:", matchedId, matchedData);
        } else {
            variationIdInput.value = "";
            console.log("No variation matched", selectedAttributes);
        }
    }

    // Xử lý click: đổi trạng thái active và gọi matchVariation
    attrButtons.forEach(button => {
        button.addEventListener('click', function () {
            const group = this.closest('.button-variation-container');
            group.querySelectorAll('.attr-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            matchVariation();
        });
    });

    // Quét ngay khi load trang để nhận biến thể mặc định
    matchVariation();
});


//#endregion