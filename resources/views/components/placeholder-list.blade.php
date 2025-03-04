
<div>
    <div class="mx-auto col-12 col-xl-12">
        <div class="text-center row">
            <div class="mx-auto col-xl-10">
            </div>
        </div>
        <div class="row">
            <div class="mx-auto col-xl-12">
                <div class="row">
                    <div class="mb-2 col-md-9">
                        <div class="mb-2">
                            <div class=" rounded-2 placeholder-glow">
                                <span class="p-1 rounded p-lg-4 placeholder w-100"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 col-md-3">
                        <div class="mb-2">
                            <div class=" rounded-2 placeholder-glow">
                                <span class="p-1 rounded p-lg-4 placeholder w-100"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" row gy-6">
                    @for($i = 0; $i < 3; $i++)
                    <div class="col-md-6 col-lg-4">
                        <a  class="pt-5 pb-5 placeholder-glow h-100">
                            <div class="flex-row d-flex">

                                <div class="mt-4 rounded placeholder-glow w-100">
                                    <hr>
                                    <span
                                        class="py-6 pb-2 rounded bg-pale-green w-100 placeholder"</span>
                                    <h4 class="py-6 rounded w-100 placeholder"></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
