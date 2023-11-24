document.addEventListener("DOMContentLoaded", () => {

    const links = document.getElementsByClassName("menu-items");

    const ul = document.getElementById("menu-ul");

    const controller = ul.dataset.controller;

    for(let link of links) {

        const linkName = link.dataset.menu;

        if(controller == linkName) {
            link.classList.add("selected");
        }
    }
});