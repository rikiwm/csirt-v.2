@props([
    'data' => '',
    'category' => '',
    'author' => '',
    'updated' => '',
    'class' => 'text-center',
    'share' => '',
])

<section class="pt-3">
    <div class="container">
        <div class="row">
            <div class="py-2 mx-auto col-lg-10 mt-n2">
                <div class="row">
                    <div class=" col-md-12 position-relative">
                        @switch($data['slug'])
                            @case('faq')
                                   <div class="accordion" id="accordionRental">
                                        @foreach ($data['content'] as $key => $item)
                                            <div class="mb-3 accordion-item">
                                                @if ($item['type'] === 'heading')
                                                    <h5 class="accordion-header">
                                                        <button class="accordion-button border-bottom font-weight-bold"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne{{ $key }}"
                                                            aria-expanded="false" aria-controls="collapseOne">
                                                            {{ $item['data']['title'] ?? '' }}
                                                            <i
                                                                class="pt-1 text-xs collapse-open position-absolute end-0 material-symbols-rounded opacity-6 me-1 text-md">home</i>
                                                        </button>
                                                    </h5>
                                                @elseif ($item['type'] === 'paragraph')
                                                    <div id="collapseOne{{ $key - 1 }}" class="accordion-collapse collapse"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionRental">
                                                        <div class="text-sm accordion-body opacity-8">
                                                            {!! $item['data']['content'] ?? '' !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                            @break
                            @default
                             <div class="p-lg-2 text-dark ">
                                @foreach ($data['content'] as $item)
                                    @if ($item['type'] == 'heading')
                                        <x-content-heading class="" :level="$item['data']['level'] ?? 'h5'" :title="$item['data']['title'] ?? ''"
                                            :uppercase="$item['data']['uppercase'] ?? false" />
                                    @elseif ($item['type'] === 'paragraph')
                                        <x-content-paragraph :content="$item['data']['content'] ?? ''" />
                                    @elseif ($item['type'] === 'images')
                                        <x-content-img :content="$item['data']['image'] ?? ''" class="mb-4" />
                                    @endif
                                @endforeach
                                <span class="text-sm font-weight-normal font-italic">Published by
                                    {{ $author['name'] ?? '' }}</span>
                            </div>
                                <hr class="horizontal dark">
                                <p class="text-sm font-weight-normal">
                                <figcaption class="mt-3 text-end blockquote-footer">
                                    {{ $data['updated_at']->locale('id')->diffForHumans() }}
                                </figcaption>
                                </p>
                                <!-- ========== Start btn share ========== -->
                                {{ $share }}
                                <!-- ========== End btn share ========== -->
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <span class="mb-2 text-center badge text-dark bg-secondary">{{ $updated }}</span> --}}
