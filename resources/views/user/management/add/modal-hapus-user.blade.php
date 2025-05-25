<div class="modal fade" id="kt_modal_delete" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<i class="fas fa-times"></i>
				</div>
			</div>
			<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
				<form class="form" id="kt_modal_delete_form">
					@include('layouts.add.delete-body')
					<div class="text-center">
						<button type="reset" id="kt_modal_delete_cancel" class="btn btn-light me-3 btn-sm w-xl-200px" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" id="kt_modal_delete_submit" class="btn btn-danger btn-sm w-xl-200px">
							<span class="indicator-label">Hapus</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

