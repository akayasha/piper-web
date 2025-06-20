<div class="card-body">
    <div class="row">

        <div class="form-group col-md-6 mb-3">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label role="name" class="form-label fw-bolder text-dark fs-6">Nama</label>
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
                <label role="email" class="form-label fw-bolder text-dark fs-6">Email</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->email : '' }}"/>
                    @error('email')
                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                    @enderror
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>

        <div class="form-group col-md-6 mb-3" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label role="password" class="form-label fw-bolder text-dark fs-6">Kata Sandi</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input type="password" name="password" class="form-control form-control-lg form-control-solid" autocomplete="off" />
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                    @error('password')
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
