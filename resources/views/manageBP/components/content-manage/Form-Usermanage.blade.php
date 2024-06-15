<div>
    <div class="text-2xl font-medium">
        <span>Add User</span>
    </div>
    <div class="flex justify-between items-center text-sm" id="tab-bar">
        {{-- <button class="btn-detail w-full  py-1 px-2 rounded bg-blue-500 text-white mr-1" onclick="handleDetail()">รายละเอียดอื่นๆ</button>
        <button class="btn-repaire w-full  py-1 px-2 rounded  ml-1" onclick="handleRepaire()">รายการซ่อม</button> --}}
        <button wire:loading.class="bg-blue-500 text-white" wire:target="handleHeader" onclick="handleDetail()" class="btn-detail w-full flex justify-center items-center gap-x-2 py-1 px-2 rounded {{ $createUser ? 'bg-blue-500 text-white' : 'hover:bg-blue-400 hover:text-white' }} duration-150 mr-1" wire:click.prevent="handleHeader({{ 0 }})" {{ $createUser ? 'disabled' : '' }}>
            <span wire:loading.class="hidden" wire:target="handleHeader" class="">เพิ่มผู้ใช้งาน</span>
            <svg wire:loading wire:target="handleHeader" aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </button>
        <button wire:loading.class="bg-blue-500 text-white" wire:target="handleHeader" onclick="handleRepaire()" class="btn-repaire w-full flex justify-center items-center gap-x-2 py-1 px-2 rounded {{ $changeRole ? 'bg-blue-500 text-white' : 'hover:bg-blue-400 hover:text-white' }} duration-150 ml-1" wire:click.prevent="handleHeader({{ 1 }})" {{ $changeRole ? 'disabled' : '' }}>
            <span wire:loading.class="hidden" wire:target="handleHeader" class="">เพิ่มสิทธ์ผู้ใช้งาน</span>
            <svg wire:loading wire:target="handleHeader" aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </button>
    </div>
    <form>
        <div class="my-5 {{ $createUser ? '' : 'hidden' }}">
            <div class="w-full flex justify-between mb-5">
                <div class="w-2/6 w-full mr-2">
                    <span>Name</span>
                    <input type="text" id="name" class="rounded py-1 w-full rounded block" wire:model="name">
                     @error('name') {{ $message }} @enderror
                </div>
                <div class="w-2/6 w-full ml-2">
                    <span>Username</span>
                    <input type="text" id="username" class="role-hide rounded py-1 w-full rounded block" wire:model="username">
                    @error('username') {{ $message }} @enderror
                </div>
            </div>
            <div class="w-full flex justify-between">
                <div class="w-2/6 w-full mr-2">
                    <span>Password</span>
                    <input type="password" id="password" class="role-hide rounded py-1 w-full rounded block" wire:model="password">
                    @error('password') {{ $message }} @enderror
                </div>
                <div class="w-3/6 w-full ml-2">
                    <span>Role</span>
                    <select id="role" onchange="getSelect()" class="rounded w-full py-1 rounded block" wire:model="role">
                        <option value="BP">--select--</option>
                            @foreach ($getRole as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button id="submit_id" wire:loading.class.remove="hover bg-blue-500" wire:target="create" wire:loading.class="bg-blue-400" type="submit" class="rounded bg-blue-500 px-5 py-2 text-white mt-5 hover:bg-blue-400 duration-100 ease-in-out" wire:click.prevent="create" onclick="handleSubmit()">
                    <span wire:loading.class="hidden" wire:target="create" class="">Create User</span>
                    <div  wire:loading wire:target="create">
                        @component('components.content-loading.spinner') @endcomponent
                    </div>
                </button>
            </div>
        </div>
    </form>
    <form>
        <div class="my-5 {{ $changeRole ? '' : 'hidden' }}">
            <div class="w-full flex justify-between mb-5">
                <div class="w-2/6 w-full mr-2">
                    <span>Role Name</span>
                    <input type="text" id="roleName" class="rounded py-1 w-full rounded block" wire:model="createRoleName">
                    @error('createRoleName') {{ $message }} @enderror
                </div>
                <div class="w-2/6 w-full ml-2">
                    <span>Permission Detail</span>
                    <input type="text" id="PermissionName" class="role-hide rounded py-1 w-full rounded block" wire:model="PermissionName">
                    @error('PermissionName') {{ $message }} @enderror
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button id="submit_id" wire:loading.class.remove="hover bg-blue-500" wire:target="createRole" wire:loading.class="bg-blue-400" type="submit" class="rounded bg-blue-500 px-5 py-2 text-white mt-5 hover:bg-blue-400 duration-100 ease-in-out" wire:click.prevent="createRole" onclick="handleSubmit()">
                    <span wire:loading.class="hidden" wire:target="createRole" class="">Create User</span>
                    <div  wire:loading wire:target="createRole">
                        @component('components.content-loading.spinner') @endcomponent
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>