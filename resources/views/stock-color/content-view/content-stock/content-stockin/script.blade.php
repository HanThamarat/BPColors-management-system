<script>
    $(document).ready(function() {
        $("#FormStockIn").submit(function(e) {
            try {
                btnDis();
                e.preventDefault();
                let data = {};
                $("#FormStockIn").serializeArray().map(function(x) {
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
                        page:'stockIn',
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
                    },
                    error: async function(err) {
                        btnEna();
                        Swal.fire({
                            icon: 'error',
                            text: error.responseJSON.message,
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

        $("#GramQuantityIn").keyup(function(e) {
            var Unit = $(this).val();
            var ProductPrice = {{ @$res[0]->UnitPrice }};

            var calUnit = (Unit * ProductPrice);

           $("#UnitPriceSumIn").val(calUnit);
        });

        
        function btnDis() {
            $("#stockInBtn").attr("disabled", true);
            $("#stockInBtn").removeClass("bg-blue-500");
            $("#stockInBtn").removeClass("hover:bg-blue-400");
            $("#stockInBtn").addClass("bg-blue-400");
            $("#spintIn").removeClass("hidden");
        }

        function btnEna() {
            $("#stockInBtn").attr("disabled", false);
            $("#stockInBtn").addClass("bg-blue-500");
            $("#stockInBtn").addClass("hover:bg-blue-400");
            $("#stockInBtn").removeClass("bg-blue-400");
            $("#spintIn").addClass("hidden");
        }
    });
</script>