$(document).ready(function () {
    $("#num_order").click(function () {
        var data_id=$(this).attr('data-id');    
        var data = {id: data_id};
//        alert(data);
        $.ajax({
            url:'?mod=order&action=update',
            method:'POST',
            data: data,
            dataType:'text',
            success:function(data){
               alert(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
        return false;
    });    
});
