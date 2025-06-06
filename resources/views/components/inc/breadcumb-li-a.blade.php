@props(['link' => '','content' => '', 'class' => ''])
@php
    if (url($link) === url()->current()) {
        # code...
         $class ='d-none';
    }
@endphp

<li class="breadcrumb-item text-dark opacity-9"><a href="{{ url()->route('home') }}">Home</a></li>
<li class="breadcrumb-item text-dark font-weight-semibold "><a href="{{ url($content) }}">{{ $content }}</a></li>
