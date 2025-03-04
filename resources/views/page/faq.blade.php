<x-layouts.app class="">
    <div class="relative mt-0 mb-0 page-header min-vh-65 ms-1 me-1 mt-lg-2 ms-lg-2 mb-lg-0 me-lg-1 rounded-4"
    style="background-image: url('https://csirt.padang.go.id/storage/image-property/mzvRlMVfbLiChlEzB1g9WIYZTEeuURXj5nI7iM9W.jpg');" loading="lazy">
        <span class="mask bg-gradient-faded-dark-blue opacity-5"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="mx-auto my-auto text-center col-lg-12 col-10">
                  <div class="pt-3 text-white display-4 font-weight-light ls-1" style="font-family: 'MinePlayer', sans-serif; font-weight: 100; letter-spacing: 0.1rem;">
                      {{ $title ?? '' }}
                  </div>
                </div>
                <div class="my-5 row">
                    <div class="mx-auto my-auto text-center text-white border-radius-xl py-lg-2 bg-gradient-faded-dark-blue-vertical card-plain col-lg-7 col-11"data-aos="fade-zoom-in"
                    data-aos-easing="ease-in-back"
                    data-aos-delay="50"
                    data-aos-offset="0">
                        <h2 class="text-white ">Frequently Asked Questions</h2>
                        <p>A lot of people don&#39;t appreciate the moment until it’s passed. I&#39;m not trying my hardest, and I&#39;m not trying to do </p>
                  </div>
                  </div>
              </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
            <section class="py-4">
                <div class="container"data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back"
                data-aos-delay="50"
                data-aos-offset="0">

                  <div class="row">
                    <div class="mx-auto col-md-10">
                      <div class="accordion" id="accordionRental">
                        <div class="mb-3 accordion-item">
                          <h5 class="accordion-header" id="headingOne">
                            <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              How do I create?
                              <i class="pt-1 text-xs collapse-close fa fa-plus position-absolute end-0"></i>
                              <i class="pt-1 text-xs collapse-open fa fa-minus position-absolute end-0"></i>
                            </button>
                          </h5>
                          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionRental">
                            <div class="text-sm accordion-body opacity-8">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque voluptas, doloribus aspernatur rerum tempore illum laboriosam velit quo ipsa tenetur, laudantium nisi? Voluptatum voluptates nemo animi ut, suscipit deserunt nostrum.
                            </div>
                          </div>
                        </div>
                        <div class="mb-3 accordion-item">
                          <h5 class="accordion-header" id="headingTwo">
                            <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              How can i make the ticket?
                              <i class="pt-1 text-xs collapse-close fa fa-plus position-absolute end-0"></i>
                              <i class="pt-1 text-xs collapse-open fa fa-minus position-absolute end-0"></i>
                            </button>
                          </h5>
                          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionRental">
                            <div class="text-sm accordion-body opacity-8">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus aut tenetur veritatis modi sequi error eveniet, repellat velit dolores quae odio corrupti officiis nisi aperiam quos at voluptatem! Eius, voluptatem?
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </section>
        </div>
      </div>

</x-layouts.app>
