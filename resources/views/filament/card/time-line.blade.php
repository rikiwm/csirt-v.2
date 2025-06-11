@props(['data'])
<x-filament::section>
   <div class="space-y-4">
    {{-- @foreach ($statuse as $status) --}}
        <div class="flex items-start space-x-3">
            <div class="w-2 h-2 bg-blue-500 rounded-full mt-1"></div>
            <div>
                <div class="font-semibold">{{ $data->status }}</div>
                {{-- <div class="text-sm text-gray-600">{{ $status->created_at->format('d M Y H:i') }}</div>
                @if ($status->notes)
                    <div class="text-sm mt-1">{{ $status->notes }}</div>
                @endif --}}
            </div>
        </div>
    {{-- @endforeach --}}
</div>
</x-filament::section>