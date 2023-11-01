document.addEventListener("DOMContentLoaded", () => {

    const likeButtons = document.querySelectorAll('button[name="like"]');

    for(let button of likeButtons) {

        const post = button.parentNode.parentNode.firstElementChild;

        const likeButton = document.getElementById("likeBtn" + post.id);

        if(likeButton.dataset.user.length > 0) {

            likeButton.setAttribute("data-like", "liked");
            likeButton.innerHTML = "Liked";
        }
        else {
            likeButton.removeAttribute("data-like");
            likeButton.innerHTML = "Like";
        }

    
        button.addEventListener("click", () => {
        
            if(!likeButton.hasAttribute("data-like")) {

                fetch("/requests/", {
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
                        likeButton.innerHTML = "Liked";

                        const likesNumber = document.getElementById("likesNumber" + post.id);

                        const oldNumber = likesNumber.innerHTML;
                
                        const newNumber = parseInt(oldNumber) + 1;
                
                        likesNumber.innerHTML = newNumber;
                    }
                })
                .catch(error => alert("Unexpected error"));

            }
            else if(likeButton.hasAttribute("data-like")) {
                
                fetch("/requests/", {
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
                        likeButton.innerHTML = "Like";

                        const likesNumber = document.getElementById("likesNumber" + post.id);

                        const oldNumber = likesNumber.innerHTML;
                
                        const newNumber = parseInt(oldNumber) - 1;
                
                        likesNumber.innerHTML = newNumber;
                    }
                })
                .catch(error => alert("Unexpected error"));
            }
        });
    }
});