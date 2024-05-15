@php
    $icon = 'fa-solid fa-user';
    $title = 'Manage User';
    $funcNameClose = 'closeForm';
    $funcNameSave = 'saveUser';
@endphp
<x-formpopup :openForm="$Formopen" :icon="$icon" :title="$title" :Data="$userData" :eventClose="$funcNameClose" :eventSave="$funcNameSave" >
    <div class="my-5">
        <div class="w-full flex justify-between mb-5">
            <div class="w-2/6 w-full mr-2">
                <span>Name</span>
                <input type="text" class="rounded py-1 w-full rounded block" wire:model.live="edit_name">
                 @error('name') {{ $message }} @enderror
            </div>
            <div class="w-2/6 w-full mx-2">
                <span>Username</span>
                <input type="text" class="rounded py-1 w-full rounded block" wire:model.live="edit_username">
                @error('username') {{ $message }} @enderror
            </div>
            <div class="w-2/6 w-full ml-2">
                <span>Password</span>
                <input type="password" class="rounded py-1 w-full rounded block" wire:model.live="edit_password">
                @error('password') {{ $message }} @enderror
            </div>
        </div>
        <div class="w-full flex justify-between">
            <div class="w-2/6 w-full mr-2">
                <span>Email</span>
                <input type="email" class="rounded py-1 w-full rounded block" wire:model.live="edit_email">
                @error('email') {{ $message }} @enderror
            </div>
            <div class="w-2/6 w-full mx-2">
                <span>Role</span>
                <select name="" class="rounded w-full py-1 rounded block" wire:model.live="edit_role">
                    <option value="BP">--select--</option>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                    <option value="BP">BP employee</option>
                </select>
            </div>
            <div class="w-2/6 w-full ml-2">
                <span>Status</span>
                <select class="rounded w-full py-1 rounded block" wire:model.live="userStatus">
                    <option value="active">active</option>
                    <option value="not-active">disabled</option>
                </select>
            </div>
        </div>
    </div>
</x-formpopup>