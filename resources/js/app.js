import './bootstrap';
import 'flowbite';

window.addEventListener('alert', (e) => {
    let data = e.detail;
    Swal.fire({
        position: data.position,
        icon: data.type,
        title: data.title,
        showConfirmButton: false,
        timer: data.timer
    });
});

window.addEventListener('confirmAlert', (e) => {
    let data = e.detail;
    Swal.fire({
        title: data.title,
        text: data.text,
        icon: data.type,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: data.textBtn,
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: data.titleCon,
            text: data.textCon,
            icon: data.typeCon
          });
        }
      });
});

