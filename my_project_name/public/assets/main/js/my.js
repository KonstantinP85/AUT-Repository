$(document).ready(function()
{
    edit_task();
})
function edit_task(){
    $(document).on('click','#btn_edit',function()
    {
        var Edit_id = $(this).attr('data-id');
        $('#update').modal('show');
        $(document).on('click','#btn_update', function(){
            $.ajax(
                {
                    url: 'http://localhost/symfonyproject/my_project_name/public/profile/task/update',
                    method: 'POST',
                    dataType: 'html',
                    data: {Edit_id:Edit_id},
                })
            location.reload();
        })

    })
}



