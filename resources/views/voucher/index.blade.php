@extends('layouts.dashboard.app')
@section('title', $title ?? 'Voucher')
@section('subtitle', $subtitle ?? 'Voucher')
@section('head')
@endsection

@section('script')
    @include('voucher.datatable.script')
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
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end gap-3" data-kt-user-table-toolbar="base">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#generateModal">
                                Generate Code Automatic
                            </button>

                            <a href="{{ route($route . 'create') }}" class="btn btn-primary">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="black" />
                                    </svg>
                                </span>
                                Add {{ $title ?? 'Voucher' }}
                            </a>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_voucher">
                            <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th>No</th>
                                    <th>Branch</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Strip</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold">
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route($route.'generate-code-auto') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="generateModalLabel">Generate Code Automatic</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 fv-row mb-3">
                                        <label role="branch_id" class="form-label fw-bolder text-dark fs-6">Branch <span class="text-danger">*</span></label>
                                        <div class="position-relative mb-3">
                                            <select name="branch_id" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true" data-placeholder="Select">
                                                @foreach ($branchs as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ isset($data) && $data->branch_id == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <p style="font-size: 12px;"
                                                    class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 fv-row mb-3">
                                        <label role="strip" class="form-label fw-bolder text-dark fs-6">Strip <span class="text-danger">*</span></label>
                                        <div class="position-relative mb-3">
                                            <input type="number" name="strip"
                                                class="form-control form-control-lg form-control-solid" autocomplete="off"
                                                value="{{ isset($data) ? $data->strip : '' }}" placeholder="Input Strip"/
                                                max="8">
                                            @error('strip')
                                                <p style="font-size: 12px;"
                                                    class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 fv-row">
                                        <label role="total_generate" class="form-label fw-bolder text-dark fs-6">Jumlah total Generate <span class="text-danger">*</span></label>
                                        <div class="position-relative mb-3">
                                            <input type="number" name="total_generate"
                                                class="form-control form-control-lg form-control-solid" autocomplete="off"
                                                value="{{ isset($data) ? $data->total_generate : '' }}"
                                                placeholder="Input Total Generate" />
                                            @error('total_generate')
                                                <p style="font-size: 12px;"
                                                    class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}
                                                    !</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <a href="{{ route($route . 'index') }}" class="btn btn-secondary" data-bs-dismiss="modal">Back</a>
                            <button class="btn btn-primary mr-1" type="submit">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
