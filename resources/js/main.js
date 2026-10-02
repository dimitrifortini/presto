import Swiper from "swiper/bundle";


// =====================================================
// SWIPER HOME
// =====================================================

const swiper = new Swiper(".mySwiper", {

    spaceBetween: 30,

    loop: true,

    centeredSlides: true,

    speed: 1200,

    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {

        0: {
            slidesPerView: 1,
            spaceBetween: 15,
        },

        768: {
            slidesPerView: 1.5,
            spaceBetween: 20,
        },

        1200: {
            slidesPerView: 3,
            spaceBetween: 30,
        },

        1400: {
            slidesPerView: 3.5,
            spaceBetween: 30,
        },

    },

});


// =====================================================
// ACCORDION
// =====================================================

const tabs = document.querySelectorAll(".accordion-tab");
const panels = document.querySelectorAll(".panel");

tabs.forEach(tab => {

    tab.addEventListener("click", () => {

        tabs.forEach(t => t.classList.remove("active"));
        panels.forEach(p => p.classList.remove("active"));

        tab.classList.add("active");

        document
            .getElementById(tab.dataset.tab)
            .classList.add("active");

    });

});


// =====================================================
// COLLAPSE CUSTOM
// =====================================================

document.addEventListener("click", event => {

    const navbar = document.querySelector(".navbar");
    const categories = document.querySelector("#categoriesMenu");
    const languages = document.querySelector("#languagesMenu");

    if (!navbar || !categories || !languages) {
        return;
    }

    if (!navbar.contains(event.target)) {

        categories.classList.remove("show");
        languages.classList.remove("show");

    }

});


// =====================================================
// ACCORDION MOBILE
// =====================================================

const mobileItems = document.querySelectorAll(".mobile-item");

mobileItems.forEach(item => {

    const header = item.querySelector(".mobile-header");

    if (!header) {
        return;
    }

    header.addEventListener("click", () => {
        item.classList.toggle("active");
    });

});


// =====================================================
// RATING
// =====================================================

const ratingContainers = document.querySelectorAll(".rating");

ratingContainers.forEach(ratingContainer => {

    const stars = ratingContainer.querySelectorAll("i");
    const ratingInput = ratingContainer.querySelector(
        'input[name="rating"]'
    );

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

            if (ratingInput) {
                ratingInput.value = selectedRating;
            }

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


// =====================================================
// EDIT REVIEW
// =====================================================

const editButtons = document.querySelectorAll(".edit-review");

editButtons.forEach(button => {

    button.addEventListener("click", () => {

        const card = button.closest(".review-card");

        if (!card) {
            return;
        }

        const display = card.querySelector(".review-display");
        const edit = card.querySelector(".review-edit");
        const cancelButton = card.querySelector(".cancel-review");

        display.classList.add("d-none");
        edit.classList.remove("d-none");

        button.classList.add("d-none");
        cancelButton.classList.remove("d-none");

    });

});


// =====================================================
// CANCEL REVIEW EDIT
// =====================================================

const cancelButtons = document.querySelectorAll(".cancel-review");

cancelButtons.forEach(button => {

    button.addEventListener("click", () => {

        const card = button.closest(".review-card");

        if (!card) {
            return;
        }

        const display = card.querySelector(".review-display");
        const edit = card.querySelector(".review-edit");
        const editButton = card.querySelector(".edit-review");

        edit.classList.add("d-none");
        display.classList.remove("d-none");

        button.classList.add("d-none");
        editButton.classList.remove("d-none");

    });

});


// =====================================================
// RATING EDIT
// =====================================================

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
                    star.classList.add(
                        "fa-solid",
                        "yellow_star"
                    );

                } else {

                    star.classList.remove(
                        "fa-solid",
                        "yellow_star"
                    );

                    star.classList.add("fa-regular");

                }

            });

        });

    });

});


// =====================================================
// DELETE REVIEW POPUP
// =====================================================

const deleteButtons = document.querySelectorAll(".delete-review");

deleteButtons.forEach(button => {

    button.addEventListener("click", () => {

        const deleteUrl = button.dataset.deleteUrl;


        const deletePopup = document.querySelector("#deletePopup");
        const deleteForm = document.querySelector("#deleteReviewForm");

        if (deletePopup && deleteForm) {

            deleteForm.action = deleteUrl;
            deletePopup.classList.remove("d-none");

        }


        const deletePopupMobile = document.querySelector(
            "#deletePopupMobile"
        );

        const deleteFormMobile = document.querySelector(
            "#deleteReviewFormMobile"
        );

        if (deletePopupMobile && deleteFormMobile) {

            deleteFormMobile.action = deleteUrl;
            deletePopupMobile.classList.remove("d-none");

        }


        const deletePopupProfile = document.querySelector(
            "#deletePopupProfile"
        );

        const deleteReviewFormProfile = document.querySelector(
            "#deleteReviewFormProfile"
        );

        if (deletePopupProfile && deleteReviewFormProfile) {

            deleteReviewFormProfile.action = deleteUrl;
            deletePopupProfile.classList.remove("d-none");

        }

    });

});


