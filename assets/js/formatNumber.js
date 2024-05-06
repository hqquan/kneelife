const numbers = document.querySelectorAll("[class*='price']");

numbers.forEach(function (number) {
    const value = parseFloat(number.innerText.replace(/[^0-9-]+/g, ""));
    const formattedNumber = value.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    number.innerText = formattedNumber;
});