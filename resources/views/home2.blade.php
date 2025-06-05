@props(['section'=>''])
<x-layouts.app >
    <div class="p-0 mx-4 card card-body blur blur-rounded-lg shadow-blur mx-md-7 mt-n7" style="z-index: 10;">
        <x-section-component :section="$section" class="text-center" >
            <x-slot name="content" >
                @if ($section['value'][1]['data']['model-view'] == 'berita')
                    <span class="p-0 m-0">
                        Model view : {{  $section['value'][1]['data']['section-view'] ?? null }}
                    </span>
                    {{-- description --}}
                @elseif($section['value'][1]['data']['model-view'] == 'peringatan')
                    <code>
                        Model view : {{  $section['value'][1]['data']['model-view'] ?? null }}
                    </code>
                    {{-- description --}}
                    <div class="row">
                        <div class="col-12 col-lg-10">
                            loop data by section // todo list
                        </div>
                    </div>
                @else
                    <code>
                        Model view : {{  $section['value'][1]['data']['model-view'] ?? null }}
                    </code>
                      {{-- description --}}
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
                @endif

            </x-slot>
        </x-section-component>

        <!-- ========== Start Section2 ========== -->
        <x-section-component :section="$section2" class="text-start" >
            <x-slot name="content" >

                <div class="row align-items-center">
                    <div class="mt-0 col-lg-6 ms-auto me-auto p-lg-4 mt-lg-0">
                      <div class="rotating-card-container ">
                        <div class="mt-5 card card-rotate card-background card-background-mask-dark shadow-blur mt-md-0">
                          <div class="p-1 front front-background ">
                          <div class="py-4 text-center card-body text-dark">
                              <i class="my-3 text-4xl text-black material-symbols-rounded">touch_app</i>
                              <h3 class="text-black" >{{  $section2['value'][2]['data']['content'] ?? null }}</h3>
                              <p class="text-black opacity-8">
                                {{  $section2['value'][2]['data']['sub_content'] ?? null }}
                              </p>
                              <svg xmlns="http://www.w3.org/2000/svg" class="rounded-3"><defs><pattern id="a" width="50" height="50" patternTransform="scale(3)" patternUnits="userSpaceOnUse"><rect width="100%" height="100%" fill="#fff" fill-opacity="0"/><path fill="#4051b5" d="M0 3a22 22 0 1 0 22 22c0-1.15-.17-2.24-.34-3.33-.36-.06-.74-.05-1.1-.12-.32-.07-.62-.21-.94-.29.23 1.21.38 2.46.38 3.74A20 20 0 1 1 0 5.01c1.28 0 2.53.15 3.74.37-.08-.32-.23-.62-.3-.95-.06-.35-.04-.74-.1-1.1C2.24 3.17 1.15 3 0 3m50 0a22 22 0 0 0-22 22c0 1.15.17 2.24.34 3.33.36.06.74.05 1.1.12.32.07.62.21.94.29A20 20 0 0 1 30 25 20 20 0 0 1 50 5.01 20 20 0 1 1 50 45a20 20 0 0 1-3.74-.38c.08.33.23.62.3.95.06.35.04.73.1 1.1 1.1.16 2.2.33 3.34.33a22 22 0 1 0 0-44M0 7a18 18 0 1 0 18 18c0-1.54-.25-3.01-.61-4.43-.31-.12-.65-.17-.95-.3-.52-.22-.98-.54-1.48-.8A15.9 15.9 0 0 1 16 25 16 16 0 1 1 0 9c1.95 0 3.8.4 5.53 1.04-.26-.5-.58-.95-.8-1.48-.13-.3-.18-.64-.3-.94A18 18 0 0 0 0 7m50 0a18 18 0 0 0-18 18c0 1.54.25 3.01.61 4.43.32.12.66.17.96.3.52.22.97.54 1.47.8A15.9 15.9 0 0 1 34 25a16 16 0 1 1 16 16c-1.95 0-3.8-.4-5.53-1.04.26.5.58.95.8 1.48.13.3.18.64.3.95 1.41.36 2.88.61 4.43.61a18 18 0 0 0 0-36M0 11a14 14 0 1 0 14 14 13.9 13.9 0 0 0-2.23-7.52c-.8-.61-1.61-1.21-2.32-1.93-.72-.7-1.32-1.52-1.93-2.33A13.9 13.9 0 0 0 0 11m50 0a14 14 0 0 0-14 14 13.9 13.9 0 0 0 2.23 7.52c.8.61 1.62 1.21 2.33 1.92s1.31 1.53 1.92 2.33A13.9 13.9 0 0 0 50 39a14 14 0 0 0 0-28M0 13.03A11.94 11.94 0 0 1 12 25a12 12 0 0 1-24 0A12 12 0 0 1 0 13.03m50 0A11.94 11.94 0 0 1 62 25a12 12 0 0 1-24 0 12 12 0 0 1 12-11.97M0 15a10 10 0 1 0 0 20 10 10 0 0 0 0-20m50 0a10 10 0 1 0 0 20 10 10 0 0 0 0-20M0 17a8 8 0 1 1 0 16 8 8 0 0 1 0-16m50 0a8 8 0 1 1 0 16 8 8 0 0 1 0-16M0 19a6 6 0 1 0 0 12 6 6 0 0 0 0-12m50 0a6 6 0 1 0 0 12 6 6 0 0 0 0-12M0 21a4 4 0 1 1 0 8 4 4 0 0 1 0-8m50 0a4 4 0 1 1 0 8 4 4 0 0 1 0-8"/><path fill="#4051b5" fill-opacity=".55" d="M25-22a22 22 0 1 0 0 44c1.15 0 2.24-.17 3.33-.34.06-.36.05-.74.12-1.1.07-.32.21-.62.29-.94-1.21.23-2.46.38-3.74.38A20 20 0 1 1 45 0c0 1.28-.15 2.52-.38 3.74.33-.08.62-.23.95-.3.35-.06.73-.04 1.1-.1.16-1.1.33-2.19.33-3.34a22 22 0 0 0-22-22m0 4a18 18 0 1 0 0 36c1.54 0 3.01-.25 4.43-.61.12-.31.17-.65.3-.95.22-.52.54-.98.8-1.48A15.9 15.9 0 0 1 25 16 16 16 0 1 1 41 0c0 1.95-.4 3.8-1.04 5.53.5-.26.95-.58 1.48-.8.3-.13.64-.18.95-.3.36-1.41.61-2.88.61-4.43a18 18 0 0 0-18-18m0 4a14 14 0 0 0 0 28 13.9 13.9 0 0 0 7.52-2.23c.61-.8 1.21-1.61 1.92-2.32.71-.72 1.53-1.32 2.33-1.93A13.9 13.9 0 0 0 39 0a14 14 0 0 0-14-14m0 2.03A11.94 11.94 0 0 1 37 0a12 12 0 0 1-24 0 12 12 0 0 1 12-11.97M25-10a10 10 0 1 0 0 20 10 10 0 0 0 0-20m0 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16m0 2a6 6 0 1 0 0 12 6 6 0 0 0 0-12m0 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8m0 32c-1.15 0-2.24.17-3.33.34-.06.36-.05.74-.12 1.1-.07.33-.21.63-.3.95 1.22-.23 2.46-.38 3.75-.38A20 20 0 1 1 5 50c0-1.28.15-2.52.38-3.74-.33.08-.62.23-.95.3-.35.06-.73.04-1.1.1C3.17 47.77 3 48.85 3 50a22 22 0 1 0 22-22m0 4c-1.54 0-3.01.26-4.43.63-.12.3-.17.63-.3.93-.22.52-.54.98-.8 1.48A15.9 15.9 0 0 1 25 34 16 16 0 1 1 9 50c0-1.95.4-3.8 1.04-5.53-.5.26-.95.58-1.48.8-.3.13-.64.18-.95.3A17.8 17.8 0 0 0 7 50a18 18 0 1 0 18-18m0 4a13.9 13.9 0 0 0-7.52 2.23c-.61.8-1.21 1.62-1.93 2.33-.7.71-1.52 1.31-2.33 1.92A13.9 13.9 0 0 0 11 50a14 14 0 1 0 14-14m0 2.03A11.94 11.94 0 0 1 37 50a12 12 0 0 1-24 0 12 12 0 0 1 12-11.97M25 40a10 10 0 1 0 0 20 10 10 0 0 0 0-20m0 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16m0 2a6 6 0 1 0 0 12 6 6 0 0 0 0-12m0 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8"/></pattern></defs><rect width="800%" height="800%" fill="url(#a)"/></svg>
                          </div>

                          </div>
                          <div class="p-1 back back-background border-radius-xl"
                          style=" background-image: url('{{ asset('frontend/img/bg-dark-prim.png') }} ">
                            <div class="text-center card-body pt-7">
                              <h3 class="text-dark">
                                {{  $section2['value'][0]['data']['sub_content'] ?? null }}
                              </h3>
                              <p class="text-dark opacity-8">
                                {{  $section2['value'][1]['data']['content'] ?? null }}
                                </p>
                              <a href="/faq" target="_blank"
                                class="mx-auto mt-3 btn btn-white btn-sm w-50">Selengkapnya</a>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="mt-0 col-lg-6 ms-auto me-auto p-lg-4 mt-lg-0">
                      <div class="rotating-card-container ">
                        <div class="mt-5 card card-rotate card-background card-background-mask-dark shadow-blur mt-md-0">
                          <div class="p-1 front front-background ">
                              <div class="py-4 text-center card-body text-dark">
                              <svg xmlns="http://www.w3.org/2000/svg" class="rounded-3"><defs><pattern id="a" width="50" height="50" patternTransform="scale(3)" patternUnits="userSpaceOnUse"><rect width="100%" height="100%" fill="#fff" fill-opacity="0"/><path fill="#4051b5" d="M0 3a22 22 0 1 0 22 22c0-1.15-.17-2.24-.34-3.33-.36-.06-.74-.05-1.1-.12-.32-.07-.62-.21-.94-.29.23 1.21.38 2.46.38 3.74A20 20 0 1 1 0 5.01c1.28 0 2.53.15 3.74.37-.08-.32-.23-.62-.3-.95-.06-.35-.04-.74-.1-1.1C2.24 3.17 1.15 3 0 3m50 0a22 22 0 0 0-22 22c0 1.15.17 2.24.34 3.33.36.06.74.05 1.1.12.32.07.62.21.94.29A20 20 0 0 1 30 25 20 20 0 0 1 50 5.01 20 20 0 1 1 50 45a20 20 0 0 1-3.74-.38c.08.33.23.62.3.95.06.35.04.73.1 1.1 1.1.16 2.2.33 3.34.33a22 22 0 1 0 0-44M0 7a18 18 0 1 0 18 18c0-1.54-.25-3.01-.61-4.43-.31-.12-.65-.17-.95-.3-.52-.22-.98-.54-1.48-.8A15.9 15.9 0 0 1 16 25 16 16 0 1 1 0 9c1.95 0 3.8.4 5.53 1.04-.26-.5-.58-.95-.8-1.48-.13-.3-.18-.64-.3-.94A18 18 0 0 0 0 7m50 0a18 18 0 0 0-18 18c0 1.54.25 3.01.61 4.43.32.12.66.17.96.3.52.22.97.54 1.47.8A15.9 15.9 0 0 1 34 25a16 16 0 1 1 16 16c-1.95 0-3.8-.4-5.53-1.04.26.5.58.95.8 1.48.13.3.18.64.3.95 1.41.36 2.88.61 4.43.61a18 18 0 0 0 0-36M0 11a14 14 0 1 0 14 14 13.9 13.9 0 0 0-2.23-7.52c-.8-.61-1.61-1.21-2.32-1.93-.72-.7-1.32-1.52-1.93-2.33A13.9 13.9 0 0 0 0 11m50 0a14 14 0 0 0-14 14 13.9 13.9 0 0 0 2.23 7.52c.8.61 1.62 1.21 2.33 1.92s1.31 1.53 1.92 2.33A13.9 13.9 0 0 0 50 39a14 14 0 0 0 0-28M0 13.03A11.94 11.94 0 0 1 12 25a12 12 0 0 1-24 0A12 12 0 0 1 0 13.03m50 0A11.94 11.94 0 0 1 62 25a12 12 0 0 1-24 0 12 12 0 0 1 12-11.97M0 15a10 10 0 1 0 0 20 10 10 0 0 0 0-20m50 0a10 10 0 1 0 0 20 10 10 0 0 0 0-20M0 17a8 8 0 1 1 0 16 8 8 0 0 1 0-16m50 0a8 8 0 1 1 0 16 8 8 0 0 1 0-16M0 19a6 6 0 1 0 0 12 6 6 0 0 0 0-12m50 0a6 6 0 1 0 0 12 6 6 0 0 0 0-12M0 21a4 4 0 1 1 0 8 4 4 0 0 1 0-8m50 0a4 4 0 1 1 0 8 4 4 0 0 1 0-8"/><path fill="#4051b5" fill-opacity=".55" d="M25-22a22 22 0 1 0 0 44c1.15 0 2.24-.17 3.33-.34.06-.36.05-.74.12-1.1.07-.32.21-.62.29-.94-1.21.23-2.46.38-3.74.38A20 20 0 1 1 45 0c0 1.28-.15 2.52-.38 3.74.33-.08.62-.23.95-.3.35-.06.73-.04 1.1-.1.16-1.1.33-2.19.33-3.34a22 22 0 0 0-22-22m0 4a18 18 0 1 0 0 36c1.54 0 3.01-.25 4.43-.61.12-.31.17-.65.3-.95.22-.52.54-.98.8-1.48A15.9 15.9 0 0 1 25 16 16 16 0 1 1 41 0c0 1.95-.4 3.8-1.04 5.53.5-.26.95-.58 1.48-.8.3-.13.64-.18.95-.3.36-1.41.61-2.88.61-4.43a18 18 0 0 0-18-18m0 4a14 14 0 0 0 0 28 13.9 13.9 0 0 0 7.52-2.23c.61-.8 1.21-1.61 1.92-2.32.71-.72 1.53-1.32 2.33-1.93A13.9 13.9 0 0 0 39 0a14 14 0 0 0-14-14m0 2.03A11.94 11.94 0 0 1 37 0a12 12 0 0 1-24 0 12 12 0 0 1 12-11.97M25-10a10 10 0 1 0 0 20 10 10 0 0 0 0-20m0 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16m0 2a6 6 0 1 0 0 12 6 6 0 0 0 0-12m0 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8m0 32c-1.15 0-2.24.17-3.33.34-.06.36-.05.74-.12 1.1-.07.33-.21.63-.3.95 1.22-.23 2.46-.38 3.75-.38A20 20 0 1 1 5 50c0-1.28.15-2.52.38-3.74-.33.08-.62.23-.95.3-.35.06-.73.04-1.1.1C3.17 47.77 3 48.85 3 50a22 22 0 1 0 22-22m0 4c-1.54 0-3.01.26-4.43.63-.12.3-.17.63-.3.93-.22.52-.54.98-.8 1.48A15.9 15.9 0 0 1 25 34 16 16 0 1 1 9 50c0-1.95.4-3.8 1.04-5.53-.5.26-.95.58-1.48.8-.3.13-.64.18-.95.3A17.8 17.8 0 0 0 7 50a18 18 0 1 0 18-18m0 4a13.9 13.9 0 0 0-7.52 2.23c-.61.8-1.21 1.62-1.93 2.33-.7.71-1.52 1.31-2.33 1.92A13.9 13.9 0 0 0 11 50a14 14 0 1 0 14-14m0 2.03A11.94 11.94 0 0 1 37 50a12 12 0 0 1-24 0 12 12 0 0 1 12-11.97M25 40a10 10 0 1 0 0 20 10 10 0 0 0 0-20m0 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16m0 2a6 6 0 1 0 0 12 6 6 0 0 0 0-12m0 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8"/></pattern></defs><rect width="800%" height="800%" fill="url(#a)"/></svg>
                              <i class="my-3 text-4xl text-black material-symbols-rounded">touch_app</i>
                              <h3 class="text-black" >{{  $section2['value'][3]['data']['content'] ?? null }}</h3>
                              <p class="text-black opacity-8">{{  $section2['value'][2]['data']['sub_content'] ?? null }}</p>
                            </div>
                          </div>
                          <div class="p-1 back back-background border-radius-xl"
                          style="background-image: url('{{ asset('frontend/img/pat') }}');">
                            <div class="text-center card-body pt-7">
                              <h3 class="text-dark">Discover Morasdase</h3>
                              <p class="text-dark opacity-8"> {{  $section2['value'][4]['data']['content'] ?? null }}</p>
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

                <div class="container mt-sm-5">
                    <div class="py-6 mb-3 page-header py-md-5 my-sm-3 border-radius-xl"
                          style="background-image: url('https://tse2.mm.bing.net/th?id=OIP.iGVTzCGaM9pQnDxlP2u-HwHaEB&pid=Api&P=0&h=180');"
                          loading="lazy">
                          <span class="mask bg-gradient-dark opacity-3"></span>
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-6 ms-lg-5">
                                <h4 class="text-white">Cyberblitz</h4>
                                <h1 class="text-white">Cyberblitz</h1>
                                <p class="text-white lead opacity-6">Cyberblitz</p>
                                <a href="#"
                                  class="text-white icon-move-right">
                                  Read Cyberblitz
                                  <i class="text-sm fas fa-arrow-right ms-1"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>

            </x-slot>
        </x-section-component>
        <!-- ========== End Section3 ========== -->

      </div>
</x-layouts.app>
