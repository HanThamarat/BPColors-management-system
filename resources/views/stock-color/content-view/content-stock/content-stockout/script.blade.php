<script>
    $(document).ready(function() {
        $("#StockOut").submit(function(e) {
            try {
                btnDis();
                e.preventDefault();
                let data = {};
                $("#StockOut").serializeArray().map(function(x) {
                    if (x.value != '') {
                        data[x.name] = x.value;
                    } else {
                        throw new Error(`กรุณากรอกข้อมูลให้ครบ`);
                    };
                });
                console.log(data);
                $.ajax({
                    url: "{{ route('stock.store') }}",
                    type: 'POST',
                    data: {
                        page:'stockOut',
                        data: data,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(res) {
                        btnEna();
                        $("input[type='text'], textarea, input[type='date']").each(function() {
                            $(this).val('');
                        });
                        Swal.fire({
                            icon: 'success',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getStockData();
                    },
                    error: async function(err) {
                        btnEna();
                        Swal.fire({
                            icon: 'error',
                            text: err.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            } catch (error) {
                btnEna();
                Swal.fire({
                    icon: 'warning',
                    text: error.message,
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        });

        
        function getStockData() {
            let elementPac = `
                @for ($i = 0; $i < 10; $i++)
                    <div class="border rounded-md border-blue-500 drop-shadow-sm px-2 py-3 w-[360px]">
                        <div class="animate-pulse w-full">
                            <div class="my-2">
                                <div class="h-[10px] bg-blue-500 rounded"></div>
                            </div>
                            <div class="flex gap-x-3 my-2">
                                <div class="h-[10px] w-full bg-blue-500 rounded"></div>
                                <div class="h-[10px] w-full bg-blue-500 rounded"></div>
                            </div>
                            <div class="flex gap-x-3 my-2">
                                <div class="h-[10px] w-2/5 bg-blue-500 rounded"></div>
                                <div class="h-[10px] w-3/5 bg-blue-500 rounded"></div>
                            </div>
                            <div class="flex gap-x-3 my-2">
                                <div class="h-[10px] w-4/5 bg-blue-500 rounded"></div>
                                <div class="h-[10px] w-1/5 bg-blue-500 rounded"></div>
                            </div>
                            <div class="my-2">
                                <div class="h-[10px] bg-blue-500 rounded"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            `;
            $("#card-stockcal").html(elementPac).slideDown('slow');
            $.ajax({
                url: "{{ route('stock.create') }}",
                type: 'GET',
                data: {
                    page: 'getDataStockCal',
                    _token: '{{ @csrf_token() }}',
                },
                success: async function(res) {
                    console.log(res);
                    $("#card-stockcal").html(res.resHtml).slideDown('slow');
                },
                error: async function(err) {
                    console.log(err);
                },
            });
        }

        $("#UnitQuatityOut").keyup(function(e) {
            var Unit = $(this).val();
            var ProductPrice = {{ @$res[0]->UnitPrice }};

            var calUnit = (Unit * ProductPrice);

           $("#UnitPriceOut").val(calUnit);
        });

        
        function btnDis() {
            $("#StockOutBtn").attr("disabled", true);
            $("#StockOutBtn").removeClass("bg-blue-500");
            $("#StockOutBtn").removeClass("hover:bg-blue-400");
            $("#StockOutBtn").addClass("bg-blue-400");
            $("#spintOut").removeClass("hidden");
        }

        function btnEna() {
            $("#StockOutBtn").attr("disabled", false);
            $("#StockOutBtn").addClass("bg-blue-500");
            $("#StockOutBtn").addClass("hover:bg-blue-400");
            $("#StockOutBtn").removeClass("bg-blue-400");
            $("#spintOut").addClass("hidden");
        }
    });
</script>