<x-layouts.app class="">
    {{-- <header class="">
        <div class="relative mt-0 mb-0 page-header min-vh-95 ms-1 me-1 mt-lg-2 ms-lg-2 mb-lg-0 me-lg-1 rounded-4">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">

                <div class="carousel-item active ">
                  <div class="page-header min-vh-75" style="background-image: url('../../assets/img/bg10.jpg');" loading="lazy">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="container">
                      <div class="row">
                        <div class="my-auto col-lg-6">
                          <h4 class="mb-0 text-white fadeIn1 fadeInBottom">News and Articel</h4>
                          <h1 class="text-white font-weight-black fadeIn2 fadeInBottom">{{ $title }}</h1>
                          <p class="text-white lead opacity-8 fadeIn3 fadeInBottom">News and Articel</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mx-4 mb-4 shadow-lg card mt-n5">
                    <div class="card-body">
                      <div class="px-0 container-fluid">
                        <div class="row">
                          <div class="mb-4 col-lg-4 col-sm-6 mb-sm-0">
                            <div class="p-4 info-horizontal bg-gradient-dark border-radius-xl d-block d-md-flex ">
                              <i class="text-3xl text-white material-symbols-rounded">shuffle</i>
                              <div class="description ps-0 ps-md-3">
                                <h5 class="text-white">Netflix's 'Shuffle Play' feature</h5>
                                <p class="text-white pe-0 pe-lg-5">The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever.</p>
                                <a href="javascript:;" class="text-white icon-move-right">
                                  More about us
                                  <i class="text-sm fas fa-arrow-right ms-1"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-sm-6 px-lg-1">
                            <div class="p-4 info-horizontal border-radius-xl d-block d-md-flex ">
                              <i class="text-3xl material-symbols-rounded text-gradient text-primary">redeem</i>
                              <div class="description ps-0 ps-md-3">
                                <h5>Landbot closes $8M Series</h5>
                                <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever.</p>
                                <a href="javascript:;" class="text-primary icon-move-right">
                                  More about us
                                  <i class="text-sm fas fa-arrow-right ms-1"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="mt-4 col-lg-4 mt-lg-0">
                            <div class="p-4 info-horizontal border-radius-xl d-block d-md-flex ">
                              <i class="text-3xl material-symbols-rounded text-gradient text-primary">bookmarks</i>
                              <div class="description ps-0 ps-md-3">
                                <h5>Brave web browser</h5>
                                <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever.</p>
                                <a href="javascript:;" class="text-primary icon-move-right">
                                  More about us
                                  <i class="text-sm fas fa-arrow-right ms-1"></i>
                                </a>
                              <div id="extwaiokist" style="display:none" v="fcoon" q="eae39ea6" c="1459." i="1471" u="26.13" s="01192501" sg="svr_11212419-ga_01192501-bai_02052512" d="1" w="false" e="" a="2" m="BMe=" vn="3gtra"><div id="extwaigglbit" style="display:none" v="fcoon" q="eae39ea6" c="1459." i="1471" u="26.13" s="01192501" sg="svr_11212419-ga_01192501-bai_02052512" d="1" w="false" e="" a="2" m="BMe="></div></div></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>



              </div>

              <div class="top-0 min-vh-75 position-absolute w-100">
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </a>
              </div>

            </div>
        </div>
    </header> --}}
    {{-- @dd($category); --}}
    <x-slot name="header">
      <x-page.hero-page >
        <x-slot name="descpage">
            <x-page.hero-content title="{{$title ?? 'Title'}}" desc="{{$description ?? 'Title'}}"/>
        </x-slot>
      </x-page.hero-page>
    </x-slot>

    <div class="p-0 mx-4 card card-body blur blur-rounded-lg shadow-blur mx-md-7 mt-n8 ">
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
