/*************************************************
  1. Preloader Loading
  2. Top Links Show/Hide dropdown
  3. Sticky Header
  4. Mobile Menu
  5. Footer links for mobiles
  6. Site Animation
  7. Scroll Top
  8. Image to background js
*************************************************/

(function ($) {
    ("use strict");

    // * 1. ---------------- Preloader Loading ----------------

    function pre_loader() {
        $("#load").fadeOut();
        $("#pre-loader").delay(0).fadeOut("slow");
    }
    pre_loader();

    // * 2. ---------------- Top Links Show/Hide dropdown ----------------
    function userlink_dropdown() {
        $(".header-wrap .user-menu").on("click", function () {
            if ($(window).width() < 990) {
                $(this).next().slideToggle(300);
                $(this).parent().toggleClass("active");
            }
        });
    }
    userlink_dropdown();

    // * 3. ---------------- Sticky Header ----------------
    function stickyHeader() {
        function handleStickyHeader() {
            if ($(window).width() > 1199) {
                if ($(window).scrollTop() > 145) {
                    $(".header-wrap").addClass("stickyNav animated fadeInDown");
                } else {
                    $(".header-wrap").removeClass("stickyNav fadeInDown");
                }
            }
        }
        window.onscroll = function () {
            handleStickyHeader();
        };
    }
    stickyHeader();

    // * 4. ---------------- Mobile Menu ----------------
    var selectors = {
        body: "body",
        sitenav: "#siteNav",
        navLinks: "#siteNav .lvl1 > a",
        menuToggle: ".js-mobile-nav-toggle",
        mobilenav: ".mobile-nav-wrapper",
        menuLinks: "#MobileNav .anm",
        closemenu: ".closemobileMenu",
    };

    $(selectors.navLinks).each(function () {
        if ($(this).attr("href") == window.location.pathname)
            $(this).addClass("active");
    });

    $(selectors.menuToggle).on("click", function () {
        body: "body", $(selectors.mobilenav).toggleClass("active");
        $(selectors.body).toggleClass("menuOn");
        $(selectors.menuToggle).toggleClass(
            "mobile-nav--open mobile-nav--close"
        );
    });

    $(selectors.closemenu).on("click", function () {
        body: "body", $(selectors.mobilenav).toggleClass("active");
        $(selectors.body).toggleClass("menuOn");
        $(selectors.menuToggle).toggleClass(
            "mobile-nav--open mobile-nav--close"
        );
    });
    $("body").on("click", function (event) {
        var $target = $(event.target);
        if (
            !$target.parents().is(selectors.mobilenav) &&
            !$target.parents().is(selectors.menuToggle) &&
            !$target.is(selectors.menuToggle)
        ) {
            $(selectors.mobilenav).removeClass("active");
            $(selectors.body).removeClass("menuOn");
            $(selectors.menuToggle)
                .removeClass("mobile-nav--close")
                .addClass("mobile-nav--open");
        }
    });
    $(selectors.menuLinks).on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass("anm-plus-l anm-minus-l");
        $(this).parent().next().slideToggle();
    });

    // * 5. ---------------- Footer links for mobiles ----------------
    function footer_dropdown() {
        $(".footer-links .h4").on("click", function () {
            if ($(window).width() < 766) {
                $(this).next().slideToggle();
                $(this).toggleClass("active");
            }
        });
    }
    footer_dropdown();

    //Resize Function
    var resizeTimer;
    $(window).on("resize", function (e) {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            $(window).trigger("delayed-resize", e);
        }, 250);
    });
    $(window).on("load resize", function (e) {
        if ($(window).width() > 766) {
            $(".footer-links ul").show();
        } else {
            $(".footer-links ul").hide();
        }
    });

    // * 6. ---------------- Site Animation ----------------
    if ($(window).width() < 771) {
        $(".wow").removeClass("wow");
    }
    var wow = new WOW({
        boxClass: "wow", // animated element css class (default is wow)
        animateClass: "animated", // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null, // optional scroll container selector, otherwise use window
    });
    wow.init();

    // * 7. ---------------- Scroll Top ----------------
    function scroll_top() {
        $("#site-scroll").on("click", function () {
            $("html, body").animate({ scrollTop: 0 }, 1000);
            return false;
        });
    }
    scroll_top();

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $("#site-scroll").fadeIn();
        } else {
            $("#site-scroll").fadeOut();
        }
    });

    // * 8. ---------------- Image to background js ----------------
    $(".bg-top").parent().addClass("b-top");
    $(".bg-bottom").parent().addClass("b-bottom");
    $(".bg-center").parent().addClass("b-center");
    $(".bg-left").parent().addClass("b-left");
    $(".bg-right").parent().addClass("b-right");
    $(".bg_size_content").parent().addClass("b_size_content");
    $(".bg-img").parent().addClass("bg-size");
    $(".bg-img.blur-up").parent().addClass("");
    jQuery(".bg-img").each(function () {
        var el = $(this),
            src = el.attr("src"),
            parent = el.parent();

        parent.css({
            "background-image": `url(${src})`,
            "background-size": "cover",
            "background-position": "center",
            "background-repeat": "no-repeat",
        });

        el.hide();
    });
    // * 9. ---------------- Profile Photo Dropdown ----------------

    function profile_dropdown() {
        $(".profile-dd").on("click", function (i) {
            i.preventDefault();
            $("#header-profile").slideToggle();
        });
        // Hide Cart on document click
        $("body").on("click", function (event) {
            var $target = $(event.target);
            if (
                !$target.parents().is(".profile-dropdown-container") &&
                !$target.is(".profile-dropdown-container")
            ) {
                $("body").find("#header-profile").slideUp();
            }
        });
    }
    profile_dropdown();
    // * 9. ---------------- Sidebar widget-title ----------------
    $(".filter-widget .widget-title").on("click", function () {
        $(this).next().slideToggle('300');
        $(this).toggleClass("active");
    });

  	function product_thumb1(){
      $('.product-dec-slider-1').slick({
        infinite: true,
        slidesToShow: 6,
        stageMargin: 5,
        slidesToScroll: 1
      });
    }
  product_thumb1();


  function product_zoom(){
		$(".zoompro").elevateZoom({
			gallery: "gallery",
			galleryActiveClass: "active",
			zoomWindowWidth: 300,
			zoomWindowHeight: 100,
			scrollZoom: false,
			zoomType: "inner",
			cursor: "crosshair"
		});
	}
	product_zoom();

  function home_slider() {
    $('.home-slideshow').slick({
     dots: false,
     infinite: true,
     slidesToShow: 1,
     slidesToScroll: 1,
     fade: true,
     arrows: true,
     autoplay: true,
     autoplaySpeed: 4000,
      lazyLoad: 'ondemand',
     rtl: document.childNodes[1].dir == 'rtl'
     });
   }
   home_slider();

 // Full Size Banner on the Any Screen
 $(window).on('resize',function() {
   var bodyheight = $(this).height() - 20;
   $(".sliderFull .bg-size").height(bodyheight);
 })

  function product_slider() {
    console.log()
    $('.productSlider').slick({
    rtl: document.childNodes[1].dir == 'rtl',
   dots: false,
   infinite: true,
   slidesToShow: 4,
   slidesToScroll: 1,
   arrows: true,
   responsive: [
   {
     breakpoint: 1024,
     settings: {
     slidesToShow: 3,
     slidesToScroll: 1
     }
   },
   {
     breakpoint: 600,
     settings: {
     slidesToShow: 2,
     slidesToScroll: 1
     }
   },
   {
     breakpoint: 480,
     settings: {
     slidesToShow: 1,
     slidesToScroll: 1
     }
   }
   ]

   });
 }
 product_slider();

})($);
