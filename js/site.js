document.addEventListener("DOMContentLoaded", function () {
    const discountButton = document.getElementById("discountButton");

    discountButton.addEventListener("click", function () {
        const now = new Date();
        const minute = now.getMinutes();

        if (minute % 2 !== 0) {
            alert("Congratz! You have a discount now!.");
        } else {
            alert("Sorry, no discount available, try odd time and press to get discount.");
        }
    });
});





