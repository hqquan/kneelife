// Get scroll btn
const scrollLeftBtn = document.querySelector('.btn-left');
const scrollRightBtn = document.querySelector('.btn-right');

// Scroll -200px
scrollLeftBtn.addEventListener('click', function() {
    const wrapper = getParentElement(this, 'menu__product-list-wrapper');
    const productList = wrapper.querySelector('.menu__product-list--active');

    productList.scrollLeft -= 200;
})

// Scroll +200px
scrollRightBtn.addEventListener('click', function() {
    const wrapper = getParentElement(this, 'menu__product-list-wrapper');
    const productList = wrapper.querySelector('.menu__product-list--active');

    productList.scrollLeft += 200;
})