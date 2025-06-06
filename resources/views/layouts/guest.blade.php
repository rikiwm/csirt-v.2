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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.cdnfonts.com/css/wheaton" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/neckless-starways" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white index-page" style=" background-image: url('{{ asset('frontend/img/blue.png') }}'); background-size: contain;">
    <div class="container top-0 position-sticky z-index-sticky">
      <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <x-navbar>
                <x-slot name="content">
                    <ul class="navbar-nav navbar-nav-hover ms-auto justify-content-center">
                        @forelse ($nav as $item)
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
        {{ $slot }}
    @include('components.script', ['csp_nonce' => $csp_nonce])
</body>
</html>
