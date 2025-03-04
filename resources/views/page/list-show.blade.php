<x-layouts.app class="">
    {{-- <section class="px-0 mt-0 video-wrapper bg-overlay bg-overlay-gradient-2 min-vh-50">
        <video poster="{{ asset('frontend/img/bg/bg-dark-mod.jpg') }}" loading="lazy" class="rounded-4">
        </video>
        <div class="video-content">
            <div class="container text-center">
                <div class="row">
                    <div class="mx-auto text-center text-white col-12 col-xl-12"data-cues="fadeIn" data-delay="500">
                        <h1 class="mb-3 text-white display-1 text-capitalize">
                            <span class="">{{ $title }}</span>

                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <header class="">
        <div class="mt-0 mb-0 page-header min-vh-55 ms-1 me-1 mt-lg-2 ms-lg-2 mb-lg-0 me-lg-1 rounded-4"
           style="background-image: url('https://static.vecteezy.com/system/resources/previews/019/954/786/non_2x/modern-cybersecurity-technology-background-with-world-globe-vector.jpg')">
             <span class="mask bg-gradient-dark-blue opacity-9"></span>
             <div class="container ">
               <div class="row justify-content-center">
                 <div class="mx-auto my-auto text-center col-lg-12 col-10">
                   <div class=" text-white display-4 font-weight-light ls-1" style="font-family: 'MinePlayer', sans-serif; font-weight: 100; letter-spacing: 0.1rem;">
                    {{$data->sub_title ?? ''}}
                   </div>
                 </div>
                 <div class="mx-auto my-auto text-center col-lg-7 col-11">
                   <p class="mb-2 text-white text-md">
                    {{$data->title ?? ''}}
                   </div>
               </div>
             </div>
           </div>
       </header>
       <div class="mx-4 mb-2 card card-body blur blur-rounded shadow-blur mx-md-6 mt-n8" style="z-index: 10;">
        <section class="pt-3">
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
        </section>
    </div>
</x-layouts.app>
