<style>
body {
--sb-track-color: #F5F5F5;
--sb-thumb-color: #3B82F6;
--sb-size: 5px;
}


.btn-detail {
    width: 100%;
    overflow-x: scroll;
    scroll-behavior: smooth;
}

.btn-detail::-webkit-scrollbar {
    display: none;
    width: var(--sb-size);
}

.btn {
    width: 450px;
}

</style>
<x-fullcard>
    <div class="flex items-center">
        <div class="px-5 py-1 mx-2 rounded-md border-2 border-blue-500">
            <button id="btnBack"><i class="text-blue-500 fa-solid fa-circle-arrow-left"></i></button>
        </div>
        <div id="detail" class="btn-detail gap-x-2 flex justify-between items-center">
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="sendinsure" name="datatype" value="sendinsure" class="hidden peer title_export" />
                    <label for="sendinsure" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>รายงานวางบิลส่งประกัน</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="caljob" name="datatype" value="caljob" class="hidden peer title_export" />
                    <label for="caljob" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>ค่าแรงช่าง</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="car_nopay" name="datatype" value="car_nopay" class="hidden peer title_export" />
                    <label for="car_nopay" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>รถประกันวางบิลแต่ยังไม่ได้รับเงิน</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="car_nocliam" name="datatype" value="car_nocliam" class="hidden peer title_export" />
                    <label for="car_nocliam" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>รถเปิดเคลมยังไม่เข้ารับบริการ</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="pase_bill" name="datatype" value="pase_bill" class="hidden peer title_export" />
                    <label for="pase_bill" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>รายการวางบิล</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="date_send" name="datatype" value="date_send" class="hidden peer title_export" />
                    <label for="date_send" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>วันนัดส่งมอบ</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="date_peak" name="datatype" value="date_peak" class="hidden peer title_export" />
                    <label for="date_peak" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>รถที่เป็นยอดได้</span>
                    </label>
                </li>
            </ul>
            <ul class="shrink-0">
                <li>
                    <input type="radio" id="wait_bill" name="datatype" value="wait_bill" class="hidden peer title_export" />
                    <label for="wait_bill" class="inline-flex items-center justify-between w-full px-10 py-1 text-ttow bg-white border border-blue-500 rounded-md cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:text-white hover:bg-blue-400 duration-100 ease-in-out">
                        <span>รอวางบิล</span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="px-5 py-1 mx-2 rounded-md border-2 border-blue-500">
            <button id="btnNext"><i class="text-blue-500 fa-solid fa-circle-arrow-right"></i></button>
        </div>
    </div>

    {{-- show data --}}
    <div id='show-data' class="w-full">
        <div class="bgg flex justify-center my-5">
            <img src="{{ asset('img/query.png') }}" alt="">
        </div>
    </div>
    <div class="loading hidden">
        <div class="animate-pulse flex space-x-4 my-5">
        <div class="flex-1 space-y-6 py-1">
            <div class="h-5 bg-blue-500 rounded"></div>
            <div class="space-y-3">
            <div class="grid grid-cols-3 gap-4">
                <div class="h-3 bg-blue-500 rounded col-span-2"></div>
                <div class="h-3 bg-blue-500 rounded col-span-1"></div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="h-3 bg-blue-500 rounded col-span-1"></div>
                <div class="h-3 bg-blue-500 rounded col-span-2"></div>
            </div>
            <div class="h-3 bg-blue-500 rounded"></div>
            <div class="h-3 bg-blue-500 rounded"></div>
            </div>
        </div>
        </div>
    </div>
</x-fullcard>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const BlackEl = document.getElementById('btnBack');
    const NextEl = document.getElementById('btnNext');
    const ScrollContent = document.getElementById('detail');

    // {ScrollContent.scrollLeft === 0 ? }

    NextEl.addEventListener('click', () => {
       let newScrollLeft = ScrollContent.scrollLeft + 200;
       ScrollContent.scrollLeft = newScrollLeft;
       console.log(newScrollLeft);
    });

    BlackEl.addEventListener('click', () => {
        let newScrollRight = ScrollContent.scrollLeft - 200;
        ScrollContent.scrollLeft = newScrollRight;
    });

    $(document).ready(function() {
        $('.title_export').click(function() {
            const selectedValue = $('input[name="datatype"]:checked').val();
            $('.title_export').prop("disabled", true);
            $('.loading').removeClass('hidden');
            $('.bgg').addClass('hidden');
            $('.hideData').addClass('hidden');

            console.log(selectedValue);

            if (selectedValue === 'caljob') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        getName: 'techname',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        $('#show-data').html(response.resHtml).slideDown('slow');
                        console.log(response);
                    },
                    error: function(error) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        console.log(error);
                    },
                });
            } else if(selectedValue === 'car_nopay') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        page: 'report',
                        typeDisplay: selectedValue,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        
                        console.log(response.message);

                        $('#show-data').html(response.resHtml).slideDown('slow');
                    },
                    error: function(err) {
                        $('.loading').addClass('hidden');
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
            } else if (selectedValue == 'car_nocliam') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        page: 'report',
                        typeDisplay: selectedValue,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        
                        console.log(response.message);

                        $('#show-data').html(response.resHtml).slideDown('slow');
                    },
                    error: function(err) {
                        $('.loading').addClass('hidden');
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
            } else if(selectedValue == 'date_peak') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        page: 'report',
                        typeDisplay: selectedValue,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        
                        console.log(response.message);

                        $('#show-data').html(response.resHtml).slideDown('slow');
                    },
                    error: function(err) {
                        $('.loading').addClass('hidden');
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
            } else if(selectedValue == 'wait_bill') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        page: 'report',
                        typeDisplay: selectedValue,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        
                        console.log(response.message);

                        $('#show-data').html(response.resHtml).slideDown('slow');
                    },
                    error: function(err) {
                        $('.loading').addClass('hidden');
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
            } else if(selectedValue == 'sendinsure') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        getName: 'pastBill',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        $('#show-data').html(response.resHtml).slideDown('slow');
                        console.log(response);
                    },
                    error: function(error) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        console.log(error);
                    },
                });
            } else if(selectedValue == 'date_send') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        getName: 'date_send',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        $('#show-data').html(response.resHtml).slideDown('slow');
                        console.log(response);
                    },
                    error: function(error) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        console.log(error);
                    },
                });
            } else if(selectedValue == 'pase_bill') {
                $.ajax({
                    url: "{{ route('report.index') }}",
                    type: 'GET',
                    data: {
                        getName: 'pase_bill',
                    },
                    success: async function(response) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        $('#show-data').html(response.resHtml).slideDown('slow');
                        console.log(response);
                    },
                    error: function(error) {
                        $('.loading').addClass('hidden');
                        $('.title_export').prop("disabled", false);
                        console.log(error);
                    },
                });
            }
        });
    });
</script>