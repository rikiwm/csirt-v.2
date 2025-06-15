<x-filament-panels::page>
<div class="prose max-w-full w-full">
<div x-data="{ activeTab: 'tab1' }">
    <x-filament::tabs label="Content tabs">
        <x-filament::tabs.item
            alpine-active="activeTab === 'tab1'"
            icon="heroicon-m-globe-alt"
            icon-position="after"
            x-on:click="activeTab = 'tab1'">
            Website
        </x-filament::tabs.item>
        <x-filament::tabs.item
            alpine-active="activeTab === 'smtpsettings'"
            icon="heroicon-m-envelope"
            icon-position="after"
            x-on:click="activeTab = 'smtpsettings'">
           SMTP
        </x-filament::tabs.item>

        <x-filament::tabs.item
            alpine-active="activeTab === 'apisettings'"
            icon="heroicon-m-rocket-launch"
            icon-position="after"
            x-on:click="activeTab = 'apisettings'">
            API
        </x-filament::tabs.item>
        <x-filament::tabs.item
            alpine-active="activeTab === 'pgpkey'"
            icon="heroicon-m-key"
            icon-position="after"
            x-on:click="activeTab = 'pgpkey'">
            PGP Key
        </x-filament::tabs.item>
    </x-filament::tabs>

    <div class="mt-2 shadow-none  ">
        <div x-show="activeTab === 'tab1'" >
            {{ $this->getFormWebsite() }}
            <x-filament::button wire:click="submitWebsite" class="my-4">Simpan Website</x-filament::button>
        </div>

        <div x-show="activeTab === 'smtpsettings'" >
            {{ $this->getFormMail() }}
            <x-filament::button wire:click="submitMail" class="mt-4">Simpan Mail</x-filament::button>
        </div>

        <div x-show="activeTab === 'apisettings'" >
            {{ $this->getFormAPI() }}
            <x-filament::button wire:click="submitAPI" class="mt-4">Simpan API</x-filament::button>
        </div>
        <div x-show="activeTab === 'pgpkey'" >
            {{ $this->getFormOther() }}
            <x-filament::button wire:click="submitOther" class="mt-4">Simpan PGP</x-filament::button>
        </div>
    </div>
</div>
</div>

</x-filament-panels::page>
