//
import "bootstrap/dist/js/bootstrap";
import Swiper from "swiper/bundle";
import "./main";


// SWIPER HOME
var swiper = new Swiper('.mySwiper', {
    spaceBetween: 30,

    loop: true,

    centeredSlides:true,
    speed: 1200,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    breakpoints: {
        
        0: {
            slidesPerView: 1,
            spaceBetween: 15
        },

        
        768: {
            slidesPerView: 1.5,
            spaceBetween: 20
            
        },

       
        1200: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        
        1400:{
            slidesPerView: 4.5,
            spaceBetween: 30

        }

    }
});
// SWIPER SHOW
 var swiper3 = new Swiper('.mySwiper3', {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper('.mySwiper2', {
        loop: true,
        spaceBetween: 10,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        thumbs: {
          swiper: swiper3,
        },
      });

