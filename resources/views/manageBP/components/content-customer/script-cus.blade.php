{{-- <script>
    let btnDetailEl = document.querySelector('.btn-detail');
    let btnRepairEl = document.querySelector('.btn-repaire');
    let detailBP = document.querySelector('.detail__bp');
    let detailRepair = document.querySelector('.detail__repair');

    function handleDetail() {
        btnDetailEl.classList.add('bg-blue-500');
        btnDetailEl.classList.add('text-white');
        btnRepairEl.classList.remove('bg-blue-500');
        btnRepairEl.classList.remove('text-white');
        detailRepair.classList.add('hidden');
        detailBP.classList.remove('hidden');
    }

    function handleRepaire() {
        btnRepairEl.classList.add('bg-blue-500');
        btnRepairEl.classList.add('text-white');
        btnDetailEl.classList.remove('bg-blue-500');
        btnDetailEl.classList.remove('text-white');
        detailRepair.classList.remove('hidden');
        detailBP.classList.add('hidden');
    }
</script> --}}
<script>
     document.title = "BP | Customer Detail";

    // let btnDetailEl = document.querySelector('.btn-detail');
    // let btnRepairEl = document.querySelector('.btn-repaire');

    function handleDetail() {
        document.querySelector('.btn-detail').disabled = true;
        document.querySelector('.btn-repaire').disabled = true;
    }

    function handleRepaire() {
        document.querySelector('.btn-detail').disabled = true;
        document.querySelector('.btn-repaire').disabled = true;
    }

    // const inputSum = document.querySelectorAll("#evaluate_job, #evaluate_job");

    // console.log(inputSum);

    // inputSum.forEach((input) => {
    //     input.addEventListener('input', calSum);
    //     console.log(input);
    // });

    // calSum = () => {
    //     var evaluate_job = parseFloat(document.getElementById('evaluate_job').value) || 0;
    //     var evaluate_spares = parseFloat(document.getElementById('evaluate_spares').value) || 0;

    //     let sum = evaluate_job + evaluate_spares;

    //     console.log(sum);

    //     document.getElementById('evaluate_total').value = sum;
    // }
</script>