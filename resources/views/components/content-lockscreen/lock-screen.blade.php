<x-guest-layout>
    <div class="my-10">
        <div class="bg-white py-4 px-4 rounded-md drop-shadow-sm max-w-2xl mx-auto">
            <div class="flex justify-center my-2">
                @php
                    $text = Auth::user()->name;
                    $textSplit = explode(" ", $text);
                    if (empty($textSplit[1])) {
                        $substring = substr($textSplit[0], 0, 1);
                    } else {
                        $sub01 = substr($textSplit[0], 0, 1);
                        $sub02 = substr($textSplit[1], 0, 1);
                        $substring = $sub01.$sub02;
                    }
                @endphp
                <span class="inline-flex rounded-md">
                    <div class="mr-2 h-[140px] w-[140px] rounded-full bg-red-600 text-white flex justify-center items-center border-4 border-red-400">
                        <span class="text-[75px] font-medium">{{ $substring }}</span>
                    </div>
                </span>
            </div>
            <div class="flex justify-center">
                <span>{{ @$text }}</span>
            </div>
            <div class="my-3">
                <div>  
                    <span>Password</span>
                    <input id="passUnlock" type="password" class="block rounded-md w-full py-1 px-2">
                </div>
                <div class="flex justify-end mt-3">
                    <button type="button" id="unLockScreen" class="py-1 px-5 bg-blue-500 rounded-md text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>UnLock</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#unLockScreen").click(function() {
            try {
                let passUnLock = $("#passUnlock").val();

                if (passUnLock == '') {
                    throw "กรุณากรอกรหัสผ่าน";
                }

                $.ajax({
                    url: "{{ route('unlockScreen.index') }}",
                    type: 'GET',
                    data: {
                        page: 'lockscreen',
                        passUnLock: passUnLock,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: function (data) {
                        window.location.href = "{{ route('dashboard') }}";
                    },
                    error: function (data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: 'รหัสผ่านไม่ถูกต้อง',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                })

                console.log(passUnLock);
            } catch (error) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: error,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
</script>