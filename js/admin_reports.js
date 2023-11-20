document.addEventListener("DOMContentLoaded", () => {

    const report = document.querySelector('div[name="report"]');

    const message = document.getElementById("successMessage");

    if(message && message.textContent !== "") {

        report.remove();
    }

});