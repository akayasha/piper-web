<div class="card-body">
    <div class="row">

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
                <!--begin::Label-->
                <label role="user_id" class="form-label fw-bolder text-dark fs-6">PIC Branch</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <select name="user_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select">
                        <option></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($data) && $data->user_id == $user->id ? 'selected' : '' }}>
                                {{$user->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                    @enderror
                </div>
            <!--end::Wrapper-->
        </div>

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
            <!--begin::Label-->
            <label role="name" class="form-label fw-bolder text-dark fs-6">Name</label>
            <!--end::Label-->
            <!--begin::Input wrapper-->
            <div class="position-relative mb-3">
                <input type="text" name="name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name"/>
                @error('name')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
                @enderror
            </div>
            <!--end::Wrapper-->
        </div>

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
            <!--begin::Label-->
            <label role="price" class="form-label fw-bolder text-dark fs-6">Price</label>
            <!--end::Label-->
            <!--begin::Input wrapper-->
            <div class="position-relative mb-3">
                <input type="in" name="price" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->price : '' }}" placeholder="Input Price"/>
                @error('price')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
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
                <input type="text" name="phone" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->phone : '' }}" placeholder="Input Phone"/>
                @error('phone')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
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
                <textarea name="address" class="form-control form-control-lg form-control-solid mb-3" rows="4" placeholder="Input Address">{{ isset($data) ? $data->address : '' }}</textarea>
                @error('address')
                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }}!</p>
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
