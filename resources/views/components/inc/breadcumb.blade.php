@props(['slot' => ''])

<div class="p-1 card card-plain">
    <div class="py-2 m-0 py-md-3 card-body">
        <div class="justify-content-center d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="mb-0 bg-transparent breadcrumb">
                    {{ $slot }}
                </ol>
              </nav>
        </div>
    </div>
</div>
