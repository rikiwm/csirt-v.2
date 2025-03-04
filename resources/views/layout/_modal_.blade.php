   <!-- <div class="modal fade modal-popup" id="modal-02" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content text-center">
            <div class="modal-body p-2 pt-12">
              <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="row">

                <div class="col-md-10 offset-md-1">
                  <figure class="mb-2">
                    <img src="assets/img/photos/bg3.jpg" class="rounded-2 w-100" srcset="assets/img/photos/bg3.jpg 2x" alt="" /></figure>
                </div>

              </div>

                 <div class="col-md-10 offset-md-1">
                    <h3>Example </h3>
                    <p class="mb-6 fs-14">Nullam quis risus eget urna mollis ornare vel eu  vel eu vel eu leo. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>

              <div class="newsletter-wrapper">
                <div class="row">
                  <div class="col-md-10 offset-md-1">

                    <div id="mc_embed_signup">

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div> -->

   {{-- alert cockies --}}
   {{-- <a href="#" class="btn btn-primary rounded-pill mx-1 mb-2 mb-md-0" data-bs-toggle="modal"
       data-bs-target="#modal-01">Cookie</a> --}}

   <div class="modal fade modal-popup modal-bottom-center" id="modal-01" tabindex="-1">
       <div class="modal-dialog modal-xl">
           <div class="modal-content">
               <div class="modal-body p-6">
                   <div class="row">
                       <div class="col-md-12 col-lg-8 mb-4 mb-lg-0 my-auto align-items-center">
                           <h4 class="mb-2">Cookie Policy</h4>
                           <p class="mb-0">We use cookies to personalize content to make our site easier for you to
                               use.</p>
                       </div>
                       <div class="col-md-5 col-lg-4 text-lg-end my-auto">
                           @include('cookie-consent::index')

                           {{-- <a href="#" class="btn btn-primary rounded-pill" data-bs-dismiss="modal" --}}
                           {{-- aria-label="Close">I Understand</a> --}}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
