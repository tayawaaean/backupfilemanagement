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
    <link rel="stylesheet" href="./css/personal.css">
    
</head>
<body>
<div class="container">
    <div class="left-section">
        <div class="header-container">
            <h2 style="color:#15169A; font-weight:bold;">Personal Information</h2>
            <hr>
        </div>
        <div class="profile-picture-container">
            <img src="default_profile_picture.jpg" alt="Profile Picture" class="profile-picture">
            <button class="edit-icon"><i class="far fa-edit"></i></button>
        </div>
        <div class="personal-info">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" class="form-control" id="contact_number" name="contact_number">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
    </div>
    
    <div class="right-section">
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="job_title">Job Title:</label>
            <input type="text" class="form-control" id="job_title" name="job_title">
        </div>
        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" id="birthday" name="birthday">
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="civil_status">Civil Status:</label>
            <select class="form-control" id="civil_status" name="civil_status">
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
            </select>
        </div>
        <!-- Save button -->
        <button class="btn-primary">Save</button>
    </div>
</div>
</body>
</html>
