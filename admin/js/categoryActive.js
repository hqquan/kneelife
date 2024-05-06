const dishCategoryBtns = document.querySelectorAll('.manager-site__category-btn');
for (const btn of dishCategoryBtns) {
    btn.addEventListener('click', function () {
            btn.classList.add('manager-site__category-btn--active');
        for (const btn of dishCategoryBtns) {
            if (btn !== this) {
                btn.classList.remove('manager-site__category-btn--active');
            }
        }
    })
}