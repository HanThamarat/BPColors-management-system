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
                        <button class="w-5 h-5 justify-center flex items-center rounded-full hover:bg-blue-500 hover:text-white duration-100 ease-in-out" wire:click.prevent="{{ $eventClose }}">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                    {{ $slot }}
                <div class="mt-5 flex justify-end">
                    <button wire:loading.class.add="hidden" class="py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out mr-2" wire:click.prevent="{{ $eventSave }}">Save Data</button>
                    <button wire:loading class="py-2 px-5 rounded bg-blue-400 text-white mr-2">@component('components.content-Loading.spinner') @endcomponent</button>
                </div>         
            </form>
        </div>
    </div>
</div>