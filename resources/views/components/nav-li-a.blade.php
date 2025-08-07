@props(['child' => ''])
<div class="d-none d-lg-block">
    <li class="nav-item dropdown dropdown-hover dropdown-subitem">
        <a class="py-1 dropdown-item ps-1 border-radius-md" href="{{ route('show', $child->slug) }}" wire:navigate>
            <div class="w-100 d-flex align-items-center justify-content-between">
                <h6
                    class="py-2 dropdown-header text-dark font-weight-semibold d-flex justify-content-cente align-items-center">
                    {{ $child->name }}</h6>
            </div>
        </a>
    </li>
</div>
<div class="d-lg-none">
    <a href="{{ route('show', $child->slug) }}"
        class="dropdown-item border-radius-md text-dark font-weight-semibold d-flex" wire:navigate>
        <span>{{ $child->name }}</span>
    </a>
</div>
