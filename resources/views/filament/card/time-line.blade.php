{{-- @props(['data'])
<x-filament::section>
   <div class="space-y-4">
        <div class="flex items-start space-x-3">
            <div class="w-2 h-2 bg-blue-500 rounded-full mt-1"></div>
            <div>
                <div class="font-semibold">{{ $data->status }}</div>

            </div>
        </div>
</div>
</x-filament::section> --}}
@props(['data','color' => ''])
@php
    $color = $data->is_verified === null ? 'warning' : ($data->is_verified === 1 ? 'success' : 'danger');
@endphp
<div class="px-2  space-y-4">
    <ol class="relative">
        <li class="mb-10 ms-2 relative">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex ">
                        <div class="fi-in-text-item inline-flex items-center gap-1.5">
                            <x-heroicon-m-plus-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            <div class="text-sm leading-6 text-gray-950 dark:text-white font-semibold">
                             Dibuat
                            </div>
                        </div>
                    </div>
                    <x-filament::badge color="success">
                        {{ $data->created_at ?? ''}}
                    </x-filament::badge>
                </div>

                <div class="text-sm text-gray-600 dark:text-gray-300 ">
                    <span class=" text-xs ms-4">User : {{ $data->users->name ?? ''}}</span>
                    <ul class="mt-2 list-disc list-inside text-xs text-gray-500 space-y-1">
                        <li><strong>Subject :{{ $data->subject ?? ''}}</li>
                        <li><strong>Description :{!! $data->description ?? '' !!}</li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="mb-10 ms-2 relative">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex ">
                        <div class="fi-in-text-item inline-flex items-center gap-1.5">
                            @if ($data->is_verified === null)
                            <x-heroicon-m-pause-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            @elseif ($data->is_verified === 1)
                            <x-heroicon-m-check-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            @else
                            <x-heroicon-m-x-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            @endif
                            <div class="text-sm leading-6 text-gray-950 dark:text-white">
                              Di Verifikasi
                            </div>
                        </div>
                    </div>
                 <x-filament::badge color="{{ $color }}">
                        {{ $data->created_at }}
                    </x-filament::badge>
                </div>

                <div class="text-sm text-gray-600 dark:text-gray-300">
                    <span class="font-medium">-</span>
                    <ul class="mt-2 list-disc list-inside text-xs text-gray-500 space-y-1">
                        <li><strong>-</li>
                    </ul>
                </div>
            </div>
        </li>

           <li class="mb-10 ms-2 relative">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex ">
                        <div class="fi-in-text-item inline-flex items-center gap-1.5">
                            <x-heroicon-o-check-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            <div class="text-sm leading-6 text-gray-950 dark:text-white">
                              Di Proses
                            </div>
                        </div>
                    </div>
               <x-filament::badge color="{{ $color }}">
                        {{ $data->created_at->diffForHumans() }}
                    </x-filament::badge>
                </div>

                <div class="text-sm text-gray-600 dark:text-gray-300">
                    <span class="font-medium">-</span>
                    <ul class="mt-2 list-disc list-inside text-xs text-gray-500 space-y-1">
                        <li><strong>-</li>
                    </ul>
                </div>
            </div>
        </li>

           <li class="mb-10 ms-2 relative">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex ">
                        <div class="fi-in-text-item inline-flex items-center gap-1.5">
                            <x-heroicon-o-check-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            <div class="text-sm leading-6 text-gray-950 dark:text-white">
                             Closed / Resolved
                            </div>
                        </div>
                    </div>
               <x-filament::badge color="{{ $color }}">
                        {{ $data->created_at->diffForHumans() }}
                    </x-filament::badge>
                </div>

                <div class="text-sm text-gray-600 dark:text-gray-300">
                    <span class="font-medium">-</span>
                    <ul class="mt-2 list-disc list-inside text-xs text-gray-500 space-y-1">
                        <li><strong>-</li>
                    </ul>
                </div>
            </div>
        </li>

           <li class="mb-10 ms-2 relative">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex ">
                        <div class="fi-in-text-item inline-flex items-center gap-1.5">
                            <x-heroicon-o-check-circle class="w-4 h-4 text-gray-950 dark:text-white" />
                            <div class="text-sm leading-6 text-gray-950 dark:text-white">
                              Reward
                            </div>
                        </div>
                    </div>
                    <x-filament::badge color="{{ $color }}">
                        {{ $data->created_at->diffForHumans() }}
                    </x-filament::badge>
                </div>

                <div class="text-sm text-gray-600 dark:text-gray-300">
                    <span class="font-medium">-</span>
                    <ul class="mt-2 list-disc list-inside text-xs text-gray-500 space-y-1">
                        <li><strong>-</li>
                    </ul>
                </div>
            </div>
        </li>
    </ol>
</div>
