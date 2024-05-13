<x-fullcard>
    <form>
        <div class="text-2xl font-medium text-blue-600">
            <span>Manage Job</span>
        </div>
        <div class="flex justify-between gap-x-2 items-center w-full my-5">
            <div class="w-full">
                <span>Job name</span>
                <input class="block rounded w-full px-2 py-1" type="text" wire:model="job_name">
                @error('job_name') {{ $message }} @enderror
            </div>
            <div class="w-full">
                <span>Job ptc</span>
                <input class="block rounded w-full px-2 py-1" type="text" wire:model="job_ptc">
                @error('job_ptc') {{ $message }} @enderror
            </div>
        </div>
        <div class="flex items-center justify-end">
            <button id="submit_id" wire:loading.class.remove="hover bg-blue-500" wire:loading.class="bg-blue-400" type="submit" class="rounded bg-blue-500 px-5 py-2 text-white mt-5 hover:bg-blue-400 duration-100 ease-in-out" wire:click.prevent="create">
                <span wire:loading.class="hidden" class="">Create Job</span>
                <div wire:loading>
                    @component('components.content-loading.spinner') @endcomponent
                </div>
            </button>
        </div>
    </form>
</x-fullcard>