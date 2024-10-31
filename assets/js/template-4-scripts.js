document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.content-wrapper');
    const navItems = document.querySelectorAll('.nav-item');
    const prevButton = document.querySelector('.oe-slider-controls a:first-child');
    const nextButton = document.querySelector('.oe-slider-controls a:last-child');
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const sliderContent = document.querySelector('.oe-travel-slider-content');

    let currentIndex = 0;

    function setBackground(index) {
        const thumbnail = navItems[index].querySelector('img').src;
        sliderWrapper.style.backgroundImage = `url(${thumbnail})`;
    }

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        navItems.forEach((navItem, i) => {
            navItem.classList.toggle('active', i === index);
        });
        setBackground(index);
    }

    function goToNextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    function goToPrevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(currentIndex);
    }

    prevButton.addEventListener('click', function (e) {
        e.preventDefault();
        goToPrevSlide();
    });

    nextButton.addEventListener('click', function (e) {
        e.preventDefault();
        goToNextSlide();
    });

    // Initialize slider
    showSlide(currentIndex);
});