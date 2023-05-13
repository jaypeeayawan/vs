
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--begin::Head-->
    <head>
        <meta charset="utf-8"/>
        <title>VS | Sign In</title>
        <meta name="description" content="Login Page"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>        
        <!--end::Fonts-->

        <!--begin::Page Custom Styles(used by this page)-->
        <link href="{{ asset('assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Page Custom Styles-->

        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Theme Styles-->

        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}"/>
        
        @livewireStyles

    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >

        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            {{ $slot }}
            <!--end::Login-->
        </div>
        <!--end::Main-->

        <!--begin::Global Config(global config for global JS scripts)-->
        <script>
            var KTAppSettings = {
            };
        </script>
        <!--end::Global Config-->

    	<!--begin::Global Theme Bundle(used by all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Theme Bundle-->

        @livewireScripts

    </body>
    <!--end::Body-->
</html>
