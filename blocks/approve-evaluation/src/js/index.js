document.addEventListener("DOMContentLoaded", () => {
    let sectionSlider = document.querySelectorAll("[data-slider-home-page-swiper]");
    sectionSlider.forEach(slider => {
      const swiper = new Swiper(slider, {
        pagination: {
          el: slider.querySelector('.swiper-pagination'),
          enabled: true,
          clickable: true,
        }
      });
    });
});