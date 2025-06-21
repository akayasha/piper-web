@extends('layouts.dashboard.app')
@section('title', $title ?? 'Transaction')
@section('subtitle', $subtitle ?? 'Transaction')
@section('head')
@endsection

@section('script')
    @include('transaction.datatable.script')
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
                    {{-- <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative gap-3 my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
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
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search" />

                            @if (!auth()->user()->branch_id)
                            <select name="branch_id" id="branch_id" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true" data-placeholder="Select Branch">
                                <option value="all" selected>Select Branch</option>
                                @foreach ($branches as $brch)
                                    <option value="{{ $brch->id }}">{{ $brch->name }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <!--end::Search-->
                    </div> --}}
                    <!--begin::Card title-->

                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search and Filters-->
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 w-100">
                            <!-- Search and Branch Filter -->
                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 flex-grow-1 w-100">
                                <!-- Search Input -->
                                <div class="position-relative w-100 w-md-250px">
                                    <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <input type="text" data-kt-user-table-filter="search"
                                        class="form-control form-control-solid ps-14" placeholder="Search" />
                                </div>
                    
                                @if (!auth()->user()->branch_id)
                                <div class="w-100 w-md-200px">
                                    <select name="branch_id" id="branch_id" class="form-select form-select-solid"
                                        data-control="select2" data-hide-search="true" data-placeholder="Select Branch">
                                        <option value="all" selected>Select Branch</option>
                                        @foreach ($branches as $brch)
                                            <option value="{{ $brch->id }}">{{ $brch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                    
                                <!-- Date Range Filter -->
                                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-2 w-100">
                                    <div class="d-flex align-items-center gap-2 w-100">
                                        <input type="date" id="start_date" class="form-control form-control-solid w-100" placeholder="Start Date">
                                        <span class="d-none d-md-inline fw-bolder">to</span>
                                        <input type="date" id="end_date" class="form-control form-control-solid w-100" placeholder="End Date">
                                        <button id="apply_date_filter" class="btn btn-primary flex-shrink-0">Apply</button>
                                        <button id="reset_date_filter" class="btn btn-secondary flex-shrink-0">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Search and Filters-->
                    </div>

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end gap-3" data-kt-user-table-toolbar="base">
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end gap-3" data-kt-user-table-toolbar="base">
                                <a href="{{ route('transactions.export') }}" class="btn btn-success">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 62 62" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.5 0C13.3687 0 11.625 1.74375 11.625 3.875V58.125C11.625 60.2562 13.3687 62 15.5 62H54.25C56.3812 62 58.125 60.2562 58.125 58.125V15.5L42.625 0H15.5Z"
                                                fill="#E2E5E7" />
                                            <path
                                                d="M46.5 15.5H58.125L42.625 0V11.625C42.625 13.7563 44.3687 15.5 46.5 15.5Z"
                                                fill="#B0B7BD" />
                                            <path d="M58.125 27.125L46.5 15.5H58.125V27.125Z" fill="#CAD1D8" />
                                            <path
                                                d="M50.375 50.375C50.375 51.4406 49.5031 52.3125 48.4375 52.3125H5.8125C4.74687 52.3125 3.875 51.4406 3.875 50.375V31C3.875 29.9344 4.74687 29.0625 5.8125 29.0625H48.4375C49.5031 29.0625 50.375 29.9344 50.375 31V50.375Z"
                                                fill="#F15642" />
                                            <path
                                                d="M12.3203 36.7099C12.3203 36.1984 12.7233 35.6404 13.3724 35.6404H16.9509C18.9659 35.6404 20.7794 36.9889 20.7794 39.5735C20.7794 42.0225 18.9659 43.3865 16.9509 43.3865H14.3644V45.4325C14.3644 46.1145 13.9304 46.5001 13.3724 46.5001C12.8609 46.5001 12.3203 46.1145 12.3203 45.4325V36.7099ZM14.3644 37.5914V41.4509H16.9509C17.9894 41.4509 18.8109 40.5345 18.8109 39.5735C18.8109 38.4904 17.9894 37.5914 16.9509 37.5914H14.3644Z"
                                                fill="white" />
                                            <path
                                                d="M23.8136 46.5C23.3021 46.5 22.7441 46.221 22.7441 45.5409V36.7408C22.7441 36.1847 23.3021 35.7798 23.8136 35.7798H27.3612C34.4408 35.7798 34.2858 46.5 27.5007 46.5H23.8136ZM24.7901 37.6708V44.6109H27.3612C31.5443 44.6109 31.7303 37.6708 27.3612 37.6708H24.7901Z"
                                                fill="white" />
                                            <path
                                                d="M36.7966 37.7948V40.2573H40.7472C41.3052 40.2573 41.8632 40.8153 41.8632 41.3559C41.8632 41.8674 41.3052 42.2859 40.7472 42.2859H36.7966V45.539C36.7966 46.0815 36.4111 46.498 35.8686 46.498C35.1866 46.498 34.77 46.0815 34.77 45.539V36.7388C34.77 36.1828 35.1885 35.7778 35.8686 35.7778H41.3071C41.9891 35.7778 42.3921 36.1828 42.3921 36.7388C42.3921 37.2348 41.9891 37.7928 41.3071 37.7928H36.7966V37.7948Z"
                                                fill="white" />
                                            <path
                                                d="M48.4375 52.3125H11.625V54.25H48.4375C49.5031 54.25 50.375 53.3781 50.375 52.3125V50.375C50.375 51.4406 49.5031 52.3125 48.4375 52.3125Z"
                                                fill="#CAD1D8" />
                                        </svg>
                                    </span>
                                    Export
                                </a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_transaction">
                            <thead>
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th>No</th>
                                    <th>Branch</th>
                                    <th>Invoice Number</th>
                                    <th>Transaction id</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Strip</th>
                                    <th>Payment Method</th>
                                    <th>Date</th>
                                    {{--  <th>Actions</th>  --}}
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
    </div>
@endsection
