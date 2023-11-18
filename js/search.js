document.addEventListener("DOMContentLoaded", () => {

    const heading = document.getElementById("heading");

    const form = document.getElementById("searchForm");

    const message = document.getElementById("message");

    const post = form.nextElementSibling;

    if(post && post !== message) {

        heading.textContent = "Search Results";

        form.remove();
    }
});