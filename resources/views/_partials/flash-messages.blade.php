<script type="module">
	@foreach (["success", "error"] as $type)
		@session($type)
			Toast.fire({
				title: "{{ ucfirst($type) }}",
				text: "{{ $value }}",
				icon: "{{ $type }}"
			});
		@endsession
	@endforeach
</script>
