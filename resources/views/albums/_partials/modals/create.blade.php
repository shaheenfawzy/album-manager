<input class="modal-toggle" id="albumCreateModal" type="checkbox" />

<div class="modal modal-bottom lg:modal-middle" role="dialog">
	<div class="modal-box lg:w-11/12 lg:max-w-3xl">
		<label class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2" for="albumCreateModal">✕</label>
		<h3 class="mb-3 text-center text-lg font-bold">Add a new Album</h3>

		<form
			class="pb-3"
			id="albumCreateForm"
			method="POST"
			enctype="multipart/form-data"
			action="{{ route("albums.store") }}"
		>
			@csrf
			<label class="form-control w-full">
				<div class="label">
					<span class="label-text">Album Name</span>
				</div>
				<input
					class="input input-bordered w-full"
					name="name"
					type="text"
					placeholder="Type here"
					required
				/>

			</label>

			@include("_partials.file-picker", [
				"fieldsView" => "albums.pictures._partials.fields.create",
				"fileName" => "path",
				"fileItemPrefix" => "pictures",
				"successCallback" => "albumAddSuccess",
			])
		</form>
		<div class="flex justify-end">
			<label class="btn" for="albumCreateModal">Close</label>
			<button
				class="btn btn-outline btn-success ms-3"
				form="albumCreateForm"
				for="albumCreateModal"
				type="submit"
			>Save</button>
		</div>
	</div>
	<label class="modal-backdrop" for="albumCreateModal">Close</label>
</div>

@pushOnce("scripts")
	<script type="module">
		window.albumAddSuccess = (response) => {
			$("#albumCreateModal").trigger('click');

			setTimeout(() => {
				window.location = route("albums.pictures.index", response.albumId)
			}, 1500);
		}
	</script>
@endPushOnce
