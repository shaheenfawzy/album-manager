<input class="modal-toggle" id="picturesEditModal" type="checkbox" />

<div class="modal modal-bottom lg:modal-middle" role="dialog">
	<div class="modal-box">
		<label class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2" for="picturesEditModal">✕</label>
		<h3 class="mb-3 text-center text-lg font-bold">Edit picture</h3>

		<div class="pb-3" id="picturesEditFormContainer"></div>

		<div class="flex justify-end">
			<label class="btn" for="picturesEditModal">Close</label>
			<button
				class="btn btn-outline btn-success ms-3"
				form="picturesEditForm"
				for="picturesEditModal"
				type="submit"
			>Save</button>
		</div>
	</div>
	<label class="modal-backdrop" for="picturesEditModal">Close</label>
</div>
