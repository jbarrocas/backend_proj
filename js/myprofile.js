document.addEventListener("DOMContentLoaded", () => {

    const buttons = document.getElementsByName("delete");

    for(let button of buttons) {

        button.addEventListener("click", () => {

            const count = document.getElementById("postsCount");

            const oldNumber = count.textContent;

            const result = parseInt(oldNumber) - 1;

            const newNumber = result;

            count.textContent = newNumber;
        });
    }



});