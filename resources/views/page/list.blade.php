<x-layouts.app class="">

    <x-slot name="header">
        <x-page.hero-content title="{{$title ?? 'Title'}}" desc="{{$description ?? 'Title'}}"/>

    </x-slot>

    <div class="p-0 mx-4 card card-body blur blur-rounded-lg shadow-blur mx-md-7 mt-n6 ">
        <section class="py-3 mx-4">
            <div class="container">
                <div class="row">
                    <div class="mx-auto mb-2 text-center col-12 col-lg-8">
                    <span class="mb-0 badge badge-info">Penting</span>
                    <h2> {{ $top->title ?? '-' }}</h2>
                    <p class="text-dark">
                        {{-- @dd($top->content[1]['data']['content']) --}}
                        {!! Str::limit($top->content[1]['data']['content'], 160) ?? '-' !!}
                    </p>
                    <a href="{{ route('post.detail', $top->slug ?? '') }}" class="mt-2 text-sm justify-content-end icon-move-right d-flex align-items-center">Baca
                        <i class="material-symbols-rounded ms-2">east</i>
                    </a>
                    </div>
                </div>
                <hr class="horizontal dark d-md-block d-none">
                <div class="row">
                    <div class="col-12 col-lg-10">
                        <livewire:list-post
                        :dataobject="collect($data)"
                        title="{{$title ?? ''}}"/>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="row">
                            <div class="col-auto mb-3 position-relative mb-sm-0">
                                @foreach ($category as $cat)
                                <div class="card card-plain">
                                    <div class="pt-0 card-body">
                                        <h6 class="mb-0 font-weight-bolder d-flex align-items-center">{{$cat->name ?? ''}}
                                        </h6>
                                        <span class="mt-0 mb-0 text-xs">{{$cat->description ?? ''}}</span>
                                    </div>
                                    <hr class="p-0 mt-0 horizontal dark d-md-block d-none">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr class="my-4 horizontal dark">

        <section class="py-4 my-2">
          <div class="container">
            <div class="row">
              <div class="text-center row justify-content-center my-sm-2">
                <div class="col-lg-6">
                  <span class="mb-3 badge bg-secondary">Terkait </span>
                  <h2 class="mb-0 text-dark" style="font-family: 'Wheaton', sans-serif; font-weight: 100;">Terkait Lainya </h2>
                  <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit.  </p>
                </div>
              </div>
            </div>
          <hr class="my-4 horizontal dark">
            <div class="container py-2">
                <div class="row">

                  <div class="col-lg-6 justify-content-center d-flex flex-column">
                    <div class="card">
                      <div class="d-block blur-shadow-image">
                        <img src="https://csirt.padang.go.id/storage/post-image/ghfG5aMIcAmz9xgO26DAXSwmPdnysN8U7Dm1lYYb.jpg" alt="img-blur-shadow-blog-2" class="img-fluid border-radius-lg" loading="lazy">
                      </div>
            </div>
                  </div>
                  <div class="pt-3 col-lg-6 justify-content-center d-flex flex-column pl-lg-5 pt-lg-0">
                    <h6 class="mt-3 category text-warning">Lorem</h6>
                    <h3 class="card-title">
                      <a href="" class="text-dark">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</a>
                    </h3>
                    <p class="card-description">
                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam nostrum inventore, excepturi itaque odit molestias perspiciatis mollitia rerum similique eum porro, hic ipsa ullam ut? Id inventore ex suscipit illo. …
                 <a href="" class="mt-2 text-sm text-darker icon-move-right d-flex align-items-center">Read More
                    <i class=" material-symbols-rounded ms-2">east</i>
                      </a>
                    </p>
                    <p class="author">
                      by
                      <a href="#" class="ms-1">
                        <span class="font-weight-bold text-warning">Lorem</span>
                    </a> Ipsum
                    </p>
                  </div>

                </div>
              </div>
            </div>
          <hr class="my-4 horizontal dark">
        </section>

    </div>

    {{-- <section class="wrapper bg-light">
        <div class="mx-auto text-center col-11 col-xl-10">
            <div class="card rounded-4 mt-n17">
                <div class="card-body">
                    <div data-cues="fadeIn" data-delay="500">
                        <h2 class="mb-1 text-center display-5"data-cues="fadeIn" data-delay="500">{{ $title }}
                        </h2>
                        <p class="mb-4 text-center px-md-16 px-lg-0 fs-sm">Documentation and Articel </p>
                    </div>
                </div>
            </div>
        </div>
        <livewire:list-post :data="$data" :title="$title"  >
    </section> --}}


</x-layouts.app>
