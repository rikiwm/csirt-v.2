<div>

    <div class="grid grid-flow-col grid-rows-3 gap-4 py-0">
        <x-filament::card>
            <div class="grid gap-6 fi-wi-stats-overview-stats-ctn md:grid-cols-3">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">
                        Start
                    </x-slot>
                    <x-filament::input type="date" wire:model="startDate" />

                </x-filament::input.wrapper>
                <x-filament::input.wrapper>
                    <x-slot name="suffix">
                        End
                    </x-slot>
                    <x-filament::input type="date" wire:model="endDate" />
                </x-filament::input.wrapper>
                <x-filament::input.wrapper>

                    <x-filament::input.select wire:model.live="type">
                        @forelse ($this->insiden as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                        @empty

                        @endforelse

                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>
        </x-filament::card>
        <x-filament::card>
            <div class="grid gap-6 fi-wi-stats-overview-stats-ctn md:grid-cols-2">
                <x-filament::input.wrapper suffix-icon="heroicon-m-magnifying-glass">
                    <x-filament::input.select wire:model="year">
                        <option value="2021">2021</option>
                    </x-filament::input.select>

                </x-filament::input.wrapper>
                <x-filament::button icon="heroicon-m-magnifying-glass"  tooltip="Download">Download
                   </x-filament::button>
            </div>
        </x-filament::card>
    </div>

    {{-- ------------------------------------------------- --}}
    <div class="grid grid-flow-col grid-rows-3 gap-4 py-6">
        <x-filament::card>
            <div class="grid gap-6 fi-wi-stats-overview-stats-ctn md:grid-cols-1">
                <div class="d-flex align-items-center">
                    <div
                        class="text-3xl font-semibold tracking-tight fi-wi-stats-overview-stat-value text-gray-950 dark:text-white">
                        {{ $this->total }}
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span
                            class="text-sm ">
                            Total Ticket
                        </span>
                    </div>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card>
            <div class="grid gap-6 fi-wi-stats-overview-stats-ctn md:grid-cols-1">
                <div class="d-flex align-items-center">
                    <div
                        class="text-3xl font-semibold tracking-tight fi-wi-stats-overview-stat-value text-gray-950 dark:text-white">
                        {{ $this->open }}
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span
                            class="text-sm">Open
                        </span>

                    </div>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card>
            <div class="grid gap-6 fi-wi-stats-overview-stats-ctn md:grid-cols-1">
                <div class="d-flex align-items-center">
                    <div
                        class="text-3xl font-semibold tracking-tight fi-wi-stats-overview-stat-value text-gray-950 dark:text-white">
                        {{ $this->closed }}
                    </div>
                    <span
                        class="text-sm ">
                        Closed
                    </span>
                </div>
            </div>
        </x-filament::card>
        <x-filament::card>
            <div class="grid gap-6 fi-wi-stats-overview-stats-ctn md:grid-cols-2 grid-cols">
                <div class="cols-span-1">
                    <div
                        class="text-3xl font-semibold tracking-tight fi-wi-stats-overview-stat-value text-gray-950 dark:text-white">
                        {{ $this->valid }}

                    </div>
                    <span
                        class="text-sm ">
                        Valid
                    </span>
                </div>

                <div class="cols-span-1">
                    <div
                        class="text-3xl font-semibold tracking-tight fi-wi-stats-overview-stat-value text-gray-950 dark:text-white">
                        {{ $this->invalid }}

                    </div>
                    <span
                        class="text-sm ">
                        Invalid
                    </span>
                </div>
            </div>
        </x-filament::card>
    </div>

    <x-filament::section class="mb-5">
        <div class="flex items-center gap-x-2">
            <div class="flex-1">
                <div class="grid gap-y-2">

                    <div
                        class="text-3xl font-semibold tracking-tight fi-wi-stats-overview-stat-value text-gray-950 dark:text-white">
                        {{ $this->avg }} Menit
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span
                            class="text-sm fi-wi-stats-overview-stat-description fi-color-custom text-gray-600 dark:text-white">
                            Respon Time Average
                        </span>
                        <svg
                            class="w-5 h-5 fi-wi-stats-overview-stat-description-icon text-gray-600 dark:text-white"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="grid text-center gap-y-2">

                <span
                    class="text-sm fi-wi-stats-overview-stat-description fi-color-custom text-custom-600 dark:text-custom-400 fi-color-primary">
                    Responder
                </span> {{ $this->total }}
            </div>
        </div>
    </x-filament::section>

    <x-filament-tables::container class="mt-2">
        <x-filament::section>
            {{ $this->table }}
        </x-filament::section>
    </x-filament-tables::container>
</div>
