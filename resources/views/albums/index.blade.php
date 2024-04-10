<x-app-layout>
	<div class="py-12">
		<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
				<h1 class="pt-3 text-center text-6xl">Albums</h1>

				<div class="flex justify-center pt-3">
					<label class="btn btn-primary btn-lg" for="albumCreateModal">{{ __("Add Album") }}</label>
				</div>

				<div class="flex flex-row flex-wrap flex-stretch justify-start gap-y-7 p-6 text-gray-900">
					@foreach ($albums as $album)
						@include("_partials.card", [
							"image" => $album->pictures()->value("path"),
							"title" => $album->name,
							"buttonsView" => "albums._partials.buttons",
							"url" => route("albums.pictures.index", $album->id),
						])
					@endforeach
				</div>
			</div>
		</div>
	</div>

	@include("albums._partials.modals.create")
	@include("albums._partials.modals.edit")

	@pushOnce("scripts")
		<script type="module">
			window.openEditModal = (albumId) => {
				$.ajax({
					url: route('albums.edit', albumId),
					success: (data) => {
						$("#albumEditFormContainer").html(data.html)
					}
				})
			}
		</script>
	@endPushOnce
</x-app-layout>
