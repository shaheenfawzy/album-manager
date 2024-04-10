@foreach ($pictures as $picture)
	<div class="px-3 md:w-1/2 lg:w-1/3">
		<div class="card bg-base-100 shadow-xl h-full">
			<span class="remove-file-item btn btn-circle btn-ghost btn-sm absolute right-1 top-1"
				onclick="deleteItem('{{ route("pictures.destroy", $picture->id) }}')"
			>✕</span>
			<figure class="max-w-[200px] mx-auto">
				<img src="{{ $picture->path }}" alt="{{ $picture->name }}" />
			</figure>

			<div class="card-body items-center text-center justify-end flex">
				<h2 class="card-title">{{ $picture->name }}</h2>
				<div class="card-actions justify-center">
					<label
						class="btn btn-warning w-7/12"
						for="picturesEditModal"
						href="javascript:;"
						onclick="openEditModal('{{ $picture->id }}')"
					>
						<i class="fa fa-pencil"></i> {{ __("Edit Picture") }}
					</label>
					<a class="btn btn-primary w-7/12" href="{{ route("pictures.download", $picture->id) }}">
						<i class="fa fa-arrow-down"></i> {{ __("Download Picture") }}
					</a>
				</div>
			</div>
		</div>
	</div>
@endforeach

@pushOnce("scripts")
	<script type="module">
		window.openEditModal = (pictureId) => {
			$.ajax({
				url: route('pictures.edit', pictureId),
				success: (data) => {
					$("#picturesEditFormContainer").html(data.html)
				}
			})
		}
		window.deleteItem = (endpoint) => {
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d33",
				cancelButtonColor: "#3085d6",
				confirmButtonText: "Yes, delete it!",
			}).then((result) => {
				if (result.isConfirmed) {
					const crsf = $("meta[name=csrf-token]").attr("content");
					const methodInput = $("<input name='_method' value='DELETE'>");
					const csrfInput = $(`<input name='_token' value='${crsf}'>`);

					const form = $("<form>")
						.addClass("hidden")
						.attr("method", "POST")
						.attr("action", endpoint)
						.append(methodInput)
						.append(csrfInput);

					$("body").append(form);

					form.trigger("submit");
				}
			});
		}
	</script>
@endPushOnce
