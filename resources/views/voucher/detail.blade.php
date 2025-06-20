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
                                <label role="branch_id" class="form-label fw-bolder text-dark fs-6">Branch</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <select name="branch_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select" disabled>
                                        <option></option>
                                        @foreach ($branchs as $branch)
                                            <option value="{{ $branch->id }}" {{ isset($data) && $data->branch_id == $branch->id ? 'selected' : '' }}>
                                                {{$branch->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                            <!--end::Wrapper-->
                        </div>
                
                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="code" class="form-label fw-bolder text-dark fs-6">Code</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="text" name="code" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->code : '' }}" placeholder="Input Code"/ readonly>
                                    @error('code')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                            <!--end::Wrapper-->
                        </div>
                
                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="type" class="form-label fw-bolder text-dark fs-6">Type</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <select name="type" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select" disabled>
                                        <option></option>
                                        <option value="online" {{ isset($data) && $data->type == 'online' ? 'selected' : '' }}>Online</option>
                                        <option value="offline" {{ isset($data) && $data->type == 'offline' ? 'selected' : '' }}>Offline</option>
                                    </select>                    
                                    @error('type')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="strip" class="form-label fw-bolder text-dark fs-6">Strip</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="number" name="strip" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->strip : '' }}" placeholder="Input Number Of Photo"/ max="8" readonly>
                                    @error('strip')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
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
