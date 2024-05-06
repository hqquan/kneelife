// Active when scroll
// Get a list of nav item
const navList = document.querySelectorAll(".header__item-link");

// Get a list of section
const sections = document.querySelectorAll("section");

window.onscroll = function() {
    sections.forEach(function(section) {

        const top = window.scrollY;
        const offset = section.offsetTop - 150;
        const height = section.offsetHeight;
        const id = section.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navList.forEach(function(navItem) {
                navItem.classList.remove('header__item-link--active');
                document.querySelector('.header__item-link[href*=' + id + ']').classList.add('header__item-link--active');
            })
        }

    })
}