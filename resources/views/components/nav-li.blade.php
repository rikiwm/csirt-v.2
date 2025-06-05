@props(['item' => '', 'child' => ''])
@php
    $item = $item ?? '';
    $child = $child ?? '';
    if ($item->children->isEmpty() && $child) {
        $item = $child;
    }
    $item->icon = $item->icon ?? 'home';
@endphp
<li class="mx-2 nav-item dropdown dropdown-hover">
    <a @if ($item->children->isNotEmpty()) @else  href="{{ route('show', $item->slug) }}" wire:navigate @endif class="cursor-pointer justify-content-start nav-link d-flex align-items-center font-weight-semibold"
        @if ($item->children->isNotEmpty())id="dropdownMenuPages"
        data-bs-toggle="dropdown"
        aria-expanded="false"
         @endif>
        <i class="material-symbols-rounded opacity-6 me-3 me-lg-1 text-md">{{ $item->icon }}</i>
        {{ $item->name }}

        {{-- <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}"
        alt="down-arrow" loading="lazy"
        class="d-block d-lg-none arrow ms-auto ms-md-2"> --}}

    </a>
    @if ($item->children->isNotEmpty())
      <img src="{{ asset('frontend/img/down-arrow-dark.svg') }}"
        alt="down-arrow" loading="lazy"
        class="d-block d-lg-none arrow ms-auto mt-n4 mb-4">
        <ul class="p-2 mt-0  dropdown-menu blur   dropdown-md dropdown-sm-responsive border-radius-lg mt-lg-4 bg-transparent max-height-200 overflow-hidden"
        aria-labelledby="dropdownMenuPages">
        {{ $slot }}
        </ul>
    @endif
</li>