// =====================================================
// CANCEL DELETE
// =====================================================

const cancelDelete = document.querySelector("#cancelDelete");
const deletePopup = document.querySelector("#deletePopup");

if (cancelDelete && deletePopup) {

    cancelDelete.addEventListener("click", () => {
        deletePopup.classList.add("d-none");
    });

}


const cancelDeleteMobile = document.querySelector("#cancelDeleteMobile");
const deletePopupMobile = document.querySelector("#deletePopupMobile");

if (cancelDeleteMobile && deletePopupMobile) {

    cancelDeleteMobile.addEventListener("click", () => {
        deletePopupMobile.classList.add("d-none");
    });

}


const cancelDeleteProfile = document.querySelector("#cancelDeleteProfile");
const deletePopupProfile = document.querySelector("#deletePopupProfile");

if (cancelDeleteProfile && deletePopupProfile) {

    cancelDeleteProfile.addEventListener("click", () => {
        deletePopupProfile.classList.add("d-none");
    });

};


// =====================================================
// SWIPER SHOW
// =====================================================

const swiper3Element = document.querySelector(".mySwiper3");
const swiper2Element = document.querySelector(".mySwiper2");

if (swiper3Element && swiper2Element) {

    const swiper3 = new Swiper(".mySwiper3", {

        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,

    });


    const swiper2 = new Swiper(".mySwiper2", {

        loop: true,
        spaceBetween: 10,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        thumbs: {
            swiper: swiper3,
        },

    });


    // =================================================
    // ZOOM SWIPER
    // =================================================

    const resetZoomFunctions = [];


    document.querySelectorAll(".zoomable-image").forEach(image => {

        let zoomed = false;
        let dragging = false;

        let startX = 0;
        let startY = 0;

        let positionX = 0;
        let positionY = 0;

        const zoom = 2;


        function resetZoom() {

            zoomed = false;
            dragging = false;

            positionX = 0;
            positionY = 0;

            image.classList.remove("zoomed", "dragging");

            image.style.transform = "";

        }


        function updatePosition() {

            const container = image.closest(".swiper-slide");

            if (!container) {
                return;
            }

            const containerWidth = container.clientWidth;
            const containerHeight = container.clientHeight;

            const imageWidth = image.clientWidth * zoom;
            const imageHeight = image.clientHeight * zoom;

            const maxX = Math.max(
                0,
                (imageWidth - containerWidth) / 2
            );

            const maxY = Math.max(
                0,
                (imageHeight - containerHeight) / 2
            );

            positionX = Math.max(
                -maxX,
                Math.min(positionX, maxX)
            );

            positionY = Math.max(
                -maxY,
                Math.min(positionY, maxY)
            );

            image.style.transform =
                `translate(${positionX}px, ${positionY}px) scale(${zoom})`;

        }


        // DOPPIO CLICK

        image.addEventListener("dblclick", event => {

            event.preventDefault();
            event.stopPropagation();

            if (!zoomed) {

                zoomed = true;

                image.classList.add("zoomed");

                positionX = 0;
                positionY = 0;

                updatePosition();

            } else {

                resetZoom();

            }

        });


        // INIZIO DRAG

        image.addEventListener("pointerdown", event => {

            if (!zoomed) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            dragging = true;

            startX = event.clientX - positionX;
            startY = event.clientY - positionY;

            image.classList.add("dragging");

            image.setPointerCapture(event.pointerId);

        });


        // DRAG

        image.addEventListener("pointermove", event => {

            if (!dragging || !zoomed) {
                return;
            }

            event.preventDefault();

            positionX = event.clientX - startX;
            positionY = event.clientY - startY;

            updatePosition();

        });


        // FINE DRAG

        image.addEventListener("pointerup", event => {

            if (!dragging) {
                return;
            }

            dragging = false;

            image.classList.remove("dragging");

            image.releasePointerCapture(event.pointerId);

        });


        image.addEventListener("pointercancel", () => {

            dragging = false;

            image.classList.remove("dragging");

        });


        resetZoomFunctions.push(resetZoom);

    });


    // CAMBIO SLIDE → RESET ZOOM

    swiper2.on("slideChangeTransitionStart", () => {

        resetZoomFunctions.forEach(resetZoom => {
            resetZoom();
        });

        document
            .querySelectorAll(".zoomable-image")
            .forEach(image => {

                image.classList.remove(
                    "zoomed",
                    "dragging"
                );

                image.style.transform = "";

            });

    });

}