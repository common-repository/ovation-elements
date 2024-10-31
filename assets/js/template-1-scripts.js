document.addEventListener('DOMContentLoaded', function() {
    let currentIndex = 0;
    const slides = document.querySelectorAll('.oe-slider-main-wrapper .slide'); // Updated selector
    const prevButton = document.querySelector('.oe-slider-controls .prev');
    const nextButton = document.querySelector('.oe-slider-controls .next');
    const counters = document.querySelectorAll('.counter-wrap .count'); // Counter elements

    console.log('Slides:', slides); // Debugging line

    function showSlide(index) {
        console.log('Showing slide:', index); // Debugging line
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        counters.forEach((counter, i) => {
            counter.classList.toggle('active', i === index); // Highlight the current slide number
        });
    }

    prevButton.addEventListener('click', function(event) {
        event.preventDefault();
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
        showSlide(currentIndex);
    });

    nextButton.addEventListener('click', function(event) {
        event.preventDefault();
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        showSlide(currentIndex);
    });

    // Initially show the first slide
    showSlide(currentIndex);
});