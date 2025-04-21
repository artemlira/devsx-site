(function ($) {

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
$('#menu-item-11').on('click', function(e) {
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
$(document).on('click', function(e) {
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
    // autoplaySpeed: 3000,
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
var slider_offset = $('.home-services-slider .container').offset().left + 16;
$('.home-services-slider-wrap').css('padding-left', slider_offset+'px');
$(window).resize(function(){
    var slider_offset = $('.home-services-slider .container').offset().left + 16;
    $('.home-services-slider-wrap').css('padding-left', slider_offset+'px');
});
//console.log($('.home-services-slider .container').offset().left);


//
// Fullscreen Swipper Home Page
//
gsap.registerPlugin(ScrollTrigger);

let allowScroll = true;
let scrollTimeout = gsap.delayedCall(1, () => allowScroll = true).pause();
let currentIndex = 0;
let swipePanels = gsap.utils.toArray(".swipe-section .panel");

gsap.set(swipePanels, { zIndex: i => swipePanels.length - i });

let intentObserver = ScrollTrigger.observe({
    type: "wheel,touch",
    onUp: () => allowScroll && gotoPanel(currentIndex - 1, false),
    onDown: () => allowScroll && gotoPanel(currentIndex + 1, true),
    tolerance: 10,
    preventDefault: true,
    onEnable(self) {
        allowScroll = false;
        scrollTimeout.restart(true);
        let savedScroll = self.scrollY();
        self._restoreScroll = () => self.scrollY(savedScroll);
        document.addEventListener("scroll", self._restoreScroll, { passive: false });
    },
    onDisable: self => document.removeEventListener("scroll", self._restoreScroll)
});
intentObserver.disable();

function gotoPanel(index, isScrollingDown) {
    if ((index === swipePanels.length && isScrollingDown) || (index === -1 && !isScrollingDown)) {
        intentObserver.disable();
        return;
    }
    allowScroll = false;
    scrollTimeout.restart(true);

    let target = isScrollingDown ? swipePanels[currentIndex] : swipePanels[index];
    gsap.to(target, {
        yPercent: isScrollingDown ? -100 : 0,
        duration: 0.75
    });

    currentIndex = index;
    updateActiveNav(currentIndex);
}

let swipeContainer = document.querySelector(".swipe-container");
let offsetTop = swipeContainer.getBoundingClientRect().top + window.scrollY;

ScrollTrigger.create({
    trigger: ".swipe-section",
    pin: true,
    start: offsetTop,
    end: "0",
    onEnter: (self) => {
        if (intentObserver.isEnabled) return;
        self.scroll(self.start + 1);
        intentObserver.enable();
    },
    onEnterBack: (self) => {
        if (intentObserver.isEnabled) return;
        self.scroll(self.end - 1);
        intentObserver.enable();
    }
});

function updateActiveNav(index) {
    document.querySelectorAll('.nav-link').forEach((link, i) => {
        link.classList.toggle('active', i === index);
    });
}

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
            animation.pause(); // Зупиняємо анімацію
            animation.seek(0); // Повертаємо у вихідне положення
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
    // autoplaySpeed: 3000,
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


//show header on scrol; top
const header = $('.site-header');
//const heroSection = $('.home-hero');
const heroSection = $('.site-header');
let lastScrollTop = 0;

$(window).on('scroll', function () {
    let scrollTop = $(this).scrollTop();
    let heroHeight = heroSection.outerHeight();

    if (scrollTop > heroHeight) {
        if (scrollTop < lastScrollTop) {
            // Скролимо вгору
            header.addClass('fixed').removeClass('hidden');
        } else {
            // Скролимо вниз
            header.removeClass('fixed').addClass('hidden');
        }
    } else {
        header.removeClass('fixed hidden');
    }

    lastScrollTop = scrollTop;
});

}(jQuery));
