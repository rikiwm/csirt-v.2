<x-layouts.app class="">
    <x-slot name="header">
        <x-page.hero-page >
          <x-slot name="descpage">
              <x-page.hero-content name="{{$data->sub_title ?? ''}}" desc="{{$data->title ?? ''}}"/>
          </x-slot>
        </x-page.hero-page>
      </x-slot>

        <section>
            <div class="container">
                <div class=" row">
                    <div class="mx-auto col-md-8 col-10 text-dark">
                        <div class="mb-2 rounded-4 card blur blur-rounded shadow-blur mt-n6" style="z-index: 10;">
                            <div class="p-1 card card-plain">
                                <div class="py-3 py-md-4 card-body">
                                    <div class="gap-2 justify-content-center d-flex align-items-center">
                                        <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">Author</a></span>
                                        <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">Created</a></span>
                                        <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">share</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <div class="mx-4 mb-2 card card-body blur blur-rounded shadow-blur mx-md-6" style="z-index: 10;">
            <x-page.section-page :data="$data" title="Artikel Lainya" updated="{{ $data['updated_at'] }}" />
            {{-- <section class="pt-3">
            <div class="container">
                <div class="row">
                <div class="py-2 mx-auto col-lg-10 mt-n2">
                    <div class="row">
                    <div class="col-md-12 position-relative">
                        <div class="p-2 text-dark ">

                        <div class="card card-plain">
                            <div class="pt-0 card-body">
                                <h6 class="mb-0 font-weight-bolder d-flex align-items-center">
                                <hr class="p-0 mt-0 horizontal dark d-md-block d-none">
                            </h6>
                            <div>
                                @foreach ($data['content'] as $item)
                                @if ($item['type'] == 'heading')
                                    <x-content-heading class="" :level="$item['data']['level'] ?? 'h5'" :title="$item['data']['title'] ?? ''" :uppercase="$item['data']['uppercase'] ?? false" />
                                @elseif ($item['type'] === 'paragraph')
                                    <x-content-paragraph :content="$item['data']['content'] ?? ''" />
                                @elseif ($item['type'] === 'image')
                                    <x-content-item :content="$item['data']['content'] ?? ''" />
                                @endif
                            @endforeach
                            </div>
                            </div>
                        </div>

                        </div>
                        <hr class="horizontal dark">
                        <figcaption class="mt-3 text-end blockquote-footer">
                            {{ $data->created_at }}
                        </figcaption>
                    </div>

                    </div>
                </div>
                </div>
            </div>
            </section> --}}
         </div>
</x-layouts.app>
