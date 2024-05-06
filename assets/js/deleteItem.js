// Delete item function
function delItem() {
    
    // Get delete button when clicke
    const delBtn = event.target;

    // Get cart row element
    const cartRow = getParentElement(delBtn, 'cart-row');
    
    // Get cart item elemment
    const cartItem = cartRow.querySelector('.cart-item');

    // Get the list of cart item by id
    const delList = document.querySelectorAll(`#${cartItem.id}`);

    for (const delItem of delList) {

        // Get cart row element
        const cartRow = getParentElement(delItem, 'cart-row');

        // Remove the cart row
        cartRow.remove();
    }
    
    // Update order
    updateOrder();
}