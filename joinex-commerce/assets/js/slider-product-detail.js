//#region   PHẦN SLIDER SẢN PHẨM LIÊN QUAN PHẢI HỌC THÔI CHỨ KHÔNG LÀ KHÔNG LÀM CHỦ ĐƯỢC ĐÂU

document.addEventListener("DOMContentLoaded", function () {
  console.log("✅ JS SLIDER ĐÃ ĐƯỢC LOAD");
  const track = document.querySelector(".product-list-slider-joinex-track");

  const btnPrev = document.getElementById("prev-joinex-slider");
  const btnNext = document.getElementById("next-joinex-slider");

  const itemWidth = 270.75 + 15;
  let scrollAmount = 0;
  let isSliding = false;

    console.log("🔍 track:", track);
  console.log("🔍 btnPrev:", btnPrev);
  console.log("🔍 btnNext:", btnNext);

  if (!track) {
    console.warn("⚠️ Không tìm thấy .product-list-slider-joinex-track");
  }
  if (!btnPrev) {
    console.warn("⚠️ Không tìm thấy #prev-joinex-slider");
  }
  if (!btnNext) {
    console.warn("⚠️ Không tìm thấy #next-joinex-slider");
  }

  function slide() {
    if (isSliding) return;
    isSliding = true;

    const firstItem = track.querySelector(".product-slider-joinex-item");
    const itemWidth = firstItem.offsetWidth + 20;

    track.appendChild(firstItem.cloneNode(true));
    track.removeChild(firstItem);

    track.style.transition = "transform 0.5s ease";
    track.style.transform = `translateX(-${itemWidth}px)`;

    setTimeout(() => {
      track.style.transition = "none";
      track.style.transform = "translateX(0)";
      isSliding = false;
    }, 500);
  }

  setInterval(slide, 3000);

  // NEXT
  btnNext.addEventListener("click", () => {
    scrollAmount += itemWidth;
    if (scrollAmount > track.scrollWidth - track.clientWidth) {
      scrollAmount = 0;
    }
    track.style.transition = "transform 0.5s ease";
    track.style.transform = `translateX(-${scrollAmount}px)`;
  });

  // PREV
  btnPrev.addEventListener("click", () => {
    scrollAmount -= itemWidth;
    if (scrollAmount < 0) {
      scrollAmount = track.scrollWidth - track.clientWidth;
    }
    track.style.transition = "transform 0.5s ease";
    track.style.transform = `translateX(-${scrollAmount}px)`;
  });
});

//#endregion
