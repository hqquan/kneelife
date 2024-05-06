let slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {

    // Declare index
    let i;

    // Get list of slide
    let slides = document.querySelectorAll(".slider__container");
    
    // Get list of dot
    let dots = document.querySelectorAll(".slider__nav-item");

    // Return default
    if (n > slides.length) {
        slideIndex = 1;
    }

    if (n < 1) {
        slideIndex = slides.length;
    }

    // Hidden the slide
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Display the slide when click the dot
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" slider__nav-item--active", "");
    }

    // Display default
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " slider__nav-item--active";
}