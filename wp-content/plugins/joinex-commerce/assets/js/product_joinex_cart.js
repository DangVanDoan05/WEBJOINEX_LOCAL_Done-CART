document.querySelectorAll('.quantity-box').forEach(function(box) {
  const input = box.querySelector('.qty-input');
  box.querySelector('.plus').addEventListener('click', function() {
    input.value = parseInt(input.value) + 1;
  });
  box.querySelector('.minus').addEventListener('click', function() {
    if (parseInt(input.value) > parseInt(input.min)) {
      input.value = parseInt(input.value) - 1;
    }
  });
});
