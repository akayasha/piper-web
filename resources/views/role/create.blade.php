@extends('layouts.dashboard.app')
@section('title', $title ?? 'Super Admin')
@section('subtitle' , 'Super Admin')
@section('head')
<link href="{{ asset('template/base-admin/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('script')
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/table.js') }}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/scripts.bundle.js') }}"></script>
@endsection
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <!--end::Svg Icon-->
                        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Buat Data {{$title ?? ''}}</h1>
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--end::Export-->
                        <!--begin::Add user-->
                        <!--end::Svg Icon-->
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <form method="POST" action="{{ route('roles.store') }}" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                @csrf
                @include($view.'field')
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
