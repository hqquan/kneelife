// Get category item
const categoryList = document.querySelectorAll(".menu__category-item");

// Get productList list
const productListListWrapper = document.querySelectorAll(".menu__product-list");

for (const category of categoryList) {

    category.addEventListener("click", function() {

        // Get category type
        let categoryType = category.getAttribute('name');
        
        for (const productList of productListListWrapper) {
            
            // Get productList type
            let productListType = productList.getAttribute('name');

            // Show productList if match with category
            if (categoryType == productListType) {
                productList.classList.add('menu__product-list--active');

                // Add scroll button
                const wrapper = getParentElement(productList, 'menu__product-list-wrapper');
                const productItem = productList.querySelectorAll('.menu__product-wrapper');
                if (productItem.length > 4) {
                    wrapper.classList.add('menu__product-scroll-btn--active');
                } else {
                    wrapper.classList.remove('menu__product-scroll-btn--active');
                }
                
            } else {
                productList.classList.remove('menu__product-list--active');
            }
            
            
        }

        // Add category border
        category.classList.add('menu__category-item--active');
        
        // Remove other category border
        for (const category of categoryList) {
            if (category != this) {
                category.classList.remove('menu__category-item--active');
            }
        }
    })
}