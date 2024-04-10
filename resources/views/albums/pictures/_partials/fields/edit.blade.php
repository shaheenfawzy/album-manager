<form
	id="picturesEditForm"
	method="POST"
	enctype="multipart/form-data"
	action="{{ route("pictures.update", $picture->id) }}"
>
	@csrf
	@method("PATCH")
	<label class="form-control w-full">
		<div class="label">
			<span class="label-text">Picture Name</span>
		</div>
		<input
			class="input input-bordered w-full"
			name="name"
			type="text"
			placeholder="Type here"
		/>
	</label>

	<label class="form-control w-full">
		<div class="label">
			<span class="label-text">Picture</span>
		</div>
		<input
			class="file-input file-input-bordered w-full"
			name="path"
			type="file"
			accept="image/*"
		/>
	</label>

</form>
