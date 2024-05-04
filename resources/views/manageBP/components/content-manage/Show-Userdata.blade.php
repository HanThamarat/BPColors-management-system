<div>
    <div class="text-2xl font-medium">
        <span>User Lists</span>
    </div>
    @foreach ($userData as $item)
        <div class="my-5 bg-gray-100 px-2 py-2 rounded flex justify-between">
            <div>
                <span>Name</span>
                <span class="block">Thamarat Loasen</span>
            </div>
            <div>
                <span>Name</span>
                <span class="block">Thamarat Loasen</span>
            </div>
            <div>
                <span>Name</span>
                <span class="block">Thamarat Loasen</span>
            </div>
            <div class="flex gap-x-2 items-center">
                <button class="w-10 h-10 rounded bg-white drop-shadow text-blue-500"><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
    @endforeach
</div>