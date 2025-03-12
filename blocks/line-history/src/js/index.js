document.addEventListener("DOMContentLoaded", () => {

    const block = document.querySelector('[data-cards-history]');
    const swiperElement = block.querySelector('.swiper');
    let mySwiper = new Swiper(swiperElement, {
        autoHeight: true,
        autoplay: {
        delay: 5000,
        disableOnInteraction: false
        },
        speed: 500,
        direction: "horizontal",
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
        },
        pagination: {
        el: ".swiper-pagination",
        type: "progressbar"
        },
        loop: false,
        effect: "slide",
        spaceBetween: 30,
        on: {
            init: function () {
                /* init point circle in 0 */
                let progressBarFill = document.querySelector(".swiper-pagination-progressbar-fill");
                progressBarFill.style.transform = 'scaleX(0)';
                let switches = document.querySelectorAll(".swiper-pagination-custom .swiper-pagination-switch");
                switches.forEach(function(switchElement) { switchElement.classList.remove("active"); });
                switches[0].classList.add("active");
            },
            slideChangeTransitionStart: function () {
                let progressBarFill = document.querySelector(".swiper-pagination-progressbar-fill");
                let switchTitles = document.querySelectorAll(".switch-title");
                let progressWidth = (mySwiper.realIndex * 100) / (switchTitles.length - 1);
                progressBarFill.style.transform = 'scaleX(' + (progressWidth / 100) + ')';
                let switches = document.querySelectorAll(".swiper-pagination-custom .swiper-pagination-switch");
                switches.forEach(function(switchElement) {
                    switchElement.classList.remove("active");
                });
                switches[mySwiper.realIndex].classList.add("active");
            }
        }
    });

    let switches = document.querySelectorAll(".swiper-pagination-custom .swiper-pagination-switch");

    switches.forEach(function(switchElement, index) {
        switchElement.addEventListener("click", function() {
            mySwiper.slideTo(index);
            switches.forEach(function(el) {
                el.classList.remove("active");
            });
            
            switchElement.classList.add("active");
        });
    });

      
});