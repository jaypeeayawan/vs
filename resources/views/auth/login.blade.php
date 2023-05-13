<x-guest-layout>
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('assets/media/bg/bg-3.jpg') }}');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{{ asset('assets/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt=""/>
                    </a>
                </div>
                <!--end::Login Header-->
                
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-8">
                        <h3>Sign In</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>

                        <x-jet-validation-errors class="mt-5" />

                    </div>
                    <form method="POST" action="{{ route('login') }}" class="form">
                        @csrf
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign In</button>
                        <a href="{{ route('home') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</a>
                    </div>
                    </form>
                </div> 
                <!--end::Login Sign in form-->
                
            </div>
        </div>
    </div>
</x-guest-layout>
