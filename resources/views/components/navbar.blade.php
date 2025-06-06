@props(['item' => 'p'])

<nav
    class="top-0 px-2 mx-auto my-0 shadow p-1 p-lg-0 navbar navbar-expand-lg blur navbar-blur border-radius-lg z-index-fixed position-absolute my-lg-4 start-0 end-0">
    <div class="px-2 container-fluid">
        <a class="text-sm navbar-brand font-weight-bolder" href="/" rel="tooltip"
            title="Designed and Coded by Creative Tim" data-placement="bottom">
            <div class="d-flex align-items-center text-dark">
                <img class="w-8 img-fluid d-none d-lg-block" src="{{ asset('frontend/img/cslogo.png') }}" alt="web-logo"
                    loading="lazy">
                {{-- <i class="material-symbols-rounded me-1" aria-hidden="true">shield_with_house</i> --}}
                PADANG-
                <abbr class="text-dark-50">CSIRT</abbr>
            </div>
        </a>
        <button class="p-2 pt-0 pb-0 border-0 shadow-none navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" wire:ignore.self
            aria-label="Toggle navigation">
            <span class="mt-2 navbar-toggler-icon">
                <span class="navbar-toggler-bar bar1 text-bg-info"></span>
                <span class="navbar-toggler-bar bar2 text-bg-info"></span>
                <span class="navbar-toggler-bar bar3 text-bg-info"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse py-3 py-lg-0 w-100" id="navigation" wire:ignore.self>
            {{ $content }}
        </div>
    </div>
</nav>
