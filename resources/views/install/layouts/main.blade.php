<html lang="en">
	<head>
		<title>{{ __('Install system web') }}</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="{{ asset(config('app.logo_favicon')) }}" />
		<link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column">
                @include('install.layouts.menu')
                <div class="d-flex flex-column flex-lg-row-fluid py-10">
                    @yield('content')
                    @include('install.layouts.footer')
                </div>
            </div>
        </div>
		<script>var hostUrl = "{{ asset('assets/admin') }}";</script>
		<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
        @include('admin.components.toastr')
		@yield('footer')
	</body>
</html>
