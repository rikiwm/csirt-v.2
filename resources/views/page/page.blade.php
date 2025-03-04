<x-layouts.app>
    <header class="">
     <div class="mt-0 mb-0 page-header min-vh-55 ms-1 me-1 mt-lg-2 ms-lg-2 mb-lg-0 me-lg-1 rounded-4 "
        style="background-image: url('https://csirt.padang.go.id/storage/image-property/mzvRlMVfbLiChlEzB1g9WIYZTEeuURXj5nI7iM9W.jpg')">
        {{-- style="background-image: url('https://static.vecteezy.com/system/resources/previews/019/954/786/non_2x/modern-cybersecurity-technology-background-with-world-globe-vector.jpg')"> --}}
          <span class="mask bg-gradient-faded-dark-blue opacity-6"></span>
          <div class="container ">
            <div class="row justify-content-center">
              <div class="mx-auto my-auto text-center col-lg-12 col-10"
              data-aos="fade-zoom-in"
              data-aos-easing="ease-in-back"
              data-aos-delay="50"
              data-aos-offset="0">
                <div class="text-white display-4 font-weight-light ls-1" style="font-family: 'MinePlayer', sans-serif; font-weight: 100; letter-spacing: 0.1rem;">
                    {{ $category->name }}
                </div>
              </div>
              <div class="mx-auto my-auto text-center col-lg-7 col-11"
              data-aos="fade-zoom-in"
              data-aos-easing="ease-in-back"
              data-aos-delay="50"
              data-aos-offset="0">
                <p class="mt-3 text-white text-md">
                    {{ $category->description }}
                </div>
            </div>
          </div>
        </div>
    </header>

    <div class="mx-4 mb-2 card card-body blur blur-rounded shadow-blur mx-md-7 mt-n8 "style="z-index: 10;">
        <section class="pt-3">
          <div class="container">
            <div class="row">
                {{-- <div class="col-12">
                    <div class="card blur blur-rounded opacity-2 " >
                        <div class="py-4 ">
                        </div>
                        <div class="pt-4 card-footer">
                        </div>
                    </div>
                </div> --}}
              <div class="py-2 mx-auto col-lg-10 mt-n2"
              data-aos="fade-zoom-in"
              data-aos-easing="ease-in-back"
              data-aos-delay="50"
              data-aos-offset="0"
              >
                <div class="row">
                  <div class="col-md-12 position-relative">
                    <div class="p-2 text-dark ">
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
                    <hr class="horizontal dark">
                    <p class="text-sm font-weight-normal">
                        <figcaption class="mt-3 text-end blockquote-footer">
                            {{ $data['created_at'] }}
                          </figcaption>

                      </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
    </div>


    <div class="mx-4 card card-body blur blur-rounded shadow-blur mx-md-7 " style="z-index: 10;">
        <section class="py-5 mx-4">
            <div class="container">
              <div class="row">
                <div class="mx-auto mb-5 text-center col-8">
                  <span class="mb-2 badge text-dark badge-secondary">Terkait Lainya</span>
                  <h2 style="font-family: 'Wheaton', sans-serif; font-weight: 100;">Artikel Terkait</h2>

                  {{-- <p>
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta quidem dolor, blanditiis aperiam dolore aliquam, accusamus rerum magnam deserunt libero sapiente perferendis facere laborum ut nemo voluptas ex pariatur eveniet?
                  </p> --}}
                </div>
              </div>
            </div>
        </section>
    </div>

</x-layouts.app>
