<div class="file-item w-full hidden relative">
	<span class="remove-file-item btn btn-circle btn-ghost btn-sm absolute right-1 top-1">✕</span>

	<div class="flex h-full w-full">
		<div
			class="reorder-handle flex cursor-move items-center justify-center bg-slate-100 sm:w-[10%] sm:max-w-[40px] w-[30%] border-e-2 min-h-[150px]"
		>
			<i class="fa-solid fa-bars"></i>
		</div>
		<div class="flex flex-wrap justify-center sm:justify-between item-content w-full">
			<div class="img flex w-5/12 items-center py-0 md:py-4 md:px-3 sm:w-3/12">
				<img class="w-100">
			</div>
			<div class="flex w-11/12 items-center pb-3 pe-4 sm:w-8/12">
				@include($fieldsView)
			</div>
		</div>
	</div>
</div>
