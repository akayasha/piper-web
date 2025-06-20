<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        @include('layouts.auth.head')
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
        @include('sweetalert::alert')
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url('{{ asset('template/base-admin/dist/assets/media/illustrations/sketchy-1/14.png') }}">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="{{ route($route.'login') }}" class="mb-12">
						<img alt="Logo" src="{{asset('assets/pipper/logo-admin.png')}}" class="h-75px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
                    @yield('content')
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="https://www.instagram.com/dimdevs_" class="text-muted text-hover-primary px-2">About</a>
						<a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
						<a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
        @include('layouts.auth.script')
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
