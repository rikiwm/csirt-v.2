
@props(
    [
        'csp_nonce' => '',
    ]
)
<script nonce="{{ $csp_nonce }}" src="{{ asset('frontend/js/core/popper.min.js')}}" type="text/javascript" ></script>
<script nonce="{{ $csp_nonce }}" type="module" src="{{ asset('frontend/js/core/bootstrap.min.js') }}" type="text/javascript" ></script>
<script nonce="{{ $csp_nonce }}" src="{{ asset('frontend/js/plugins/perfect-scrollbar.min.js') }}"></script>
{{-- <script src="{{ asset('frontend/js/plugins/countup.min.js') }}"  ></script>
<script src="{{ asset('frontend/js/plugins/choices.min.js') }}"  ></script>
<script src="{{ asset('frontend/js/plugins/prism.min.js') }}"  ></script>
<script src="{{ asset('frontend/js/plugins/highlight.min.js') }}"  ></script>
<script src="{{ asset('frontend/js/plugins/rellax.min.js') }}"  ></script>
<script src="{{ asset('frontend/js/plugins/tilt.min.js') }}"  ></script>
<script src="{{ asset('frontend/js/plugins/choices.min.js') }}"  ></script> --}}
<script nonce="{{ $csp_nonce }}" src="{{ asset('frontend/js/material-kit.min.js')}}" type="text/javascript"  ></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12" ></script>
<!-- ========== Js Section ========== -->

<script nonce="{{ $csp_nonce }}" defer >
    window.addEventListener("scroll", function () {
        let navbar = document.querySelector(".navbar");
        if (window.scrollY > 100) {
            navbar.classList.add("shrink");
        } else {
            navbar.classList.remove("shrink");
        }
    });
</script>

<script nonce="{{ $csp_nonce }}" type="text/javascript" defer>
    if (document.getElementById('typed')) {
    var typed = new Typed("#typed", {
        stringsElement: '#typed-strings',
        fadeOut: false,
        fadeOutClass: 'typed-fade-out',
        fadeOutDelay: 500,
        autoInsertCss: true,
        typeSpeed: 200,
        backSpeed: 30,
        backDelay: 200,
        startDelay: 500,
        loop: true,
        showCursor: false
    });
    }
</script>



<!-- ========== Js Section ========== -->

