<div>
    <div class="text-2xl font-medium">
        <span>Add User</span>
    </div>
    <form>
        <div class="my-5">
            <div class="w-full flex justify-between mb-5">
                <div class="w-2/6 w-full mr-2">
                    <span>Name</span>
                    <input type="text" class="rounded py-1 w-full rounded block" wire:model="name">
                     @error('name') {{ $message }} @enderror
                </div>
                <div class="w-2/6 w-full mx-2">
                    <span>Username</span>
                    <input type="text" class="rounded py-1 w-full rounded block" wire:model="username">
                    @error('username') {{ $message }} @enderror
                </div>
                <div class="w-2/6 w-full ml-2">
                    <span>Password</span>
                    <input type="password" class="rounded py-1 w-full rounded block" wire:model="password">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>
            <div class="w-full flex justify-between">
                <div class="w-3/6 w-full mr-2">
                    <span>Email</span>
                    <input type="email" class="rounded py-1 w-full rounded block" wire:model="email">
                    @error('email') {{ $message }} @enderror
                </div>
                <div class="w-3/6 w-full ml-2">
                    <span>Role</span>
                    <select name="" id="" class="rounded w-full py-1 rounded block" wire:model="role">
                        <option value="BP">--select--</option>
                        <option value="admin">Admin</option>
                        <option value="BP">BP employee</option>
                    </select>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="rounded bg-blue-500 px-5 py-2 text-white mt-5" wire:click.prevent="create">Create User</button>
            </div>
        </div>
    </form>
</div>