$(document).ready(function() {
  var carousel = $('#carouselExample');
  var carouselInner = carousel.find('.carousel-inner');
  var carouselControls = carousel.find('.carousel-controls');
  var slides = carouselInner.find('.carousel-item');

  var currentIndex = 0;
  var lastIndex = slides.length - 1;

  function showSlide(index) {
    if (index >= 0 && index <= lastIndex) {
      slides[currentIndex].classList.remove('active');
      slides[index].classList.add('active');
      currentIndex = index;

      // Toggle visibility of previous and next buttons
      if (currentIndex === 0) {
        carouselControls.find('.carousel-control').eq(0).hide();
      } else {
        carouselControls.find('.carousel-control').eq(0).show();
      }

      if (currentIndex === lastIndex) {
        carouselControls.find('.carousel-control').eq(1).hide();
      } else {
        carouselControls.find('.carousel-control').eq(1).show();
      }
    }
  }

  function prevSlide() {
    var newIndex = currentIndex - 1;
    if (newIndex >= 0) {
      showSlide(newIndex);
    }
  }

  function nextSlide() {
    var newIndex = currentIndex + 1;
    if (newIndex <= lastIndex) {
      showSlide(newIndex);
    }
  }

  carouselControls.find('.carousel-control').eq(0).click(function() {
    prevSlide();
  });

  carouselControls.find('.carousel-control').eq(1).click(function() {
    nextSlide();
  });

  carouselControls.find('.carousel-control').eq(0).hide();
});
