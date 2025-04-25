let swiper = new Swiper(".our-team-slider-wrap", {
  slidesPerView: 1,
  spaceBetween: 24,
  centeredSlides: false,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    520: {
      slidesPerView: 1.5,
      centeredSlides: false,
    },
    680: {
      slidesPerView: 2,
      centeredSlides: false,
    },
    820: {
      slidesPerView: 2.5,
      centeredSlides: false,
    },
    1024: {
      slidesPerView: 3,
      centeredSlides: false,
    },
    1240: {
      slidesPerView: 3.5,
      centeredSlides: false,
    },
    1440: {
      slidesPerView: 4.2,
      centeredSlides: false,
    },
  },
});
