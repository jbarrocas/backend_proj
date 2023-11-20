document.addEventListener("DOMContentLoaded", () => {

    const posts = document.getElementsByName("post");

    for(let post of posts) {

        const user_id = post.dataset.user_id;

        const session_id = post.dataset.session_id;
    
        const report_button = post.nextElementSibling.lastElementChild.previousElementSibling;
    
        const delete_button = report_button.nextElementSibling;
    
        if(user_id === session_id) {
    
            report_button.remove();
        }
    
        if(user_id !== session_id) {
    
            delete_button.remove();
        }
    }



});