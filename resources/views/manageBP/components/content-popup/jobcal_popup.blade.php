@php
    $icon = 'fa-solid fa-user';
    $title = 'Manage User';
    $funcNameClose = 'closeManage';
    $funcNameSave = 'saveEdit';
@endphp
<x-formpopup :openForm="$edit" :icon="$icon" :title="$title" :Data="$title" :eventClose="$funcNameClose" :eventSave="$funcNameSave" >
    <div class="my-5">
        <div class="w-full flex justify-between mb-5">
            <div class="w-2/6 w-full mr-2">
                <span>JOB NAME</span>
                <input class="block rounded w-full px-2 py-1" type="text" wire:model="job_name_edit">
                @error('job_name_edit') {{ $message }} @enderror
            </div>
            <div class="w-2/6 w-full mx-2">
                <span>JOB PTC</span>
                <input type="text" class="rounded py-1 w-full rounded block" wire:model.live="job_cal_edit">
                @error('job_cal_edit') {{ $message }} @enderror
            </div>
        </div>
    </div>
</x-formpopup>