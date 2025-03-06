<x-layouts.app>
    <x-slot name="header">
        <x-page.hero-page >
            <x-slot name="descpage">
                <x-page.hero-content name="{{$category->name}}" desc="{{$category->description}}"/>
            </x-slot>
        </x-page.hero-page>
    </x-slot>

    <section>
        <div class="container">
            <div class=" row">
                <div class="mx-auto col-md-8 col-10 text-dark">
                    <div class="mb-2 rounded-4 card blur blur-rounded shadow-blur mt-n6" style="z-index: 1;">
                        <div class="p-1 card card-plain">
                            <div class="py-3 py-md-4 card-body">
                                <div class="gap-2 justify-content-center d-flex align-items-center">
                                    <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">Author</a></span>
                                    <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">Created</a></span>
                                    <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">share</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mx-4 mb-2 card card-body blur blur-rounded shadow-blur mx-md-7 "style="z-index: 10;">
       <x-page.section-page :data="$data" title="Artikel Lainya" updated="{{ $data['updated_at'] }}" />
    </div>

    <div class="mx-2 card card-body blur blur-rounded shadow-blur mx-md-2 " style="">
        <x-page.section-page-sugest title="Title Artikel Lainya"/>
    </div>

</x-layouts.app>

