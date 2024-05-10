<link rel="stylesheet" href= "./css/user.css">



<div class="container-fluid">
    <div class="row">
        <div class="card col-lg-12 container_card">
            <div class="card-body">
                <div class="col-lg-12">
                    <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
                </div>
                <input type="text" id="searchInput" placeholder="Search for names.." class="form-control mb-3">
                <!-- <table class="table-striped table-bordered col-md-12 info_table"> -->
                <table class="info_table">
                    <thead>
                        <tr>
                            <th class="text-center">Profile</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'db_connect.php';
                            $users = $conn->query("SELECT * FROM users order by name asc");
                            $i = 1;
                            while($row= $users->fetch_assoc()):
                         ?>
                         <tr>
                            <td> 
                                <center>
                                    <img src="profile_image/profile_sample.jpg" alt="Profile Image" style="width: 75px; height: 75px;"> 
                                </center>
                            </td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary edit_user" data-id="<?php echo $row['id'] ?>"><i class="fa fa-pen"></i></button>
                                        <button type="button" class="btn btn-primary delete_user" data-id="<?php echo $row['id'] ?>"><i class="fa fa-user-minus"></i></button>
                                    </div>
                                </center>
                            </td>
                         </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
        uni_modal('Edit User','manage_user.php?id='+$(this).data('id'))
    });
</script>
