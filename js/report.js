document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector('form[name="form"]');

    const message = document.getElementById("message").innerHTML;

    if(message !== "") {

        form.remove();
    }

});