<style>
        body {
        --sb-track-color: #F5F5F5;
        --sb-thumb-color: #3B82F6;
        --sb-size: 5px;
        }

        .detail__repair {
            margin-top: 10px;
            height: 250px;
            overflow-y: scroll;
            padding: 20px;
        }

        .detail__repair::-webkit-scrollbar {
            width: var(--sb-size);
        }

        .detail__repair::-webkit-scrollbar-track {
            background: var(--sb-track-color);
            border-radius: 4px;
        }

        .detail__repair::-webkit-scrollbar-thumb {
            background: var(--sb-thumb-color);
            border-radius: 4px;
        }

        @supports not selector(::-webkit-scrollbar) {
            .detail__repair {
                scrollbar-color: var(--sb-thumb-color)
                                var(--sb-track-color);
            }
        }
</style>
    <div class="flex justify-between items-center text-sm" id="tab-bar">
        {{-- <button class="btn-detail w-full  py-1 px-2 rounded bg-blue-500 text-white mr-1" onclick="handleDetail()">รายละเอียดอื่นๆ</button>
        <button class="btn-repaire w-full  py-1 px-2 rounded  ml-1" onclick="handleRepaire()">รายการซ่อม</button> --}}
        <button wire:loading.class="bg-blue-500 text-white" wire:target="handledetail" onclick="handleDetail()" class="btn-detail w-full flex justify-center items-center gap-x-2 py-1 px-2 rounded {{ $user_original ? 'bg-blue-500 text-white' : 'hover:bg-blue-400 hover:text-white' }} duration-150 mr-1" wire:click.prevent="handledetail({{ 0 }})" {{ $user_original ? 'disabled' : '' }}>
            <span wire:loading.class="hidden" wire:target="handledetail" class="">รายละเอียดผู้ใช้งาน</span>
            <svg wire:loading wire:target="handledetail" aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </button>
        <button wire:loading.class="bg-blue-500 text-white" wire:target="handledetail" onclick="handleRepaire()" class="btn-repaire w-full flex justify-center items-center gap-x-2 py-1 px-2 rounded {{ $user_PA ? 'bg-blue-500 text-white' : 'hover:bg-blue-400 hover:text-white' }} duration-150 ml-1" wire:click.prevent="handledetail({{ 1 }})" {{ $user_PA ? 'disabled' : '' }}>
            <span wire:loading.class="hidden" wire:target="handledetail" class="">รายละเอียดผู้รับเคส</span>
            <svg wire:loading wire:target="handledetail" aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </button>
    </div>
    <div class="animate-pulse flex space-x-4">
            <div wire:loading wire:target="handledetail" class="flex-1 space-y-6 py-1 my-5">
            <div class="h-2 bg-blue-600 rounded"></div>
            <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4">
                <div class="h-2 bg-blue-600 rounded col-span-2"></div>
                <div class="h-2 bg-blue-600 rounded col-span-1"></div>
                </div>
                <div class="h-2 bg-blue-600 rounded"></div>
            </div>
            </div>
      </div>
      <div wire:loading.class="hidden" wire:target="handledetail">
        <div class="detail__bp  {{ $user_original ? '' : 'hidden' }}">
            @if ($count_u_original->COUNTU != 0)
                <div>
                    @foreach ($userData as $item)
                        <div class="my-5 bg-gray-100 px-2 py-2 rounded flex justify-between items-center">
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
                            <div class="w-full">
                                <span>Status</span>
                                <span class="block">{{ @$item->status }}</span>
                            </div>
                            <div class="flex gap-x-2 items-center">
                                <button wire:loading.class='flex justify-center items-center' wire:target="openForm({{ $item->id }})" class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="openForm({{ $item->id }})">
                                    <i wire:loading.class="hidden" wire:target="openForm({{ $item->id }})" class="fa-solid fa-pen"></i>
                                    <div wire:loading wire:target="openForm({{ $item->id }})" role="status">
                                        <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                                <button wire:loading.class='flex justify-center items-center' wire:target="deleteUser({{ $item->id }})" class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="deleteUser({{ $item->id }})">
                                    <i wire:loading.class="hidden" wire:target="deleteUser({{ $item->id }})" class="fa-solid fa-trash text-red-600"></i>
                                    <div wire:loading wire:target="deleteUser({{ $item->id }})" role="status">
                                        <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div>
                    <div class="w-full flex justify-center mt-6">
                        <img src="{{ asset('img/out-of-stock.png') }}" style="width: 75px;" class="out__of animate-bounce animate-infinite animate-duration-1000 animate-delay-500 animate-ease-out" alt="">
                    </div>
                    <div class="flex justify-center text-gray-600 mt-2">
                        <span>ยังไม่ข้อมูลผู้ใช้งาน</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="detail__repair {{ $user_PA ? '' : 'hidden' }}">
            @if ($count_u_pa->COUNTPA != 0)
                <div>
                    @foreach ($userdata_pa as $item)
                        <div class="my-5 bg-gray-100 px-2 py-2 rounded flex justify-between items-center">
                            <div class="w-full">
                                <span>Name</span>
                                <span class="block">{{ @$item->name }}</span>
                            </div>
                            <div class="w-full">
                                <span>Role</span>
                                <span class="block">{{ @$item->role }}</span>
                            </div>
                            <div class="w-full">
                                <span>Status</span>
                                <span class="block">{{ @$item->status }}</span>
                            </div>
                            <div class="flex gap-x-2 items-center">
                                <button wire:loading.class='flex justify-center items-center' wire:target="openForm({{ $item->id }})" class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="openForm({{ $item->id }})">
                                    <i wire:loading.class="hidden" wire:target="openForm({{ $item->id }})" class="fa-solid fa-pen"></i>
                                    <div wire:loading wire:target="openForm({{ $item->id }})" role="status">
                                        <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                                <button wire:loading.class='flex justify-center items-center' wire:target="deleteUser({{ $item->id }})" class="w-10 h-10 rounded bg-white hover:drop-shadow text-blue-500" wire:click.prevent="deleteUser({{ $item->id }})">
                                    <i wire:loading.class="hidden" wire:target="deleteUser({{ $item->id }})" class="fa-solid fa-trash text-red-600"></i>
                                    <div wire:loading wire:target="deleteUser({{ $item->id }})" role="status">
                                        <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button> 
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div>
                    <div class="w-full flex justify-center mt-6">
                        <img src="{{ asset('img/out-of-stock.png') }}" style="width: 75px;" class="out__of animate-bounce animate-infinite animate-duration-1000 animate-delay-500 animate-ease-out" alt="">
                    </div>
                    <div class="flex justify-center text-gray-600 mt-2">
                        <span>ยังไม่ข้อมูลผู้ใช้งาน</span>
                    </div>
                </div>
            @endif
        </div>
      </div>