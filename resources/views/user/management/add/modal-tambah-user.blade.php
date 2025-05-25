<div class="modal fade" id="kt_modal_tambah_user" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content">
			<div class="modal-header py-3">
				<h5 class="fw-bolder">Tambah User Baru</h5>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<i class="fas fa-times"></i>
				</div>
			</div>
			<div class="modal-body mx-5 mx-xl-15 my-7">
				{{-- <form id="kt_modal_tambah_user_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data"> --}}
				<form id="kt_modal_tambah_user_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
					@csrf
					<div class="row mb-9">
						<div class="col-xl-12 mb-6">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Nama User</span>
							</label>
							<input type="text" class="form-control form-control-solid" placeholder="" required name="name">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-xl-6 col-6 mb-6">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Role</span>
							</label>
							<select class="form-select form-select-solid" data-control="select2" required name="role_id" id="role_id" data-dropdown-parent="#kt_modal_tambah_user" tabindex="-1">
								<option value="" selected hidden disabled>Pilih Dulu</option>
								@foreach ($getRole as $gr)
								<option value="{{$gr->id}}">{{$gr->name}}</option>
								@endforeach
							</select>
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-xl-6 col-6 mb-6">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Email</span>
							</label>
							<input type="email" class="form-control form-control-solid" placeholder="" required name="email">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-xl-12 mb-6">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Site Region</span>
							</label>
							<select class="form-select form-select-solid" data-control="select2" multiple required name="site_region_id[]" id="site_region_id" data-dropdown-parent="#kt_modal_tambah_user" tabindex="-1">
								@foreach ($getRegion as $gs)
								<option value="{{$gs->id}}">{{$gs->region_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xl-6 col-6 mb-6">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Password</span>
							</label>
							<input type="password" class="form-control form-control-solid" placeholder="" confirmed required minlength="8" name="new_password">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-xl-6 col-6 mb-6">
							<label class="d-flex align-items-center fs-6 form-label mb-2">
								<span class="required fw-bold">Konfirmasi Password</span>
							</label>
							<input type="password" class="form-control form-control-solid" placeholder="" required minlength="8" name="new_password_confirmation">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
						<div class="col-xl-12 mb-6">
							<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 align-items-center">
								<i class="fa-solid fa-exclamation-circle fs-2x me-4 text-warning"></i>
								<div class="d-flex flex-stack flex-grow-1">
									<div class="fw-semibold">
										<h5 class="text-dark fw-bold mb-0">Perhatian</h5>
										<div class="fs-7 text-dark">Password minimal berjumlah <span class="text-danger fw-bold">8</span> karakter</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center">
						<button type="reset" id="kt_modal_tambah_user_cancel" class="btn btn-sm btn-light me-3 w-xl-200px" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" id="kt_modal_tambah_user_submit" class="btn btn-sm btn-primary w-xl-200px">
							<span class="indicator-label">Simpan</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>