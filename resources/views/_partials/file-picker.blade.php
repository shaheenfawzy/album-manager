<div
	class="file-picker-container"
	data-file-name="{{ $fileName }}"
	data-file-item-prefix={{ $fileItemPrefix }}
	data-success-callback={{ $successCallback ?? "" }}
>
	<div class="my-3 mb-0 w-full border-b-0 relative divide-y-2 file-items-container">
		@include("_partials.file-picker.item")
	</div>

	@include("_partials.file-picker.input")
</div>
