document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="follow"');

        const user = button.parentNode;

        const followButton = document.getElementById("followBtn");

        if(followButton.dataset.user.length > 0) {

            followButton.setAttribute("data-follow", "followed");
            followButton.innerHTML = "Followed";

        }
        else {

            followButton.innerHTML = "Follow";
            followButton.removeAttribute("data-follow");

        }


    button.addEventListener("click", () => {

        if(!followButton.hasAttribute("data-follow")) {

             fetch("/requests/", {
                 method: "POST",
                 headers: {
                     "Content-Type":"application/x-www-form-urlencoded"
                 },
                 body: "request=createFollower&user_id=" + user.id
             })
             .then( response => response.json())
             .then( result => {
                 if(result.message === "followed") {

                    followButton.setAttribute("data-follow", "followed");
                    followButton.innerHTML = "Followed";

                    const followersNumber = document.getElementById("followersNumber");

                    const oldNumber = followersNumber.innerHTML;
                
                    const newNumber = parseInt(oldNumber) + 1;
                
                    followersNumber.innerHTML = newNumber;
                }
            })
            .catch(error => alert("Unexpected error"));

        }
        else {
                
            fetch("/requests/", {
                method: "POST",
                headers: {
                    "Content-Type":"application/x-www-form-urlencoded"
                },
                body: "request=deleteFollower&user_id=" + user.id
            })
            .then( response => response.json())
            .then( result => {
                if(result.message === "unfollowed") {

                    followButton.removeAttribute("data-follow");
                    followButton.innerHTML = "Follow";

                    const followersNumber = document.getElementById("followersNumber");

                    const oldNumber = followersNumber.innerHTML;
            
                    const newNumber = parseInt(oldNumber) - 1;
            
                    followersNumber.innerHTML = newNumber;
                }
            })
            .catch(error => alert("Unexpected error"));
        }
    });
});