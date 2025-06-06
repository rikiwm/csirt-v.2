@props(['data' => $data ?? '', 'category' => $category ?? '', 'author' => $author ?? '', 'updated' => $updated ?? '', 'class' => 'text-center', 'share' => ''])
<x-layouts.app class="">
    <x-slot name="header">
        <x-page.hero-content :category="$data['categori']" title="{{$data->sub_title ?? ''}}" desc="{{$data->title ?? ''}}"/>
    </x-slot>

        <div class="container">
            <div class=" row">
                <div class="mx-auto col-md-8 col-10 text-dark">
                    <div class="mb-2 rounded-4 card blur blur-rounded border-0 mt-n5" style="z-index: 10;">
                    <x-inc.breadcumb>
                        <x-slot name="slot">
                            <x-inc.breadcumb-li-a :link="$data['menu']['slug']" content="{{ Str::title($data['menu']['name']) }}"/>
                        </x-slot>
                    </x-inc.breadcumb>
                    </div>
                </div>
            </div>
        </div>


       <div class="mx-1 mb-2 card card-body blur blur-rounded shadow-blur border-0 mx-md-6" style="z-index: 10;">
            <x-page.section-page :data="$data" title="Artikel Lainya" :author="$data['user']" updated="{{ $data['updated_at'] }}">
                <x-slot name="share">
                    <div class="d-flex justify-content-end">
                        <div class="mt-1 btn-group caret-transparent dropup me-3 ">
                            <button type="button" class="rounded-md btn bg-gradient-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="">
                              Share to
                            </button>
                            <ul class="px-2 py-3 dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item border-radius-md" href="https://api.whatsapp.com/send?text={{ urlencode('Halo Admin, saya ingin bertanya tentang ' . $data['slug']) }}" target="_blank">
                                        <i class="bi bi-whatsapp opacity-8 me-1 text-md"></i>
                                        Whatsapp
                                    </a>
                                </li>
                                {{-- <li>
                                    <a class="dropdown-item border-radius-md" href="https://www.instagram.com/me" target="_blank">
                                        <i class="bi bi-instagram opacity-8 me-1 text-md"></i>
                                        Instagram
                                    </a>
                                </li> --}}
                                <li>
                                    <a class="dropdown-item border-radius-md" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="bi bi-facebook opacity-8 me-1 text-md"></i>
                                        Facebook
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="https://twitter.com/intent/tweet?text={{ urlencode('Cek ini: ' . url()->current()) }}" target="_blank">
                                        <i class="bi bi-twitter opacity-8 me-1 text-md"></i>
                                        Twitter
                                    </a>
                                </li>
                            </ul>

                        </div>

                       </div>
                </x-slot>
            </x-page.section-page>
        </div>
     @push('script')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiperThumbs = new Swiper(".swiper-thumbs", {
                spaceBetween: 10,
                slidesPerView: false,
                centeredSlides: true,
                freeMode: true,
                watchSlidesProgress: true,
            });
            var swiper = new Swiper(".mySwiper", {
                loop: true,
                effect: "fade",
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
                speed: 600,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                thumbs: {
                    swiper: swiperThumbs,
                }
            });
        </script>
     @endpush
</x-layouts.app>
