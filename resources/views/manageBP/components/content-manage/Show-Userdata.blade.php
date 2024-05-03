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
            <div class="flex gap-x-2">
                <button class="border px-2 py-2"><i class="fa-solid fa-trash"></i></button>
                <button><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
    @endforeach
</div>