<script src="{{ asset('frontend/js/core/popper.min.js')}}" type="text/javascript" defer></script>
<script src="{{ asset('frontend/js/core/bootstrap.min.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('frontend/js/plugins/perfect-scrollbar.min.js') }}"defer></script>
<script src="{{ asset('frontend/js/plugins/countup.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/plugins/choices.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/plugins/prism.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/plugins/highlight.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/plugins/rellax.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/plugins/tilt.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/plugins/choices.min.js') }}" defer ></script>
<script src="{{ asset('frontend/js/material-kit.min.js')}}" type="text/javascript" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12" ></script>
<!-- ========== Js Section ========== -->

<script defer >
    window.addEventListener("scroll", function () {
        let navbar = document.querySelector(".navbar");
        if (window.scrollY > 100) {
            navbar.classList.add("shrink");
        } else {
            navbar.classList.remove("shrink");
        }
    });
</script>
<script type="text/javascript" defer>
    if (document.getElementById('state1')) {
    const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
    if (!countUp.error) {
        countUp.start();
    } else {
        console.error(countUp.error);
    }
    }
    if (document.getElementById('state2')) {
    const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
    if (!countUp1.error) {
        countUp1.start();
    } else {
        console.error(countUp1.error);
    }
    }
    if (document.getElementById('state3')) {
    const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
    if (!countUp2.error) {
        countUp2.start();
    } else {
        console.error(countUp2.error);
    };
    }
</script>

<script type="text/javascript" defer>
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

