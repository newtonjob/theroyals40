<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <title>Plain Invite - Smart Invite, Smooth Entry</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Smart Invite, Smooth Entry">
    <meta name="keywords" content="event, invite, entry, qr code">
    <meta name="author" content="Createx Studio">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Theme switcher (color modes) -->
    <script src="/assets/js/theme-switcher.js"></script>

    <!-- Favicon and Touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <link rel="shortcut icon" href="/favicon.png">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:title" content="Plain Invite - Smart Invite, Smooth Entry" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="{{ asset('og.png') }}" />

    <!-- Vendor Styles -->
    <link rel="stylesheet" media="screen" href="/assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" media="screen" href="/assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" media="screen" href="/assets/vendor/lightgallery/css/lightgallery-bundle.min.css">

    <!-- Main Theme Styles + Bootstrap -->
    <link rel="stylesheet" media="screen" href="/assets/css/theme.min.css">

    <!-- Page loading styles -->
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all .4s .2s ease-in-out;
            transition: all .4s .2s ease-in-out;
            background-color: #fff;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }

        [data-bs-theme="dark"] .page-loading {
            background-color: #0b0f19;
        }

        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }

        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            opacity: 0;
        }

        .page-loading.active > .page-loading-inner {
            opacity: 1;
        }

        .page-loading-inner > span {
            display: block;
            font-size: 1rem;
            font-weight: normal;
            color: #9397ad;
        }

        [data-bs-theme="dark"] .page-loading-inner > span {
            color: #fff;
            opacity: .6;
        }

        .page-spinner {
            display: inline-block;
            width: 2.75rem;
            height: 2.75rem;
            margin-bottom: .75rem;
            vertical-align: text-bottom;
            border: .15em solid #b4b7c9;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner .75s linear infinite;
            animation: spinner .75s linear infinite;
        }

        [data-bs-theme="dark"] .page-spinner {
            border-color: rgba(255, 255, 255, .4);
            border-right-color: transparent;
        }

        @-webkit-keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Page loading scripts -->
    <script>
        (function () {
            window.onload = function () {
                const preloader = document.querySelector('.page-loading');
                preloader.classList.remove('active');
                setTimeout(function () {
                    preloader.remove();
                }, 1000);
            };
        })();
    </script>
</head>


<!-- Body -->
<body>

<!-- Page loading spinner -->
<div class="page-loading active">
    <div class="page-loading-inner">
        <div class="page-spinner"></div>
        <span>Loading...</span>
    </div>
</div>


