<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/icons8-laravel-16.png') }}" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate">
    <title>CSIRT-PADANG</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- Icons -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link href="https://fonts.cdnfonts.com/css/wheaton" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/neckless-starways" rel="stylesheet">
    {{-- <link href="https://fonts.cdnfonts.com/css/tmbg-severe-tire-damage" rel="stylesheet"> --}}
    <link href="{{ asset('frontend/css/material-kit.css') }}" rel="stylesheet" />

</head>
<style>
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(-30px);
      }
      60% {
        transform: translateY(-15px);
      }
    }
    .bounce {
      display: inline-block;
      animation: bounce 2.2s infinite;
    }
  </style>
<style>
    .navbar {
      width: 100%;
      margin: auto;
      transition-property: width;
      transition-duration: .5s ;
    }
    .navbar.shrink  {
      right: 0;
      left: 0;
       width: 75%;
    }
  </style>
<body class="bg-white index-page" style=" background-image: url('{{ asset('frontend/img/blue.png') }}'); background-size: contain;">
    <!-- Navbar -->
    <div class="container top-0 position-sticky z-index-sticky">
      <div class="row">
        <div class="col-12">
            <nav
            class="top-0 p-2 mx-auto my-2 shadow p-lg-0 navbar navbar-expand-lg blur navbar-blur border-radius-lg z-index-fixed position-absolute my-lg-4 start-0 end-0">
            <div class="px-2 container-fluid">
                <a class="text-sm navbar-brand font-weight-bolder" href="index.HTML" rel="tooltip"
                title="Designed and Coded by Creative Tim" data-placement="bottom"><div class="d-flex align-items-center text-dark">
                  <i class="material-symbols-rounded me-1" aria-hidden="true">shield_with_house</i>
                  PADANG-<abbr class="text-dark-50">CSIRT</abbr>

                </div>
              </a>

              <button class="p-2 pt-0 pb-0 border-0 shadow-none navbar-toggler ms-2" type="button"
                data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="mt-2 navbar-toggler-icon">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse py-lg-0 w-100" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                  <li class="mx-2 nav-item dropdown dropdown-hover">
                    <a class="cursor-pointer nav-link ps-2 d-flex align-items-center font-weight-semibold"
                      id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="material-symbols-rounded opacity-6 me-2 text-md">dashboard</i>
                      Pages
                      <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-auto ms-md-2">
                    </a>
                    <div class="p-3 mt-0 dropdown-menu dropdown-menu-animation ms-n3 dropdown-md border-radius-xl mt-lg-3"
                      aria-labelledby="dropdownMenuPages">
                      <div class="d-none d-lg-block">
                        <h6 class="px-1 dropdown-header text-dark font-weight-bolder d-flex align-items-center">
                          Landing Pages
                        </h6>
                        <a href="./pages/about-us.html" class="dropdown-item border-radius-xl">
                          <span>About Us</span>
                        </a>
                        <a href="./pages/contact-us.html" class="dropdown-item border-radius-xl">
                          <span>Contact Us</span>
                        </a>
                        <a href="./pages/author.html" class="dropdown-item border-radius-xl">
                          <span>Author</span>
                        </a>
                        <h6 class="px-1 mt-3 dropdown-header text-dark font-weight-bolder d-flex align-items-center">
                          Account
                        </h6>
                        <a href="./pages/sign-in.html" class="dropdown-item border-radius-xl">
                          <span>Sign In</span>
                        </a>
                      </div>

                      <div class="d-lg-none">
                        <h6 class="px-1 dropdown-header text-dark font-weight-bolder d-flex align-items-center">
                          Landing Pages
                        </h6>

                        <a href="./pages/about-us.html" class="dropdown-item border-radius-xl">
                          <span>About Us</span>
                        </a>
                        <a href="./pages/contact-us.html" class="dropdown-item border-radius-xl">
                          <span>Contact Us</span>
                        </a>
                        <a href="./pages/author.html" class="dropdown-item border-radius-xl">
                          <span>Author</span>
                        </a>

                        <h6 class="px-1 mt-3 dropdown-header text-dark font-weight-bolder d-flex align-items-center">
                          Account
                        </h6>
                        <a href="./pages/sign-in.html" class="dropdown-item border-radius-xl">
                          <span>Sign In</span>
                        </a>

                      </div>

                    </div>
                  </li>

                  <li class="mx-2 nav-item dropdown dropdown-hover">
                    <a class="cursor-pointer nav-link ps-2 d-flex align-items-center font-weight-semibold"
                      id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="material-symbols-rounded opacity-6 me-2 text-md">view_day</i>
                      Sections
                      <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-auto ms-md-2">
                    </a>
                    <ul
                      class="p-3 mt-0 dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive border-radius-lg mt-lg-3"
                      aria-labelledby="dropdownMenuBlocks">
                      <div class="d-none d-lg-block">
                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Page Sections</h6>
                                <span class="text-sm">See all sections</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/page-sections/hero-sections.html">
                              Page Headers
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/page-sections/features.html">
                              Features
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Navigation</h6>
                                <span class="text-sm">See all navigations</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/navigation/navbars.html">
                              Navbars
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/navigation/nav-tabs.html">
                              Nav Tabs
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/navigation/pagination.html">
                              Pagination
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Input Areas</h6>
                                <span class="text-sm">See all input areas</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/inputs.html">
                              Inputs
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/forms.html">
                              Forms
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Attention Catchers</h6>
                                <span class="text-sm">See all examples</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/attention-catchers/alerts.html">
                              Alerts
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/attention-catchers/modals.html">
                              Modals
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/attention-catchers/tooltips-popovers.html">
                              Tooltips & Popovers
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Elements</h6>
                                <span class="text-sm">See all elements</span>
                              </div>

                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/avatars.html">
                              Avatars
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/badges.html">
                              Badges
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/elements/breadcrumbs.html">
                              Breadcrumbs
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/buttons.html">
                              Buttons
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/dropdowns.html">
                              Dropdowns
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/elements/progress-bars.html">
                              Progress Bars
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/toggles.html">
                              Toggles
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/elements/typography.html">
                              Typography
                            </a>
                          </div>
                        </li>
                      </div>

                      <div class="row d-lg-none">
                        <div class="col-md-12">
                          <div class="mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-single-copy-04 text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Page Sections</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/page-sections/hero-sections.html">
                            Page Headers
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/page-sections/features.html">
                            Features
                          </a>

                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-laptop text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Navigation</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/navigation/navbars.html">
                            Navbars
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/navigation/nav-tabs.html">
                            Nav Tabs
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/navigation/pagination.html">
                            Pagination
                          </a>


                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-badge text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Input Areas</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/inputs.html">
                            Inputs
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/forms.html">
                            Forms
                          </a>


                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-notification-70 text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Attention Catchers</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/attention-catchers/alerts.html">
                            Alerts
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/attention-catchers/modals.html">
                            Modals
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/attention-catchers/tooltips-popovers.html">
                            Tooltips & Popovers
                          </a>


                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-app text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Elements</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/avatars.html">
                            Avatars
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/badges.html">
                            Badges
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/breadcrumbs.html">
                            Breadcrumbs
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/buttons.html">
                            Buttons
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/dropdowns.html">
                            Dropdowns
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/elements/progress-bars.html">
                            Progress Bars
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/toggles.html">
                            Toggles
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/typography.html">
                            Typography
                          </a>
                        </div>
                      </div>

                    </ul>
                  </li>
                  <li class="mx-2 nav-item dropdown dropdown-hover">
                    <a class="cursor-pointer nav-link ps-2 d-flex align-items-center font-weight-semibold"
                      id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="material-symbols-rounded opacity-6 me-2 text-md">view_day</i>
                      Sections
                      <!-- <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-auto ms-md-2"> -->
                    </a>
                    <ul
                      class="p-3 mt-0 dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive border-radius-lg mt-lg-3"
                      aria-labelledby="dropdownMenuBlocks">
                      <div class="d-none d-lg-block">

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Page Sections</h6>
                                <span class="text-sm">See all sections</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/page-sections/hero-sections.html">
                              Page Headers
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/page-sections/features.html">
                              Features
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Navigation</h6>
                                <span class="text-sm">See all navigations</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/navigation/navbars.html">
                              Navbars
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/navigation/nav-tabs.html">
                              Nav Tabs
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/navigation/pagination.html">
                              Pagination
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Input Areas</h6>
                                <span class="text-sm">See all input areas</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/inputs.html">
                              Inputs
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/forms.html">
                              Forms
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Attention Catchers</h6>
                                <span class="text-sm">See all examples</span>
                              </div>
                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/attention-catchers/alerts.html">
                              Alerts
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/attention-catchers/modals.html">
                              Modals
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/attention-catchers/tooltips-popovers.html">
                              Tooltips & Popovers
                            </a>
                          </div>
                        </li>

                        <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./presentation.html">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Elements</h6>
                                <span class="text-sm">See all elements</span>
                              </div>

                              <img src="{{ asset('frontend/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
                            </div>
                          </a>
                          <div class="px-2 py-3 mt-0 mt-3 dropdown-menu">
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/avatars.html">
                              Avatars
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/badges.html">
                              Badges
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/elements/breadcrumbs.html">
                              Breadcrumbs
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/buttons.html">
                              Buttons
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/dropdowns.html">
                              Dropdowns
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/elements/progress-bars.html">
                              Progress Bars
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/toggles.html">
                              Toggles
                            </a>
                            <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                              href="./sections/elements/typography.html">
                              Typography
                            </a>
                          </div>
                        </li>
                      </div>

                      <div class="row d-lg-none">
                        <div class="col-md-12">
                          <div class="mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-single-copy-04 text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Page Sections</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/page-sections/hero-sections.html">
                            Page Headers
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/page-sections/features.html">
                            Features
                          </a>

                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-laptop text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Navigation</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/navigation/navbars.html">
                            Navbars
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/navigation/nav-tabs.html">
                            Nav Tabs
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/navigation/pagination.html">
                            Pagination
                          </a>


                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-badge text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Input Areas</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/inputs.html">
                            Inputs
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/input-areas/forms.html">
                            Forms
                          </a>


                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-notification-70 text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Attention Catchers</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/attention-catchers/alerts.html">
                            Alerts
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/attention-catchers/modals.html">
                            Modals
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/attention-catchers/tooltips-popovers.html">
                            Tooltips & Popovers
                          </a>


                          <div class="mt-3 mb-2 d-flex">
                            <div class="h-10 mt-1 icon me-3 d-flex">
                              <i class="ni ni-app text-gradient text-primary"></i>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-between">
                              <div>
                                <h6
                                  class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                  Elements</h6>
                              </div>
                            </div>
                          </div>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/avatars.html">
                            Avatars
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/badges.html">
                            Badges
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/breadcrumbs.html">
                            Breadcrumbs
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/buttons.html">
                            Buttons
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/dropdowns.html">
                            Dropdowns
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl"
                            href="./sections/elements/progress-bars.html">
                            Progress Bars
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/toggles.html">
                            Toggles
                          </a>
                          <a class="mb-1 dropdown-item ps-3 border-radius-xl" href="./sections/elements/typography.html">
                            Typography
                          </a>
                        </div>
                      </div>

                    </ul>
                  </li>

                  <li class="mx-2 nav-item dropdown dropdown-hover">
                    <a class="cursor-pointer nav-link ps-2 d-flex align-items-center font-weight-semibold"
                      id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="material-symbols-rounded opacity-6 me-2 text-md">article</i>
                      Docs
                      <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}" alt="down-arrow"
                        class="d-block d-lg-none arrow ms-auto ms-md-2">
                    </a>
                    <ul
                      class="p-3 mt-0 dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive mt-lg-3 border-radius-lg"
                      aria-labelledby="dropdownMenuDocs">
                      <div class="d-none d-lg-block">
                        <ul class="list-group">
                          <li class="p-0 border-0 nav-item list-group-item">
                            <a class="py-2 dropdown-item ps-3 border-radius-xl"
                              href=" https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit ">
                              <h6
                                class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                Getting Started</h6>
                              <span class="text-sm">All about overview, quick start, license and contents</span>
                            </a>
                          </li>
                          <li class="p-0 border-0 nav-item list-group-item">
                            <a class="py-2 dropdown-item ps-3 border-radius-xl"
                              href=" https://www.creative-tim.com/learning-lab/bootstrap/colors/material-kit ">
                              <h6
                                class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                Foundation</h6>
                              <span class="text-sm">See our colors, icons and typography</span>
                            </a>
                          </li>
                          <li class="p-0 border-0 nav-item list-group-item">
                            <a class="py-2 dropdown-item ps-3 border-radius-xl"
                              href=" https://www.creative-tim.com/learning-lab/bootstrap/alerts/material-kit ">
                              <h6
                                class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                Components</h6>
                              <span class="text-sm">Explore our collection of fully designed components</span>
                            </a>
                          </li>
                          <li class="p-0 border-0 nav-item list-group-item">
                            <a class="py-2 dropdown-item ps-3 border-radius-xl"
                              href=" https://www.creative-tim.com/learning-lab/bootstrap/datepicker/material-kit ">
                              <h6
                                class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                Plugins</h6>
                              <span class="text-sm">Check how you can integrate our plugins</span>
                            </a>
                          </li>
                          <li class="p-0 border-0 nav-item list-group-item">
                            <a class="py-2 dropdown-item ps-3 border-radius-xl"
                              href=" https://www.creative-tim.com/learning-lab/bootstrap/utilities/material-kit ">
                              <h6
                                class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                                Utility Classes</h6>
                              <span class="text-sm">For those who want flexibility, use our utility classes</span>
                            </a>
                          </li>
                        </ul>
                      </div>

                      <div class="row d-lg-none">
                        <div class="col-md-12 g-0">
                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./pages/about-us.html">
                            <h6
                              class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                              Getting Started</h6>
                            <span class="text-sm">All about overview, quick start, license and contents</span>
                          </a>

                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./pages/about-us.html">
                            <h6
                              class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                              Foundation</h6>
                            <span class="text-sm">See our colors, icons and typography</span>
                          </a>

                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./pages/about-us.html">
                            <h6
                              class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                              Components</h6>
                            <span class="text-sm">Explore our collection of fully designed components</span>
                          </a>

                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./pages/about-us.html">
                            <h6
                              class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                              Plugins</h6>
                            <span class="text-sm">Check how you can integrate our plugins</span>
                          </a>

                          <a class="py-2 dropdown-item ps-3 border-radius-xl" href="./pages/about-us.html">
                            <h6
                              class="p-0 dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center">
                              Utility Classes</h6>
                            <span class="text-sm">For those who want flexibility, use our utility classes</span>
                          </a>
                        </div>
                      </div>

                    </ul>
                  </li>

                  <li class="nav-item ms-lg-auto">
                    <a class="nav-link nav-link-icon me-2" href="https://github.com/creativetimofficial/material-kit"
                      target="_blank">
                      <i class="fa fa-github me-1"></i>
                      <p class="text-sm d-inline z-index-1 font-weight-semibold" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Star us on Github">Github</p>
                    </a>
                  </li>

                </ul>
                <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                    <li class="my-auto nav-item ms-3 ms-lg-4">
                        <a href="/app/login" class="p-1 mt-2 mb-0 btn btn-outline-dark-blue rounded-3 ms-0 btn-icon mt-md-0">
                          <div class="d-flex align-items-center text-dark">
                            <i class="material-symbols-rounded" aria-hidden="true"> login</i>
                          </div>
                        </a>

                      </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
      </div>
    </div>
        {{ $slot }}
<x-script />
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    window.addEventListener("scroll", function () {
      let navbar = document.querySelector(".navbar");
      if (window.scrollY > 100) {
          navbar.classList.add("shrink");
      } else {
          navbar.classList.remove("shrink");
      }
  });
  </script>
</body>
</html>
