
<div class="prose ">
    <div class="p-1">
        @foreach ($content as $item)
            @if ($item['type'] === 'heading')
                <x-content-heading :level="$item['data']['level'] ?? 'h2'" :title="$item['data']['title'] ?? ''" :uppercase="$item['data']['uppercase'] ?? false" />
            @elseif ($item['type'] === 'paragraph')
                <x-content-paragraph :content="$item['data']['content'] ?? ''" />
            @elseif ($item['type'] === 'images')
                <x-content-img :content="$item['data']['image'] ?? ''" />
            @endif
        @endforeach
    </div>
</div>
