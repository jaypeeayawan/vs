@section('page-title')
    {{ $pageTitle }}
@endsection

<div class="mt-20 mb-20">

    <div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="first" data-wizard-clickable="false">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">

                            <div class="text-center mb-10">
                                <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                    <div class="symbol-label" style="background-image:url('assets/media/users/300_21.jpg')"></div>
                                    <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                </div>
            
                                <h4 class="font-weight-bold my-2">
                                    {{ $voter->persons->lastname }}, {{ $voter->persons->firstname }} {{ $voter->persons->middlename }}
                                </h4>
                                <span class="label label-light-success label-inline font-weight-bold label-lg">Voters ID : {{ $voter->votersnumber }}</span>
                            </div>

                            <!--begin::Wizard Step 1 Nav-->
                            <div class="wizard-steps">
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-2x">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>                            
                                        </div>
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                                Voting Ballot
                                            </h3>
                                            <div class="wizard-desc">
                                                Select candidates
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->

                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-2x">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Like.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z" fill="#000000"></path>
                                                        <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1"></rect>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>                            
                                        </div>
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                                Completed!
                                            </h3>
                                            <div class="wizard-desc">
                                                Review and Submit
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                            </div>
                        </div>
                        <!--end: Wizard Nav-->

                        <!--begin: Wizard Body-->
                        <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                            <!--begin: Wizard Form-->
                            <div class="row">
                                <div class="offset-xxl-2 col-xxl-8">
                                    <form class="form fv-plugins-bootstrap fv-plugins-framework" id="election_form">
                                        <!--begin: Wizard Step 1-->
                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                            <h4 class="mb-10 font-weight-bold text-dark">
                                                {{ ($form) ? $form->title : 'Voting Ballot' }}
                                            </h4>

                                            <!--begin::Input-->
                                            @if ($vote)
                                                <div class="alert alert-custom alert-danger" role="alert">
                                                    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                                                    <div class="alert-text">You already voted for this election</div>
                                                </div>
                                            @else
                                                @if ($form)
                                                    {!! $candidates !!}
                                                @else
                                                    <div class="alert alert-custom alert-danger" role="alert">
                                                        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                                                        <div class="alert-text">Election is closed</div>
                                                    </div>
                                                @endif
                                            @endif
                                            <!--end::Input-->

                                        </div>
                                        <!--end: Wizard Step 1-->

                                        <!--begin: Wizard Step 2-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <!--begin::Section-->
                                            <h4 class="mb-10 font-weight-bold text-dark">Review and Submit</h4>
                                            <div id="selected-candidates"></div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end: Wizard Step 2-->

                                        <!--begin: Wizard Actions-->
                                        <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                            <div class="mr-2">
                                                <button type="button" class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">
                                                    Previous
                                                </button>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">
                                                    Submit
                                                </button>
                                                <button type="button" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                        <!--end: Wizard Actions-->
                                    
                                    </form>
                                </div>
                                <!--end: Wizard-->
                            </div>
                            <!--end: Wizard Form-->
                        </div>
                        <!--end: Wizard Body-->
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>
		</div>
		<!--end::Container-->
	</div>

</div>
