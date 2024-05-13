<div>
    <div class="text-2xl font-medium">
        <span>User Lists</span>
    </div>
    @foreach ($userData as $item)
        <div class="my-5 bg-gray-100 px-2 py-2 rounded flex justify-between">
            <div class="w-full">
                <span>Name</span>
                <span class="block">{{ @$item->name }}</span>
            </div>
            <div class="w-full">
                <span>Username</span>
                <span class="block">{{ @$item->username }}</span>
            </div>
            <div class="w-full">
                <span>Email</span>
                <span class="block">{{ @$item->email }}</span>
            </div>
            <div class="w-full">
                <span>Role</span>
                <span class="block">{{ @$item->role }}</span>
            </div>
            <div class="flex gap-x-2 items-center">
                <button class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="deleteUser({{ $item->id }})"><i class="fa-solid fa-trash"></i></button>
                <button class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="openForm({{ $item->id }})"><i class="fa-solid fa-bars"></i></button>
            </div>
        </div>
    @endforeach
</div>