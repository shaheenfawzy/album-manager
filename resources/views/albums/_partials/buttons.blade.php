<div class="card-body items-center text-center justify-end flex">
	<h2 class="card-title">{{ $album->name }}</h2>
	<div class="card-actions justify-center flex">
		<label
			class="btn btn-warning w-7/12"
			for="albumEditModal"
			href="javascript:;"
			onclick="openEditModal('{{ $album->id }}')"
		>
			<i class="fa fa-pencil"></i> {{ __("Edit album") }}
		</label>
		<a class="btn btn-primary w-7/12" href="{{ route("albums.pictures.index", $album->id) }}">
			<i class="fa fa-eye"></i> {{ __("Show pictures") }}
		</a>
	</div>
</div>

