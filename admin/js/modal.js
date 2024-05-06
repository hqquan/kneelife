const modal = document.querySelector(".modal");
const modalOverlay = modal.querySelector(".modal__overlay");

function resetInput(id) {
    const form = document.querySelector(`[name*="${id}Modal"]`);
    if (form) {
        const inputTexts = form.querySelectorAll("[class*='__input-text']");
        
        for (const input of inputTexts) {
            if(!input.getAttribute("value")) {
                input.value = '';
            }
        }
    }
}

function openModal(id) {
    // Display modal
    modal.style.display = "flex";

    const form = document.querySelector(`[name*="${id}Modal"]`);
    if (form.getAttribute('name').includes(id)) {
        form.style.display = "block";

        // Close when click outside modal
        modalOverlay.addEventListener("click", function () {
            modal.style.display = "none";
            closeModal(id);
        });
    }
}

function closeModal(id) {
    const form = document.querySelector(`[name*="${id}Modal"]`);
    if (form) {
        form.style.display = "none";
    }
    resetInput(id);
}

function closeModalBtn(id) {
    closeModal(id);
    modal.style.display = "none";
}

function checkDetailModal() {
    const itemList = document.querySelectorAll('button[name="viewDetail"]');
    const viewDetailModal = modal.querySelector('[name*="viewDetailModal"]');
    const accept = viewDetailModal.querySelector('.accept');
    const cancel = viewDetailModal.querySelector('.cancel');
    const print = viewDetailModal.querySelector('.print');
    for (const item of itemList) {
        item.addEventListener('click', function() {
            if (item.innerText.toLowerCase() === "wait") {
                accept.style.display = 'inline-block';
                cancel.style.display = 'inline-block';
                print.style.display = 'none';
            } else {
                accept.style.display = 'none';
                cancel.style.display = 'none';
                print.style.display = 'inline-block';
            }
        })
    }
}