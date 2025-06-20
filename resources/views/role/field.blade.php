<div class="card-body">
    <div class="row">

        <div class="form-group col-md-6 mb-3">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6">Nama</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input type="name" name="name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->name : '' }}"/>
                    @error('name')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                    @enderror
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>

        <div class="form-group col-md-6 mb-3">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label role="guard_name" class="form-label fw-bolder text-dark fs-6">Nama Penjaga</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input type="text" name="guard_name" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->guard_name : '' }}"/>
                    @error('guard_name')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                    @enderror
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>

    </div>
</div>
<div class="card-footer d-flex justify-content-between">
    <a href="{{ route($route.'index') }}" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary mr-1" type="submit">Simpan</button>
</div>
