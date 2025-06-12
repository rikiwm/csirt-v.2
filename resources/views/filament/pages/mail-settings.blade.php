{{-- <x-filament-panels::page>
  {{ $this->form }}
<x-filament::button type="submit" class=" btn btn-facebook"  wire:loading.attr="disabled" >
    <x-filament::loading-indicator class="h-5 w-5" wire:loading />
    Save
</x-filament::button>
</x-filament-panels::page> --}}


<x-filament-panels::page>
<x-filament::tabs x-data="{ activeTab: 'tab1' }">
    <x-filament::tabs.item
        alpine-active="activeTab === 'tab1'"
        x-on:click="activeTab = 'tab1'"
           :href="url('/')"
        tag="a"
    >
        Notifications
    </x-filament::tabs.item>
    <x-filament::tabs.item
        alpine-active="activeTab === 'tab2'"
        x-on:click="activeTab = 'tab2'"
    >
        Tab 2
    </x-filament::tabs.item>
        <x-filament::tabs.item
        alpine-active="activeTab === 'tab3'"
        x-on:click="activeTab = 'tab3'"
    >
        Tab 3
    </x-filament::tabs.item>
    {{-- Other tabs --}}
</x-filament::tabs>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit" wire:loading.attr="disabled">
            <x-filament::loading-indicator class="h-5 w-5" wire:loading />
            Save
        </x-filament::button>
    </form>
</x-filament-panels::page>
