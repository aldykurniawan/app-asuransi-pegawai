<script setup>
import { computed, onMounted, ref } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import getStaticData from '@/Helpers/StaticData.js';
import Footer from '../Components/Footer.vue';
import Swal from "sweetalert2";

const props = defineProps({
  imageFooter: {
    type: Array,
    default: () => [],
  },
});

const user = computed(() => {
  return usePage().props.auth.user;
});

const pageInfo = computed(() => {
  return usePage().props;
});

// const pluginPartikel = () => {
//   particlesJS("particles-js",{
//   "particles": {
//     "number": {
//       "value": 1,
//       "density": {
//         "enable": true,
//         "value_area": 400.8530152163807
//       }
//     },
//     "color": {
//       "value": "#f5e5c9"
//     },
//     "shape": {
//       "type": "polygon",
//       "stroke": {
//         "width": 0,
//         "color": "#000"
//       },
//       "polygon": {
//         "nb_sides": 3
//       },
//       "image": {
//         "src": "img/github.svg",
//         "width": 100,
//         "height": 100
//       }
//     },
//     "opacity": {
//       "value": 0.3,
//       "random": true,
//       "anim": {
//         "enable": false,
//         "speed": 1,
//         "opacity_min": 0.1,
//         "sync": false
//       }
//     },
//     "size": {
//       "value": 160,
//       "random": false,
//       "anim": {
//         "enable": true,
//         "speed": 10,
//         "size_min": 40,
//         "sync": false
//       }
//     },
//     "line_linked": {
//       "enable": false,
//       "distance": 200,
//       "color": "#ffffff",
//       "opacity": 1,
//       "width": 0.4810236182596568
//     },
//     "move": {
//       "enable": true,
//       "speed": 8,
//       "direction": "none",
//       "random": false,
//       "straight": false,
//       "out_mode": "out",
//       "bounce": false,
//       "attract": {
//         "enable": false,
//         "rotateX": 600,
//         "rotateY": 1200
//       }
//     }
//   },
//   "interactivity": {
//     "detect_on": "canvas",
//     "events": {
//       "onhover": {
//         "enable": true,
//         "mode": "grab"
//       },
//       "onclick": {
//         "enable": true,
//         "mode": "bubble"
//       },
//       "resize": true
//     },
//     "modes": {
//       "grab": {
//         "distance": 400,
//         "line_linked": {
//           "opacity": 1
//         }
//       },
//       "bubble": {
//         "distance": 400,
//         "size": 40,
//         "duration": 2,
//         "opacity": 8,
//         "speed": 3
//       },
//       "repulse": {
//         "distance": 200,
//         "duration": 0.4
//       },
//       "push": {
//         "particles_nb": 4
//       },
//       "remove": {
//         "particles_nb": 2
//       }
//     }
//   },
//   "retina_detect": true
// });
// };