<!-- Page wrapper for sticky footer -->
<!-- Wraps everything except footer to push footer to the bottom of the page if there is little content -->
<main class="page-wrapper">


    <!-- Navbar -->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page -->
    <header class="header navbar navbar-expand-lg position-absolute navbar-sticky">
        <div class="container px-3">
            <a href="/" class="navbar-brand pe-3">
                <img src="/assets/img/logo.png" width="47" alt="Silicon">
                Plain Invite
            </a>
            <div id="navbarNav" class="offcanvas offcanvas-end">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-header border-top">
                    <a href="#"
                       class="btn btn-primary w-100" target="_blank" rel="noopener">
                        <i class="bx bx-user fs-4 lh-1 me-1"></i>
                        &nbsp; Login
                    </a>
                </div>
            </div>
            <div class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4" data-bs-toggle="mode">
                <input type="checkbox" class="form-check-input" id="theme-mode">
                <label class="form-check-label d-none d-sm-block" for="theme-mode">Light</label>
                <label class="form-check-label d-none d-sm-block" for="theme-mode">Dark</label>
            </div>
            <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#"
               class="btn btn-primary btn-sm fs-sm rounded d-none d-lg-inline-flex" target="_blank" rel="noopener">
                <i class="bx bx-user fs-5 lh-1 me-1"></i>
                &nbsp; Login
            </a>
        </div>
    </header>


    <!-- Hero -->
    <section class="jarallax position-relative d-flex align-items-center min-vh-100 bg-light mb-5 py-lg-5 pt-5"
             style="background-image: url('assets/img/landing/digital-agency/hero-bg.svg');" data-jarallax
             data-img-position="0% 100%" data-speed="0.5">
        <div class="container position-relative zindex-5 py-5">
            <div class="row justify-content-md-start justify-content-center">
                <div
                    class="col-md-6 col-sm-8 order-md-1 order-2 d-flex flex-column justify-content-between mt-4 pt-2 text-md-start text-center">
                    <div class="mb-md-5 pb-xl-5 mb-4">

                        <!-- Video popup btn -->
                        <div class="d-inline-flex align-items-center position-relative mb-3">
                            <a href="https://www.youtube.com/watch?v=zPo5ZaH6sW8"
                               class="btn btn-video btn-icon btn-lg flex-shrink-0 me-3 stretched-link"
                               data-bs-toggle="video" aria-label="Play video">
                                <i class="bx bx-play"></i>
                            </a>
                            <h4 class="mb-0">Play</h4>
                        </div>

                        <!-- Text -->
                        <h1 class="display-2 mb-md-5 mb-3 pb-3">
                            Smart <span class="text-gradient-primary">Invite</span>, Smooth Entry
                        </h1>
                        <div class="d-md-flex align-items-md-start">
                            <a href="#" class="btn btn-lg btn-primary flex-shrink-0 me-md-4 mb-md-0 mb-sm-4 mb-3">
                                Try our demo
                            </a>
                            <p class="d-lg-block d-none mb-0 ps-md-3">
                                Create personalized invites with unique QR codes for your guests. Say goodbye to long lines and confusion at the entrance.
                            </p>
                        </div>
                    </div>

                    <!-- Scroll down btn -->
                    <div
                        class="d-inline-flex align-items-center justify-content-center justify-content-md-start position-relative">
                        <a href="#benefits" data-scroll data-scroll-offset="100"
                           class="btn btn-video btn-icon rounded-circle shadow-sm flex-shrink-0 stretched-link me-3"
                           aria-label="Scroll for more">
                            <i class="bx bx-chevron-down"></i>
                        </a>
                        <span class="fs-sm">Discover more</span>
                    </div>
                </div>

                <!-- Animated gfx -->
                <div class="col-sm-6 col-9 order-md-2 order-1">
                    <lottie-player class="mx-auto" src="/assets/json/animation-digital-agency.json"
                                   background="transparent" speed="1" loop autoplay></lottie-player>
                </div>
            </div>
        </div>
    </section>

    <!-- Backer benefits -->
    <section class="container py-2 py-sm-3 py-md-4 py-lg-5" id="benefits">
        <div class="row py-5 my-md-2 my-lg-3">
            <div class="col-lg-5 col-xl-4 mb-5 mb-lg-0">
                <div class="text-center text-lg-start pe-lg-5 pe-xl-0">
                    <h2 class="h1 pb-3 pb-lg-5">Take your events to the <span class="text-primary">next level!</span></h2>
                    <a href="landing-startup.html#" class="btn btn-lg btn-primary w-100 w-sm-auto">
                        Get started
                        <i class="bx bx-right-arrow-alt lead ms-2 me-n1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 col-xl-7 offset-xl-1">
                <div class="row row-cols-1 row-cols-sm-2 gy-5">
                    <div class="col pt-md-2">
                        <div class="text-center text-sm-start pe-sm-3 pe-xl-4">
                            <img src="assets/img/landing/startup/icons/mobile.svg" class="d-inline-block mb-4" width="60" alt="Icon">

                            <h3 class="h4 mb-2">Customizable E-Invites</h3>
                            <p class="fs-md mb-0">
                                Design stunning e-invites tailored to your event's theme.<br>
                                Personalize every detail, from colors to fonts and images.
                            </p>
                        </div>
                    </div>
                    <div class="col pt-md-2">
                        <div class="text-center text-sm-start pe-sm-3 pe-xl-4">
                            <img src="assets/img/landing/startup/icons/scooter.svg" class="d-inline-block mb-4" width="60" alt="Icon">
                            <h3 class="h4 mb-2">Unique QR Codes</h3>
                            <p class="fs-md mb-0">
                                Each invite comes with a unique QR code for secure guest check-in. <br>
                                Ensure only invited guests can access your event.
                            </p>
                        </div>
                    </div>
                    <div class="col pt-md-2">
                        <div class="text-center text-sm-start pe-sm-3 pe-xl-4">
                            <img src="assets/img/landing/startup/icons/hand.svg" class="d-inline-block mb-4" width="60" alt="Icon">

                            <h3 class="h4 mb-2">Easy Management</h3>
                            <p class="fs-md mb-0">
                                Track RSVPs and manage your guest list with ease from your portal. <br>
                                Know who’s attending.
                            </p>
                        </div>
                    </div>
                    <div class="col pt-md-2">
                        <div class="text-center text-sm-start pe-sm-3 pe-xl-4">
                            <img src="assets/img/landing/startup/icons/smiley.svg" class="d-inline-block mb-4" width="60" alt="Icon">

                            <h3 class="h4 mb-2">Hassle-Free Check-In</h3>
                            <p class="fs-md mb-0">
                                Quickly scan QR codes at the venue for a seamless check-in process.
                                Say goodbye to long lines and confusion at the entrance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if (false)
        <!-- Benefits (features) -->
        <section class="container mb-5 pt-lg-5" id="benefits">
            <div class="swiper pt-3" data-swiper-options='{
          "slidesPerView": 1,
          "pagination": {
            "el": ".swiper-pagination",
            "clickable": true
          },
          "breakpoints": {
            "500": {
              "slidesPerView": 2
            },
            "991": {
              "slidesPerView": 3
            }
          }
        }'>
                <div class="swiper-wrapper">

                    <!-- Item -->
                    <div class="swiper-slide border-end-lg px-2">
                        <div class="text-center">
                            <img src="/assets/img/landing/digital-agency/icons/idea.svg" width="48" alt="Bulb icon"
                                 class="d-block mb-4 mx-auto">
                            <h4 class="mb-2 pb-1">Customizable E-Invites</h4>
                            <p class="mx-auto" style="max-width: 336px;">
                                Design stunning e-invites tailored to your event's theme.<br>
                                Personalize every detail, from colors to fonts and images.
                            </p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide border-end-lg px-2">
                        <div class="text-center">
                            <img src="/assets/img/landing/digital-agency/icons/award.svg" width="48" alt="Award icon"
                                 class="d-block mb-4 mx-auto">
                            <h4 class="mb-2 pb-1">Unique QR Codes</h4>
                            <p class="mx-auto" style="max-width: 336px;">
                                Each invite comes with a unique QR code for secure guest check-in. <br>
                                Ensure only invited guests can access your event.
                            </p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide px-2">
                        <div class="text-center">
                            <img src="/assets/img/landing/digital-agency/icons/team.svg" width="48" alt="Team icon"
                                 class="d-block mb-4 mx-auto">
                            <h4 class="mb-2 pb-1">Easy Management</h4>
                            <p class="mx-auto" style="max-width: 336px;">
                                Track RSVPs and manage your guest list with ease from your portal. <br>
                                Know who’s attending.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Pagination (bullets) -->
                <div class="swiper-pagination position-relative pt-2 pt-sm-3 mt-4"></div>
            </div>
        </section>
    @endif

    <!-- Gallery (carousels) -->
    <section class="mb-5 pt-md-3 pt-lg-4 pt-xl-5">
        <h2 class="h1 mb-4 text-center">Create, Send, Celebrate!</h2>
        <p class="mb-4 mx-auto pb-3 fs-lg text-center" style="max-width: 636px;">
            Effortlessly craft beautiful e-invites with unique QR codes for your special events.
        </p>

        <div class="pb-2 pb-sm-3 pb-md-4">
            <!-- LTR -->
            <div class="swiper"
                 data-swiper-options='{
                    "loop": true,
                    "grabCursor": false,
                    "centeredSlides": true,
                    "autoplay": {
                      "delay": 0,
                      "disableOnInteraction": false
                    },
                    "freeMode": true,
                    "speed": 38000,
                    "freeModeMomentum": false,
                    "breakpoints": {
                      "0": {
                        "slidesPerView": 1,
                        "spaceBetween": 8
                      },
                      "500": {
                        "spaceBetween": 16
                      },
                      "768": {
                        "slidesPerView": 4,
                        "spaceBetween": 24
                      }
                    }
                }'
            >
                <div class="swiper-wrapper">
                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/04.jpg" alt="Gallery image" class="rounded-3">
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/03.jpg" alt="Gallery image" class="rounded-3">
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/02.jpg" alt="Gallery image" class="rounded-3">
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/01.jpg" alt="Gallery image" class="rounded-3">
                    </div>
                </div>
            </div>

            <!-- RTL -->
            <div class="swiper mt-md-4 mt-sm-3 mt-2" dir="rtl"
                 data-swiper-options='{
                    "loop": true,
                    "grabCursor": false,
                    "centeredSlides": true,
                    "autoplay": {
                      "delay": 0,
                      "disableOnInteraction": false
                    },
                    "freeMode": true,
                    "speed": 38000,
                    "freeModeMomentum": false,
                    "breakpoints": {
                      "0": {
                        "slidesPerView": 1,
                        "spaceBetween": 8
                      },
                      "500": {
                        "spaceBetween": 16
                      },
                      "768": {
                        "slidesPerView": 4,
                        "spaceBetween": 24
                      }
                    }
                  }'
            >
                <div class="swiper-wrapper">

                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/05.jpg" alt="Gallery image" class="rounded-3">
                    </div>
                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/06.jpg" alt="Gallery image" class="rounded-3 border border-secondary">
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/08.jpg" alt="Gallery image" class="rounded-3">
                    </div>

                    <!-- Item -->
                    <div class="swiper-slide">
                        <img src="/assets/img/portfolio/grid/07.jpg" alt="Gallery image" class="rounded-3">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Steps (How it works) -->
    <section class="container pb-md-3 pb-lg-4 pb-xl-0 pt-sm-2 pt-md-3 pt-lg-5 mt-2 mt-md-3">
        <h2 class="display-5 text-center pt-5 pb-3 pb-md-4 pb-lg-5 mb-xl-4">So, how does it work?</h2>

        <!-- Step -->
        <div class="row align-items-center pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="col-md-6 pb-2 pb-md-0 mb-4 mb-md-0">
                <div class="bg-secondary rounded-3 border-secondary border">
                    <img src="/assets/img/portfolio/grid/s01.png" class="rounded-3" alt="Project image">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <div class="ps-md-4 ps-lg-0">
                    <div class="text-primary fs-xl fw-bold pb-1 mb-2">Step 1</div>
                    <h3 class="h1 mb-lg-4">Create Your Invite</h3>
                    <p class="fs-xl mb-0">
                        Choose from our beautiful templates or design your own.
                        Provide basic information of your guest and create their unique invite.
                    </p>
                </div>
            </div>
        </div>

        <!-- Step -->
        <div class="row align-items-center pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="col-md-6 pb-2 pb-md-0 mb-4 mb-md-0">
                <div class="position-relative rounded-3 overflow-hidden">
                    <div class="bg-gradient-primary position-absolute top-0 start-0 w-100 h-100"></div>
                    <img src="/assets/img/portfolio/grid/09.jpg" class="d-block position-relative zindex-2 mx-auto" width="636" alt="Image">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <div class="ps-md-4 ps-lg-0">
                    <div class="text-primary fs-xl fw-bold pb-1 mb-2">Step 2</div>
                    <h3 class="h1 mb-lg-4">Send to Guests</h3>
                    <p class="fs-xl mb-0">
                        Automatically send invites via email or other channels, with just a few clicks.
                    </p>
                </div>
            </div>
        </div>

        <!-- Step -->
        <div class="row align-items-center pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
            <div class="col-md-6 pb-2 pb-md-0 mb-4 mb-md-0">
                <div class="position-relative rounded-3 overflow-hidden">
                    <div class="bg-gradient-primary position-absolute top-0 start-0 w-100 h-100"></div>
                    <img src="/assets/img/portfolio/grid/10.jpg" class="d-block position-relative zindex-2 mx-auto" width="636" alt="Image">
                </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1">
                <div class="ps-md-4 ps-lg-0">
                    <div class="text-primary fs-xl fw-bold pb-1 mb-2">Step 3</div>
                    <h3 class="h1 mb-lg-4">Hassle-Free Check-In</h3>
                    <p class="fs-xl mb-0">
                        Quickly scan QR codes at the venue for a seamless check-in process.
                        Say goodbye to long lines and confusion at the entrance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @if (false)
        <!-- Testimonials slider -->
        <section class="container mb-5 pt-2 pb-3 py-md-4 py-lg-5">
            <h2 class="h1 pb-2 pb-lg-0 mb-4 mb-lg-5 text-center">What They Say About Us</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-4 p-xxl-5 mb-4 me-xxl-4">

                        <!-- Quotation mark -->
                        <div class="pb-4 mb-2">
                <span class="btn btn-icon btn-primary btn-lg shadow-primary pe-none">
                  <i class="bx bxs-quote-left"></i>
                </span>
                        </div>

                        <!-- Slider -->
                        <div class="swiper mx-0 mb-md-n2 mb-xxl-n3" data-swiper-options='{
                "spaceBetween": 24,
                "pager": true,
                "loop": true,
                "tabs": true,
                "navigation": {
                  "prevEl": ".page-prev",
                  "nextEl": ".page-next"
                }
              }'>
                            <div class="swiper-wrapper">

                                <!-- Item -->
                                <div class="swiper-slide h-auto" data-swiper-tab="#author-1">
                                    <figure class="card h-100 position-relative border-0 bg-transparent">
                                        <blockquote class="card-body p-0 mb-0">
                                            <p class="fs-lg mb-0">Dolor, a eget elementum, integer nulla volutpat, nunc,
                                                sit. Quam iaculis varius mauris magna sem. Egestas sed sed suscipit dolor
                                                faucibus dui imperdiet at eget. Tincidunt imperdiet quis hendrerit aliquam
                                                feugiat neque cras sed. Dictum quam integer volutpat tellus, faucibus
                                                platea. Pulvinar turpis proin faucibus at mauris. Sagittis gravida vitae
                                                porta enim, nulla arcu fermentum massa. Tortor ullamcorper lacus.
                                                Pellentesque lectus adipiscing aenean volutpat tortor habitant.</p>
                                        </blockquote>
                                        <figcaption class="card-footer border-0 d-sm-flex d-md-none w-100 pb-2">
                                            <div class="d-flex align-items-center border-end-sm pe-sm-4 me-sm-2">
                                                <img src="/assets/img/avatar/01.jpg" width="48" class="rounded-circle"
                                                     alt="Ralph Edwards">
                                                <div class="ps-3">
                                                    <h5 class="fw-semibold lh-base mb-0">Ralph Edwards</h5>
                                                    <span class="fs-sm text-muted">Head of Marketing</span>
                                                </div>
                                            </div>
                                            <img src="/assets/img/brands/01.svg" width="160"
                                                 class="d-block mt-2 ms-5 mt-sm-0 ms-sm-0" alt="Company logo">
                                        </figcaption>
                                    </figure>
                                </div>

                                <!-- Item -->
                                <div class="swiper-slide h-auto" data-swiper-tab="#author-2">
                                    <figure class="card h-100 position-relative border-0 bg-transparent">
                                        <blockquote class="card-body p-0 mb-0">
                                            <p class="fs-lg mb-0">Mi semper risus ultricies orci pulvinar in at enim orci.
                                                Quis facilisis nunc pellentesque in ullamcorper sit. Lorem blandit arcu
                                                sapien, senectus libero, amet dapibus cursus quam. Eget pellentesque eu
                                                purus volutpat adipiscing malesuada. Purus nisi, tortor vel lacus. Donec
                                                diam molestie ultrices vitae eget pulvinar fames. Velit lacus mi purus velit
                                                justo, amet. Nascetur lobortis diam, duis orci.</p>
                                        </blockquote>
                                        <figcaption class="card-footer border-0 d-sm-flex d-md-none w-100 pb-2">
                                            <div class="d-flex align-items-center border-end-sm pe-sm-4 me-sm-2">
                                                <img src="/assets/img/avatar/06.jpg" width="48" class="rounded-circle"
                                                     alt="Annette Black">
                                                <div class="ps-3">
                                                    <h5 class="fw-semibold lh-base mb-0">Annette Black</h5>
                                                    <span class="fs-sm text-muted">Strategic Advisor</span>
                                                </div>
                                            </div>
                                            <img src="/assets/img/brands/02.svg" width="160"
                                                 class="d-block mt-2 ms-5 mt-sm-0 ms-sm-0" alt="Company logo">
                                        </figcaption>
                                    </figure>
                                </div>

                                <!-- Item -->
                                <div class="swiper-slide h-auto" data-swiper-tab="#author-3">
                                    <figure class="card h-100 position-relative border-0 bg-transparent">
                                        <blockquote class="card-body p-0 mb-0">
                                            <p class="fs-lg mb-0">Ac at sed sit senectus massa. Massa ante amet ultrices
                                                magna porta tempor. Aliquet diam in et magna ultricies mi at. Lectus enim,
                                                vel enim egestas nam pellentesque et leo. Elit mi faucibus laoreet aliquam
                                                pellentesque sed aliquet integer massa. Orci leo tortor ornare id mattis
                                                auctor aliquam volutpat aliquet. Odio lectus viverra eu blandit nunc
                                                malesuada vitae eleifend pulvinar. In ac fermentum sit in orci.</p>
                                        </blockquote>
                                        <figcaption class="card-footer border-0 d-sm-flex d-md-none w-100 pb-2">
                                            <div class="d-flex align-items-center border-end-sm pe-sm-4 me-sm-2">
                                                <img src="/assets/img/avatar/05.jpg" width="48" class="rounded-circle"
                                                     alt="Darrell Steward">
                                                <div class="ps-3">
                                                    <h5 class="fw-semibold lh-base mb-0">Darrell Steward</h5>
                                                    <span class="fs-sm text-muted">Project Manager</span>
                                                </div>
                                            </div>
                                            <img src="/assets/img/brands/04.svg" width="160"
                                                 class="d-block mt-2 ms-5 mt-sm-0 ms-sm-0" alt="Company logo">
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination (Pager) -->
                    <nav class="pagination d-flex justify-content-center justify-content-md-start">
                        <div class="page-item me-2">
                            <a class="page-link page-prev btn-icon btn-sm" href="#"
                               aria-label="Previous">
                                <i class="bx bx-chevron-left"></i>
                            </a>
                        </div>
                        <ul class="list-unstyled d-flex justify-content-center w-auto mb-0"></ul>
                        <div class="page-item ms-2">
                            <a class="page-link page-next btn-icon btn-sm" href="#"
                               aria-label="Next">
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="col-md-4 d-none d-md-block">

                    <!-- Swiper tabs (Author images) -->
                    <div class="swiper-tabs">

                        <!-- Author image 1 -->
                        <div id="author-1" class="card bg-transparent border-0 swiper-tab active">
                            <div class="card-body p-0 rounded-3 bg-size-cover bg-repeat-0 bg-position-top-center"
                                 style="background-image: url('assets/img/testimonials/01.jpg');"></div>
                            <div class="card-footer d-flex w-100 border-0 pb-0">
                                <img src="/assets/img/brands/01.svg" width="160" class="d-none d-xl-block"
                                     alt="Company logo">
                                <div class="border-start-xl ps-xl-4 ms-xl-2">
                                    <h5 class="fw-semibold lh-base mb-0">Ralph Edwards</h5>
                                    <span class="fs-sm text-muted">Head of Marketing <span class="d-xl-none d-inline">at Lorem Ltd.</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Author image 2 -->
                        <div id="author-2" class="card bg-transparent border-0 swiper-tab">
                            <div class="card-body p-0 rounded-3 bg-size-cover bg-repeat-0 bg-position-top-center"
                                 style="background-image: url('assets/img/testimonials/02.jpg');"></div>
                            <div class="card-footer d-flex w-100 border-0 pb-0">
                                <img src="/assets/img/brands/02.svg" width="160" class="d-none d-xl-block"
                                     alt="Company logo">
                                <div class="border-start-xl ps-xl-4 ms-xl-2">
                                    <h5 class="fw-semibold lh-base mb-0">Annette Black</h5>
                                    <span class="fs-sm text-muted">Strategic Advisor <span class="d-xl-none d-inline">at Company LLC</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Author image 3 -->
                        <div id="author-3" class="card bg-transparent border-0 swiper-tab">
                            <div class="card-body p-0 rounded-3 bg-size-cover bg-repeat-0 bg-position-top-center"
                                 style="background-image: url('assets/img/testimonials/03.jpg');"></div>
                            <div class="card-footer d-flex w-100 border-0 pb-0">
                                <img src="/assets/img/brands/04.svg" width="160" class="d-none d-xl-block"
                                     alt="Company logo">
                                <div class="border-start-xl ps-xl-4 ms-xl-2">
                                    <h5 class="fw-semibold lh-base mb-0">Darrell Steward</h5>
                                    <span class="fs-sm text-muted">Project Manager <span class="d-xl-none d-inline">at Ipsum Ltd.</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <!-- Hero -->
    <section class="bg-dark py-4" data-bs-theme="dark">
        <div class="container pb-2 py-lg-3">
            <h1 class="text-center mb-0">Simple, Transparent Pricing for You</h1>
        </div>
        <div style="height: 350px;"></div>
    </section>


    <!-- Pricing plans -->
    <section class="container position-relative zindex-2" style="margin-top: -300px;">
        <div class="price-switch-wrapper">
            <div class="pb-2 pb-lg-3" data-bs-theme="dark">

            </div>
            <div class="table-responsive-lg">
                <div class="d-flex align-items-center pb-4">
                    <!-- Pricing plan -->
                    <div class="border rounded-3 rounded-end-0 shadow-sm me-n1" style="width: 32%; min-width: 16rem;">
                        <div class="card bg-light h-100 border-0 border-end rounded-end-0 py-3 py-sm-4 py-lg-5">
                            <div class="card-body text-center">
                                <h3 class="mb-2">Below 50 Guests</h3>
                                <div class="fs-lg pb-4 mb-3">Best for trying out Plain Invite</div>
                                <div class="display-5 text-dark mb-1">Free</div>
                                <div class="text-muted mb-5">forever</div>
                            </div>
                            <div class="card-footer border-0 text-center pt-0 pb-4">
                                <a href="javascript:" class="btn btn-outline-primary btn-lg">Get started now</a>
                            </div>
                        </div>
                    </div>

                    <!-- Featurd pricing plan -->
                    <div class="bg-primary position-relative rounded-3 shadow-primary shadow-dark-mode-none zindex-2 p-4" style="width: 36%; min-width: 18rem;">
                        <div class="card bg-transparent border-light py-3 py-sm-4 py-lg-5">
                            <div class="card-body text-light text-center">
                                <h3 class="text-light mb-2">50 - 500 Guests</h3>
                                <div class="fs-lg opacity-70 pb-4 mb-3">Best for medium-sized events</div>
                                <div class="display-5 mb-1">N280,000</div>
                                <div class="opacity-50 mb-5">per event</div>
                            </div>
                            <div class="card-footer border-0 text-center pt-0 pb-4">
                                <a href="javascript:" class="btn btn-light btn-lg shadow-secondary">Get started now</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing plan -->
                    <div class="border rounded-3 rounded-start-0 shadow-sm" style="width: 32%; min-width: 16rem;">
                        <div class="card bg-light h-100 border-0 rounded-start-0 py-3 py-sm-4 py-lg-5">
                            <div class="card-body text-center">
                                <h3 class="mb-2">500 - 1000 Guests</h3>
                                <div class="fs-lg pb-4 mb-3">Best for large events</div>
                                <div class="display-5 text-dark mb-1">N480,000</div>
                                <div class="text-muted mb-5">per event</div>
                            </div>
                            <div class="card-footer border-0 text-center pt-0 pb-4">
                                <a href="javascript:" class="btn btn-outline-primary btn-lg">Get started now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog + Contact cta -->
    <div class="bg-secondary mb-5 pt-5">
        <!-- Contact CTA -->
        <section class="container pt-3 pb-4 pb-md-5"
                 style="margin-top: -156px; margin-bottom: 120px; transform: translateY(156px);">
            <div class="card border-0 bg-gradient-primary">
                <div class="card-body p-md-5 p-4 bg-size-cover"
                     style="background-image: url('assets/img/landing/digital-agency/contact-bg.png');">
                    <div class="py-md-5 py-4 text-center">
                        <h3 class="h4 fw-normal text-light opacity-75">Want to talk?</h3>
                        <a href="tel:2349068221380" class="display-6 text-light">+2349068221380</a>
                        <div class="pt-md-5 pt-4 pb-md-2">
                            <a href="mailto:hello@plaininvite.com" class="btn btn-lg btn-light">Email: hello@plaininvite.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>


