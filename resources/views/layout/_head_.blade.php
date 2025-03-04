@dd($item)
<ul class="navbar-nav content" :item="{{ $item }}">
    @forelse ($navbar as $item)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-light fs-14 ls-1 text-capitalize"
                href="{{ route('show', $item->slug) }}">
                {{ $item->name }}
            </a>
            @if ($item->children->isNotEmpty())
            <ul class="dropdown-menu">
                @foreach ($item->children as $child)
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('show', $child->slug) }}">{{ $child->name }}</a>
                </li>

                {{-- @if($child->pages->isNotEmpty())
                @foreach ($child->pages as $pages)
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('show', $pages->slug) }}">{{ $pages->title }}</a>
                </li>
                @endforeach
                @endif --}}

                @endforeach
            </ul>
            @endif
        </li>
    @empty
    @endforelse
</ul>
