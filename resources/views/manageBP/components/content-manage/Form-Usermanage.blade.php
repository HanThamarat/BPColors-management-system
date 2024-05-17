<div>
    <div class="text-2xl font-medium">
        <span>Add User</span>
    </div>
    <form>
        <div class="my-5">
            <div class="w-full flex justify-between mb-5">
                <div class="w-2/6 w-full mr-2">
                    <span>Name</span>
                    <input type="text" id="name" class="rounded py-1 w-full rounded block" wire:model="name">
                     @error('name') {{ $message }} @enderror
                </div>
                <div class="w-2/6 w-full mx-2">
                    <span>Username</span>
                    <input type="text" id="username" class="role-hide rounded py-1 w-full rounded block" wire:model="username">
                    @error('username') {{ $message }} @enderror
                </div>
                <div class="w-2/6 w-full ml-2">
                    <span>Password</span>
                    <input type="password" id="password" class="role-hide rounded py-1 w-full rounded block" wire:model="password">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>
            <div class="w-full flex justify-between">
                <div class="w-3/6 w-full mr-2">
                    <span>Email</span>
                    <input type="email" id="email" class="role-hide rounded py-1 w-full rounded block" wire:model="email">
                    @error('email') {{ $message }} @enderror
                </div>
                <div class="w-3/6 w-full ml-2">
                    <span>Role</span>
                    <select id="role" onchange="getSelect()" class="rounded w-full py-1 rounded block" wire:model="role">
                        <option value="BP">--select--</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="BP">BP employee</option>
                        <option value="PA">ผู้รับเคส</option>
                    </select>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button id="submit_id" wire:loading.class.remove="hover bg-blue-500" wire:loading.class="bg-blue-400" type="submit" class="rounded bg-blue-500 px-5 py-2 text-white mt-5 hover:bg-blue-400 duration-100 ease-in-out" wire:click.prevent="create" onclick="handleSubmit()">
                    <span wire:loading.class="hidden" class="">Create User</span>
                    <div wire:loading>
                        @component('components.content-loading.spinner') @endcomponent
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>