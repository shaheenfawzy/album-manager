<div class="px-3 md:w-1/2 lg:w-1/3">
	<div class="card bg-base-100 shadow-xl h-full relative">
		<span class="remove-file-item btn btn-circle btn-ghost btn-sm absolute right-1 top-1"
			onclick="deleteItem('{{ route("albums.destroy", $album->id) }}', true, '{{ $album->id }}')"
		>✕</span>
		<figure class="max-w-[200px] mx-auto rounded-none">
			<a href="{{ $url }}">
				<img src="{{ $image }}" alt="{{ $title }}" />
			</a>
		</figure>
		@include($buttonsView)
	</div>
</div>
