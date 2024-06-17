<x-fullcard>
    <div class="flex justify-start w-full gap-x-10">
        <div class="w-full relative">
            <div class="flex items-center gap-x-4">
                <div class="flex gap-x-3 items-center">
                    <img src="{{ asset('gif/gift-box.gif') }}" class="h-[65px]" alt="">
                    <span class="text-[50px] font-prompt text-gray-400">สอบถามรายการ</span>
                </div>
                <div class="animate-bounce animate-infinite animate-duration-1000 animate-ease-in-out">
                    <span id="contentName" class="text-[30px] font-meduim text-blue-600"></span>
                </div>
            </div>
            <div class="w-full flex gap-x-2">
                <div class="w-full flex gap-x-1">
                    <div class="w-full">
                        <input type="date" id="DateF" class="py-1 rounded-sm w-full border-none bg-gray-200 focus:outline-none focus:border-none" placeholder="จากวันที่">
                    </div>
                    <div class="flex w-full">
                        <input type="date" id="DateT" class="py-1 rounded-sm w-full border-none bg-gray-200 focus:outline-none focus:border-none" placeholder="ถึงวันที่">
                        <button type="button" id="openDropdown" class="px-2 bg-blue-500 rounded-sm text-white hover:bg-blue-400 duration-150 ease-in-out">
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
                <div class="flex">
                    <button type="button" id="getData" class="px-5 bg-blue-500 py-1 rounded-sm text-white hover:bg-blue-400 duration-150 ease-in-out">
                        <svg aria-hidden="true" id="spint" class="hidden w-5 h-5 text-gray-100 animate-spin fill-blue-700" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <i class="fa-solid fa-magnifying-glass getDataI"></i>
                   </button>
                </div>
            </div>
            <div id="dropdownsss" class="w-full flex w-4/5 justify-end gap-x-2 my-2 hidden absolute">
                <div id="dropdown" class="z-10 bg-white divide-y divide-gray-100 rounded-lg drop-shadow-md w-44 border-gray-100 animate-fade-down animate-once animate-duration-1000 animate-ease-in-out">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownHoverButton">
                      <li>
                        <button id="incomein" class="w-full flex items-end block px-4 py-2 hover:bg-gray-100">
                            <img src="{{ asset('gif/packing.gif') }}" class="h-[35px]" alt="">
                            <span>นำเข้าสต็อก</span>
                        </button>
                      </li>
                      <li>
                        <button id="incomeout" class="w-full flex items-end block px-4 py-2 hover:bg-gray-100">
                            <img src="{{ asset('gif/unboxing.gif') }}" class="h-[35px]" alt="">
                            <span>นำออกสต็อก</span>
                        </button>
                      </li>
                    </ul>
                </div>
                <div class="flex invisible">
                    <button type="button" class="px-5 bg-blue-500 py-1 rounded-sm text-white hover:bg-blue-400 duration-150 ease-in-out">
                        <i class="fa-solid fa-magnifying-glass"></i>
                   </button>
                </div>
            </div>

            {{-- display form stock in and out --}}
            <div id="htmlRender" class="w-full my-5">
                <div class="flex justify-center items-end">
                    <img src="{{ asset('img/query.png') }}" class="h-[300px]" alt="">
                </div>
            </div>
        </div>
    </div>
</x-fullcard>
@include('stock-color.content-view.content-list.components.script')