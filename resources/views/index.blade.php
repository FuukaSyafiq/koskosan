<x-header :user="$user" />


<div class="my-5 w-full justify-center items-center flex h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($datas as $data)
            <x-room :data="$data" />
        @endforeach
    </div>
</div>
