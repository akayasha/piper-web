<div class="card-body">
    <div class="row">

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
                <!--begin::Label-->
                <label role="branch_id" class="form-label fw-bolder text-dark fs-6">Branch</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <select name="branch_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select">
                        @foreach ($branches as $branch)
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
                    <input type="text" name="code" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->code : '' }}" placeholder="Input Code"/>
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
                <select name="type" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select" readonly>
                    <option value="offline" selected>Offline</option>
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
                    <input type="number" name="strip" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->strip : '' }}" placeholder="Input strip"/ max="8">
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
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
