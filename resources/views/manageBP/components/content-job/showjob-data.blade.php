<x-fullcard>
    <div>
        <div class="txet-1xl font-medium text-blue-600">
            <span>JOB List</span>
        </div>
        @foreach ($getJob as $res)
            <div class="w-full bg-gray-100 rounded my-2 px-4 py-4 flex justify-between items-center">
                <div>
                    <span class="text-blue-600"><i class="fa-solid fa-user-doctor mr-2"></i>JOB NAME</span>
                    <span class="block">{{ @$res->job_name }}</span>
                </div>
                <div>
                    <span class="text-blue-600"><i class="fa-solid fa-percent mr-2"></i>JOB PTC</span>
                        <span class="block">{{ @$res->job_ptc }}</span>
                </div>
                <div class="flex gap-x-2 items-center">
                    <button class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="manage({{ @$res->id }})"><i class="fa-solid fa-pen"></i></button>
                    <button class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="delete({{ @$res->id }})"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        @endforeach
    </div>
</x-fullcard>