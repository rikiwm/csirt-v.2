@props(['setting'=>'','address'=>'','footer'=>'','appname'=>'','visitor'=>''])
<div class="pt-4 mt-2 card card-body blur blur-rounded shadow-blur" style="z-index: 10;">
    <footer class="footer">
        <div class="px-lg-4 container-fluid">
        <div class="row">
            <div class="mx-auto mb-4 col-12 col-md-10">
                <div>
                    <div class="flex-row d-flex align-items-center">
                        <a href="/" class="">
                            <x-logo />

                        </a>
                        <h6 class="mb-2 ms-2 font-weight-bolder text-uppercase">
                            {{ $appname ??  env('APP_NAME') }}
                        </h6>
                    </div>

                    <!-- ========== Start FOOTER CONTENT ========== -->
                    <div class="mb-2">
                        <span class="text-capitalize">{{ $footer['value'][1]['data']['keys'] ?? null }}</span>
                        <h6 class="mb-1 font-weight-bolder text-capitalize">
                            {{ $footer['value'][1]['data']['content'] ?? null }}
                        </h6>
                        <span class="text-capitalize">{{ $footer['value'][2]['data']['keys'] ?? null }}</span>
                        <h6 class="mb-1 font-weight-bolder text-capitalize">
                            {{ $footer['value'][2]['data']['content'] ?? null }}
                        </h6>
                        <span class="text-capitalize">{{ $footer['value'][3]['data']['keys'] ?? null }}</span>
                        <h6 class="mb-1 font-weight-bolder text-capitalize">
                            {{ $footer['value'][3]['data']['content'] ?? null }}
                        </h6>
                    </div>

                    <!-- ========== End FOOTER CONTENT ========== -->
                </div>

            </div>

            {{-- <div class="mb-4 col-md-2 col-sm-6 col-6">
            <div>
                <h6 class="text-sm">Company</h6>
                <ul class="flex-column ms-n3 nav">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/presentation" target="_blank">
                    About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/templates/free" target="_blank">
                    Freebies
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/templates/premium" target="_blank">
                    Premium Tools
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/blog" target="_blank">
                    Blog
                    </a>
                </li>
                </ul>
            </div>
            </div>


            <div class="mb-4 col-md-2 col-sm-6 col-6">
            <div>
                <h6 class="text-sm">Help & Support</h6>
                <ul class="flex-column ms-n3 nav">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/contact-us" target="_blank">
                    Contact Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/knowledge-center" target="_blank">
                    Knowledge Center
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://services.creative-tim.com/?ref=ct-mk2-footer" target="_blank">
                    Custom Development
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://www.creative-tim.com/sponsorships" target="_blank">
                    Sponsorships
                    </a>
                </li>

                </ul>
            </div>
            </div> --}}

            <div class="mx-auto mb-4 col-md-2 col-sm-6 ">
                <div>
                    <h6 class="text-sm text-lg-end me-2">Site Map</h6>
                    <ul class="flex-column ms-n3 nav text-lg-end">
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                        target="_blank">
                        Terms & Conditions
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                        Privacy Policy
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                    Opensource
                        </a>
                    </li>

                    </ul>
                    <h6 class="text-sm text-lg-end me-2">Help & Support</h6>
                    <ul class="flex-column ms-n3 nav text-lg-end">
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.creative-tim.com/contact-us" target="_blank">
                        Contact Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.creative-tim.com/knowledge-center" target="_blank">
                        Knowledge Center
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://services.creative-tim.com/?ref=ct-mk2-footer" target="_blank">
                        Custom Development
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.creative-tim.com/sponsorships" target="_blank">
                        Sponsorships
                        </a>
                    </li>

                    </ul>
                </div>
            </div>

            <div class="col-12">

                <div class="">
                    <ul class="justify-content-center d-flex ms-n3 nav">
                    <li class="nav-item">
                        <a class="nav-link pe-1" href="https://www.facebook.com/" target="_blank">
                            <i class="text-lg bi bi-facebook"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link pe-1" href=""
                        target="_blank">
                        <i class="text-lg bi bi-instagram opacity-8"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link pe-1" href=""
                        target="_blank">
                        <i class="text-lg bi bi-youtube opacity-8"></i>
                        </a>
                    </li>
                    </ul>
                </div>

                <div class="">
                    <ul class="justify-content-center d-flex ms-n3 nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                            target="_blank">
                            Visitor : {{ $visitor['yearlyVisitors'] ?? null }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_blank">
                            Today : {{ $visitor['todayVisitors'] ?? null }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" target="_blank">
                        Online : {{ $visitor['onlineVisitors'] ?? null }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <p class="my-1 text-sm text-dark font-weight-normal">
                    All rights reserved. Copyright ©
                    {{ date('Y') ?? '2025' }}
                    {{ $footer[0]['value'][0]['data']['content'] ?? null }}
                    by <a href="" target="_blank">E-Govorment</a>.
                    </p>
                </div>
            </div>
        </div>
        </div>
    </footer>
  </div>

