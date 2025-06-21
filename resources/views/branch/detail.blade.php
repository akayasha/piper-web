@extends('layouts.dashboard.app')
@section('title', $title ?? 'Branch')
@section('subtitle', 'Detail ' . $title)
@section('head')

@endsection

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card mb-5">
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
                                    <input type="text" name="name"
                                        class="form-control form-control-lg form-control-solid" autocomplete="off"
                                        value="{{ isset($data) ? $data->name : '' }}" readonly />
                                    @error('name')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                            {{ $message }}!</p>
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
                                    <input type="text" name="phone"
                                        class="form-control form-control-lg form-control-solid" autocomplete="off"
                                        value="{{ isset($data) ? $data->phone : '' }}" readonly />
                                    @error('phone')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                            {{ $message }}!</p>
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
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                            {{ $message }}!</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                                <!--end::Wrapper-->
                            </div>

                        </div>
                    </div>

                    @if (isset($data) && $data->priceBranches->isNotEmpty())
                        @foreach ($data->priceBranches as $priceBranch)
                            <div class="card-body">
                                <div id="packages-container">
                                    <div class="row package-item">
                                        <!-- Input Strip -->
                                        <div class="form-group col-md-5 fv-row mb-3">
                                            <label class="form-label fw-bolder text-dark fs-6">Strip</label>
                                            <input type="number" name="strip[]"
                                                class="form-control form-control-lg form-control-solid"
                                                value="{{ $priceBranch->strip }}" placeholder="Input Strip" disabled>
                                        </div>

                                        <!-- Input Price -->
                                        <div class="form-group col-md-5 fv-row mb-3">
                                            <label class="form-label fw-bolder text-dark fs-6">Price</label>
                                            <input type="number" name="price[]"
                                                class="form-control form-control-lg form-control-solid price-input"
                                                value="{{ $priceBranch->price }}" placeholder="Input Price">
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="form-group col-md-2 fv-row mb-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-package-btn"
                                                disabled>Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card-body text-center">
                            <p class="text-muted mb-0">No Price Branches found.</p>
                        </div>
                    @endif
                    

                    {{--  <div class="card-body">
                        <div id="packages-container">
                            <div class="row package-item">
                                <!-- Input Strip -->
                                <div class="form-group col-md-5 fv-row mb-3">
                                    <label class="form-label fw-bolder text-dark fs-6">Strip</label>
                                    <input type="number" name="strip[]" class="form-control form-control-lg form-control-solid" value="{{ isset($data) ? $data->strip : '' }}" placeholder="Input Strip" disabled>
                                    @error('strip[]')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                        {{ $message }}!
                                    </p>
                                    @enderror
                                </div>
                    
                                <!-- Input Price -->
                                <div class="form-group col-md-5 fv-row mb-3">
                                    <label class="form-label fw-bolder text-dark fs-6">Price</label>
                                    <input type="number" name="price[]" class="form-control form-control-lg form-control-solid price-input" value="{{ isset($data) ? number_format($data->price, 0, ',', '.') : '' }}" placeholder="Input Price" readonly>
                                    @error('price[]')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                        {{ $message }}!
                                    </p>
                                    @enderror
                                </div>
                    
                                <!-- Remove Button -->
                                <div class="form-group col-md-2 fv-row mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-package-btn" disabled>Remove</button>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Add Package Button -->
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="button" id="add-package-btn" class="btn btn-primary" disabled>+ Package</button>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route($route . 'index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
                <!--end::Card body-->
            </div>
            <div class="card mb-5">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
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
                            <input type="text" data-kt-pic-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->

            </div>
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
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
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end gap-3" data-kt-user-table-toolbar="base">
                            <button class="btn btn-success" id="refresh-template" type="button">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_162_895)">
                                            <path
                                                d="M23.9999 4.91864L19.6721 4.32806L19.08 8.65622L20.7032 7.42308C21.4426 8.82769 21.8325 10.3988 21.8325 12C21.8325 17.4216 17.4217 21.8325 12 21.8325V23.8668C18.5434 23.8668 23.8668 18.5433 23.8668 12C23.8668 9.95452 23.3396 7.94897 22.3416 6.17841L23.9999 4.91864Z"
                                                fill="white" />
                                            <path
                                                d="M0.133172 12.0001C0.133172 14.0454 0.660375 16.051 1.65844 17.8215L0 19.0814L4.32778 19.672L4.91995 15.3439L3.29681 16.5769C2.55736 15.1722 2.16745 13.6013 2.16745 12.0001C2.1675 6.57841 6.57834 2.16757 12 2.16757V0.13324C5.45663 0.13324 0.133172 5.45669 0.133172 12.0001Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_162_895">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </span>
                            </button>
                            <a href="{{ route('templates.create', $data->id) }}" class="btn btn-primary">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="black" />
                                    </svg>
                                </span>
                                Add Template
                            </a>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_template">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Branch</th>
                                <th>Nama</th>
                                <th>Template</th>
                                <th>Count Photo</th>
                                <th>Updated At</th>
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
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const packagesContainer = document.getElementById("packages-container");
        const addPackageBtn = document.getElementById("add-package-btn");
        let stripCounter = 1;

        const addPackage = () => {
            stripCounter++;
            const packageItem = document.createElement("div");
            packageItem.classList.add("row", "package-item", "mt-3");

            packageItem.innerHTML = `
                <div class="form-group col-md-5 fv-row mb-3">
                    <label class="form-label fw-bolder text-dark fs-6">Strip</label>
                    <input type="number" name="strip[]" class="form-control form-control-lg form-control-solid" value="${stripCounter}" placeholder="Input Strip" disabled>
                </div>
                <div class="form-group col-md-5 fv-row mb-3">
                    <label class="form-label fw-bolder text-dark fs-6">Price</label>
                    <input type="number" name="price[]" class="form-control form-control-lg form-control-solid price-input" value="" placeholder="Input Price">
                </div>
                <div class="form-group col-md-2 fv-row mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-package-btn" disabled>Remove</button>
                </div>
            `;

            packagesContainer.appendChild(packageItem);
            updateRemoveButtonsVisibility();
            validatePriceInputs();
        };

        const updateRemoveButtonsVisibility = () => {
            const removeButtons = packagesContainer.querySelectorAll(".remove-package-btn");
            removeButtons.forEach((button, index) => {
                button.disabled = packagesContainer.children.length <= 1;
            });
        };

        const validatePriceInputs = () => {
            const priceInputs = packagesContainer.querySelectorAll('.price-input');
            let allPricesFilled = true;

            priceInputs.forEach(input => {
                const value = input.value.trim();
                if (!value || parseFloat(value) <= 0) {
                    allPricesFilled = false;
                }
            });

            addPackageBtn.disabled = !allPricesFilled;
        };

        addPackageBtn.addEventListener("click", addPackage);

        packagesContainer.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-package-btn")) {
                const packageItem = e.target.closest(".package-item");
                packagesContainer.removeChild(packageItem);

                const allStripInputs = packagesContainer.querySelectorAll('input[name="strip[]"]');
                stripCounter = 0;
                allStripInputs.forEach((input, index) => {
                    stripCounter++;
                    input.value = stripCounter;
                });

                if (allStripInputs.length === 0) {
                    stripCounter = 1;
                    addPackage();
                }

                updateRemoveButtonsVisibility();
                validatePriceInputs();
            }
        });

        packagesContainer.addEventListener("input", function (e) {
            if (e.target.classList.contains("price-input")) {
                validatePriceInputs();
            }
        });

        updateRemoveButtonsVisibility();
        validatePriceInputs();
    });
</script>
@include('branch.datatable.pic-script')
@include('template.datatable.script')
@endsection
