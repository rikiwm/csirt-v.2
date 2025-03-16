@props(['content' => ''])
<div class="mx-auto mb-4 text-center px-lg-4 justify-content-center">
    <div class="rounded swiper mySwiper">
        <div class="swiper-wrapper">
            @forelse ($content as $img)
            <div class="swiper-slide"><img class="" loading="lazy" src="{{url('storage/' . $img ?? '') }}" alt=""></div>
            @empty
            @endforelse
        </div>
        @if (count($content) > 1)
        {{-- <div class=" swiper-pagination"></div> --}}
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        @endif
    </div>
    @if (count($content) > 1)
    <div class="swiper swiper-thumbs">
        <div class="swiper-wrapper d-flex justify-content-center">
            @forelse ($content as $img)
            <div class="swiper-slide"><img class="" loading="lazy" src="{{url('storage/' . $img ?? '') }}" alt=""></div>
            @empty
            @endforelse
        </div>
    </div>
    @endif
</div>
