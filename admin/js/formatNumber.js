function formatNumber() {
    const numbers = document.querySelectorAll("[class*='price']");

    numbers.forEach(function (number) {
        const value = parseFloat(number.innerText.replace(/[^0-9-]+/g, ""));
        const formattedNumber = value.toLocaleString("it-IT", {
            style: "currency",
            currency: "VND",
        });
        number.innerText = formattedNumber;
    });
}

var inputs = document.querySelectorAll("[class*='price-input']");

inputs.forEach(function(input) {
    input.addEventListener("keyup", function (event) {
        // When user selects text in the document, also abort.
        var selection = window.getSelection().toString();
        if (selection !== "") {
            return;
        }
    
        // When the arrow keys are pressed, abort.
        if ([38, 40, 37, 39].indexOf(event.keyCode) !== -1) {
            return;
        }
    
        // Get the value.
        var inputValue = this.value;
    
        inputValue = inputValue.replace(/[\D\s\._\-]+/g, "");
        inputValue = inputValue ? parseInt(inputValue, 10) : 0;
    
        this.value = inputValue === 0 ? "" : inputValue.toLocaleString("en-US");
    });
})
