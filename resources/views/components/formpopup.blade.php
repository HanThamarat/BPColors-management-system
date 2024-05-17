@props(['Data','eventClose','eventSave','title','icon','openForm'])

<style>
    .popup__style {
        background: rgba(0, 0, 0, 0.5)
    }
</style>

<div id="popup-modal" tabindex="-1" class="popup__style {{ $openForm ? '' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 flex">
    <div class="relative p-4 w-5/6">
        <div class="relative bg-white rounded-lg shad py-8 px-4">
            <form>
                <div class="text-blue-600 border-b pb-4 flex justify-between items-center">
                    <div>
                        <i class="{{ $icon }}"></i>
                        <span>{{ $title }}</span>
                    </div>
                    <div>
                        <button wire:loading.class="bg-blue-500" wire:target="{{ $eventClose }}" class="w-5 h-5 justify-center flex items-center rounded-full hover:bg-blue-500 hover:text-white duration-100 ease-in-out" wire:click.prevent="{{ $eventClose }}">
                            <i wire:loading.class="hidden" wire:target="{{ $eventClose }}" class="fa-solid fa-xmark"></i>
                                <div wire:loading wire:target="{{ $eventClose }}" role="status">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                        </button>
                    </div>
                </div>
                    {{ $slot }}
                <div class="mt-5 flex justify-end">
                    <button wire:loading.class.add="hidden" wire:target="{{ $eventSave }}" class="py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out mr-2" wire:click.prevent="{{ $eventSave }}">Save Data</button>
                    <button wire:loading wire:target="{{ $eventSave }}" class="py-2 px-5 rounded bg-blue-400 text-white mr-2">@component('components.content-Loading.spinner') @endcomponent</button>
                </div>         
            </form>
        </div>
    </div>
</div>