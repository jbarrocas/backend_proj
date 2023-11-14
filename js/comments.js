document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="sendComment"]');

    button.addEventListener("click", () => {

        const form = document.getElementById("commentForm");

        const post_id = form.previousElementSibling.firstElementChild.dataset.post_id;

        const content = form.firstElementChild.value;

        const token = form.firstElementChild.nextElementSibling.value;

        fetch("/requests/", {
            method: "POST",
            headers: {
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body: "request=createComment&content=" + content + "&post_id=" + post_id + "&token=" + token
        })
        .then( response => response.json())
        .then( result => {

            if(result.message === "commented") {

                const comment_content = document.getElementById("sentContent");

                comment_content.textContent = content;

                const username = document.getElementById("sentUsername");

                username.textContent = result.username + " - " + result.country;

                const comment_date = document.getElementById("sentDate");

                comment_date.textContent = result.date;

                form.remove();
            }
        })
        .catch( error => alert("Unexpected error"));

        form.reset();

    });

    const sendReplyButtons = document.querySelectorAll('button[name="sendReply"]');

    for(let button of sendReplyButtons) {

        button.addEventListener("click", () => {

            const form = button.parentNode;

            const post_id = form.parentNode.firstElementChild.firstElementChild.dataset.post_id;

            const parent_id = form.previousElementSibling.dataset.comment_id;

            const replyContent = form.firstElementChild.value;

            const token = form.firstElementChild.nextElementSibling.value;

            fetch("/requests/", {
                method: "POST",
                headers: {
                    "Content-Type":"application/x-www-form-urlencoded"
                },
                body: "request=createReply&content=" + replyContent + "&parent_id=" + parent_id + "&post_id=" + post_id + "&token=" + token
            })
            .then( response => response.json())
            .then( result => {
    
                if(result.message === "replied") {
    
                    const reply_content = document.getElementById("sentReplyContent" + parent_id);
    
                    reply_content.textContent = replyContent;
    
                    const reply_username = document.getElementById("sentReplyUsername" + parent_id);
    
                    reply_username.textContent = result.username + " - " + result.country;
    
                    const reply_comment_date = document.getElementById("sentReplyDate" + parent_id);
    
                    reply_comment_date.textContent = result.date;

                    form.classList.add("hide");    
                }
            })
            .catch( error => alert("Unexpected error"));
    
            form.reset();
        });
    }

    const replyButtons = document.querySelectorAll('button[name="reply"]');

    for(let button of replyButtons) {

        const form = button.parentNode.parentNode.nextElementSibling;

        const parent_id = form.dataset.reply_check;

        const comment = form.previousElementSibling;

        if(parent_id !== "") {

            form.remove();
            comment.classList.add("comment-reply");
            button.remove();
        }

        button.addEventListener("click", () => {

            form.classList.toggle("hide");
        });
    }    
});