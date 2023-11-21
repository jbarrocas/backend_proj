document.addEventListener("DOMContentLoaded", () => {

    const heading = document.getElementById("heading");

    const form = document.getElementById("searchForm");

    const message = document.getElementById("message");

    const footer = document.getElementById("footer");

    const post = form.nextElementSibling;

    if(post && post != message && post != footer) {

        heading.textContent = "Search Results";

        form.remove();
    }
});