const JqueryTemplate = () => {
  $(function () {
    "use strict";

    var wind = $(window);

    /* ===============================  Navbar Menu  =============================== */

    $.scrollIt({
      upKey: 38, // key code to navigate to the next section
      downKey: 40, // key code to navigate to the previous section
      easing: "swing", // the easing function for animation
      scrollTime: 600, // how long (in ms) the animation takes
      activeClass: "active", // class given to the active nav element
      onPageChange: null, // function(pageIndex) that is called when page is changed
      topOffset: -80, // offste (in px) for fixed top navigation
    });

    $(".navbar .dropdown").hover(
      function () {
        $(this).find(".dropdown-menu").addClass("show");
      },
      function () {
        $(this).find(".dropdown-menu").removeClass("show");
      }
    );

    $(".navbar .dropdown-item").hover(
      function () {
        $(this).find(".dropdown-side").addClass("show");
      },
      function () {
        $(this).find(".dropdown-side").removeClass("show");
      }
    );

    wind.on("scroll", function () {
      var bodyScroll = wind.scrollTop(),
        navbar = $(".navbar"),
        logo = $(".navbar.change .logo> img");

      if (bodyScroll > 300) {
        navbar.addClass("nav-scroll");
        logo.attr("src", "/fe/assets/img/logo.svg");
      } else {
        navbar.removeClass("nav-scroll");
        logo.attr("src", "/fe/assets/img/logo.svg");
      }
    });

    function noScroll() {
      window.scrollTo(0, 0);
    }

    wind.on("scroll", function () {
      var bodyScroll = wind.scrollTop(),
        navbar = $(".topnav");

      if (bodyScroll > 300) {
        navbar.addClass("nav-scroll");
      } else {
        navbar.removeClass("nav-scroll");
      }
    });

    /* ===============================  Swiper slider  =============================== */

    var parallaxSlider;
    var parallaxSliderOptions = {
      speed: 1000,
      autoplay: true,
      parallax: true,
      loop: true,

      on: {
        init: function () {
          var swiper = this;
          for (var i = 0; i < swiper.slides.length; i++) {
            $(swiper.slides[i])
              .find(".bg-img")
              .attr({
                "data-swiper-parallax": 0.75 * swiper.width,
              });
          }
        },
        resize: function () {
          this.update();
        },
      },

      pagination: {
        el: ".slider-prlx .parallax-slider .swiper-pagination",
        type: "fraction",
        clickable: true,
      },

      navigation: {
        nextEl: ".slider-prlx .parallax-slider .next-ctrl",
        prevEl: ".slider-prlx .parallax-slider .prev-ctrl",
      },
    };
    parallaxSlider = new Swiper(
      ".slider-prlx .parallax-slider",
      parallaxSliderOptions
    );

    var swiperTestim = new Swiper(".swiper-testim", {
      spaceBetween: 0,
      speed: 1000,
      loop: true,

      pagination: {
        el: ".swiper-testim .swiper-pagination",
      },

      navigation: {
        nextEl: ".swiper-testim .swiper-button-next",
        prevEl: ".swiper-testim .swiper-button-prev",
      },
    });

    var swiperTestimImg = new Swiper(".testimonials .swiper-img", {
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 800,
      loop: true,
      effect: "fade",

      pagination: {
        el: ".testimonials .controls .swiper-pagination",
        type: "fraction",
      },

      navigation: {
        nextEl: ".testimonials .controls .next-ctrl",
        prevEl: ".testimonials .controls .prev-ctrl",
      },
    });

    var swiperTestimContent = new Swiper(".testimonials .swiper-content", {
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 800,
      loop: true,

      pagination: {
        el: ".testimonials .controls .swiper-pagination",
        type: "fraction",
      },

      navigation: {
        nextEl: ".testimonials .controls .next-ctrl",
        prevEl: ".testimonials .controls .prev-ctrl",
      },
    });

    var swiperWork = new Swiper(".work-crsol", {
      slidesPerView: "auto",
      spaceBetween: 60,
      loop: true,
      pagination: {
        el: ".work-crsol .swiper-pagination",
        type: "fraction",
        clickable: true,
      },

      navigation: {
        nextEl: ".work-crsol .next-ctrl",
        prevEl: ".work-crsol .prev-ctrl",
      },
    });

    /* ===============================  Var Background image  =============================== */

    var pageSection = $(".bg-img, section");
    pageSection.each(function (indx) {
      if ($(this).attr("data-background")) {
        $(this).css(
          "background-image",
          "url(" + $(this).data("background") + ")"
        );
      }
    });

    var pageSectionColor = $(".bg-solid-color, section");
    pageSectionColor.each(function (indx) {
      var color = $(this).attr("data-solid-color");

      if ($(this).attr("data-solid-color")) {
        $(this).css("background-color", color);
      }
    });

    /* ===============================  sticky-bar  =============================== */

    var offset = 600;
    jQuery(window).on("scroll", function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery(".sticky-bar").addClass("active");
      } else {
        jQuery(".sticky-bar").removeClass("active");
      }
    });

    // $(".fixed-search .search-area").on("click", ".search-icon", function () {
    //   $(this).toggleClass("active");
    //   $(".fixed-search .search-area").toggleClass("search-on");
    // });

    /* ===============================  Mouse Hover  =============================== */

    $(".feat").on("mouseenter", ".items", function () {
      $(this).addClass("active").siblings().removeClass("active");
    });

    document
      .querySelectorAll(".button")
      .forEach(
        (button) =>
          (button.innerHTML =
            "<div><span>" +
            button.textContent.trim().split("").join("</span><span>") +
            "</span></div>")
      );

    /* ===============================  tabs  =============================== */

    $(".tabs .tab-links").on("click", ".item-link", function () {
      var tab_id = $(this).attr("data-tab");

      $(".tabs .tab-links .item-link").removeClass("current");
      $(this).addClass("current");

      $(".tab-content").slideUp();
      $("#" + tab_id).slideDown();
    });

    $(".tabs-fade .tab-links").on("click", ".item-link", function () {
      var tab2_id = $(this).attr("data-tab");

      $(".tabs-fade .tab-links .item-link").removeClass("current");
      $(this).addClass("current");

      $(".tab-content").fadeOut();
      $("#" + tab2_id).fadeIn();
    });

    /* ===============================  skills-circle  =============================== */

    var c4 = $(".skills-circle .skill");
    var myVal = $(this).attr("data-value");

    $(".skills-circle .skill").each(function () {
      c4.circleProgress({
        startAngle: (-Math.PI / 2) * 1,
        value: myVal,
        thickness: 4,
        size: 140,
        fill: { color: "#ff5e57" },
      });
    });

    wind.on("scroll", function () {
      $(".skill-progress .progres").each(function () {
        var bottom_of_object = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        var myVal = $(this).attr("data-value");
        if (bottom_of_window > bottom_of_object) {
          $(this).css({
            width: myVal,
          });
        }
      });
    });

    /* ===============================  accordion  =============================== */

    $(".accordion").on("click", ".title", function () {
      $(this).next().slideDown();

      $(".accordion-info").not($(this).next()).slideUp();
    });

    $(".accordion").on("click", ".item", function () {
      $(this).addClass("active").siblings().removeClass("active");
    });

    /* ===============================  tooltip  =============================== */

    $("[data-tooltip-tit]")
      .hover(
        function () {
          $('<div class="div-tooltip-tit"></div>')
            .text($(this).attr("data-tooltip-tit"))
            .appendTo("body")
            .fadeIn("slow");
        },
        function () {
          $(".div-tooltip-tit").remove();
        }
      )
      .mousemove(function (e) {
        $(".div-tooltip-tit").css({ top: e.pageY + 10, left: e.pageX + 20 });
      });

    $("[data-tooltip-sub]")
      .hover(
        function () {
          $('<div class="div-tooltip-sub"></div>')
            .text($(this).attr("data-tooltip-sub"))
            .appendTo("body")
            .fadeIn("slow");
        },
        function () {
          $(".div-tooltip-sub").remove();
        }
      )
      .mousemove(function (e) {
        $(".div-tooltip-sub").css({ top: e.pageY + -15, left: e.pageX + 30 });
      });

    /* ===============================  TriggerPlugins  =============================== */

    /* --------- YouTubePopUp --------- */

    $("a.vid").YouTubePopUp();

    /* --------- parallaxie --------- */

    $(".parallaxie").parallaxie({
      speed: 0.5,
      size: "cover",
    });

    /* --------- magnificPopup --------- */

    $(".popup-img , .gallery").magnificPopup({
      delegate: ".popimg",
      type: "image",
      gallery: {
        enabled: true,
      },
    });

    /* --------- justifiedGallery --------- */

    $(".justified-gallery").justifiedGallery({
      rowHeight: 400,
      lastRow: "nojustify",
      margins: 15,
    });

    /* --------- hover3d --------- */

    $(".hover3d").hover3d({
      selector: ".hover3d-child",
      invert: true,
    });

    /* --------- countUp --------- */

    $(".number-sec .count").countUp({
      delay: 10,
      time: 500,
    });
  });

  // === window When Loading === //

  $(window).on("load", function () {
    /* ===============================  SPLITTING TEXT  =============================== */

    Splitting();

    /* ===============================  thumparallax  =============================== */

    var imageUp = document.getElementsByClassName("thumparallax");
    new simpleParallax(imageUp, {
      delay: 1,
      scale: 1.1,
    });

    var imageDown = document.getElementsByClassName("thumparallax-down");
    new simpleParallax(imageDown, {
      orientation: "down",
      delay: 1,
      scale: 1.1,
    });

    /* ===============================  isotope Masonery  =============================== */

    $(".gallery").isotope({
      itemSelector: ".items",
    });

    var $gallery = $(".gallery").isotope();

    $(".filtering").on("click", "span", function () {
      var filterValue = $(this).attr("data-filter");
      $gallery.isotope({ filter: filterValue });
    });

    $(".filtering").on("click", "span", function () {
      $(this).addClass("active").siblings().removeClass("active");
    });

    /* ===============================  contact validator  =============================== */

    $("#contact-form").validator();

    $("#contact-form").on("submit", function (e) {
      if (!e.isDefaultPrevented()) {
        var url = "contact.php";

        $.ajax({
          type: "POST",
          url: url,
          data: $(this).serialize(),
          success: function (data) {
            var messageAlert = "alert-" + data.type;
            var messageText = data.message;

            var alertBox =
              '<div class="alert ' +
              messageAlert +
              ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
              messageText +
              "</div>";
            if (messageAlert && messageText) {
              $("#contact-form").find(".messages").html(alertBox);
              $("#contact-form")[0].reset();
            }
          },
        });
        return false;
      }
    });
  });

  /* ===============================  Scroll back to top  =============================== */

  $(document).ready(function () {
    "use strict";

    var progressPath = document.querySelector(".progress-wrap path");
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "stroke-dashoffset 10ms linear";
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength) / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 150;
    var duration = 550;
    jQuery(window).on("scroll", function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery(".progress-wrap").addClass("active-progress");
      } else {
        jQuery(".progress-wrap").removeClass("active-progress");
      }
    });
    jQuery(".progress-wrap").on("click", function (event) {
      event.preventDefault();
      jQuery("html, body").animate({ scrollTop: 0 }, duration);
      return false;
    });
  });

  $(window).scroll(function () {
    /* ===============================  fade slideshow  =============================== */

    var scrolled = $(this).scrollTop();
    $(".fixed-slider .caption , .fixed-slider .capt .parlx").css({
      transform: "translate3d(0, " + -(scrolled * 0.2) + "px, 0)",
      opacity: 1 - scrolled / 600,
    });
  });

  $(function () {
    "use strict";

    /* ===============================  fixed-slider  =============================== */

    var slidHeight = $(".fixed-slider").outerHeight();

    $(".main-content").css({
      marginTop: slidHeight,
    });

    /* ===============================  slider-thumbs  =============================== */

    var galleryTop = new Swiper(".slider-thumbs .gallery-top", {
      spaceBetween: 10,
      navigation: {
        nextEl: ".slider-thumbs .swiper-button-next",
        prevEl: ".slider-thumbs .swiper-button-prev",
      },
      loop: true,
      loopedSlides: 4,
    });

    var galleryThumbs = new Swiper(".slider-thumbs .gallery-thumbs", {
      spaceBetween: 10,
      centeredSlides: true,
      slidesPerView: 3,
      touchRatio: 0.2,
      slideToClickedSlide: true,
      loop: true,
      loopedSlides: 4,
    });

  });

  /* ===============================  Swiper showcases with data  =============================== */

  $('[data-carousel="swiper"]').each(function () {
    var containe = $(this).find('[data-swiper="container"]').attr("id");
    var pagination = $(this).find('[data-swiper="pagination"]').attr("id");
    var prev = $(this).find('[data-swiper="prev"]').attr("id");
    var next = $(this).find('[data-swiper="next"]').attr("id");
    var items = $(this).data("items");
    var autoplay = $(this).data("autoplay");
    var iSlide = $(this).data("initial");
    var loop = $(this).data("loop");
    var parallax = $(this).data("parallax");
    var space = $(this).data("space");
    var speed = $(this).data("speed");
    var center = $(this).data("center");
    var effect = $(this).data("effect");
    var direction = $(this).data("direction");
    var mousewheel = $(this).data("mousewheel");

    // Configuration
    var conf = {};

    // Responsive
    if ($(this).hasClass("clients-carsouel")) {
      var conf = {
        breakpoints: {
          0: {
            slidesPerView: 3,
          },
          640: {
            slidesPerView: 3,
          },
          768: {
            slidesPerView: 3,
          },
          1024: {
            slidesPerView: 5,
          },
        },
      };
    }

    if ($(this).hasClass("work-crus")) {
      var conf = {
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 3,
          },
        },
      };
    }

    if ($(this).hasClass("work-crsol-clum")) {
      var conf = {
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 4,
          },
        },
      };
    }

    if ($(this).hasClass("testim-grid")) {
      var conf = {
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 4,
          },
        },
      };
    }

    if ($(this).hasClass("testim-modrn2")) {
      var conf = {
        navigation: {
          nextEl: ".testim-modrn2 .swiper-button-next",
          prevEl: ".testim-modrn2 .swiper-button-prev",
        },
      };
    }

    if ($(this).hasClass("testim-modrn02")) {
      var conf = {
        navigation: {
          nextEl: ".testim-modrn02 .swiper-button-next",
          prevEl: ".testim-modrn02 .swiper-button-prev",
        },
      };
    }

    if ($(this).hasClass("anim-pagination")) {
      var conf = {
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 3,
          },
        },

        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          renderBullet: function (index, className) {
            return (
              '<span class="' +
              className +
              '">' +
              '<svg class="fp-arc-loader" width="16" height="16" viewBox="0 0 16 16">' +
              '<circle class="path" cx="8" cy="8" r="5.5" fill="none" transform="rotate(-90 8 8)" stroke="#FFF"' +
              'stroke-opacity="1" stroke-width="1px"></circle>' +
              '<circle cx="8" cy="8" r="3" fill="#FFF"></circle>' +
              "</svg></span>"
            );
          },
        },
      };
    }

    if (items) {
      conf.slidesPerView = items;
    }
    if (autoplay) {
      conf.autoplay = autoplay;
    }
    if (iSlide) {
      conf.initialSlide = iSlide;
    }
    if (center) {
      conf.centeredSlides = center;
    }
    if (loop) {
      conf.loop = loop;
    }
    if (parallax) {
      conf.parallax = parallax;
    }
    if (space) {
      conf.spaceBetween = space;
    }
    if (speed) {
      conf.speed = speed;
    }
    if (mousewheel) {
      conf.mousewheel = mousewheel;
    }
    if (effect) {
      conf.effect = effect;
    }
    if (direction) {
      conf.direction = direction;
    }
    if (prev) {
      conf.prevButton = "#" + prev;
    }
    if (next) {
      conf.nextButton = "#" + next;
    }
    if (pagination) {
      (conf.pagination = "#" + pagination), (conf.paginationClickable = true);
    }

    // Initialization
    if (containe) {
      var initID = "#" + containe;
      var init = new Swiper(initID, conf);
    }
  });


};

