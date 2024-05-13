<?php 
include('db_connect.php');
if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<link rel="stylesheet" href= "./css/user.css">
<style>
    h2{
    font-size: 50px;
    font-weight: bold;
    color: black;
    font-family: montserrat;
}

.dash-content .overview .title{
    display: flex;
    align-items: center;
    margin: 0px 0 30px 0;
    justify-content: space-between;
}
.dash-content .title i{
    position: relative;
    height: 35px;
    width: 35px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
.dash-content .title .text{
    font-size: 24px;
    font-weight: 500;
    color: var(--text-color);
    margin-left: 10px;
}
</style>
<div class="overview">
        <div class="title">
            <h2>Users</h2>
        </div>
        <hr>
<div class="container-fluid">
    <div class="row">
        <div class="card col-lg-12 container_card">
            <div class="card-body">
                <input type="text" id="searchInput" placeholder="Search for names.." class="form-control mb-3">
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
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $users = $conn->query("SELECT * FROM users ORDER BY name ASC");
                        while($row= $users->fetch_assoc()):
                        ?>
                        <tr>
                            <td> 
                                <center>
                                <div class="profile-image-container">
                                    <?php 
                                    // Check if profile picture path is empty
                                    if(!empty($row['profile_pic'])):
                                    ?>
                                    <!-- Display profile picture dynamically -->
                                    <img src="profile_pics/<?php echo $row['profile_pic'] ?>" alt="Profile Image" class="profile-image" style="width: 75px; height: 75px;">
                                    <?php else: ?>
                                    <!-- If profile picture path is empty, set default profile picture -->
                                    <img src="profile_pics/.png" alt="Default Profile Image" class="profile-image" style="width: 75px; height: 75px;">
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-primary edit_profile" data-id="<?php echo $row['id'] ?>"><i class="fa fa-pen"></i></button>
                                </div>
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

<!-- Modal for uploading profile picture -->
<div class="modal fade" id="uploadProfileModal" tabindex="-1" aria-labelledby="uploadProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadProfileModalLabel">Upload Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadProfileForm" enctype="multipart/form-data">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="profileImage">Choose Profile Picture:</label>
                        <input type="file" class="form-control-file" id="profileImage" name="profileImage" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
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

        $('#new_user').click(function(){
            uni_modal('New User','manage_user.php')
        });

        $('.edit_user').click(function(){
            uni_modal('Edit User','manage_user.php?id='+$(this).data('id'))
        });

        // Open upload profile picture modal on edit button click
        $('.edit_profile').click(function(){
            var userId = $(this).data('id');
            $('#userId').val(userId); // Set the user ID in the hidden input field
            $('#uploadProfileModal').modal('show'); // Show the modal
        });

        // Submit form to upload profile picture
        $('#uploadProfileForm').submit(function(e){
            e.preventDefault();
            var userId = $('#userId').val();
            var formData = new FormData(this);
            $.ajax({
                url: 'upload_profile.php?id='+userId,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success:function(resp){
                    if(resp == 1){
                        alert("Profile picture uploaded successfully!");
                        $('#uploadProfileModal').modal('hide');
                        location.reload();
                    } else {
                        alert("Failed to upload profile picture!");
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Function to handle delete user action
        $('.delete_user').click(function(){
            var id = $(this).data('id'); // Get the user ID from the data attribute

            // Confirm deletion with user
            if(confirm("Are you sure you want to delete this user?")){
                // Send AJAX request to delete_user.php with the user ID
                $.ajax({
                    url: 'delete_user.php',
                    method: 'POST',
                    data: { id: id },
                    success:function(resp){
                        // Reload the page or update the user list after successful deletion
                        if(resp == 1){
                            alert("User deleted successfully!");
                            location.reload();
                        } else {
                            alert("Failed to delete user!");
                        }
                    }
                });
            }
        });
    });
</script>

