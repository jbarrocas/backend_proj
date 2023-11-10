document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="follow"]');

    const user_id = button.parentNode.dataset.user_id;

    const followButton = document.getElementById("followBtn");

    if(followButton.dataset.user.length > 0) {
        followButton.setAttribute("data-follow", "followed");
        followButton.textContent = "Followed";
    }
    else {
        followButton.textContent = "Follow";
        followButton.removeAttribute("data-follow");
    }


    button.addEventListener("click", () => {

        if(!followButton.hasAttribute("data-follow")) {

            fetch("/requests/", {
                method: "POST",
                headers: {
                    "Content-Type":"application/x-www-form-urlencoded"
                },
                body: "request=createFollower&user_id=" + user_id
            })
            .then( response => response.json())
            .then( result => {
                
                if(result.message === "followed") {

                   followButton.setAttribute("data-follow", "followed");

                   followButton.textContent = "Followed";

                    const followersNumber = document.getElementById("followersNumber");

                    const oldNumber = followersNumber.textContent;

                    const newNumber = parseInt(oldNumber) + 1;

                    followersNumber.textContent = newNumber;
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
                body: "request=deleteFollower&user_id=" + user_id
            })
            .then( response => response.json())
            .then( result => {
                
                if(result.message === "unfollowed") {

                    followButton.removeAttribute("data-follow");
                    followButton.textContent = "Follow";

                    const followersNumber = document.getElementById("followersNumber");

                    const oldNumber = followersNumber.textContent;
            
                    const newNumber = parseInt(oldNumber) - 1;
            
                    followersNumber.textContent = newNumber;
                }
            })
            .catch(error => alert("Unexpected error"));
        }
    });
});