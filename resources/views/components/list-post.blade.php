@props(['data' => '', 'limit' => '', 'title' => null, 'class' => '','link' => null,'class' => 'col-lg-4 col-md-6'])

    <div class="mb-3 {{ $class }} position-relative mb-sm-0 ">
        <div class="bg-transparent card card-plain rounded-3 ">
        <div class="p-0 mt-3 position-relative z-index-1">
            <a href="{{ route('post.detail', $data->slug) }}" class="d-block img-thumbnail">
                <img src="https://csirt.jatimprov.go.id/storage/post-image/znAhGpik9hnBSLvDXVueTztfO5R6P0GUfsQXTYtu.jpg"
                     class="w-100 border-radius-lg" loading="lazy">
            </a>
        </div>
        </div>
        <div class="py-2 ms-lg-2">
        <h5 class="">
            <a href="{{ route('post.detail', $data->slug) }}" class="text-wrapped text-darker">
                {{ Str::limit($data->title ?? '', 88, preserveWords: true) }}
            </a>
        </h5>
        {{-- <p class="mb-1 text-sm text-dark">
            @foreach ($data['content'] as $item)
            @if ($item['type'] == 'paragraph')
            {!! Str::limit($item['data']['content'] ?? '', 48, preserveWords: true) !!}
            @endif
            @endforeach
        </p> --}}
        <span class="mb-1 badge bg-dark-subtle">{{$data->categori->name}}</span>
        <div class="author">
            <div class="my-auto name ps-1">
                <p class="mb-0 text-xs text-secondary">{{$data->created_at->diffForHumans()}}</p>
                {{-- <p class="mb-0 text-sm text-darker font-weight-bold">Jhon </p>
                <div class="stats">
                    <p class="mb-0 text-xs text-secondary">Anon</p>
                </div> --}}
            </div>
        </div>
        </div>
        <hr class="my-4 horizontal dark">
    </div>
{{-- @endif --}}
{{--
@if ($data->categori_id == 2)
    <div class="mb-3 col-lg-4 col-md-6 position-relative mb-sm-0">
        <hr class="vertical dark d-lg-block d-none">
        <div class="card card-plain">
            <div class="p-0 mt-3 bg-transparent card-header position-relative z-index-1">
                <a href="{{ route('post.detail', $data->slug) }}" class="d-block img-thumbnail">
                    <img src="https://csirt.jatimprov.go.id/storage/post-image/znAhGpik9hnBSLvDXVueTztfO5R6P0GUfsQXTYtu.jpg"
                         class="w-100 border-radius-lg" loading="lazy">
                </a>
            </div>
            <div class="pt-3 card-body">
                <h4 class="mb-3">
                    <a href="{{ route('post.detail', $data->slug) }}" class="text-darker font-weight-bolder">
                        {{ $data->title ?? '' }}
                    </a>
                </h4>
                <p class="mb-1 card-description">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    They haven't done the work to decide what they think. And that isn't a rewarding way to live.
                </p>
                <span class="mb-1 badge bg-dark-subtle">{{$data->categori->name}}</span>

           <div class="author">

                <div class="my-auto name ps-1">
                    <p class="mb-0 text-xs text-secondary">{{$data->created_at->diffForHumans()}}</p>
                </div>
            </div>
                <div class="author">
                    <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/freedom.jpg"
                         alt="..." class="shadow avatar border-radius-lg" loading="lazy">
                    <div class="my-auto name ps-3">
                        <p class="mb-0 text-sm text-darker font-weight-bold">Jhon Doe</p>
                        <div class="stats">
                            <p class="mb-0 text-xs text-secondary">Anon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4 horizontal dark">
    </div>
@endif
@if ($data->categori_id === 3)
    <div class="mb-3 col-lg-4 col-md-6 position-relative mb-sm-0">
        <hr class="vertical dark d-md-block d-none">
        <div class="card card-plain">
            <div class="p-0 mt-3 card-header mx-lg-3 position-relative z-index-1">
                <a href="#" class="d-block">
                </a>
            </div>
            <div class="pt-3 card-body">
                <h4 class="mb-1">
                    <a href="#" class="text-darker font-weight-bolder">
                        {{ $data->title ?? '' }}
                    </a>
                </h4>
                <span class="mb-1 badge bg-dark-subtle">{{$data->categori->name}}</span>
                <p class="mb-0 text-xs text-secondary">{{$data->created_at->diffForHumans()}}</p>
            </div>
        </div>
        <div class="card card-plain">
            <div class="p-0 card-header mx-lg-3 position-relative z-index-1">
                <a href="#" class="d-block">
                </a>
            </div>
        </div>
    </div>
@endif
 --}}
