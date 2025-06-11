@props([
    'section' => $section ?? '',
    'data' => '',
    'link' => $link ?? null,
    'class' => 'text-center',
])
{{-- @dd($section) --}}
<div>
    <section class="pt-3 pb-4 pt-lg-4">
        <div class="container-fluid">
            <div class="row">
                <div class="py-3 mx-auto col-lg-11 ">
                    <!-- ========== Start title ========== -->
                    <x-section-title class="{{ $class }} text-dark-blue opacity-8"
                        style="font-family: 'Pixies', sans-serif; letter-spacing: 0rem; font-size: clamp(1rem, -0.4286rem + 4.5714vw, 2.5rem);">
                        <x-slot name="title">
                            {{ $section['value'][0]['data']['content'] ?? null }} <br>
                        </x-slot>
                    </x-section-title>
                    <!-- ========== End title ========== -->

                    <!-- ========== Start subtitle ========== -->
                    <x-section-sub-title class="{{ $class }} text-lg opacity-5">
                        <x-slot name="subtitle">
                            {{ $section['value'][0]['data']['sub_content'] ?? null }}
                        </x-slot>
                    </x-section-sub-title>
                    <!-- ========== End subtitle ========== -->
                    <hr class=" horizontal dark" style="height: 3px">
                </div>

                <!-- ========== Start isicontent ========== -->
                <div class="py-1 mx-auto col-lg-12 mt-n3">
                    {{ $content }}
                    @isset($section['key'])
                       @switch($section['key'])
                           @case('section-2')
                             <div class="text-center row justify-content-center my-sm-2">
                                <div class="col-lg-6">
                                    <span class="mb-3 badge bg-dark-blue">You made it possible.</span>
                                    <p class="lead">Thank you to everyone for your support!.</p>
                                </div>
                            </div>
                               @break
                           @case('section-3')
                            <div class="text-center row justify-content-center my-sm-2">
                                <div class="col-lg-6">
                                    <span class="mb-3 badge bg-dark-blue">We Open Bug Hunt</span>
                                    <p class="lead">By ourselves we are nothing, as a team, we can do anything.</p>
                                </div>
                            </div>
                               @break
                           @default
                           <div class="py-1 mx-auto col-lg-8">
                            @includeWhen($section['value'][1]['data']['model-view'] === 'berita','components.list-post',['data' => $data, 'class' => 'col-lg-10 mx-auto', 'link' => $link])
                           </div>
                                @if ($section['value'][1]['data']['model-view'] == 'berita')
                                    <div class="mx-auto row">
                                        <div class="py-3 text-center col-12">
                                            <x-a-href class="btn btn-facebook btn-sm text-capitalize" :link="$link">
                                                <x-slot name="name">
                                                    Read all {{ $section['value'][1]['data']['model-view'] ?? null }}
                                                </x-slot>
                                            </x-a-href>
                                        </div>
                                    </div>
                                    <hr class="pt-0 mt-0 horizontal dark" style="height: 1px">
                                @endif
                       @endswitch
                    @endisset
                </div>
                <!-- ========== End isicontent ========== -->
            </div>
        </div>
    </section>
</div>
