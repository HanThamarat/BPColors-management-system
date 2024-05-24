<x-app-layout>
    <x-fullcard>
        <form action="" id="formData" enctype="multipart/form-data">
            @csrf
            <div class="text-center my-2 text-2xl font-medium ">
                <span>Report Form</span>
            </div>
            <div class="flex w-full justify-between items-center">
                <div class="w-1/2">
                    <img src="{{ asset('img/report-gp.png') }}" alt="">
                </div>
                <div class="w-full justify-between items-center w-1/2">
                    <div class="w-full mr-2">
                        <label>Report</label>
                        <select name="l_report" id="l_report" onchange="getSelect()" class="block w-full rounded py-1 px-2">
                            <!-- 	<option value="report/report.php">รายงานสำหรับ Credo Lab</option> -->
                            <option value="pivotclaim" >Pivot รับเคลม</option>
                            <option value="pivotservice">Pivot รับบริการรถ</option>
                            <option value="pivotsend">Pivot ส่งมอบรถ</option>
                            <!-- 	<option value="report/pivotcom.php">Pivot คอมมิสชั่น</option> -->
                            <option value="pivotamont">Pivot ยอดยกมา ทั้งหมด</option>
                            <option value="pivottotalwork">Pivot ค่าแรงช่าง</option>
                            <option value="todayreport">reportBP CreateDate</option>
                            <option value="todayservice">todayClose</option>
                            <option value="billreport">รายงานสรุปรายได้ประจำเดือน</option>
                            <option value="dereport">ลูกหนี้คงเหลือ</option>
                            <option value="expectreport">รถที่เป็นยอดได้</option>
                            <option value="monthreport">รายงานยอดรายวัน</option>
                            <option value="jobreport">รายงานJOB</option>
                            <option value="reportStatus">รายงานสถานะรถ</option>
                            <option value="reportCarstatus">รายงานสถานะรถซ่อม</option>
                            <option value="reportEvaluate">รายงานประเมิณ</option>
                        </select>
                    </div>
                    <div class="year w-full my-2">
                        <label>Year</label>
                        <input type="text" id="year" class="block w-full rounded py-1 px-2" name='year' placeholder="กรุณากรอกปี ค.ศ.">
                    </div>
                    <div class="date w-full flex items-center hidden my-2">
                        <div class="w-full mr-2">
                            <label>From Date</label>
                            <input type="date" id="fromdate" class="block w-full rounded py-1 px-2" name='fromdate'>
                        </div>
                        <div class="w-full ml-2">
                            <label>To Date</label>
                            <input type="date" id="todate" class="block w-full rounded py-1 px-2" name='todate'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="mt-4 h-10 px-4 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out" id="ExportReport">Export Report</button>
                <button class="hidden mt-4 h-10 px-10 rounded bg-blue-400 text-white" id="spinner">
                    @component('components.content-Loading.spinner')@endcomponent
                </button>
            </div>
        </form>
    </x-fullcard>
</x-app-layout>
<script>
    document.title = "BP | Report";
    const ExpoetEl = document.querySelector("#ExportReport");
    const spinerEl = document.querySelector("#spinner");

    function getSelect() {
        if (document.getElementById('l_report').value === 'todayreport' || document.getElementById('l_report').value === 'billreport' ||  document.getElementById('l_report').value === 'jobreport' || document.getElementById('l_report').value === 'todayservice' || document.getElementById('l_report').value === 'monthreport' || document.getElementById('l_report').value === 'reportEvaluate' || document.getElementById('l_report').value === 'monthreport') {
            document.querySelector('.date').classList.remove('hidden');
            document.querySelector('.year').classList.add('hidden');
        } else {
            document.querySelector('.date').classList.add('hidden');
            document.querySelector('.year').classList.remove('hidden');
        }
    }

    $(document).ready(function () {
        $('#formData').submit(function(e) {
            ExpoetEl.classList.add('hidden');
            spinerEl.classList.remove('hidden');

            e.preventDefault();

            var fromdata = {
                reportType: $('#l_report').val(),
                year: $('#year').val(),
                fromdate: $('#fromdate').val(),
                todate: $('#todate').val(),
            };

            if(fromdata.year !== '' || fromdata.fromdate !== '' || fromdata.todate !== '') {
                let reports = document.getElementById('l_report').value;
                // button.disabled = true;
                $.ajax({
                    type: 'GET',
                    url: "{{ route('report.create') }}",
                    data: {
                        report: reports,
                        year: fromdata.year,
                        fromdata: fromdata.fromdate,
                        todate: fromdata.todate
                    },
                    success: function(res) {
                        ExpoetEl.classList.remove('hidden');
                        spinerEl.classList.add('hidden');
                        // window.location.href = `{{ route('report.create') }}?report=${reports}&year=${fromdata.year}&fromdate=${fromdata.fromdate}&todate=${fromdata.todate}`;
                        // window.open(`{{ route('report.create') }}?report=${reports}&year=${fromdata.year}&fromdate=${fromdata.fromdate}&todate=${fromdata.todate}`);
                        window.location.href(`{{ route('report.create') }}?report=${reports}&year=${fromdata.year}&fromdate=${fromdata.fromdate}&todate=${fromdata.todate}`);
                        alert({
                            type: 'success',
                            title: 'Export report success',
                            timer: 2000,
                        });
                    },
                    error: function(err) {
                        ExpoetEl.classList.remove('hidden');
                        spinerEl.classList.add('hidden');
                        alert({
                            type: 'error',
                            title: 'Export report error',
                            timer: 2000,
                        });
                    }
                });
            } else {
                ExpoetEl.classList.remove('hidden');
                spinerEl.classList.add('hidden');
                alert({
                    type: 'warning',
                    title: 'กรุณากรอกข้อมูล',
                    timer: 2000
                });
            }
        });

        function alert({type, title, timer}) {
            Swal.fire({
                position: 'center',
                icon: type,
                title: title,
                showConfirmButton: false,
                timer: timer
            });
        }
    })
</script>