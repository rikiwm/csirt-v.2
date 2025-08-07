<x-filament-panels::page>

<x-filament::input.wrapper>
    <x-filament::input.select wire:model.live="selectedYear">
     <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
    </x-filament::input.select>
</x-filament::input.wrapper>
  {{-- <x-filament::select
            label="Pilih Tahun"
            wire:model.live="selectedYear"
        >
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
        </x-filament::select> --}}
    <livewire:summary-reports />
</x-filament-panels::page>