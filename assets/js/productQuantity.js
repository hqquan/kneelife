
function quantityInput(quantityInput) {
    quantityInput = document.querySelectorAll('[class*="__quantity-input"]');
    
    for (const item of quantityInput) {
    
        item.addEventListener('change', function() {
    
            // Get item cart form menu page and order page and connect it
            // Value of this change, value of another will change
            const cartRow = getParentElement(this, 'cart-row');
            const itemCart = cartRow.querySelector('.cart-item');
            const itemList = document.querySelectorAll(`#${itemCart.id}`);
    
            for (const item of itemList) {
    
                const itemInput = item.querySelector('[class*="__quantity-input"]');
                
                if (itemInput != this) {
                    itemInput.value = this.value;
                }
            }
            // ------------------------------------------
            
            // Return default value
            if (isNaN(item.value) || item.value <= 0) {
                item.value = 1;
            }

            // Update order
            updateOrder();
        })
    }
}
