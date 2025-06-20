<div class="card-body">
    <div class="row">

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
                <!--begin::Label-->
                <label role="name" class="form-label fw-bolder text-dark fs-6">Name</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input type="name" name="name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name"/>
                    @error('nama')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                    @enderror
                </div>
            <!--end::Wrapper-->
        </div>

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
                <!--begin::Label-->
                <label role="template" class="form-label fw-bolder text-dark fs-6">Template</label>
                <!--end::Label-->

                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
					<textarea name="template" class="form-control form-control-lg form-control-solid mb-3" rows="3" data-kt-element="input">{{ isset($data) ? $data->template : '' }}</textarea>
                    @error('template')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                    @enderror
                </div>
                <!--end::Input wrapper-->
        </div>


    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <a href="{{ route($route.'index') }}" class="btn btn-secondary">Back</a>
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
