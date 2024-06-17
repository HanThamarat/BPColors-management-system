<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function() {
        document.title = 'COLOR STOCK | manage stock';
        $("#contentName").text("นำเข้าสต็อก");
        let contentStock = 'stockIn';

        $("#openDropdown").click(function() {
            $("#dropdownsss").toggleClass("hidden");
        });

        $("#incomein").click(function() {
            $("#contentName").text("นำเข้าสต็อก");
            $("#dropdownsss").addClass("hidden");
            contentStock = 'stockIn';
        });

        $("#incomeout").click(function() {
            $("#contentName").text("นำออกสต็อก");
            $("#dropdownsss").addClass("hidden");
            contentStock = 'stockOut';
        });

        $(document).keypress(function(event) {
            if (event.which == 13) {
                $("#search").click();
            }
        });

        $("#search").click(function() {
            try {
                btnDis();
                let ProId = $("#ProductNo").val();

                if (ProId == "") {
                    throw new Error(`กรุณากรอกข้อมูลให้ครบ`);
                }

                $.ajax({
                    url: "{{ route('stock.create') }}",
                    type: 'GET',
                    data: {
                        page: 'manageStock',
                        StockContent: contentStock,
                        ProductNo: ProId,
                        _token: '{{ @csrf_token() }}',
                    },
                    success: async function(res) {
                        btnEna();
                        console.log(res);
                        $("#htmlRender").html(res.resHtml);
                    },
                    error: async function(err) {
                        btnEna();
                        console.log(err);
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

        function btnDis() {
            $("#search").attr("disabled", true);
            $("#search").removeClass("bg-blue-500");
            $("#search").removeClass("hover:bg-blue-400");
            $(".searchI").addClass("hidden");
            $("#search").addClass("bg-blue-400");
            $("#spint").removeClass("hidden");
        }

        function btnEna() {
            $("#search").attr("disabled", false);
            $("#search").addClass("bg-blue-500");
            $("#search").addClass("hover:bg-blue-400");
            $(".searchI").removeClass("hidden");
            $("#search").removeClass("bg-blue-400");
            $("#spint").addClass("hidden");
        }
    });
</script>
