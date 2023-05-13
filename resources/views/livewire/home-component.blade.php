@section('page-title')
    {{ $pageTitle }}
@endsection

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row-fluid" id="">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('assets/media/bg/bg-3.jpg') }}');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
        
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{{ asset('assets/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt=""/>
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <!--begin::Stats Widget 16-->
                        <a href="{{ route('login') }}" class="card card-custom card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
                                            <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5">Sign In</div>
                                <div class="font-weight-bold text-inverse-white font-size-sm">System Administration</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 16-->
                    </div>
                    <div class="col-lg-4">
                        <!--begin::Stats Widget 17-->
                        <a href="{{ route('voters.portal') }}" class="card card-custom bg-info bg-hover-state-info card-stretch card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-info font-weight-bolder font-size-h5 mb-2 mt-5">Vote</div>
                                <div class="font-weight-bold text-inverse-info font-size-sm">Voters Portal</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 17-->
                    </div>
                    <div class="col-lg-4">
                        <!--begin::Stats Widget 18-->
                        <a href="{{ route('voters.registration') }}" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">Register</div>
                                <div class="font-weight-bold text-inverse-dark font-size-sm">Voters Registration</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
