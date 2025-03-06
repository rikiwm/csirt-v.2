@props(['name' => '', 'background' => '', 'class' => '','content' => '','desc' => ''])
<div class="container ">

<div class="row justify-content-center">
    <div class="mx-auto my-auto text-center col-lg-12 col-10"
    data-aos="fade-zoom-in"
    data-aos-easing="ease-in-back"
    data-aos-delay="50"
    data-aos-offset="0">
      <div class="text-white display-4 font-weight-light ls-1" style="font-family: 'MinePlayer', sans-serif; font-weight: 100; letter-spacing: 0.1rem;">
        {{$name}}
      </div>
    </div>
    <div class="mx-auto my-auto text-center col-lg-7 col-11"
    data-aos="fade-zoom-in"
    data-aos-easing="ease-in-back"
    data-aos-delay="50"
    data-aos-offset="0">
      <p class="mt-3 text-white text-md">
          {{ $desc }}
      </div>
  </div>

</div>

