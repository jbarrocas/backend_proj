document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector('form[name="form"]');

    const message = document.getElementById("message");

    if(message && message.textContent !== "") {

        form.remove();
    }

});