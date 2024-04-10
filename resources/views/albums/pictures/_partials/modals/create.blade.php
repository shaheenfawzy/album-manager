<input class="modal-toggle" id="picturesCreateModal" type="checkbox" />

<div class="modal modal-bottom lg:modal-middle" role="dialog">
	<div class="modal-box lg:w-11/12 lg:max-w-3xl">
		<label class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2" for="picturesCreateModal">✕</label>
		<h3 class="mb-3 text-center text-lg font-bold">{{ __("Add new pictures") }}</h3>

		<form
			id="picturesCreateForm"
			method="POST"
			enctype="multipart/form-data"
			action="{{ route("albums.pictures.store", $album->id) }}"
		>
			@csrf
			<span>Pictures: </span>

			@include("_partials.file-picker", [
				"fieldsView" => "albums.pictures._partials.fields.create",
				"fileName" => "path",
				"fileItemPrefix" => "pictures",
				"successCallback" => "picturesAddSuccess",
			])
		</form>
		<div class="flex justify-end">
			<label class="btn" for="picturesCreateModal">Close</label>
			<button
				class="btn btn-outline btn-success ms-3"
				form="picturesCreateForm"
				for="picturesCreateModal"
				type="submit"
			>Save</button>
		</div>
	</div>
	<label class="modal-backdrop" for="picturesCreateModal">Close</label>
</div>

@pushOnce("scripts")
	<script type="module">
		window.picturesAddSuccess = (response) => {
			$("#picturesCreateModal").trigger('click')
			$("#picturesContainer").html(response.html)
		}
	</script>
@endPushOnce
