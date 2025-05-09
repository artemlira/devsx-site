(function ($) {

  // wow animate
  wow = new WOW(
    {
      boxClass: 'wow',
      animateClass: 'animated',
      offset: 0,
      mobile: true,
      live: true
    }
  )
  wow.init();


  // Open mobile menu
  $('.header-burger').on('click', function (e) {
    e.stopPropagation();
    $('.mobile-menu').addClass('active');
    $('body').addClass('mobile-menu-active');
    $('.mobile-menu').hasClass('active') ? freezeScroll() : unfreezeScroll();
  });

  //close-mobile-menu
  $('.close-mobile-menu').on('click', function (e) {
    e.stopPropagation();
    $('.mobile-menu').removeClass('active');
    $('body').removeClass('mobile-menu-active');
    $('.mobile-menu .menu .menu-item-11 > .sub-menu').removeClass('active');
    $('.mobile-menu').hasClass('active') ? freezeScroll() : unfreezeScroll();
  });

  // Вставляємо кнопку "Назад" у .sub-menu всередині .menu-item-11
  $(".mobile-menu .menu .menu-item-11 > .sub-menu").each(function () {
    const backButton = $('<li class="back-button"><a href="#">Services</a></li>');
    $(this).prepend(backButton);
  });

// Відкриваємо підменю при клікуxwxx на .menu-item-11
  $('.mobile-menu .menu .menu-item-11').on('click', function (e) {
    e.stopPropagation();
    let $submenu = $(this).children('.sub-menu');

    if ($submenu.length) {
      $submenu.addClass('active');
    }
  });

// Закриваємо підменю при кліку на кнопку "Назад"
  $(".mobile-menu .menu .menu-item-11 > .sub-menu .back-button").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).closest(".sub-menu").removeClass("active");
  });

  //
  // Menu Services Actions Desktop
  //
  var scrollPos = 0;

  function freezeScroll() {
    scrollPos = $(window).scrollTop();
    var offset = $('body').hasClass('admin-bar') ? 32 : 0;
    $('body').css({
      'position': 'fixed',
      'top': -(scrollPos - offset) + 'px',
      'width': '100%'
    });
    $('body').addClass('services-menu-active');
  }

  function unfreezeScroll() {
    $('body').css({
      'position': '',
      'top': '',
      'width': ''
    });
    $(window).scrollTop(scrollPos);
    $('body').removeClass('services-menu-active');
  }

  $('#menu-item-11').on('click', function (e) {
    e.stopPropagation();
    var $menuItem = $(this);
    if ($menuItem.hasClass('active')) {
      $menuItem.children('.sub-menu').removeClass('active');
      $menuItem.removeClass('active');
      $('body').removeClass('services-menu-active');
      unfreezeScroll();
    } else {
      $menuItem.children('.sub-menu').addClass('active');
      $menuItem.addClass('active');
      $('body').addClass('services-menu-active');
      freezeScroll();
    }
  });
  $(document).on('click', function (e) {
    if (!$(e.target).closest('#menu-item-11').length && $('#menu-item-11').hasClass('active')) {
      $("#menu-item-11 > .sub-menu").removeClass('active');
      $("#menu-item-11").removeClass('active');
      $('body').removeClass('services-menu-active');
      unfreezeScroll();
    }
  });

  //
  // Services Slider
  //
  $('.home-services-slider-container').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  //
  // Services Slider Dynamic Padding
  //
  if ($('.home-services-slider .container').length > 0) {
    var slider_offset = $('.home-services-slider .container').offset().left + 16;
    $('.home-services-slider-wrap').css('padding-left', slider_offset + 'px');
    $(window).resize(function () {
      var slider_offset = $('.home-services-slider .container').offset().left + 16;
      $('.home-services-slider-wrap').css('padding-left', slider_offset + 'px');
    });

  }


  //
  // Fullscreen Swipper Home Page
  // //
  // gsap.registerPlugin(ScrollTrigger);

  // let allowScroll = true;
  // let scrollTimeout = gsap.delayedCall(1, () => allowScroll = true).pause();
  // let currentIndex = 0;
  // let swipePanels = gsap.utils.toArray(".swipe-section .panel");

  // gsap.set(swipePanels, { zIndex: i => swipePanels.length - i });

  // let intentObserver = ScrollTrigger.observe({
  //     type: "wheel,touch",
  //     onUp: () => allowScroll && gotoPanel(currentIndex - 1, false),
  //     onDown: () => allowScroll && gotoPanel(currentIndex + 1, true),
  //     tolerance: 10,
  //     preventDefault: true,
  //     onEnable(self) {
  //         allowScroll = false;
  //         scrollTimeout.restart(true);
  //         let savedScroll = self.scrollY();
  //         self._restoreScroll = () => self.scrollY(savedScroll);
  //         document.addEventListener("scroll", self._restoreScroll, { passive: false });
  //     },
  //     onDisable: self => document.removeEventListener("scroll", self._restoreScroll)
  // });
  // intentObserver.disable();

  // function gotoPanel(index, isScrollingDown) {
  //     if ((index === swipePanels.length && isScrollingDown) || (index === -1 && !isScrollingDown)) {
  //         intentObserver.disable();
  //         return;
  //     }
  //     allowScroll = false;
  //     scrollTimeout.restart(true);

  //     let target = isScrollingDown ? swipePanels[currentIndex] : swipePanels[index];
  //     gsap.to(target, {
  //         yPercent: isScrollingDown ? -100 : 0,
  //         duration: 0.75
  //     });

  //     currentIndex = index;
  //     updateActiveNav(currentIndex);
  // }

  // let swipeContainer = document.querySelector(".swipe-container");
  // let offsetTop = swipeContainer.getBoundingClientRect().top + window.scrollY;

  // ScrollTrigger.create({
  //     trigger: ".swipe-section",
  //     pin: true,
  //     start: offsetTop,
  //     end: "0",
  //     onEnter: (self) => {
  //         if (intentObserver.isEnabled) return;
  //         self.scroll(self.start + 1);
  //         intentObserver.enable();
  //     },
  //     onEnterBack: (self) => {
  //         if (intentObserver.isEnabled) return;
  //         self.scroll(self.end - 1);
  //         intentObserver.enable();
  //     }
  // });

  // function updateActiveNav(index) {
  //     document.querySelectorAll('.nav-link').forEach((link, i) => {
  //         link.classList.toggle('active', i === index);
  //     });
  // }

  // document.querySelectorAll('.nav-link').forEach(link => {
  //     link.addEventListener('click', function (e) {
  //         e.preventDefault();
  //         let index = parseInt(this.dataset.index);
  //         gotoPanel(index, index > currentIndex);
  //     });
  // });


  $(".item-active .slide").each(function () {
    let $slide = $(this);
    let text = $slide.children(".h5").first().prop("outerHTML");

    for (let i = 0; i < 20; i++) {
      $slide.append(text);
    }
  });

  document.querySelectorAll('.industries-item').forEach(item => {
    let animation;

    item.addEventListener('mouseenter', function () {
      let elt = this.querySelectorAll('.item-active .slide > *');

      animation = anime({
        targets: elt,
        translateX: '-100%',
        duration: 12000,
        easing: 'linear',
        loop: true,
        autoplay: true
      });
    });

    item.addEventListener('mouseleave', function () {
      if (animation) {
        animation.pause();
        animation.seek(0);
      }
    });
  });


  //
  // Testimonial Slider
  //
  $('.testimonials-carousel').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });


  //show header on scroll top
  const header = $('.site-header');
  const heroSection = $('.site-header');
  let lastScrollTop = 0;

  $(window).on('scroll', function () {
    let scrollTop = $(this).scrollTop();
    let heroHeight = heroSection.outerHeight();

    if (scrollTop > heroHeight) {
      if (scrollTop < lastScrollTop) {

        header.addClass('fixed').removeClass('hidden');
      } else {

        header.removeClass('fixed').addClass('hidden');
      }
    } else {
      header.removeClass('fixed hidden');
    }

    lastScrollTop = scrollTop;
  });


  let hero_video = $("#hero-video-mobile")[0];
  let overlay = $(".overlay");


  $("#play-video").on("click", function () {
    if (hero_video.paused) {
      hero_video.play();
      overlay.fadeOut(300);
    }
  });


  $("#hero-video-mobile").on("click", function () {
    if (hero_video.paused) {
      hero_video.play();
      hero_video.fadeOut(300);
    } else {
      hero_video.pause();
      overlay.fadeIn(300);
    }
  });


  //testimonial bottom slider
  if ($('.testiomonials-slider-full-width').length > 0) {
    $('.testiomonials-slider-full-width').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      autoplay: false,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }


  // Спочатку відкриті ВСІ
  //$('.accordion-item').addClass('active').find('.accordion-content').show();

  $('.services-toggle-items .accordion-header').on('click', function () {

    var $accordionItem = $(this).closest('.accordion-item');
    var $accordionContent = $accordionItem.find('.accordion-content');

    // Перемикаємо активний стан (закрити або відкрити)
    if ($accordionItem.hasClass('active')) {

      $accordionContent.stop().slideUp(300);
      $accordionItem.removeClass('active');

    } else {

      $accordionContent.stop().slideDown(300);
      $accordionItem.addClass('active');

    }

  });


}(jQuery));

