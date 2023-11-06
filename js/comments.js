document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="send"]');

    button.addEventListener("click", () => {

        const form = document.getElementById("commentForm");

        const post_id = form.previousElementSibling.firstElementChild.dataset.post_id;

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

    const replyButtons = document.querySelectorAll('button[name="sendReply"]');

    for(let button of replyButtons) {

        button.addEventListener("click", () => {

            const form = button.parentNode;

            const post_id = form.parentNode.firstElementChild.firstElementChild.dataset.post_id;

            const parent_id = form.previousElementSibling.dataset.comment_id;

            const replyContent = form.firstElementChild.value;

            console.log(post_id);

            fetch("/requests/", {
                method: "POST",
                headers: {
                    "Content-Type":"application/x-www-form-urlencoded"
                },
                body: "request=createReply&content=" + replyContent + "&parent_id=" + parent_id + "&post_id=" + post_id
            })
            .then( response => response.json())
            .then( result => {
    
                if(result.message === "replied") {

    
                    // const comment_confirmation = document.getElementById("replyConfirmation");
    
                    // comment_confirmation.innerHTML = "Reply sent";
    
                    // const comment_content = document.getElementById("sentReply");
    
                    // comment_content.innerHTML = content;
    
                    // const username = document.getElementById("sentReplyUsername");
    
                    // username.innerHTML = result.username + " - " + result.country;
    
                    // const comment_date = document.getElementById("sentReplyDate");
    
                    // comment_date.innerHTML = result.date;
    
                }
            })
            .catch( error => alert("Unexpected error"));
    
            form.reset();
        });
    }




    
});