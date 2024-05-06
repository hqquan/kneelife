// Get card list
const cards = document.querySelectorAll('.promotion__card-item');

// Declare card type
const type = {
    'card1': 'content-1',
    'card2': 'content-2',
    'card3': 'content-3',
    'card4': 'content-4'
}

for (const card of cards) {

    card.addEventListener('click', function() {

        // Get content
        let cardName = card.getAttribute('name');
        let cardType = type[cardName];
        let content = document.querySelector(`[name=${cardType}]`);
        
        // Show content
        content.classList.add('promotion__content-wrapper--active');

        // Hide other content
        for (const card of cards) {
            if (card !== this) {
                let cardName = card.getAttribute('name');
                let cardType = type[cardName];
                let content = document.querySelector(`[name=${cardType}]`);
                content.classList.remove('promotion__content-wrapper--active');
            }
        }
    })
}
