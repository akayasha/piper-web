@extends('layouts.dashboard.app')
@section('title', $title ?? 'Admin')
@section('subtitle' , 'Detail ' . $title)
@section('head')

@endsection
@section('script')
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/table.js') }}"></script>
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/export-users.js')}}"></script>
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/add.js')}}"></script>
@endsection
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->

            <!--end::Card header-->
            <!--begin::Card body-->
            <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label for="name" class="form-label fw-bolder text-dark fs-6">Name</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="name" name="name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" readonly/>
                                    @error('name')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="phone" class="form-label fw-bolder text-dark fs-6">Phone</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="number" name="phone" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->phone : '' }}" placeholder="Input Phone"/ readonly>
                                    @error('phone')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label for="email" class="form-label fw-bolder text-dark fs-6">Email</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->email : '' }}" readonly/>
                                    @error('email')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label for="password" class="form-label fw-bolder text-dark fs-6">Password</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="password" name="password" class="form-control form-control-lg form-control-solid" autocomplete="off" readonly/>
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                    @error('password')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route($route.'index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
