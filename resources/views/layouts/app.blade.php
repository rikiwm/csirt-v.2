<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/cslogo.png') }}" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate">
    <title>CSIRT-PADANG</title>
    <link href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/material-kit.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.cdnfonts.com/css/pixies" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/mineplayer" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        width: 80%;
        }

    </style>

<body class="bg-white index-page"
        style="background-image: url('{{ asset('frontend/img/blue.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center top;">
    <div class="container top-0 position-sticky z-index-sticky">
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
                            <a href="/app/dashboard" class="p-1 mt-2 mb-0 rounded btn btn-facebook ms-1 btn-icon mt-md-0 ">
                            <div class="mx-2 text-white d-flex align-items-center">Dashboard
                            </div>
                            </a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                        <li class="my-auto nav-item ms-3 ms-lg-4">
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

    <!-- ========== Start hero  ========== -->
        @if(Request::url('/') == url('/'))
            <x-hero :name="$hero"/>
        @else
            {{ $header }}
        @endif
    <!-- ========== End hero  ========== -->

    <!-- ========== Start Section Content ========== -->
        {{ $slot}}
    <!-- ========== End Section Content ========== -->

    <!-- ========== Start footer ========== -->
        <x-footer :setting="$copyright" :address="$alamat" :footer="$footer" appname="{{ $appname ?? env('APP_NAME') }}"/>
    <!-- ========== End footer ========== -->
@livewireScripts()
    <x-script />
</body>
</html>
Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo porro, eveniet tempore doloribus temporibus nam veritatis perspiciatis ut veniam nemo, numquam, facilis recusandae cum natus neque modi libero! Recusandae, deserunt?
