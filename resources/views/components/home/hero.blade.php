@props(['name' => '', 'content' => '', 'bg' => 'frontend/img/bg4.mp4',])
     <x-home.hero-bg :background="$bg"/>
        <div class="container ">
            <div class="row justify-content-center">
            <div class="mx-auto my-auto text-center col-lg-12 col-10">
                <h1 class="pt-0 text-white display-1 font-weight-light ls-1 text-capitalize" style="font-family: 'MinePlayer', sans-serif; font-weight: 100; font-size: clamp(4rem, 2.2143rem + 5.7143vw, 6.5rem);">
                    {{  $name['value'][0]['data']['desc'] ?? 'CSIRT-PAdang' }}
                </h1>
            </div>
            <div class="mx-auto my-auto text-center col-lg-7 col-11">
                <span class="text-white text-uppercase display-6" id="typed"></span>
                <div class="bounce">
                <i class="text-white material-symbols-rounded ms-2" aria-hidden="true"> swipe_down</i>
                </div>
                <div id="typed-strings">
                <h1>EDUKASI</h1>
                <h1 >INFORMASI</h1>
                </div>
                <p class="mt-2 text-white text-md">
                    {{  $name['value'][1]['data']['desc'] ?? null }}
                </p>
                <div class="mx-auto my-auto mb-2 text-center col-lg-7 col-11">
                <a class="btn btn-sm btn-white rounded-xl me-2 text-capitalize" href="{{url($name['value'][2]['data']['content'] ?? '#')}}">{{ $name['value'][2]['data']['keys'] ?? null }} Ticket</a>
                <a class="btn btn-sm btn-outline-white rounded-xl text-capitalize" href="{{url($name['value'][3]['data']['content'] ?? "#")}}">{{ $name['value'][3]['data']['content'] ?? null }}</a>
            </div>
            </div>
            </div>
        </div>