const getData = async () => {
    await getStaticData();
    getLocalStatikData();
};

const detaildata = ref({
    'tentang_kami': {
        content: '-',
    },
    'alamat': {
        content: '-',
    },
    'no_hp': {
        content: '-',
    },
    'email': {
        content: '-',
    },
    'facebook': {
        content: '-',
    },
    'twitter': {
        content: '-',
    },
    'youtube': {
        content: '-',
    },
    'tentang_footer': {
        content: '-',
    },
});

const getLocalStatikData = () => {
    // check interval in 2 seconds for check in localStorage staticData
    // insert to detaildata
    setInterval(() => {
        const statikData = localStorage.getItem('staticData');
        if (statikData) {
            detaildata.value = JSON.parse(statikData);
        }
    }, 1000);
};

const location = ref({
    lat: null,
    lng: null,
});

const originUrl = window.location.origin;

const allowLocation = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            location.value.lat = position.coords.latitude;
            location.value.lng = position.coords.longitude;
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
};

const darurat = () => {
    // check user allow location
    if (location.value.lat === null && location.value.lng === null) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Kamu belum mengizinkan akses lokasi!'
        });
         Swal.fire({
        title: 'Oops....?',
        text: "Tampaknya kamu belum mengizinkan akses lokasi, izinkan sekarang?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Aktifkan!',
        cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                allowLocation();
                return ;
            }
        })

    } else {
        const noHp = localStorage.getItem('no_hp');
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Saya menegaskan bahwa informasi yang saya sampaikan adalah sesuai dengan kebenaran. Saya memahami dan bersedia untuk bertanggung jawab penuh atas pemberitahuan yang telah saya berikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Setuju!',
            cancelButtonText: 'Batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                title: 'Masukan No Handphone',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'SUBMIT',
                cancelButtonText: 'BATALKAN',
                showLoaderOnConfirm: true,
                // default value
                inputValue: noHp !== null ? noHp : '',
                preConfirm: (login) => {
                    if (result.isConfirmed) {
                        // axios post
                        return axios.post(`${originUrl}/api-darurat/${login}`, {
                            lat: location.value.lat,
                            lng: location.value.lng,
                        }).then((response) => {
                            console.log(response.data);
                            if (response.data.status) {
                                // set local storage
                                localStorage.setItem('no_hp', login);
                                // sukses
                                return response.data;
                            } else {
                                throw new Error(response.data.message || 'No HP Tidak Terdaftar!')
                            }
                        }).catch((error) => {
                            console.log(error);
                            Swal.showValidationMessage(
                            `Request Gagal: ${error}`
                            )
                        });
                    } else {
                        return result.isConfirmed;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    console.log(result);
                    if (result.isConfirmed) {
                        // sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Permintaan Darurat Berhasil Dikirim',
                        });
                    }
                })
            }
        })
    }

}

