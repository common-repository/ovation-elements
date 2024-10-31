document.addEventListener('DOMContentLoaded', function () {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide-outer');
    const totalSlides = slides.length;

    function updateClasses() {
        slides.forEach((slide, i) => {
            slide.classList.remove('active', 'previous', 'next');
        });

        slides[currentSlide].classList.add('active');

        const prevIndex = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
        const nextIndex = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1;

        slides[prevIndex].classList.add('previous');
        slides[nextIndex].classList.add('next');

        document.querySelector('.current-slide').textContent = String(currentSlide + 1).padStart(2, '0');
    }

    function handleThumbnailClick(event) {
        const target = event.currentTarget;
        const index = parseInt(target.getAttribute('data-index'), 10);
        if (!isNaN(index)) {
            currentSlide = index;
            updateClasses();
        }
    }

    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', handleThumbnailClick);
    });

    document.querySelector('.oe-slider-controls-prev').addEventListener('click', function (e) {
        e.preventDefault();
        currentSlide = (currentSlide > 0) ? currentSlide - 1 : totalSlides - 1;
        updateClasses();
    });

    document.querySelector('.oe-slider-controls-next').addEventListener('click', function (e) {
        e.preventDefault();
        currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : 0;
        updateClasses();
    });

    updateClasses();
});