@php
use Filament\Support\Enums\Alignment;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\RichEditor;
@endphp
<div class="py-2">
    <x-filament-tables::container>
        <x-filament::card>
            @if($data && $data->hasMedia('ticket_media'))
            <object data="{{ $data->getFirstMediaUrl('ticket_media') }}" type="application/pdf" width="100%" height="500px">
                <p>Unable to display PDF file. <a href="{{ $data->getFirstMediaUrl('ticket_media') }}">Download</a> instead.</p>
              </object>
            @else
                <h1>Poc: No  Available</h1>
            @endif
            {{-- <x-filament::input.wrapper suffix-icon="heroicon-m-globe-alt">
    <x-filament::input
        type="url"
        wire:model="domain"
    />
</x-filament::input.wrapper>
            <h1>Poc: {{ $data?->getFirstMediaUrl('ticket_media') ?? 'No Image' }}</h1> --}}
        </x-filament::card>
    </x-filament-tables::container>
</div>
