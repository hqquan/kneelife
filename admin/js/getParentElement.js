function getParentElement(selector, contain) {
    
    // If have parent...
    while (selector.parentElement) {
        if (selector.parentElement.className.includes(contain)) {
            return selector.parentElement;
        }
        selector = selector.parentElement;
    }
}