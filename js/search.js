document.addEventListener("DOMContentLoaded", () => {

    const message = document.getElementById("result");

    const getCheck = document.getElementById("getCheck");

    const post = message.nextElementSibling;

    if(!post && getCheck && getCheck.value !== "") {

        message.textContent = "No results were found.";
    }

    const heading = document.getElementById("heading"); 

    const form = document. getElementById("searchForm");

    if(post) {

        heading.textContent = "Search Results";

        form.remove();
    }
});