<div>
    @php
    use Filament\Support\Enums\Alignment;
    use Filament\Tables\Actions\HeaderActionsPosition;
    use Filament\Tables\Actions\Action;
    use Filament\Forms\Components\RichEditor;
@endphp

<x-filament-tables::container>
    <x-filament::card>
        <form wire:submit="create">
            {{ $this->form }}
            <div class="flex justify-end mt-2">
                @if($this->record->agent_id == null || auth()->user()->id == $this->record->users_id || auth()->user()->id == $this->record->agent_id )
                <x-filament::button type="submit" class=" btn btn-facebook">
                    Kirim
                </x-filament::button>
                @else

                @endif
            </div>
        </form>
        <x-filament-actions::modals />
    </x-filament::card>
</x-filament-tables::container>
</div>
