<div class="h-screen flex flex-col justify-between">
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
                    {{ $isMine ? 'bg-gray-200 text-black rounded-br-none' : 'bg-gray-200 text-gray-900 rounded-bl-none' }}">
                    
                    <div class="text-xs font-semibold mb-1">
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