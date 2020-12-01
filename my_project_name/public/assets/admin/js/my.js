$(document).ready(function()
{
    orderno_task();
    orderyes_task();
})
function orderno_task(){

        $(document).on('click','#btn_orderno', function(){
            var data = $(this).serialize();
            $.ajax(
                {
                    url: 'http://localhost/symfonyproject/my_project_name/public/admin/task/orderno',
                    method: 'POST',
                    dataType: 'html',
                    data: data,
                    success: function(result){
                        $('#result').html(result);
                    }
                })
        })
}
function orderyes_task(){

    $(document).on('click','#btn_orderyes', function(){
        var data = $(this).serialize();
        $.ajax(
            {
                url: 'http://localhost/symfonyproject/my_project_name/public/admin/task/orderyes',
                method: 'POST',
                dataType: 'html',
                data: data,
                success: function(result){
                    $('#result').html(result);
                }
            })
    })
}