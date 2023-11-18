document.addEventListener("DOMContentLoaded", () => {

    const percentages = document.getElementsByName("percentage");

    for(let percentage of percentages) {

        const total = percentage.parentNode.parentNode.firstElementChild.firstElementChild.nextElementSibling.dataset.total;

        const total_by_subject = percentage.previousElementSibling.dataset.count;

        const result = (total_by_subject / total) * 100;

        percentage.textContent = result.toFixed(2) + "%";
    }

    const month_percentages = document.getElementsByName("percentageMonth");

    for(let month_percentage of month_percentages) {

        const total = month_percentage.parentNode.parentNode.firstElementChild.firstElementChild.nextElementSibling.dataset.total;

        const total_by_subject = month_percentage.previousElementSibling.dataset.count;

        const result = (total_by_subject / total) * 100;

        month_percentage.textContent = result.toFixed(2) + "%";
    }
});