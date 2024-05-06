const modal = document.querySelector(".modal");

const modalOverlay = modal.querySelector(".modal__overlay");

// Create an array archive name of each modal, same name with button
const modalName = ["signin", "signup", "forgot", "reset", "changeInfo", "productDetail", "viewDetailModal"];

// Get all input in modal
const inputTexts = modal.querySelectorAll("[class*='__input-text']");

function resetInput() {
    for (const input of inputTexts) {
        input.value = '';
    }
}

function openModal(id) {
    // Display modal
    modal.style.display = "flex";

    const form = document.querySelector(`[name*="${id}Modal"]`);
    if (form) {
        form.style.display = "block";

        for (const item of modalName) {
            if (item !== id) {
                closeModal(item);
            }
        }
    }
}

function closeModal(id) {
    const form = document.querySelector(`[name*="${id}Modal"]`);
    const errorMsgs = document.querySelectorAll('.auth-form__error');
    errorMsgs.forEach(function(errorMsg) {
        errorMsg.style.display = 'none';
    })
    if (form) {
        form.style.display = "none";
    }
    resetInput(id);
}

function closeModalBtn(id) {
    closeModal(id);
    modal.style.display = "none";
}

for (const item of modalName) {
    // Get list of button with the name of array modalName
    const navItems = document.querySelectorAll(`[name='${item}']`);

    navItems.forEach(function (item) {
        item.addEventListener("click", function () {

            if (item.getAttribute('name') == "productDetail") {
                const menuProduct = getParentElement(item, "menu__product");
                setDetailProduct(menuProduct);
            }

            // Display modal
            openModal(item.getAttribute("name"));
        });
    });

    // Close when click outside modal
    modalOverlay.addEventListener("click", function () {
        modal.style.display = "none";
        closeModal(item);
    });
}

function setDetailProduct(menuProduct) {

    // Get product content
    const img = menuProduct.querySelector('[class*="__product-img"]').src;
    const name = menuProduct.querySelector('[class*="__product-name"]').innerText;
    const price = menuProduct.querySelector('[class*="__product-price"]').innerText;
    const desc = menuProduct.querySelector('[class*="__product-desc"]').innerHTML;
    const id = menuProduct.id;

    // Set detail product content
    const detailProduct = modal.querySelector('.detail__product-wrapper');
    detailProduct.querySelector('[class*="__product-img"]').src = img;
    detailProduct.querySelector('[class*="__product-name"]').innerText = name;
    detailProduct.querySelector('[class*="__product-price"]').innerText = price;
    detailProduct.querySelector('[class*="__product-desc"]').innerHTML = desc;
    detailProduct.id = id;

}

function checkDetailModal() {
    const itemList = document.querySelectorAll('button[name="viewDetail"]');
    const viewDetailModal = modal.querySelector('[name*="viewDetailModal"]');
    const cancel = viewDetailModal.querySelector('.cancel');
    const print = viewDetailModal.querySelector('.print');
    for (const item of itemList) {
        item.addEventListener('click', function() {
            if (item.innerText.toLowerCase() === "wait") {
                cancel.style.display = 'inline-block';
                print.style.display = 'none';
            } else {
                cancel.style.display = 'none';
                print.style.display = 'inline-block';
            }
        })
    }
}