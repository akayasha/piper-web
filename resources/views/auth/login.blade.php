@extends('layouts.auth.app')
@section('title' , 'Login')
@section('content')
<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route($route. 'store') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">Sign In to Piper Admin Panel</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label for="email" class="form-label fs-6 fw-bolder text-dark">Email</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input id="email" class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                <!--end::Label-->
                <!--begin::Link-->
                {{-- <a href="{{route('authentications.forgot-password')}}" class="link-primary fs-6 fw-bolder">Forget Password ?</a> --}}
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Input-->
            <input id="password" class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100">
                <span class="indicator-label">Sign In</span>
                <span class="indicator-progress">Please Wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Submit button-->
            <!--begin::Separator-->
            {{-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div> --}}
            <!--end::Separator-->
            <!--begin::Google link-->
            {{-- <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="{{asset('template/base-admin/dist/assets/media/svg/brand-logos/google-icon.svg')}}" class="h-20px me-3" />Continue with Google</a> --}}
            <!--end::Google link-->
            <!--begin::Facebook-->
            {{-- <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="{{asset('template/base-admin/dist/assets/media/svg/brand-logos/facebook-4.svg')}}" class="h-20px me-3" />Continue with Facebook</a> --}}
            <!--end::Facebook-->
            <!--begin::Apple-->
            {{-- <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
            <img alt="Logo" src="{{asset('template/base-admin/dist/assets/media/svg/brand-logos/apple-black.svg')}}" class="h-20px me-3" />Continue with Apple</a> --}}
            <!--end::Apple-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
@endsection
