<x-layouts.app>
    <x-slot name="header">
        <x-page.hero-page >
            <x-slot name="descpage">
                <x-page.hero-content name="{{$title }}" desc="{{$title}}"/>
            </x-slot>
        </x-page.hero-page>
    </x-slot>

    <section>
        <div class="container">
            <div class=" row">
                <div class="mx-auto col-md-8 col-10 text-dark">
                    <div class="mb-2 rounded-4 card blur blur-rounded shadow-blur mt-n6" style="z-index: 10;">
                        <div class="p-1 card card-plain">
                            <div class="py-3 py-md-4 card-body">
                                <div class="gap-2 justify-content-center d-flex align-items-center">
                                    <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">Author</a></span>
                                    <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">Created</a></span>
                                    <span class="text-center badge bg-gradient-faded-dark-blue-vertical"><a class="mx-2 text-white " href="#" target="_blank">share</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <div class="card">
        <div class="card-body">
            <section class="py-4">
                <div class="container">
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
