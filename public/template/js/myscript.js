const flashData = $('.flash-data').data('flashdata');
// console.log(flashData);

if (flashData) {
    swal({
        title: "Berhasil!",
        text: flashData,
        icon: "success",
        buttons: {
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-success",
                closeModal: true
            }
        }
    });
}

// tombol hapus

// $('.tombol-hapus').on('click', function(e) {
//     e.preventDefault();
//     const href = $(this).attr('href');
//     swal({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         type: 'warning',
//         buttons:{
//             confirm: {
//                 text : 'Yes, delete it!',
//                 className : 'btn btn-success'
//             },
//             cancel: {
//                 visible: true,
//                 className: 'btn btn-danger'
//             }
//         }
//     }).then((Delete) => {
//         if (Delete.value) {
//             document.location.href = href;
//             swal({
//                 title: 'Deleted!',
//                 text: 'Your file has been deleted.',
//                 type: 'success',
//                 buttons : {
//                     confirm: {
//                         className : 'btn btn-success'
//                     }
//                 }
//             });
//         } else {
//             swal.close();
//         }
//     });
// });