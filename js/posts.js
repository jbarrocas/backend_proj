document.addEventListener("DOMContentLoaded", () => {

    const deleteButtons = document.querySelectorAll('button[name="delete"]');

    for(let button of deleteButtons) {

        const post_id = button.parentNode.previousElementSibling.dataset.post_id;

        button.addEventListener("click", () => {

            if(confirm("Do you really want to delete it?")) {

                const post = button.parentNode.parentNode;

                fetch("/requests/", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/x-www-form-urlencoded"
                    },
                    body: "request=deletePost&post_id=" + post_id
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