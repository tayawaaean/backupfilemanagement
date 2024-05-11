$(document).ready(function(){
    $('#manage-files').submit(function(e){
        e.preventDefault()
        start_load();
    $('#msg').html('')
    $.ajax({
        url:'ajax.php?action=save_files',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            if(typeof resp != undefined){
                resp = JSON.parse(resp);
                if(resp.status == 1){
                    alert_toast("New File successfully added.",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)
                }else{
                    $('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
                    end_load()
                }
            }
        }
    })
    })
})
function displayname(input,_this) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    _this.siblings('label').html(input.files[0]['name'])
                    
                }

                reader.readAsDataURL(input.files[0]);
            }
        }