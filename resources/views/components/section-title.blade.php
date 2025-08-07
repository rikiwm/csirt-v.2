@props(['title' => '', 'content' => '','class'=>'','style'=>''])
<h2
    class="{{ $class ?? null }}"
    style="{{ $style ?? null }}">
    {{ $title }}
</h2>
