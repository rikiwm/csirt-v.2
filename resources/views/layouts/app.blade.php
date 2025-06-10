<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- PWA  -->
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">
    <meta name="theme-color" content="#4CAF50">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <link rel="apple-touch-icon" href="{{ asset('frontend/img/cslogo.png') }}">

    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/cslogo.png') }}" /> --}}
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate">
    <title>CSIRT-PADANG</title>
    <link preload href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link preload href="{{ asset('frontend/css/material-kit.css') }}" rel="stylesheet" />
    <link preload rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link preload rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link preload href="https://fonts.cdnfonts.com/css/pixies" rel="stylesheet">
    <link preload href="https://fonts.cdnfonts.com/css/mineplayer" rel="stylesheet">
    <link preload rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link preload rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @livewireStyles
    <script src="//unpkg.com/alpinejs" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        width: 86%;
        }

    </style>
    <style>
        .swiper {
            width: 100%;
            max-width: 1200px;
            height: auto;
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .swiper-pagination-bullet {
            background-color: white;
            width: 10px;
            height: 10px;
        }
        .swiper-button-next, .swiper-button-prev {
            width: 30px;
            height: 30px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%; /* Bulat */
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 14px;
            color: white;
        }
        .swiper-thumbs {
            max-width: 1200px;
            margin-top: 10px;
        }
        .swiper-thumbs .swiper-slide {
            width: 50px; /* Ukuran thumbnail */
            height: auto;
            opacity: 0.5;
            transition: opacity 0.3s;
            cursor: pointer;
        }
        .swiper-thumbs .swiper-slide-thumb-active {
            opacity: 1; /* Highlight thumbnail aktif */
            border: 2px solid #007bff;
            border-radius: 5px;
        }
    </style>

<body class="bg-white index-page"
        style="background-image: url('{{ asset('frontend/img/blue.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center top;">
    <div class="container-xl top-0 position-sticky z-index-sticky">
        <div class="row">
          <div class="col-12">
            <x-navbar>
                <x-slot name="content">
                    <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                        @forelse ($navbar as $item)
                        <x-nav-li :item="$item">
                            @foreach ($item->children as $child)
                            <x-nav-li-a :child="$child" />
                            @endforeach
                        </x-nav-li>
                        @empty
                        @endforelse
                    </ul>
                    @if (auth()->check())
                    <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                        <li class="my-auto nav-item ms-3 ms-lg-4">
                            <a href="/app" class="p-1 mt-2 mb-0 rounded btn btn-facebook ms-1 btn-icon mt-md-0 ">
                            <div class="mx-2 text-white d-flex align-items-center">Dashboard
                            </div>
                            </a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                        <li class="my-auto nav-item ms-lg-4 arrow ms-auto ">
                            <a href="/app/login" class="p-1 mt-2 mb-0 rounded btn btn-facebook ms-1 btn-icon mt-md-0 ">
                            <div class="mx-2 text-white d-flex align-items-center">Login
                            </div>
                            </a>
                        </li>
                    </ul>
                    @endif
                </x-slot>
            </x-navbar>
            <!-- End Navbar -->
          </div>
        </div>
    </div>
    @php
        $route = Request::url('/') == url('/') ? 'home' : 'page';
    @endphp
    <!-- ========== Start hero  ========== -->
    <header class="">
    @switch($route)
        @case('home')
        <div class="relative mt-0 mb-0 page-header min-vh-90  ms-1 me-1 mt-lg-2 ms-lg-2 mb-lg-0 me-lg-1 rounded-4" >
            <x-home.hero :name="$hero"/>
        </div>
        @break
        @default
            <div class="relative mt-0 mb-0 page-header min-vh-35 ms-1 me-1 mt-lg-2 ms-lg-2 mb-lg-0 me-lg-1 rounded-4" style="background-image: url('https://csirt.padang.go.id/storage/image-property/mzvRlMVfbLiChlEzB1g9WIYZTEeuURXj5nI7iM9W.jpg')">
          <span class="mask bg-gradient-faded-dark-blue opacity-6"></span>
            {{ $header ?? '' }}
            </div>
            @endswitch
    </header>
        {{-- @if(Request::url('/') == url('/'))
            <x-home.hero :name="$hero"/>
        @else

        @endif --}}
    <!-- ========== End hero  ========== -->

    <!-- ========== Start Section Content ========== -->
        {{ $slot}}
    <!-- ========== End Section Content ========== -->

    <!-- ========== Start footer ========== -->
        <x-footer :setting="$copyright" :address="$alamat" :footer="$footer" :visitor="$visitor ?? null" appname="{{ $appname ?? env('APP_NAME') }}"/>
    <!-- ========== End footer ========== -->

        <x-script />
    @stack('script')

    @livewireScripts

<script type="module" defer>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("{{ asset('frontend/serviceworker.js') }}")
            .then(function(registration) {
                console.log("Service Worker registered with scope:", registration.scope);
            })
            .catch(function(error) {
                console.log("Service Worker registration failed:", error);
            });
    }
</script>



</body>
</html>
{{-- Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo porro, eveniet tempore doloribus temporibus nam veritatis perspiciatis ut veniam nemo, numquam, facilis recusandae cum natus neque modi libero! Recusandae, deserunt? --}}
