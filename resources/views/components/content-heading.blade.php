@props(['level' => '', 'title' => '', 'uppercase' => false])
<{{ $level }} class="text-xl font-bold mb-4 {{ $uppercase ? 'uppercase' : '' }}"  style="text-align: center">
    {{ $title }}
</{{ $level }}>

