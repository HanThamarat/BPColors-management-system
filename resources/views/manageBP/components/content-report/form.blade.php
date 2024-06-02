<div class="hideData">
    @if ($page == 'techname')
    <div>
        <form id="formDatass" class="w-full my-5 flex w-full justify-between gap-x-3">
            <div class="w-full">
                <label>ของเดือน</label>
                <input type="date" name="month" class="w-full py-1 px-4 rounded">
            </div>
            <div class="w-full">
                <label>ชื่อช่าง</label>
                <select name="techName" class="w-full py-1 px-4 rounded block">
                    <option value="">--select--</option>
                    @foreach ($response as $index => $values)
                        <option value="{{ $values->name }}">{{ $values->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="invisible">btn</label>
                <button id="btnCaljob" type="submit" class="w-[50px] h-[34px] bg-blue-500 hover:bg-blue-600 duration-100 ease-in-out flex justify-center items-center rounded">
                    <i id="ic" class="fa-solid fa-magnifying-glass text-white"></i>
                    <div id="spinnerss" role="status" class="hidden">
                        <svg aria-hidden="true" class="w-5 h-5 text-white animate-spin text-white fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
        <div id="showJobcal">

        </div>
    </div>
    @elseif($page == 'pastBill')
    <div>
        <form id="formBill" class="w-full my-5 flex w-full justify-between gap-x-3">
            <div class="w-full">
                <label>เลขที่วางบิล</label>
                <input type="text" name="no_bill" class="w-full py-1 px-4 rounded">
            </div>
            <div>
                <label class="invisible">btn</label>
                <button id="billBtn" type="submit" class="w-[50px] h-[34px] bg-blue-500 hover:bg-blue-600 duration-100 ease-in-out flex justify-center items-center rounded">
                    <i id="ic" class="fa-solid fa-magnifying-glass text-white"></i>
                    <div id="spinnerss" role="status" class="hidden">
                        <svg aria-hidden="true" class="w-5 h-5 text-white animate-spin text-white fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
        <div id="showJobcal">

        </div>
    </div>
    @elseif($page == 'date_send')
    <div>
        <form id="dateSend" class="w-full my-5 flex w-full justify-between gap-x-3">
            <div class="w-full">
                <label>จากวันที่</label>
                <input type="date" name="no_bill" class="w-full py-1 px-4 rounded">
            </div>
            <div class="w-full">
                <label>ถึงวันที่</label>
                <input type="date" name="no_bill" class="w-full py-1 px-4 rounded">
            </div>
            <div>
                <label class="invisible">btn</label>
                <button id="dateSendBtn" type="submit" class="w-[50px] h-[34px] bg-blue-500 hover:bg-blue-600 duration-100 ease-in-out flex justify-center items-center rounded">
                    <i id="ic" class="fa-solid fa-magnifying-glass text-white"></i>
                    <div id="spinnerss" role="status" class="hidden">
                        <svg aria-hidden="true" class="w-5 h-5 text-white animate-spin text-white fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
        <div id="showJobcal">

        </div>
    </div>
    @elseif($page == 'pase_bill')
    <div>
        <form id="paseBill" class="w-full my-5 flex w-full justify-between gap-x-3">
            <div class="w-full">
                <label>จากวันที่</label>
                <input type="date" name="no_bill" class="w-full py-1 px-4 rounded">
            </div>
            <div class="w-full">
                <label>ถึงวันที่</label>
                <input type="date" name="no_bill" class="w-full py-1 px-4 rounded">
            </div>
            <div>
                <label class="invisible">btn</label>
                <button id="paseBillBtn" type="submit" class="w-[50px] h-[34px] bg-blue-500 hover:bg-blue-600 duration-100 ease-in-out flex justify-center items-center rounded">
                    <i id="ic" class="fa-solid fa-magnifying-glass text-white"></i>
                    <div id="spinnerss" role="status" class="hidden">
                        <svg aria-hidden="true" class="w-5 h-5 text-white animate-spin text-white fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
        <div id="showJobcal">

        </div>
    </div>
    @endif
</div>
<script>
    $(document).ready(function() {
        $('#btnCaljob').click(function(e) {
            e.preventDefault();

            $('#ic').addClass('hidden');
            $('#spinnerss').removeClass('hidden');

            let data = {};
            $("#formDatass").serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            const selectedValue = $('input[name="datatype"]:checked').val();
            $('.title_export').prop("disabled", true);
            $('.loading').removeClass('hidden');
            $('.bgg').addClass('hidden');

            if (data.month !== '' && data.techName !== '') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        page: 'report',
                        typeDisplay: selectedValue,
                        data: data,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        $('#spinnerss').addClass('hidden');
                        $('.loading').addClass('hidden');
                        $('#ic').removeClass('hidden');
                        $('.title_export').prop("disabled", false);
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#show-data').html(response.resHtml).slideDown('slow');
                    },
                    error: function(err) {
                        $('#spinnerss').addClass('hidden');
                        $('.loading').addClass('hidden');
                        $('#ic').removeClass('hidden');
                        $('.title_export').prop("disabled", false);
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            text: err.responseJSON.err,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            } else {
                $('#spinnerss').addClass('hidden');
                $('.loading').addClass('hidden');
                $('#ic').removeClass('hidden');
                $('.title_export').prop("disabled", false);
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        $('#billBtn').click(function(e) {
            e.preventDefault();

            $('#ic').addClass('hidden');
            $('#spinnerss').removeClass('hidden');

            let data = {};
            $("#formBill").serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            const selectedValue = $('input[name="datatype"]:checked').val();
            $('.title_export').prop("disabled", true);
            $('.loading').removeClass('hidden');
            $('.bgg').addClass('hidden');

            console.log(data);

            if (data.no_bill !== '') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        page: 'report',
                        typeDisplay: selectedValue,
                        data: data,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        $('#spinnerss').addClass('hidden');
                        $('.loading').addClass('hidden');
                        $('#ic').removeClass('hidden');
                        $('.title_export').prop("disabled", false);
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#show-data').html(response.resHtml).slideDown('slow');
                    },
                    error: function(err) {
                        $('#spinnerss').addClass('hidden');
                        $('.loading').addClass('hidden');
                        $('#ic').removeClass('hidden');
                        $('.title_export').prop("disabled", false);
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            text: err.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            } else {
                $('#spinnerss').addClass('hidden');
                $('.loading').addClass('hidden');
                $('#ic').removeClass('hidden');
                $('.title_export').prop("disabled", false);
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
</script>