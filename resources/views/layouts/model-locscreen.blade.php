<div id="modal" tabindex="-1" aria-hidden="true" style="background: rgba(0, 0, 0, 0.4)" class="hidden animate-fade-down animate-once animate-duration-500 animate-ease-in-out overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" id="close-modal" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5">
                <div class="flex gap-x-1 items-center">
                    <img src="{{ asset('/gif/notification.gif') }}" class="w-[35px]" alt="">
                    <span>นีคือการแจ้งเตือนจากระบบ</span>
                </div>
                <div class="py-2 text-[14px] ">
                    <span>คุณไม่ได้มีการใช้งานระบบ ระบบจะนำคุณไปยังหน้า Lock screen ภายใน : <span id="countdown"></span></span>
                </div>
                <div class="flex justify-end items-center mt-2 gap-x-2">
                    <button type="button" class="border border-red-600 px-5 py-2 text-red-600 rounded-md duration-150 ease-in-out hover:bg-red-500 hover:text-white">
                        <span>ออกจากระบบ</span>
                    </button>
                    <button id="close-modal-2"  class="bg-blue-500 px-5 py-2 text-white rounded-md duration-150 ease-in-out hover:bg-blue-400">
                        <span>อยู่หน้านี้ต่อ</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> 