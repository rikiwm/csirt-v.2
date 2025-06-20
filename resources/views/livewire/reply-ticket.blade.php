<div>
    @php
    use Filament\Support\Enums\Alignment;
    use Filament\Tables\Actions\HeaderActionsPosition;
    use Filament\Tables\Actions\Action;
    use Filament\Forms\Components\RichEditor;
@endphp
        <form wire:submit.prevent="create" class="flex flex-col">

            {{ $this->form }}
            <div class="flex justify-end my-4">
                @if($this->record->agent_id == null || auth()->user()->id == $this->record->users_id || auth()->user()->id == $this->record->agent_id )
                <x-filament::button type="submit" class=" btn btn-facebook"  wire:loading.attr="disabled" >
                    <x-filament::loading-indicator class="h-5 w-5" wire:loading />
                    Kirim
                </x-filament::button>
                @else

                @endif
            </div>
        </form>
</div>
