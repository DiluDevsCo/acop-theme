document.addEventListener("DOMContentLoaded", () => {
 let blockPurposeUs = document.querySelector(".block-purpose-us");

 if (blockPurposeUs) {
  let slideIndex = 1;
  showSlides(slideIndex);

  window.plusSlides = function (n) {
   showSlides((slideIndex += n));
  };

  window.currentSlide = function (n) {
   showSlides((slideIndex = n));
  };

  function showSlides(n) {
   let i;
   let slides = document.getElementsByClassName("mySlides");
   if (n > slides.length) {
    slideIndex = 1;
   }
   if (n < 1) {
    slideIndex = slides.length;
   }
   for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
   }
   slides[slideIndex - 1].style.display = "block";
  }
 }
});
