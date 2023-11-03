document.addEventListener("DOMContentLoaded", () => {

    const deleteButtons = document.querySelectorAll('button[name="delete"]');

    for(let button of deleteButtons) {

        const postId = button.parentNode.previousElementSibling.id;

        button.addEventListener("click", () => {

            if(confirm("Do you really want to delete it?")) {

                const post = button.parentNode.parentNode;

                fetch("/requests/", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/x-www-form-urlencoded"
                    },
                    body: "request=deletePost&post_id=" + postId
                })
                .then( response => response.json() )
                .then( result => {
    
                    if(result.message === "deleted") {
    
                        post.remove();
                    }
                })
                .catch(error => alert("Unexpected error"));
            }

            
        });
    }
});