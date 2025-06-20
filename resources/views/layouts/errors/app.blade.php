<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        @include('layouts.errors.head')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg">
		<!--begin::Main-->
		<!--begin::Root-->
        @yield('content')
		<!--end::Root-->
		<!--end::Main-->

        <!--begin::Javascript-->
        @include('layouts.errors.script')
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
