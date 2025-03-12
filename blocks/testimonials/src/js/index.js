document.addEventListener('DOMContentLoaded', function() {
  const blocks = document.querySelectorAll('[data-video-carrousel]');

  [...blocks].forEach((block) => {
    const swiperElement = block.querySelector('[data-testimonials-swiper]');

    const swiper = new Swiper(swiperElement, {
      
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  });
});
