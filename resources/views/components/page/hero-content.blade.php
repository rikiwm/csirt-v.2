@props([
    'name' => '',
    'background' => '',
    'class' => '',
    'content' => '',
    'desc' => '',
    'category' => '',
    'title' => '',
])
<div class="container ">
    <div class="row justify-content-center">
        <div class="mx-auto my-auto text-center col-lg-12 col-10">
            <div class="text-white display-4 font-weight-light ls-1"style="font-family: 'MinePlayer', sans-serif; font-weight: 100; letter-spacing: 0.1rem;">
                {{ $title ?? '' }}
            </div>
        </div>
        <div class="mx-auto my-auto text-center col-lg-7 col-11">
            <p class="mt-2 text-white text-md">
                <span class="badge bg-info">{{ $category['name'] ?? '' }}</span>
            </p>
        </div>
    </div>
</div>
