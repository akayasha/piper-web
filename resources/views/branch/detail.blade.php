@extends('layouts.dashboard.app')
@section('title', $title ?? 'Branch')
@section('subtitle', 'Detail ' . $title)
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
            <!--begin::Card body-->
            <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                            <!--begin::Label-->
                            <label role="user_id" class="form-label fw-bolder text-dark fs-6">PIC Branch</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <select name="user_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select" disabled>
                                    <option></option>
                                    @if (isset($data) && $data->user_id)
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">Data tidak tersedia</option>
                                    @endif
                                </select>
                                @error('user_id')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
                                @enderror
                            </div>
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                            <!--begin::Label-->
                            <label for="name" class="form-label fw-bolder text-dark fs-6">Name</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" readonly/>
                                @error('name')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
                                @enderror
                            </div>
                            <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                            <!--begin::Label-->
                            <label for="price" class="form-label fw-bolder text-dark fs-6">Price</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input type="text" name="price" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->price : '' }}" readonly/>
                                @error('price')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
                                @enderror
                            </div>
                            <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                            <!--begin::Label-->
                            <label for="phone" class="form-label fw-bolder text-dark fs-6">Phone</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input type="text" name="phone" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->phone : '' }}" readonly/>
                                @error('phone')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
                                @enderror
                            </div>
                            <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-12 fv-row mb-3">
                            <!--begin::Wrapper-->
                            <!--begin::Label-->
                            <label for="address" class="form-label fw-bolder text-dark fs-6">Address</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <textarea name="address" class="form-control form-control-lg form-control-solid mb-4" rows="3" readonly>{{ isset($data) ? $data->address : '' }}</textarea>
                                @error('address')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
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
