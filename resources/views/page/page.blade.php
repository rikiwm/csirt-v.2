
<x-layouts.app>
    <x-slot name="header">
        <x-page.hero-content title="{{$data->slug ?? ''}}" name="{{$category->name}}" desc="{{$category->description}}"/>
    </x-slot>

    <section>
        <div class="container">
            <div class=" row">
                <div class="mx-auto col-md-8 col-10 text-dark">
                    <div class="mb-2 rounded-4 card blur blur-rounded border-0 mt-n5" style="z-index: 1;">
                        <x-inc.breadcumb>
                            <x-slot name="slot">
                                <x-inc.breadcumb-li-a class="d-block" :link="$data['menu']['slug']" content="{{ Str::title($data['menu']['name']) }}"/>
                            </x-slot>
                        </x-inc.breadcumb>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="mx-1 mb-2 card card-body blur blur-rounded shadow-blur border-0 mx-md-6 "style="z-index: 10;">
        <x-page.section-page :data="$data" title="Artikel Lainya" updated="{{ $data['updated_at'] }}" />
    </div>

    {{-- <div class="mx-2 card card-body blur blur-rounded shadow-blur mx-md-2 " style="">
        <x-page.section-page-sugest title="Title Artikel Lainya"/>
    </div> --}}

</x-layouts.app>

