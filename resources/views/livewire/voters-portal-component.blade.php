@section('page-title')
    {{ $pageTitle }}
@endsection

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
                    <h3>Vote</h3>
                    <div class="text-muted font-weight-bold">Enter your details to vote</div>
                </div>
                <form wire:submit.prevent="auth" method="POST" class="form">
                    @csrf
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Voters Number" autocomplete="off" wire:model="votersnumber" />
                        @error('votersnumber') 
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                        <a href="{{ route('home') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</a>
                    </div>
                </form>
            </div> 
            <!--end::Login Sign in form-->
            
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.addEventListener('alert',({detail:{type,message}})=>{
        Swal.fire({
            title: message,
            icon: type,
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // var url = '{{ route("voters.registration") }}';
                // window.location.href = url;
            }
        })
    });
</script>
@endpush
