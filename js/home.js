document.addEventListener("DOMContentLoaded", () => {

    const likeButtons = document.querySelectorAll('button[name="like"');

    for(let button of likeButtons) {

        const post = button.parentNode.parentNode.firstElementChild;

        const likeButton = document.getElementById("likeBtn" + post.id);

        fetch("../requests/", {
            method: "POST",
            headers: {
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body: "request=likeCheck&post_id=" + post.id
        })
        .then( response => response.json())
        .then( result => {
            if(result.message === "liked") {

                likeButton.setAttribute("data-like", "liked");
                likeButton.innerHTML = "liked";
            }
            else {
                likeButton.removeAttribute("data-like");
                likeButton.innerHTML = "unliked";
            }
        })
        .catch(error => alert("Unexpected error"));

    
        button.addEventListener("click", () => {
        
            if(likeButton.hasAttribute("data-like")) {

                fetch("../requests/", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/x-www-form-urlencoded"
                    },
                    body: "request=deleteLike&post_id=" + post.id
                })
                .then( response => response.json())
                .then( result => {
                    if(result.message === "deleted") {

                        likeButton.removeAttribute("data-like");
                        likeButton.innerHTML = "unliked";
                    }
                })
                .catch(error => alert("Unexpected error"));

            }
            else if(!likeButton.hasAttribute("data-like")) {

                fetch("../requests/", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/x-www-form-urlencoded"
                    },
                    body: "request=createLike&post_id=" + post.id
                })
                .then( response => response.json())
                .then( result => {
                    if(result.message === "created") {

                        likeButton.setAttribute("data-like", "liked");
                        likeButton.innerHTML = "liked";
                    }
                })
                .catch(error => alert("Unexpected error"));
            }
        });
    }
});