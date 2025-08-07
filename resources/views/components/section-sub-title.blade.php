@props(['subtitle' => '', 'content' => '','class'=>'text-center','style'=>''])
<h2
    class="{{ $class ?? null }}"
    style="{{ $style ?? null }}">
    {{ $subtitle }}
</h2>
