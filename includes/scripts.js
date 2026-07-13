// ============================================
// Slick Slider 1: Main + Nav Slider
// ============================================
$(".slider-for").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  asNavFor: ".slider-nav",
});

$(".slider-nav").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: ".slider-for",
  dots: true,
  centerMode: true,
  focusOnSelect: true,
});

// ============================================
// Slick Slider 2: Fade Slider
// ============================================
$(".fade-slider").slick({
  autoplay: true,
  dots: true,
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: "linear",
});

// ============================================
// Slick Slider 3: Responsive
// ============================================
$(".responsive").slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
      },
    },
  ],
});

// ============================================
// AOS Animation Init
// ============================================
AOS.init({
  duration: 1200,
});

// Add to cart logic
$(document).on("click", ".add-to-cart-btn", function () {
  var product_id = $(this).val();
  var qty = $(".qty-input").val(); // Quantity field ki class
  var paper_type = $('select[name="paper_type"]').val(); // Select box ki value

  $.ajax({
    url: "../ajax/handle-cart.php",
    method: "POST",
    data: {
      add_to_cart: true,
      product_id: product_id,
      qty: qty,
      paper_type: paper_type,
    },
    success: function (response) {
      try {
        var res = JSON.parse(response);
        if (res.status == "success") {
          $(".kt-cart-total").text(res.cart_count);
          alert("Product added to cart!");
        }
      } catch (e) {
        console.error("Invalid JSON:", response);
      }
    },
  });
});
