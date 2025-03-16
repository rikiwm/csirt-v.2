@props(['data' => '', 'limit' => '', 'title' => null, 'class' => '','link' => null,'class' => 'col-lg-4 col-md-6'])

    <div class="mb-3 {{ $class }} position-relative mb-sm-0 ">
        <div class="bg-transparent card card-plain rounded-3 ">
        <div class="p-0 mt-3 position-relative z-index-1">
            @php
            $image = $data->content[1]['data']['image'] ?? [];
            @endphp
            <a href="{{ route('post.detail', $data->slug) }}" class="d-block img-thumbnail">
                @forelse ($image as $img)
                <img src="{{ url('storage/' . $img ?? '') }}"
                class="w-100 border-radius-lg" loading="lazy">
                @break
                @empty
                <img src="https://csirt.jatimprov.go.id/storage/post-image/znAhGpik9hnBSLvDXVueTztfO5R6P0GUfsQXTYtu.jpg"
                class="w-100 border-radius-lg" loading="lazy">
                @endforelse

            </a>
        </div>
        </div>
        <div class="py-2 ms-lg-2">
        <h5 class="">
            <a href="{{ route('post.detail', $data->slug) }}" class="text-wrapped text-darker">
                {{ Str::limit($data->title ?? '', 88, preserveWords: true) }}
            </a>
        </h5>
        <span class="mb-1 badge bg-dark-subtle">{{$data->categori->name}}</span>
        <div class="author">
            <div class="my-auto name ps-1">
                <p class="mb-0 text-xs text-secondary">{{$data->created_at->diffForHumans()}}</p>
            </div>
        </div>
        </div>
        <hr class="my-4 horizontal dark">
    </div>
