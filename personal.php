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

    <!-- Add custom CSS -->
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 20px;
            max-width: 2000px;
            height: 750px;
            background-color: #82bfff;
            padding: 20px;
            border-radius: 10px;
            display: flex;
        }

        .left-section {
            flex: 1.2;
            padding-right: 20px;
            
        }

        .right-section {
            flex: 1;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile-picture-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .profile-picture {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 2); 
        }


        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }

        .edit-icon:hover {
            background-color: #0056b3;
        }

        .personal-info {
            margin-bottom: 20px;
        }

        .personal-info label {
            font-weight: bold;
            color: white;
            font-size: 17px;
        }
        .right-section label{
            font-weight: bold;
            color: white;
            font-size: 17px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 50px;
            background-color: #FFE6AC;;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            align-self: flex-end;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-section">
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
            <input type="text" class="form-control" id="job_title" name="job_title">
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
