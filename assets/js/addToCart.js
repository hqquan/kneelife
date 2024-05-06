// Get all button of product
const addCartBtns = document.querySelectorAll("[class*='__product-btn']");

for (const btn of addCartBtns) {

    btn.addEventListener('click', function() {

        // Get product element
        const product = getParentElement(this, 'product-wrapper');

        // Get product content
        const img = product.querySelector('[class*="__product-img"]').src;
        const name = product.querySelector('[class*="__product-name"]').innerText;
        const price = product.querySelector('[class*="__product-price"]').innerText;
        const id = product.id;

        // Get the list name of item, if duplicate in cart, increase the quantity
        // Get the list name of item
        const cartItems = document.querySelectorAll('.cart-item');
        for (const cartItem of cartItems) {
            
            let cartItemId = cartItem.id;
            cartItemId = cartItemId.replace(/[^0-9]/g, '');
            parseInt(cartItemId);
            // If duplicate
            if (cartItemId == id) {
                
                // Increase quantity
                for (const cartItem of cartItems) {
                    let cartItemId = cartItem.id;
                    cartItemId = cartItemId.replace(/[^0-9]/g, '');
                    parseInt(cartItemId);
                    if (cartItemId == id) {
                        cartItem.querySelector('.cart-item__quantity-input').value++;
                    }
                }

                // Update order
                updateOrder();
                return;
            }
        }

        // Add item to cart
        addToCart(img, name, price, id);
        
        // Update order
        updateOrder();
    })
}

function addToCart(img, name, price, id) {

    // Get list wrapper of item
    const cartList = document.querySelectorAll('[class*="__cart-item-wrapper"]');
    
    // If list wrapper of menu, add menu item content
    // If list wrapper of order, add order item content
    for (const cart of cartList) {
        
        // Get create cart row element
        const cartRow = document.createElement('div');
        cartRow.classList.add('cart-row');

        // Menu item content
        const menuCartContent = `
        <div class="cart-item" id="cart${id}">
            <div class="cart-item__wrapper">
                <h1 class="cart-item__name">${name}</h1>
                <img src="${img}" class="cart-item__img">
                <input type="number" class="cart-item__quantity-input" min="1" value="1">
                <span class="cart-item__del-btn btn--hover" onclick="delItem()">
                    <i class="cart-item__del-icon fa-solid fa-xmark"></i>
                </span>
            </div>
        </div>
        `

        // Order item content
        const orderCartContent = `
        <div class="cart-item" id="cart${id}">
            <span class="cart-item__del-btn btn--hover" onclick="delItem()"><i class="fa-regular fa-circle-xmark"></i></span>
            <div class="cart-item__wrapper">
                <img src="${img}" class="cart-item__img">
                <div class="cart-item__content">
                    <h1 class="cart-item__name">${name}</h1>
                    <h1 class="cart-item__vat">VAT: <span class="cart-item__vat-value">8%</span></h1>
                    <p class="cart-item__note">
                        <i class="cart-item__note-icon fa-regular fa-pen-to-square"></i>
                        <label for="cart-item__note-input">Add note:</label>
                        <input id="productNote" type="textarea" class="cart-item__note-input" name="cart-item__note-input">
                    </p>
                    <input id="productQuantity" type="number" class="cart-item__quantity-input" min="1" value="1">
                </div>
            </div>
            <span class="cart-item__price">${price}</span>
        </div>
        `

        // If menu, add cart row with menu content
        if (cart.className.includes('menu')) {
            cartRow.innerHTML = menuCartContent;
            cart.append(cartRow);
        } 

        // If order, add cart row with order content
        if (cart.className.includes('order')) {
            cartRow.innerHTML = orderCartContent;
            cart.append(cartRow);
        }

        // Update the input of cart item
        quantityInput(quantityInput);
    }
}