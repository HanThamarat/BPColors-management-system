<div class="lg:w-1/5 px-2 py-4">
    <div class="rounded bg-gradient-to-r from-cyan-500 to-blue-500 justify-between flex drop-shadow-md">
        <div class="flex justify-center py-5 px-2">
            <span class="font-medium flex items-center text-white drop-shadow-md animate-bounce animate-infinite animate-ease-in-out">
                Customer BP
            </span>
        </div>
        <div>
            <img src="{{ asset('img/service.png') }}" class="object-cover py-2" style="width: 200px; margin-bottom: -20px; margin-top: -10px;" alt="">
        </div>
    </div>
    <div class="bg-white mt-2 drop-shadow-md rounded px-2 py-5">
        <div class="font-medium text-gray-600">
            <span>Personal Information</span>
        </div>
        <div class="flex mt-2">
            <i class="fa-solid fa-user text-blue-500 text-lg mr-3"></i>
            <div class="user__infor">
                <span class="block">ชื่อ-นามสกุล</span>
                <span class="block">{{ $getUserData->cus_name }}</span>
            </div>
        </div>
        <div class="flex mt-2">
            <i class="fa-solid fa-mobile text-blue-500 text-lg mr-3"></i>
            <div class="user__infor">
                <span class="block">เบอร์โทรลูกค้า</span>
                <span class="block">{{ $getUserData->cus_tel }}</span>
            </div>
        </div>
    </div>
</div>