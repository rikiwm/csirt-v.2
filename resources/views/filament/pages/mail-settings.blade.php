<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit" wire:loading.attr="disabled">
            <x-filament::loading-indicator class="h-5 w-5" wire:loading />
            Save
        </x-filament::button>
    </form>
</x-filament-panels::page>
