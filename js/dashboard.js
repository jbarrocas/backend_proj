document.addEventListener("DOMContentLoaded", () => {

    const sections = document.getElementsByTagName('section');

    for(let section of sections) {

        const super_admin = section.dataset.admin;

        const super_area = document.getElementById('AdminActionArea').lastElementChild;

        if(!super_admin) {

            super_area.remove();
        }
    }
});