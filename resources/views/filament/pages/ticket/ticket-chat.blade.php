
@props(['messages' => '', 'record' => '','statuse' => ''])
<div class=" h-screen" id="messages">
    <div class="space-y-4  mb-4 overflow-hidden  overflow-y-auto " id="messages" >
    @foreach ($messages as $message)
            <div class="border border-gray-200 rounded-lg flex items-start gap-1" @if ($message->user_id == auth()->user()->id) style="direction: rtl" @else style="direction: ltr" @endif >
                <img class="items-center h-6 mt-2 rounded-full me-2" src="https://cdn1.iconfinder.com/data/icons/people-avatar-flat-2/128/1-07-512.png" alt="Jese image" loading="lazy">
                <div class="flex flex-col w-full max-w-[220px] leading-1.5 p-4 border-gray-100 bg-white rounded-e-xl rounded-es-xl dark:bg-gray-800 rounded-lg">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-xs font-semibold text-gray-900 dark:text-white mx-2 capitalize" >{{ $message->user->name ?? '' }} </span>
                    <span class="text-xs font-normal text-gray-500 dark:text-gray-400 "> {{ $message->created_at->diffForHumans() ?? '' }}</span>
                    </div>
                <p class="text-xs py-1 text-gray-900 dark:text-white">{!! $message->message ?? '' !!}</p>
                <span class="mt-2 text-['6px'] font-light text-gray-500 dark:text-gray-400">
                    <x-heroicon-c-calendar-date-range class="inline-block w-3 h-3 text-primary-500 mx-2 dark:text-gray-400" />
                    {{ $message->created_at->toDateTimeString() ?? '' }}</span>

            </div>
            </div>
            @endforeach
</div>
@if ($statuse != 'closed')
    <livewire:reply-ticket :record="$record"/>
@endif
</div>
