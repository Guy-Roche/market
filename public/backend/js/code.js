// $(function(){
//     $(document).on('click', '.delete-btn', function(e){
//         e.preventDefault();
//         var deleteUrl = $(this).data('url');

//         Swal.fire({
//             title: 'Êtes-vous sûr ?',
//             text: "de supprimer cet élément ?",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#007bff',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Oui, supprimez-le!'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $('#deleteForm').attr('action', deleteUrl).submit();
//             }
//         });
//     });
// });

$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

  });



