document.addEventListener('DOMContentLoaded', function () {
  const swiperBlocks = document.querySelectorAll('.swiper-block:not(.is-initialized)');

  swiperBlocks.forEach((container) => {
    const config = {
      loop: true,
      slidesPerView: 3,
      pagination: {
        el: container.querySelector('.swiper-pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: container.querySelector('.swiper-button-next'),
        prevEl: container.querySelector('.swiper-button-prev'),
      },
      // Дополнительные настройки
      autoplay: {
        delay: 5000,
      },
    };

    // Инициализация
    new Swiper(container, config);

    // Помечаем как инициализированный
    container.classList.add('is-initialized');
  });
});