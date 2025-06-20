@extends('layouts.dashboard.app')
@section('title', $title ?? 'Admin')
@section('subtitle' , 'Add ' . $title)
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
            <!--begin::Card body-->
            <form method="POST" action="{{ route('admins.store') }}" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
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
