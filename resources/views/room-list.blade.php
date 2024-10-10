<x-header :user="$user" />


<div class="min-h-screen flex flex-col">
    <div class="flex-grow w-full flex justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            @foreach ($rooms as $item)
                <x-room :data="$item" />
            @endforeach
        </div>
    </div>
    
    <x-footer />
</div>