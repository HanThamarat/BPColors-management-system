<div>
    <style>
        /* .user__infor {
            border: solid 1px;
            border-radius: 10px;
            padding: 10px;
        } */
        .btn-edit {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20px;
            height: 20px;
            padding: 20px;
            background: #F5F5F5;
            border-radius: 50%;
            color: #1E88E5;
            transition: all 0.2s ease-in-out;
        }

        /* .btn-edit:hover {
            margin-top: -20px;
        } */

        .stock__con {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .out__of {
            width: 100px;
        }

        .popup__style {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    @include('manageBP.components.content-customer.main-customer')
</div>
<script>
    document.title = "BP | Customer Detail";
</script>
{{-- @include('manageBP.components.content-customer.script-cus') --}}
