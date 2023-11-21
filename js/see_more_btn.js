document.addEventListener("DOMContentLoaded", () => {

    const button = document.querySelector('button[name="page_number"]');

    const next_page = button.value - 1;

    if(next_page === 0) {

        button.remove();
    }
});