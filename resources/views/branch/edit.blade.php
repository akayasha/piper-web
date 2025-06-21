@extends('layouts.dashboard.app')
@section('title', $title ?? 'Branch')
@section('subtitle', 'Edit ' . $title)
@section('head')

@endsection
@section('script')
    <script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/table.js') }}"></script>
    <script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/export-users.js') }}"></script>
    <script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/add.js') }}"></script>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <form method="POST" action="{{ route('branchs.update', e($data->id)) }}" class="needs-validation"
                    id="xss-validation" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-6 fv-row mb-3">
                                <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="name" class="form-label fw-bolder text-dark fs-6">Name</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="text" name="name"
                                        class="form-control form-control-lg form-control-solid" autocomplete="off"
                                        value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name" />
                                    @error('name')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                            {{ $message }}!</p>
                                    @enderror
                                </div>
                                <!--end::Wrapper-->
                            </div>

                            <div class="form-group col-md-6 fv-row mb-3">
                                <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="phone" class="form-label fw-bolder text-dark fs-6">Phone</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="number" name="phone"
                                        class="form-control form-control-lg form-control-solid" autocomplete="off"
                                        value="{{ isset($data) ? $data->phone : '' }}" placeholder="Input Phone" />
                                    @error('phone')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                            {{ $message }}!</p>
                                    @enderror
                                </div>
                                <!--end::Wrapper-->
                            </div>

                            <div class="form-group col-md-12 fv-row mb-3">
                                <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label role="address" class="form-label fw-bolder text-dark fs-6">Address</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <textarea name="address" class="form-control form-control-lg form-control-solid mb-3" rows="4"
                                        placeholder="Input Address">{{ isset($data) ? $data->address : '' }}</textarea>
                                    @error('address')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                            {{ $message }}!</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
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

                    <!-- Add Package Button -->
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="button" id="add-package-btn" class="btn btn-primary w-100 w-lg-auto" disabled>+ Package</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route($route . 'index') }}" class="btn btn-secondary">Back</a>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

            packagesContainer.addEventListener("click", function(e) {
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

            packagesContainer.addEventListener("input", function(e) {
                if (e.target.classList.contains("price-input")) {
                    validatePriceInputs();
                }
            });

            updateRemoveButtonsVisibility();
            validatePriceInputs();
        });
    </script>
@endsection
