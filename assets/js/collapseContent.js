
// Get list of button
const btns = document.querySelectorAll('.consult__button');

for (const btn of btns) {

    btn.addEventListener('click', function () {

        let content = btn.querySelector('.consult__content');

        // Collapse
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + 'px';
        }

        // Close other collapse
        for (const btn of btns) {
            if (btn !== this) {
                content = btn.querySelector('.consult__content');
                content.style.maxHeight = null;
            }
        }
    })
}