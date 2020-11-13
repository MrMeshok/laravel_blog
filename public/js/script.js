$(document).ready(function() {
    $(".reply_button").click(function() {
        var id = $(this).attr('id');
        $("#reply_form_"+id).toggle(400)
    });

    $("#all_comments").click(function() {
        // var idd = $(this).attr('id');
        var id = $(this).attr('data');
        jQuery.ajax({
            url: 'all_comments/'+id,
            // data:{'id': id, 'table': table},
            // type: 'POST',
            success:function(data){
                console.log(data);
                // $('tr#'+table+'_'+id).remove();
            },
            error:function (){
                console.log('Ошибка');
            }
        })
    });
});