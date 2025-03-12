document.addEventListener('DOMContentLoaded', function() {
    const blocks = document.querySelectorAll('[data-cards-carrousel]');
  
    [...blocks].forEach((block) => {
      const swiperElement = block.querySelector('[data-cards-swiper]');
  
      const swiper = new Swiper(swiperElement, {
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    });
});
