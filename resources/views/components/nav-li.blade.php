@props(['item' => ''])
<li class="mx-2 nav-item dropdown dropdown-hover">
    <a href="{{ route('show', $item->slug) }}" class="cursor-pointer justify-content-start nav-link d-flex align-items-center font-weight-semibold"
        @if ($item->children->isNotEmpty())id="dropdownMenuPages"
        data-bs-toggle="dropdown"
        aria-expanded="false"
         @endif>
        <i class="material-symbols-rounded opacity-6 me-1 text-md">{{ $item->icon }}</i>
        {{ $item->name }}
        <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}"
        alt="down-arrow"
        class="d-block d-lg-none arrow ms-auto ms-md-2">
    </a>
    @if ($item->children->isNotEmpty())
        <ul class="p-2 mt-0 border dropdown-menu blur border-1 dropdown-menu-animation dropdown-md dropdown-md-responsive border-radius-lg mt-lg-3"
        aria-labelledby="dropdownMenuPages">
        {{ $slot }}
        </ul>
    @endif
</li>
