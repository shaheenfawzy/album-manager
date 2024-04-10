<input class="modal-toggle" id="albumEditModal" type="checkbox" />

<div class="modal modal-bottom lg:modal-middle" role="dialog">
	<div class="modal-box">
		<label class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2" for="albumEditModal">✕</label>
		<h3 class="mb-3 text-center text-lg font-bold">Edit album</h3>

		<div class="pb-3" id="albumEditFormContainer"></div>

		<div class="flex justify-end">
			<label class="btn" for="albumEditModal">Close</label>
			<button
				class="btn btn-outline btn-success ms-3"
				form="albumsEditForm"
				for="albumsEditModal"
				type="submit"
			>Save</button>
		</div>
	</div>
	<label class="modal-backdrop" for="albumEditModal">Close</label>
</div>
