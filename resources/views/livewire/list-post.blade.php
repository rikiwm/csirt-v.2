{{-- @props(['dataobject' => '', 'limit' => '', 'title' => null, 'class' => '']) --}}
<div>
    {{-- search --}}
    <div class="row" x-data="{ search: '' }">
        <div class="mb-2 col-md-9 ">
            <div class="mb-2 form-floating ">
                <input x-model="search" wire:model.live.defer="search" type="text" class="form-control ps-2 bg-gradient-faded-white-vertical "
                    placeholder="Search" id="textInputExample">
                <label for="textInputExample" class="ps-2 text-info">Search</label>
            </div>
        </div>
        <div class="mb-3 col-md-3">
            <div class=" form-floating">
                <select class="form-control ps-2 pe-2 bg-gradient-faded-white rounded-xl" wire:model.live="categori_id" id="cate">
                    <option value=""></option>
                    @foreach ($this->categori as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <label for="cate">Categories</label>
            </div>
        </div>
        <div class="mb-3 col-md-12">
            <span class="text-center text-muted" x-text="search"></span>
        </div>

    </div>
    <div class="row">
    @foreach ($dataobject as $item)
        <x-list-post :data="$item" :title="$title" :limit="$limit" />
        @endforeach
    </div>
    {{-- search --}}

    {{-- load --}}
    <div class="mt-4 row">
        <div class="mx-auto text-center col-lg-6 col-xl-5 align-content-center">
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="btn btn-sm btn-outline-dark rounded-4">
                {{-- <div wire:loading wire:target="loadMore">
                </div> --}}
                Get in More
            </button>
        </div>
    </div>
    {{-- load --}}

    {{-- <p class="alert alert-warning" wire:offline>
        Whoops, your device has lost connection. The web page you are viewing is offline.
    </p>
    <div class="mx-auto col-12 col-xl-12">
        <div class="shadow card rounded-4 mt-n6">
            <div class="card-body pe-2 ps-2 pe-lg-5 ps-lg-5">
                <div class="text-center row">
                    <div class="mx-auto col-xl-10">
                        <h2 class="mb-10 fs-16 text-uppercase">{{ $title }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="mx-auto col-xl-10">
                        <div class="row" x-data="{ search: '' }">
                            <div class="mb-3 col-md-8">
                                <div class="mb-4 form-floating">
                                    <input x-model="search" wire:model.live.400ms="search" type="text" class="form-control"
                                        placeholder="Search" id="textInputExample">
                                    <label for="textInputExample">Search</label>
                                </div>
                            </div>


                            <div class="mb-3 col-md-3">
                                <div class=" form-floating">
                                    <select class="form-select" wire:model.live="categori_id" id="cate">
                                        <option></option>
                                        @foreach ($this->categori as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="cate">Categories</label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-1">
                                <div class="form-floating">
                                    <select class="form-select" id="limits">
                                        <option></option>
                                        <option>{{ $limit }}</option>
                                    </select>
                                    <label for="limits">Limit</label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <span class="text-center text-muted" x-text="search"></span>
                            </div>
                        </div>

                        <div class="row gy-6">
                            @forelse ($data as $item)
                                <x-list-post :data="$item" :title="$title" :limit="$limit" />
                                @php
                                    $limit = (int) $limit;
                                @endphp
                                @if ($loop->iteration >= $limit)
                                @break
                            @else
                                @continue
                            @endif
                        @empty
                        @endforelse

                    </div>

                    <div class="row mt-11">
                        <div class="mx-auto text-center col-lg-6 col-xl-5 align-content-center">
                            <button wire:click="loadMore" wire:loading.attr="disabled"
                                class="btn btn-sm btn-outline-green rounded-4">
                                <div wire:loading wire:target="loadMore">
                                    <div class="w-3 h-3 spinner-border spinner-border-sm me-1" role="status"></div>
                                </div>
                                Get in More
                            </button>
                        </div>
                    </div>
                    @session('limit')
                    <div class="mt-2 alert alert-info alert-icon alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-circle"></i> A simple info alert with <a href="#" class="alert-link hover">an example link</a>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endsession
                </div>
            </div>
            <hr class="my-12" />
            <div class="row">
                <div class="mx-auto col-lg-12 col-xl-10 ">
                    <div class="text-start row">
                        <div class="mx-auto col-flex">
                            <h2 class=" fs-16 text-Capitalize">Lainnya</h2>
                            <hr class="my-4 mb-10 double" />
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div> --}}
</div>
