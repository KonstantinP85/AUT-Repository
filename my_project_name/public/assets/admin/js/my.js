$(document).ready(function()
{
    orderno_task();
    orderyes_task();
    order_task();
})
function orderno_task(){

        $(document).on('click','#btn_orderno', function(){
            var data = $(this).serialize();
            $.ajax(
                {
                    url: '',
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
                url: '',
                method: 'POST',
                dataType: 'html',
                data: data,
                success: function(result){
                    $('#result').html(result);
                }
            })
    })
}
function order_task() {
    $("input[type=radio]").on("change", function() {
        var data = $("check").serialize();
        var check_id = $(this).attr('id');
        $.ajax(
            {
                url: 'http://localhost/symfonyproject/my_project_name/public/admin/task/order',
                method: 'POST',
                dataType: 'html',
                data: {check_id:check_id, data:data},
                success: function(result){
                    $('#result').html(result);
                }
            })
    })

}