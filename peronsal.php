<?php 

?>

<div class="container-fluid">

    
</div>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $('#new_user').click(function(){
        uni_modal('New User','manage_user.php')
    });

    $('.edit_user').click(function(){
        uni_modal('Edit Personal Information','manage_personal_info.php?id='+$(this).data('id'))
    });
</script>
