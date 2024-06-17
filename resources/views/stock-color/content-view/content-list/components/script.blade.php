<script src="{{ asset('js/jquery.js') }}"></script>
<script>
        $(document).ready(function() {
        document.title = 'COLOR STOCK | query stock';
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
                $("#getData").click();
            }
        });

        $("#getData").click(function() {
            try {
                btnDis();
                let DateF = $("#DateF").val();
                let DateT = $("#DateT").val();

                if (DateF == "" && DateT == "") {
                    throw new Error(`กรุณากรอกข้อมูลให้ครบ`);
                }

                $.ajax({
                    url: "{{ route('stocklist.create') }}",
                    type: 'GET',
                    data: {
                        page: contentStock,
                        Fdate: DateF,
                        Tdate: DateT,
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
            $("#getData").attr("disabled", true);
            $("#getData").removeClass("bg-blue-500");
            $("#getData").removeClass("hover:bg-blue-400");
            $(".getDataI").addClass("hidden");
            $("#getData").addClass("bg-blue-400");
            $("#spint").removeClass("hidden");
        }

        function btnEna() {
            $("#getData").attr("disabled", false);
            $("#getData").addClass("bg-blue-500");
            $("#getData").addClass("hover:bg-blue-400");
            $(".getDataI").removeClass("hidden");
            $("#getData").removeClass("bg-blue-400");
            $("#spint").addClass("hidden");
        }
    });
</script>