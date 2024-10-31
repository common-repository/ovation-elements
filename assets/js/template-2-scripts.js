document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    const slides = document.querySelectorAll('.oe-banner-img');
    const sliderMain = document.querySelector('.oe-travel-slider-main');
    const prevButton = document.querySelector('.oe-slider-controls .prev');
    const nextButton = document.querySelector('.oe-slider-controls .next');
    const navSlides = document.querySelectorAll('.oe-travel-nav-slide');
    const sliderContent = document.querySelector('.oe-travel-slider-content');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            navSlides[i].classList.toggle('active', i === index);
        });
        const activeSlide = slides[index];
        sliderMain.style.backgroundImage = `url(${activeSlide.getAttribute('data-bg-image')})`;

        // Update the content
        sliderContent.querySelector('.heading-tag').innerText = activeSlide.querySelector('.heading-tag').innerText;
        sliderContent.querySelector('h1').innerText = activeSlide.querySelector('h1').innerText;
        sliderContent.querySelector('.banner-para').innerText = activeSlide.querySelector('.banner-para').innerText;
        const btn = sliderContent.querySelector('.theme-btn');
        btn.innerText = activeSlide.querySelector('.theme-btn').innerText;
        btn.href = activeSlide.querySelector('.theme-btn').href;
    }

    prevButton.addEventListener('click', function (event) {
        event.preventDefault();
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
        showSlide(currentIndex);
    });

    nextButton.addEventListener('click', function (event) {
        event.preventDefault();
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        showSlide(currentIndex);
    });

    navSlides.forEach((navSlide, index) => {
        navSlide.addEventListener('click', function () {
            currentIndex = index;
            showSlide(currentIndex);
        });
    });

    // Initially show the first slide
    showSlide(currentIndex);
});