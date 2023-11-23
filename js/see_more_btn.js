document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="page_number"]');

    const posts_number = parseInt(button.dataset.posts);

    const limit = button.dataset.limit;

    const next_page = button.value - 1;

    if(next_page === 0 || posts_number <= limit) {

        button.remove();
    }
});