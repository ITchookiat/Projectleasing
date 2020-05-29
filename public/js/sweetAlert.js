$(document).ready(function () {
   $('.AlertForm').click(function (evt) {
        var Contract_buyer = $(this).data("name");
        var form = $(this).closest("form");
        
        evt.preventDefault();
        swal({
            title: `${Contract_buyer}`,
            icon: "warning",
            text: "คุณต้องการยืนยันการลบหรือไม่ ?",
            buttons: true,
            dangerMode: true
        }).then((willDelete)=>{
            if (willDelete) {
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                form.submit();
            }
        });
    });
});

$(document).ready(function () {
    $('.MainPage').click(function (evt) {
         var form = $(this).closest("form");
         
         evt.preventDefault();
         swal({
                 icon: "warning",
                 text: "คุณต้องการกลับหน้าหลักหรือไม่ ?",
                 buttons: true,
                 dangerMode: true
         })
    });
 });