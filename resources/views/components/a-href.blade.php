@props(['link' => '', 'name' => '','class'=>''])

<a href="{{url($link ?? null)}}"
    class="btn btn-sm {{ $class ?? null }} rounded-xl me-2">
    {{$name ?? null}}
</a>
