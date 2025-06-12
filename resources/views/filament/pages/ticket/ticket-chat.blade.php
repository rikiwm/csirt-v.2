<div class=" flex flex-col justify-between">
    {{-- Chat Messages --}}
    <div
        id="messages"
        class="flex-1 overflow-y-auto p-2 space-y-2"
        style="max-height: 60vh;"
    >
        @foreach ($messages as $message)
            @php
                $isMine = $message->user_id === auth()->id();
            @endphp

            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-sm rounded-lg p-3 shadow-md 
                    {{ $isMine ? 'bg-gray-200 text-black rounded-br-none dark:bg-gray-800' : 'bg-gray-200 text-gray-900 rounded-bl-none dark:bg-gray-800' }}">
                    
                    <div class="text-xs font-semibold mb-1 capitalize">
                        {{ $message->user->name ?? 'User' }}
                        <span class="text-[10px] text-gray-300 ml-2">
                            {{-- {{ $message->created_at->diffForHumans() }} --}}
                        </span>
                    </div>

                    <div class="text-sm leading-snug">
                        {!! $message->message ?? '' !!}
                    </div>

                    <div class="text-xs mt-1 text-right">
                        <x-heroicon-c-calendar-date-range class="inline-block w-3 h-3 text-black opacity-70" />
                        {{ $message->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Input Reply Form --}}
    @if ($statuse !== 'closed')
        <div class="p-2 border-t">
            <livewire:reply-ticket :record="$record" />
        </div>
    @endif
</div>

                {{-- @if ($message->user_id === auth()->user()->id) style="direction: rtl" @else style="direction: ltr" @endif --}}

                {{-- @props(['messages' => '', 'record' => '', 'statuse' => ''])

<div class="h-screen flex flex-col justify-between bg-gray-50 dark:bg-gray-900">
    <div
        id="messages"
        class="flex-1 overflow-y-auto px-4 py-3 space-y-3 max-h-[70vh]"
    >
        @foreach ($messages as $message)
            @php
                $isMine = $message->user_id === auth()->id();
            @endphp

            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-sm rounded-xl px-4 py-2 shadow
                    {{ $isMine ? 'bg-blue-500 text-white rounded-br-none' : 'bg-white text-gray-800 rounded-bl-none' }}">
                    
                    <div class="text-xs font-semibold mb-1">
                        {{ $message->user->name ?? 'User' }}
                        <span class="text-[10px] text-gray-300 ml-2">
                            {{ $message->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="text-sm leading-snug">
                        {!! $message->message ?? '' !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($statuse !== 'closed')
        <div class="p-3 border-t bg-white dark:bg-gray-800">
            <form wire:submit.prevent="sendMessage" class="flex items-center gap-2">
                <input
                    wire:model.defer="message"
                    type="text"
                    class="flex-1 px-4 py-2 text-sm rounded-full border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Ketik pesan..."
                >
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-full transition"
                >
                    Kirim
                </button>
            </form>
        </div>
    @endif
</div> --}}
