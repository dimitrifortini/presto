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


// RATING

const ratingContainers = document.querySelectorAll(".rating");

ratingContainers.forEach(ratingContainer => {

    const stars = ratingContainer.querySelectorAll("i");
    const ratingInput = ratingContainer.querySelector('input[name="rating"]');

    let selectedRating = Number(ratingInput?.value) || 0;

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

});

// edit review

const editButtons = document.querySelectorAll(".edit-review");

editButtons.forEach(button => {

    button.addEventListener("click", () => {

        const card = button.closest(".review-card");

        const display = card.querySelector(".review-display");
        const edit = card.querySelector(".review-edit");
        const cancelButton = card.querySelector(".cancel-review");

        display.classList.add("d-none");
        edit.classList.remove("d-none");

        button.classList.add("d-none");
        cancelButton.classList.remove("d-none");
    });

});


// Undo edit

const cancelButtons = document.querySelectorAll(".cancel-review");

cancelButtons.forEach(button => {

    button.addEventListener("click", () => {

        const card = button.closest(".review-card");

        const display = card.querySelector(".review-display");
        const edit = card.querySelector(".review-edit");
        const editButton = card.querySelector(".edit-review");

        edit.classList.add("d-none");
        display.classList.remove("d-none");

        button.classList.add("d-none");
        editButton.classList.remove("d-none");
    });

});


// Rating Edit

const ratings = document.querySelectorAll(".review-edit .rating");

ratings.forEach(rating => {

    const stars = rating.querySelectorAll("i");
    const input = rating.querySelector("input");

    stars.forEach(star => {

        star.addEventListener("click", () => {

            const value = star.dataset.rating;

            input.value = value;

            stars.forEach(star => {

                if (star.dataset.rating <= value) {

                    star.classList.remove("fa-regular");
                    star.classList.add("fa-solid", "yellow_star");

                } else {

                    star.classList.remove("fa-solid", "yellow_star");
                    star.classList.add("fa-regular");

                }

            });

        });

    });

});

// Delete PopUP


const deleteButtons = document.querySelectorAll(".delete-review");

const deletePopup = document.querySelector("#deletePopup");
const deleteForm = document.querySelector("#deleteReviewForm");
const cancelDelete = document.querySelector("#cancelDelete");

deleteButtons.forEach(button => {

    button.addEventListener("click", () => {

        const deleteUrl = button.dataset.deleteUrl;

        deleteForm.action = deleteUrl;

        deletePopup.classList.remove("d-none");

    });

});

cancelDelete.addEventListener("click", () => {

    deletePopup.classList.add("d-none");

});

// DELETE POPUP MOBILE

const deleteButtonsMobile = document.querySelectorAll(".delete-review");

const deletePopupMobile = document.querySelector("#deletePopupMobile");
const deleteFormMobile = document.querySelector("#deleteReviewFormMobile");
const cancelDeleteMobile = document.querySelector("#cancelDeleteMobile");

deleteButtonsMobile.forEach(button => {

    button.addEventListener("click", () => {

        const deleteUrl = button.dataset.deleteUrl;

        deleteFormMobile.action = deleteUrl;

        deletePopupMobile.classList.remove("d-none");

    });

});

cancelDeleteMobile.addEventListener("click", () => {

    deletePopupMobile.classList.add("d-none");

});