<x-app-layout>
	<div class="py-12">
		<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
				<h1 class="pt-3 text-center text-6xl">{{ $album->name }} Picutres</h1>

				<div class="flex justify-center pt-3">
					<label class="btn btn-primary btn-lg" for="picturesCreateModal">{{ __("Add Pictures") }}</label>
				</div>

				<div class="flex flex-row flex-wrap items-stretch justify-start gap-y-7 p-6 text-gray-900" id="picturesContainer">
					@include("albums.pictures._partials.items")
				</div>
				<div class="flex justify-center py-3">
					<div class="w-6/12">
						{{ $pictures->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

	@include("albums.pictures._partials.modals.create")
	@include("albums.pictures._partials.modals.edit")

</x-app-layout>
