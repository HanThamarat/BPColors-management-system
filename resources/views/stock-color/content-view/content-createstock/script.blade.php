<script src="{{ asset('js/jquery.js') }}"></script>
<script> 
    $(document).ready(function() {
        document.title = 'COLOR STOCK | create stock'; 
        $("#stockData").submit(function(e) {
            try {
                btnDis();
                e.preventDefault();

                let data = {};
                $(this).serializeArray().map(function(x) {
                    if (x.value != '') {
                        data[x.name] = x.value;
                    } else {
                        throw new Error(`กรุณากรอกข้อมูลให้ครบ`);
                    }
                });
                
                $.ajax({
                    url: "{{ route('stock.store') }}",
                    type: 'POST',
                    data: {
                        page: 'createStock',
                        data: data,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(response) {
                        btnEna();
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $("input[type='text'], textarea").each(function() {
                            $(this).val('');
                        });
                    },
                    error: function(err) {
                        btnEna();
                        Swal.fire({
                            icon: 'error',
                            text: err.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                });
            } catch (error) {
                btnEna();
                Swal.fire({
                    icon: 'warning',
                    text: error,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        $("#UnitStart, #ProductPrice").keyup(function() {
            var UnitStart = $(this).val();
            var ProductPrice = $("#ProductPrice").val();

            var calUnit = (ProductPrice / UnitStart);

           $("#UnitPrice").val(calUnit);
        });

        $('#UnitStart').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

        $('#ProductPrice').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

        function btnDis() {
            $("#create").attr("disabled", true);
            $("#create").removeClass("bg-blue-500");
            $("#create").removeClass("hover:bg-blue-400");
            $("#create").addClass("bg-blue-400");
            $("#spint").removeClass("hidden");
        }

        function btnEna() {
            $("#create").attr("disabled", false);
            $("#create").addClass("bg-blue-500");
            $("#create").addClass("hover:bg-blue-400");
            $("#create").removeClass("bg-blue-400");
            $("#spint").addClass("hidden");
        }
        // $('#ProductPrice').mask('000,000.00', {reverse: true});
    });
</script>