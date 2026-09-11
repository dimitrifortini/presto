// Accordion
const tabs = document.querySelectorAll(".accordion-tab");
const panels = document.querySelectorAll(".panel");


tabs.forEach(tab => {

    tab.addEventListener("click",()=>{

        tabs.forEach(t=>t.classList.remove("active"));
        panels.forEach(p=>p.classList.remove("active"));


        tab.classList.add("active");

        document
        .getElementById(tab.dataset.tab)
        .classList.add("active");

    });

});

// collapse-custom


document.addEventListener("click", function (event) {

    const navbar = document.querySelector(".navbar");
    const categories = document.querySelector("#categoriesMenu");
    const languages = document.querySelector("#languagesMenu");

    if (!navbar.contains(event.target)) {

        categories.classList.remove("show");
        languages.classList.remove("show");

    }

});


// accordion mobile
const mobileItems = document.querySelectorAll('.mobile-item');

mobileItems.forEach(item => {

    item.querySelector('.mobile-header').addEventListener('click', () => {
        item.classList.toggle('active');
    });

});

// RATING


const stars = document.querySelectorAll(".rating i");
const ratingContainer = document.querySelector(".rating");
const ratingInput = document.querySelector("#rating");

let selectedRating = 0;



stars.forEach(star => {

    star.addEventListener("mouseenter", () => {

        const hoverRating = Number(star.dataset.rating);

        stars.forEach(star => {

            const starRating = Number(star.dataset.rating);

            if (starRating <= hoverRating) {
                star.classList.remove("fa-regular");
                star.classList.add("fa-solid");
            } else {
                star.classList.remove("fa-solid");
                star.classList.add("fa-regular");
            }

        });

    });


   
    star.addEventListener("click", () => {

        selectedRating = Number(star.dataset.rating);

        ratingInput.value = selectedRating;

    });

});



ratingContainer.addEventListener("mouseleave", () => {

    stars.forEach(star => {

        const starRating = Number(star.dataset.rating);

        if (starRating <= selectedRating) {
            star.classList.remove("fa-regular");
            star.classList.add("fa-solid");
        } else {
            star.classList.remove("fa-solid");
            star.classList.add("fa-regular");
        }

    });

});