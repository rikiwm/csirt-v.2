@props(['section'=>''])

<x-layouts.app >
    <div class="container-fluid">

         <div class="col-12 col-lg-9  mx-auto">
                <div class="card bg-transparent shadow-none  border-0">
                <section class="image-container mt-n1 mt-lg-n10 mx-n5"id="zoomImage">
                    <div class="card card-body blur blur-rounded p-0 p-lg-1">
                        <img src="{{ asset('frontend/img/abg.png') }}" alt="Nature Image" class="bg-cover border-radius-xl"loading="lazy">
                        {{-- <img src="https://media.slidesgo.com/storage/162549/responsive-images/24-cybersecurity-infographics___media_library_original_1600_900.png" alt="Nature Image" class="border-radius-xl p-1"loading="lazy"> --}}
                    </div>
                </section>
                </div>
        </div>
        </div>
    <div class="container-fluid">
        <x-section-component :section="$section" class="text-center" >
            <x-slot name="content" >
              @isset($section['value'][1])
                {{-- @if (!$section['value'][1]['data']['model-view'] == 'berita' && $section['value'][1]['data']['model-view'] == 'peringatan')
                    <div class="row">
                        <div class="col-md-3 position-relative">
                        <div class="p-3 text-center ">
                            <h1 class="text-gradient text-dark"><span id="state1" countTo="0">0</span></h1>
                            <h5 class="mt-3">Scammpage</h5>
                            <p class="text-sm font-weight-normal">website
                            </p>
                        </div>
                        <hr class="horizontal dark">

                        <hr class="vertical dark">
                        </div>
                        <div class="col-md-3 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-dark"><span id="state2" countTo="0">0</span></h1>
                            <h5 class="mt-3">Phising</h5>
                            <p class="text-sm font-weight-normal">website
                            </p>
                        </div>
                        <hr class="horizontal dark">

                        <hr class="vertical dark">
                        </div>
                        <div class="col-md-3 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-dark"><span id="state3" countTo="0">0</span></h1>
                            <h5 class="mt-3">Phising</h5>
                            <p class="text-sm font-weight-normal">
                            website</p>
                        </div>
                        <hr class="horizontal dark">
                        <hr class="vertical dark">

                        </div>
                        <div class="col-md-3">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-dark"><span id="state4" countTo="0">0</span></h1>
                            <h5 class="mt-3">Phising</h5>
                            <p class="text-sm font-weight-normal">
                            website</p>
                        </div>
                        <hr class="horizontal dark">
                        <hr class="vertical dark">
                        </div>
                    </div>
                @endif --}}
              @endisset
            </x-slot>
        </x-section-component>

        <!-- ========== Start Section2 ========== -->
        <x-section-component :section="$section2" class="text-start" >
            <x-slot name="content">
                <div class="row align-items-center">
                          <div class="col-lg-6 ms-auto me-auto p-lg-4 mt-lg-0">
                      <div class="rotating-card-container ">
                        <div class="mt-5 card card-rotate card-background card-background-mask-dark  mt-md-0">
                          <div class="p-1 front front-background ">
                              <div class="py-4 text-center card-body text-dark">
                              <div class="bg-info-subtle shadow-none border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-center">
                              <h3 class="text-secondary" >{{  $section2['value'][2]['data']['content'] ?? null }}</h3>
                            </div>
                              <p class="text-secondary opacity-8 mt-2">{{  $section2['value'][2]['data']['sub_content'] ?? null }}</p>
                            </div>
                          </div>
                          <div class="p-1 back back-background border-radius-xl">
                            <div class="text-center card-body pt-7">
                              <h3 class="text-dark">{{  $section2['value'][2]['data']['sub_content'] ?? null }}</h3>
                              <p class="text-dark opacity-8"> {{  $section2['value'][2]['data']['content'] ?? null }}</p>
                              <a href="/faq" target="_blank"
                                class="mx-auto mt-3 btn btn-white btn-sm w-50">Selengkapnya</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 ms-auto me-auto p-lg-4 mt-lg-0">
                      <div class="rotating-card-container ">
                        <div class="mt-5 card card-rotate card-background card-background-mask-dark  mt-md-0">
                          <div class="p-1 front front-background ">
                              <div class="py-4 text-center card-body text-dark">
                              <div class="bg-info-subtle shadow-none border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-center">
                              <h3 class="text-secondary" >{{  $section2['value'][2]['data']['content'] ?? null }}</h3>
                            </div>
                              <p class="text-secondary opacity-8 mt-2">{{  $section2['value'][2]['data']['sub_content'] ?? null }}</p>
                            </div>
                          </div>
                          <div class="p-1 back back-background border-radius-xl">
                            <div class="text-center card-body pt-7">
                              <h3 class="text-dark">{{  $section2['value'][2]['data']['sub_content'] ?? null }}</h3>
                              <p class="text-dark opacity-8"> {{  $section2['value'][2]['data']['content'] ?? null }}</p>
                              <a href="/faq" target="_blank"
                                class="mx-auto mt-3 btn btn-white btn-sm w-50">Selengkapnya</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </x-slot>
        </x-section-component>
        <!-- ========== End Section2 ========== -->

        <!-- ========== Start Section3 ========== -->
        <x-section-component :section="$section3" class="text-end" >
            <x-slot name="content" >
                  <div class="py-4 mb-3 page-header py-md-5 my-sm-3 border-radius-xl ">
                        <span class="mask bg-gradient-faded-info  opacity-4"></span>
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-6 ms-lg-5 ">
                                <a href=" {{ $section3['value'][1]['data']['keys'] ?? null }}" target="_blank" >
                                <h4 class="text-white">{{  $section2['value'][1]['data']['content'] ?? null }}</h4>
                                <h1 class="text-white">Cyberblitz</h1>
                                <p class="text-white lead opacity-6">Cyberblitz</p>
                                <a href="#"
                                  class="text-white icon-move-right">
                                  Read Cyberblitz
                                  <i class="text-sm fas fa-arrow-right ms-1"></i>
                                </a>
                                </a>
                              </div>
                            </div>
                          </div>
                    </div>
            </x-slot>
        </x-section-component>
        <!-- ========== End Section3 ========== -->
        </div
    @push('js')


    @endpush
</x-layouts.app>