document.addEventListener('DOMContentLoaded', function () {
  // Выбираем все заголовки с h2 по h6
  const headings = document.querySelectorAll('h2, h3, h4, h5, h6');
  const tocItems = document.querySelectorAll('.toc-item');
  const progressFill = document.querySelector('.progress-bar::after');
  let animating = false;

  // Функция сортировки заголовков по их позиции в документе
  const sortedHeadings = Array.from(headings).sort((a, b) => {
    return a.offsetTop - b.offsetTop;
  });

  function updateProgress() {
    if (animating) return;
    animating = true;

    const scrollPosition = window.scrollY + window.innerHeight / 2;
    let currentIndex = 0;
    let passedHeight = 0;

    // Итерируем через отсортированные заголовки
    sortedHeadings.forEach((heading, index) => {
      const rect = heading.getBoundingClientRect();
      if (rect.top <= window.innerHeight / 2) {
        currentIndex = index;
        passedHeight = rect.bottom + window.scrollY;
      }
    });

    // Обновление классов
    tocItems.forEach((item, index) => {
      item.classList.remove('active', 'passed');
      if (index < currentIndex) item.classList.add('passed');
      if (index === currentIndex) item.classList.add('active');
    });

    // Расчет прогресса
    const start = sortedHeadings[0]?.offsetTop || 0;
    const end = sortedHeadings[sortedHeadings.length - 1]?.offsetTop || document.documentElement.scrollHeight;
    const totalHeight = end - start;
    const currentProgress = totalHeight > 0
      ? ((passedHeight - start) / totalHeight) * 100
      : 0;

    // Плавное обновление прогресс-бара
    gsap.to(progressFill, {
      height: `${Math.min(currentProgress, 100)}%`,
      duration: 0.8,
      ease: "power2.out",
      onComplete: () => animating = false
    });

    requestAnimationFrame(updateProgress);
  }

  // Плавный скролл для якорей
  document.querySelectorAll('.toc-item a').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  window.addEventListener('scroll', updateProgress);
  window.addEventListener('resize', updateProgress);
  updateProgress();
});

