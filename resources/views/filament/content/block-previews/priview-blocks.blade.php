
<x-layouts.app>
@props(['content' => ''])
<section class="px-0 mt-0 video-wrapper bg-overlay bg-overlay-gradient-2 min-vh-50">
    <video poster="{{ asset('frontend/img/bg/bg-dark-mod.jpg') }}" loading="lazy" class="rounded-4">
    </video>
    <div class="video-content">
        <div class="container text-center">
            <div class="row">
                <div class="mx-auto text-center text-white col-12 col-xl-12"data-cues="fadeIn" data-delay="500">
                    <h1 class="mb-3 text-white display-1 text-capitalize"><span class="">{{ $content->title ?? '' }}
                        </span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wrapper bg-light">
    <div class="mx-auto text-center col-11 col-xl-10">
        <div class="card rounded-4 mt-n17">
            <div class="card-body">
                <div data-cues="fadeIn" data-delay="500">
                    <h2 class="mb-1 text-center display-5"data-cues="fadeIn" data-delay="500">
                        {{ $content->title ?? '' }}
                    </h2>
                    <p class="mb-4 text-center px-md-16 px-lg-0 fs-sm">Pemerintah Kota Padang </p>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto col-12 col-xl-12">
        <div class="card rounded-4 mt-n6">
            {{-- <div class="card-header">
                {{ $title }}
            </div> --}}
            <div class="card-body pe-2 ps-2 pe-lg-5 ps-lg-5">
                {{-- @dd($content['content']) --}}
                @foreach ($content['content'] as $item)
                @if ($item['type'] === 'heading')
                    <x-content-heading :level="$item['data']['level'] ?? 'h2'" :title="$item['data']['title'] ?? ''" :uppercase="$item['data']['uppercase'] ?? false" />
                @elseif ($item['type'] === 'paragraph')
                    <x-content-paragraph :content="$item['data']['content'] ?? ''" />
                @elseif ($item['type'] === 'image')
                    <x-content-item :content="$item['data']['content'] ?? ''" />
                @endif
            @endforeach

                {{-- @foreach ($content['content'] as $item)
                    <h5 class="card-title">{{ $item['type'] ?? '' }}</h5>
                @endforeach
{!! $content !!}

                <h5 class="card-title">{{ $data->content[] ?? 'Data Null' }}</h5> --}}
            </div>
        </div>
    </div>
    </div>
</section>

</x-layouts.app>
