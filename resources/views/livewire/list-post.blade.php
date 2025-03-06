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
            @if ($count > $this->limit)
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="btn btn-sm btn-outline-dark rounded-4 ">
                <div wire:loading wire:target="loadMore">
                </div>
                Get in More
            </button>
            @else
            <span class="text-muted">No More Data</span>
             @endif
        </div>
    </div>


    {{-- load --}}

</div>
