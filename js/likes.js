document.addEventListener("DOMContentLoaded", () => {

    const likeButtons = document.querySelectorAll('button[name="like"]');

    for(let button of likeButtons) {

        const post_id = button.parentNode.parentNode.firstElementChild.dataset.post_id;

        const likeButton = document.getElementById("likeBtn" + post_id);

        if(likeButton.dataset.user.length > 0) {

            likeButton.setAttribute("data-like", "liked");
            likeButton.textContent = "Unlike";
        }
        else {
            likeButton.removeAttribute("data-like");
            likeButton.textContent = "Like";
        }

    
        button.addEventListener("click", () => {
        
            if(!likeButton.hasAttribute("data-like")) {

                fetch("/requests/", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/x-www-form-urlencoded"
                    },
                    body: "request=createLike&post_id=" + post_id
                })
                .then( response => response.json())
                .then( result => {
                    if(result.message === "created") {

                        likeButton.setAttribute("data-like", "liked");
                        likeButton.textContent = "Unlike";

                        const likesNumber = document.getElementById("likesNumber" + post_id);

                        const oldNumber = likesNumber.textContent;
                
                        const newNumber = parseInt(oldNumber) + 1;
                
                        likesNumber.textContent = newNumber;
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
                    body: "request=deleteLike&post_id=" + post_id
                })
                .then( response => response.json())
                .then( result => {
                    if(result.message === "deleted") {

                        likeButton.removeAttribute("data-like");
                        likeButton.textContent = "Like";

                        const likesNumber = document.getElementById("likesNumber" + post_id);

                        const oldNumber = likesNumber.textContent;
                
                        const newNumber = parseInt(oldNumber) - 1;
                
                        likesNumber.textContent = newNumber;
                    }
                })
                .catch(error => alert("Unexpected error"));
            }
        });
    }
});