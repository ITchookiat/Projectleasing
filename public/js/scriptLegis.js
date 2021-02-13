
 function FunctionGetUser(url){
    $.get(url, function (data) {
    $('#modal-data').modal('show');
    // $('#ShowData').val(data.result);
    $('#textid').text(data.id);

    // วนลูปเอาค่า
    // data.forEach(element => {
    //   console.log(element.id);
    //   $('.modal-body').append(element.id);
    // });
    });
 }
 