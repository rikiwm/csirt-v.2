
@props(['messages' => '', 'record' => '','statuse' => ''])
<div @foreach ($messages as $message)
<div class="py-2">
    <x-filament-tables::container>
        <x-filament::card>
            <div class="flex items-start gap-3" @if ($message->user_id == auth()->user()->id) style="direction: rtl" @else style="direction: ltr" @endif >
                <img class="items-center h-8 mt-2 rounded-full me-2" src="https://cdn1.iconfinder.com/data/icons/people-avatar-flat-2/128/1-07-512.png" alt="Jese image" loading="lazy">
                <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-100 bg-white rounded-e-xl rounded-es-xl dark:bg-gray-800 rounded-lg">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white me-4" >{{ $message->user->name ?? '' }} </span>
                    <span class="text-xs font-normal text-gray-500 dark:text-gray-400 "> {{ $message->created_at->diffForHumans() ?? '' }}</span>
                </div>
                <p class="text-md font-normal py-2.5 text-gray-900 dark:text-white">{!! $message->message ?? '' !!}</p>
                <span class="mt-2 text-xs font-normal text-gray-500 dark:text-gray-400">
                    <x-heroicon-c-calendar-date-range class="inline-block w-4 h-4 text-primary-500 me-1 dark:text-gray-400" />
                    {{ $message->created_at->toDateTimeString() ?? '' }}</span>

            </div>
            </div>
        </x-filament::card>
    </x-filament-tables::container>
</div> @endforeach
@if ($statuse != 'closed')
    <livewire:reply-ticket :record="$record"/>
@endif
</div>
