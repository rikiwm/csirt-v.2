<div class="py-2">
    <x-filament-tables::container>
        <x-filament::card>
            <img class="w-full rounded img-fluid" src="{{ asset('storage/'.$data->file_path) }}" alt="">
            <div class="mt-3 text-end">
                <x-filament::button class="warning">
                    <a href="{{ asset('storage/'.$data->file_path) }}" download="{{ $data->ticketreward->created_at }}-{{ $data->ticketreward->code }}" target="_blank" rel="noopener noreferrer" class="btn btn-behance"> Download</a>
                </x-filament::button>
            </div>
        </x-filament::card>
    </x-filament-tables::container>
</div>
