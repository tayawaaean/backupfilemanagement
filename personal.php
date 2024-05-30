<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Personal Information</title>
    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/personal.css">
</head>
<body>
<div class="container">
<?php
    include 'db_connect.php';
    $login_id = $_SESSION['login_id'];
    $user_query = $conn->query("SELECT * FROM users WHERE id = $login_id");
    $user = $user_query->fetch_assoc();
    $profile_pic = !empty($user['profile_pic']) ? $user['profile_pic'] : 'default_profile_picture.jpg';
?>
    <form action="save_info.php" method="post" enctype="multipart/form-data">
        <div class="header-container">
            <hr>
            <h2 style="color:#15169A; font-weight:bold;">Personal Information</h2>
            <hr>
        </div>
        <div class="profile-picture-container" style="text-align: center; position: relative;">
            <img src="<?php echo htmlspecialchars($profile_pic, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile Picture" class="profile-picture" id="profilePicture" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
            <label class="edit-icon" for="profilePictureInput"><i class="far fa-edit"></i></label>
            <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="loadFile(event)" style="display: none;">
        </div>
        <div class="form-container">
            <div class="personal-info">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="tel" class="form-control" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($user['contact_number'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
            </div>
            <div class="right-section">
                <div class="form-group">
                    <label for="job_title">Job Title:</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo htmlspecialchars($user['position'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user['birthday'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo $user['gender'] == 'other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="civil_status">Civil Status:</label>
                    <select class="form-control" id="civil_status" name="civil_status">
                        <option value="single" <?php echo $user['civil_status'] == 'single' ? 'selected' : ''; ?>>Single</option>
                        <option value="married" <?php echo $user['civil_status'] == 'married' ? 'selected' : ''; ?>>Married</option>
                        <option value="divorced" <?php echo $user['civil_status'] == 'divorced' ? 'selected' : ''; ?>>Divorced</option>
                        <option value="widowed" <?php echo $user['civil_status'] == 'widowed' ? 'selected' : ''; ?>>Widowed</option>
                    </select>
                </div>
                <button class="btn-primary" type="submit">Save</button><!-- Changed last -->
            </div>
        </div>
    </form>
</div>
<script>
    function loadFile(event) {
        var output = document.getElementById('profilePicture');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src); // Free memory
        }
    }
</script>
</body>
</html>