onMounted(() => {
    // pluginPartikel();
    JqueryTemplate();
    getData();
    allowLocation();
    // if not in path /e-maps
    if (window.location.pathname !== '/e-maps') {
        // remove display none on footer
        document.querySelector("footer").style.display = "block";
        // remove display none on fixed-search
        document.querySelector(".fixed-search").style.display = "block";
    }
});

</script>

<style>
    .logo img {
        min-width: 110px;
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .flex--ig {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .flex--ig__item {
        width: 20%;
        height: 20%;
        object-fit: cover;
    }
    .flex--ig__item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .icon__alarm {
        background-color: #32B3A6 !important;
        margin-top: -50px;
    }
    .icon__alarm span {
        color: #fff;
        font-weight: bold;
        font-size: 1.2em;
    }
    .icon__alarm:hover {
        background-color: #fff !important;
    }
    .icon__alarm:hover span {
        color: #32B3A6;
    }
    .swal2-confirm {
        background-color: #fff !important;
        color: #32B3A6 !important;
        border: #32B3A6 1px solid !important;
    }
    .swal2-confirm:hover {
        background-color: #32B3A6 !important;
        color: #fff !important;
    }
    .swal2-html-container {
        font-size: 0.8em !important;
    }
</style>

<template>
  <div class="">
    <Head>
      <title>{{ pageInfo?.page_title }} | SI-GAP Kutim</title>
    </Head>

    <!-- ==================== Start progress-scroll-button ==================== -->

    <div class="progress-wrap cursor-pointer">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>

    <!-- ==================== End progress-scroll-button ==================== -->

    <!-- ==================== Start sticky sidebar ==================== -->

    <div class="sticky-bar">
      <div class="left-bar">
        <Link href="/kontak" class="contact-butn">
          <span class="icon mr-10">
            <i class="far fa-comment"></i>
          </span>
          <span>Contact Us</span>
        </Link>
      </div>

      <div class="right-bar">
        <div class="social-text fz-13">
          <span class="text">Follow Us</span>
          <a :href="detaildata.facebook">Fa.</a>
          <i>/</i>
          <a :href="detaildata.twitter">Tw.</a>
          <i>/</i>
          <a :href="detaildata.youtube">Yt.</a>
        </div>
        <div class="progress-container" style="display: none;">
          <div class="progress-bar-vr" id="progressBar"></div>
        </div>
      </div>
    </div>

    <!-- ==================== End sticky sidebar ==================== -->

    <!-- ==================== Start Navbar ==================== -->

    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <Link class="navbar-brand" href="/">
          <div class="logo">
            <img src="/fe/assets/img/logo_panjang_new.svg" alt />
          </div>
        </Link>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <Link class="nav-link" :href="route('fe.index')">Home</Link>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >Publikasi</a>
              <ul class="dropdown-menu">
                  <li><Link class="dropdown-item" href="/berita">Berita & Informasi</Link></li>
                  <li><Link class="dropdown-item" href="/gallery">Galeri Kegiatan</Link></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >Layanan</a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/e-penanggulangan">E-Penanggulangan</a></li>
                  <li><a class="dropdown-item" href="/e-maps">E-Maps</a></li>
                  <li><a @click="() => darurat()" class="dropdown-item" href="javascript:;">E-Lapor</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <Link class="nav-link" href="/tentang">Tentang</Link>
            </li>
          </ul>
          <div class="social">
            <ul class="rest">
              <li>
                <a :href="detaildata.facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a :href="detaildata.twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <a :href="detaildata.youtube">
                  <i class="fab fa-youtube"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ==================== End Navbar ==================== -->

    <!-- ==================== Start sticky sidebar ==================== -->

    <div class="sticky-bar">
      <div class="left-bar">
        <Link href="/kontak" class="contact-butn">
          <span>Contact Us</span>
          <span class="icon ml-10">
            <i class="far fa-comment"></i>
          </span>
        </Link>
      </div>

      <div class="right-bar">
        <div class="social-text fz-13">
          <span class="text">Follow Us</span>
          <a :href="detaildata.facebook">Fa.</a>
          <i>/</i>
          <a :href="detaildata.twitter">Tw.</a>
          <i>/</i>
          <a :href="detaildata.youtube">Yt.</a>
        </div>
      </div>
    </div>

    <div class="fixed-search">
      <div class="search-area">
        <div class="search-icon cursor-pointer icon__alarm" @click="() => darurat()">
            <span>SOS</span>
        </div>
      </div>
    </div>

    <!-- ==================== End sticky sidebar ==================== -->
    <slot />

    <Footer />
  </div>
</template>