// document.addEventListener('DOMContentLoaded', function () {
//   const headings = document.querySelectorAll('h2, h3');
//   const tocItems = document.querySelectorAll('.toc-item');
//   const progressFill = document.querySelector('.progress-bar::after');
//   let animating = false;
//
//   function updateProgress() {
//     if (animating) return;
//     animating = true;
//
//     const scrollPosition = window.scrollY + window.innerHeight / 2;
//     let currentIndex = 0;
//     let passedHeight = 0;
//
//     headings.forEach((heading, index) => {
//       const rect = heading.getBoundingClientRect();
//       if (rect.top <= window.innerHeight / 2) {
//         currentIndex = index;
//         passedHeight = rect.bottom + window.scrollY;
//       }
//     });
//
//     // Обновление классов
//     tocItems.forEach((item, index) => {
//       item.classList.remove('active', 'passed');
//       if (index < currentIndex) item.classList.add('passed');
//       if (index === currentIndex) item.classList.add('active');
//     });
//
//     // Расчет прогресса
//     const start = headings[0]?.offsetTop || 0;
//     const end = headings[headings.length - 1]?.offsetTop || document.documentElement.scrollHeight;
//     const totalHeight = end - start;
//     const currentProgress = ((passedHeight - start) / totalHeight) * 100;
//
//     // Плавное обновление прогресс-бара
//     gsap.to(progressFill, {
//       height: `${Math.min(currentProgress, 100)}%`,
//       duration: 0.8,
//       ease: "power2.out",
//       onComplete: () => animating = false
//     });
//
//     requestAnimationFrame(updateProgress);
//   }
//
//   // Плавный скролл для якорей
//   document.querySelectorAll('.toc-item a').forEach(link => {
//     link.addEventListener('click', function (e) {
//       e.preventDefault();
//       const target = document.querySelector(this.getAttribute('href'));
//       target.scrollIntoView({
//         behavior: 'smooth',
//         block: 'start'
//       });
//     });
//   });
//
//   window.addEventListener('scroll', updateProgress);
//   window.addEventListener('resize', updateProgress);
//   updateProgress();
// });