<!-- Footer -->
<footer class="footer pt-5 pb-4 pb-lg-5 mt-2 mt-md-0">
    <div class="container pt-lg-4">
        <div class="row pb-5">
            <div class="col-lg-4 col-md-6">
                <div class="navbar-brand text-dark p-0 me-0 mb-3 mb-lg-4">
                    <img src="/assets/img/logo.png" width="47" alt="Silicon">
                    Plain Invite
                </div>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-5 offset-xl-2 offset-md-1 pt-4 pt-md-1 pt-lg-0">
                <div id="footer-links" class="row">
                    <div class="col-lg-4">
                        <h6 class="mb-2">
                            <a href="#useful-links"
                               class="d-block text-dark dropdown-toggle d-lg-none py-2" data-bs-toggle="collapse">Useful
                                Links</a>
                        </h6>
                        <div id="useful-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                            <ul class="nav flex-column pb-lg-1 mb-lg-3">
                                <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">Home</a></li>
                            </ul>
                            {{--<ul class="nav flex-column mb-2 mb-lg-0">
                                <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">Terms &amp;Conditions</a></li>
                                <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">Privacy Policy</a></li>
                            </ul>--}}
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3">
                        <h6 class="mb-2">
                            <a href="#social-links"
                               class="d-block text-dark dropdown-toggle d-lg-none py-2" data-bs-toggle="collapse">Socials</a>
                        </h6>
                        <div id="social-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                            <ul class="nav flex-column mb-2 mb-lg-0">
                                <li class="nav-item"><a href="#"
                                                        class="nav-link d-inline-block px-0 pt-1 pb-2">Facebook</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 pt-2 pt-lg-0">
                        <h6 class="mb-2">Contact Us</h6>
                        <a href="mailto:hello@plaininvite.com" class="fw-medium">hello@plaininvite.com</a>
                    </div>
                </div>
            </div>
        </div>
        <p class="nav d-block fs-xs text-center text-md-start pb-2 pb-lg-0 mb-0">
            &copy; All rights reserved. Plain Invite
        </p>
    </div>
</footer>


<!-- Back to top button -->
<a href="#top" class="btn-scroll-top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
    <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
</a>


<!-- Vendor Scripts -->
<script src="/assets/vendor/jarallax/dist/jarallax.min.js"></script>
<script src="/assets/vendor/@lottiefiles/lottie-player/dist/lottie-player.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/lightgallery/lightgallery.min.js"></script>
<script src="/assets/vendor/lightgallery/plugins/video/lg-video.min.js"></script>
<script src="/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/vendor/shufflejs/dist/shuffle.min.js"></script>

<!-- Main Theme Script -->
<script src="/assets/js/theme.min.js"></script>
</body>
</html>
