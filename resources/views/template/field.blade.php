<div class="card-body">
    <div class="row">
        <div class="form-group col-md-6 fv-row mb-3">
            <label role="nabtn btn-sm btn-primary p-3 m-1me" class="form-label fw-bolder text-dark fs-6">Name</label>
            <div class="position-relative mb-3">
                <input type="name" name="name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name" />
                @error('nama')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>

        <div class="form-group col-md-6 fv-row mb-3">
            <label role="template" class="form-label fw-bolder text-dark fs-6">Template</label>
            <div class="position-relative mb-3">
                <input type="file" name="template" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}"  />
                @error('template')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <a href="{{ route('branchs.show', e($branch_data->id)) }}" class="btn btn-secondary">Back</a>
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
