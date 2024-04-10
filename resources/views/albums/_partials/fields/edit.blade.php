<form
	id="albumsEditForm"
	method="POST"
	enctype="multipart/form-data"
	action="{{ route("albums.update", $album->id) }}"
>
	@csrf
	@method("PATCH")

	<label class="form-control w-full">
		<div class="label">
			<span class="label-text">Album Name</span>
		</div>
		<input
			class="input input-bordered w-full"
			name="name"
			type="text"
			required
			pattern=".{3,255}"
			placeholder="Type here"
		/>
	</label>

</form>
