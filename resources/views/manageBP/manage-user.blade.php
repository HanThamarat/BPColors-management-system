<x-app-layout>
    <livewire:manage-user lazy />
    <script>
        document.title = "BP | User Manage";
    
        // let btnDetailEl = document.querySelector('.btn-detail');
        // let btnRepairEl = document.querySelector('.btn-repaire');

        function getSelect() {
            if (document.getElementById('role').value == 'PA') {
                document.getElementById("username").readOnly = true;
                document.getElementById("password").readOnly = true;
                document.getElementById("email").readOnly = true;
            } else {
                document.getElementById("username").readOnly = false;
                document.getElementById("password").readOnly = false;
                document.getElementById("email").readOnly = false;
            }
        }
    
        function handleDetail() {
            document.querySelector('.btn-detail').disabled = true;
            document.querySelector('.btn-repaire').disabled = true;
        }
    
        function handleRepaire() {
            document.querySelector('.btn-detail').disabled = true;
            document.querySelector('.btn-repaire').disabled = true;
        }
    </script>
</x-app-layout>