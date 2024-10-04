<x-header />

<div class="flex w-full flex-col">
	<div class="w-full m-5 mt-10">
		<p class="font-bold text-xl">Hasil pencarian kos {{$location}}</p>
	</div>

	{{-- <div class="flex w-11/12 gap-16 mx-auto justify-center items-center flex-wrap" id="skeleton">
		@for ($i = 1; $i <= 12; $i++)
			<x-skeleton-room />
		@endfor
	</div> --}}
	<div class="flex w-11/12 gap-16 mx-auto justify-center items-center flex-wrap" id="skeleton">
		@foreach ($datas as $data)
			<x-room :data="$data" />
		@endforeach
	</div>
</div>
