@extends('layouts.dashboard.app')
@section('title', $title ?? 'Template')
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
                                <label for="template" class="form-label fw-bolder text-dark fs-6">Template</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <textarea name="template" class="form-control form-control-lg form-control-solid mb-3" rows="3" data-kt-element="input" readonly>{{ isset($data) ? $data->template : '' }}</textarea>
                                    @error('template')
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
