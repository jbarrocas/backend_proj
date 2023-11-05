document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="send"]');

    const form = document.getElementById("commentForm");

    const post_id = form.previousElementSibling.firstElementChild.dataset.post_id;

    button.addEventListener("click", () => {

        const content = form.firstElementChild.value;

        fetch("/requests/", {
            method: "POST",
            headers: {
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body: "request=createComment&content=" + content + "&post_id=" + post_id
        })
        .then( response => response.json())
        .then( result => {

            if(result.message === "commented") {

                const comment_confirmation = document.getElementById("commentConfirmation");

                comment_confirmation.innerHTML = "Comment sent";

                const comment_content = document.getElementById("sentContent");

                comment_content.innerHTML = content;

                const username = document.getElementById("sentUsername");

                username.innerHTML = result.username + " - " + result.country;

                const comment_date = document.getElementById("sentDate");

                comment_date.innerHTML = result.date;

            }
        })
        .catch( error => alert("Unexpected error"));

        form.reset();

    });


    
});