<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navigation.css">
    <style>
        .active {
            background-color: #f0f0f0; /* Change to your active color */
        }
    </style>
</head>
<body>
    <?php
    // Your PHP logic for checking login_type
    // For demonstration, let's assume $_SESSION['login_type'] holds the user type
    // You may need to adjust this logic based on your actual implementation
    $login_type = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : null;
    ?>
   <!--<div class="menuToggle"></div>-->
    <div class="sidebar">
        <ul>
            <div class="logo_icon">
            <li class="logo">
                <a href="#">
                    <img src="./assets/img/BNHS Logo.png" width="70" height="70">
                    <div class="text-head"><b>Bingao National<br>High School</b></div>
                </a>
            </li>
            </div>
            <div class="menulist">
                <?php if($login_type == 1): ?>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : ''; ?>">
                        <a href="index.php?page=home">
                            <div class="icon"><ion-icon name="home"></ion-icon></div>
                            <div class="text-nav">Home</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'files' ? 'active' : ''; ?>">
                        <a href="index.php?page=files">
                            <div class="icon"><ion-icon name="document"></ion-icon></div>
                            <div class="text-nav">Files</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'users' ? 'active' : ''; ?>">
                        <a href="index.php?page=users">
                            <div class="icon"><ion-icon name="people"></ion-icon></div>
                            <div class="text-nav">Users</div>
                        </a>
                    </li>
                <?php elseif($login_type == 2): ?>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'employee' ? 'active' : ''; ?>">
                        <a href="index.php?page=home">
                            <div class="icon"><ion-icon name="home"></ion-icon></div>
                            <div class="text-nav">Home</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'files' ? 'active' : ''; ?>">
                        <a href="index.php?page=files">
                            <div class="icon"><ion-icon name="document"></ion-icon></div>
                            <div class="text-nav">Files</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'personal' ? 'active' : ''; ?>">
                        <a href="index.php?page=personal">
                            <div class="icon"><ion-icon name="people"></ion-icon></div>
                            <div class="text-nav">Personal Information</div>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'shared-files' ? 'active' : ''; ?>">
                    <a href="index.php?page=shared-files">
                        <div class="icon"><ion-icon name="share"></ion-icon></div>
                        <div class="text-nav">Shared Files</div>
                    </a>
                </li>
            </div>
            <div class="bottom-nav">
            <?php
                include 'db_connect.php';
                // Assuming $login_id stores the session login ID
                $login_id = $_SESSION['login_id'];
                $user_query = $conn->query("SELECT * FROM users WHERE id = $login_id");
                $user = $user_query->fetch_assoc();
                ?>
                <li>
                    <a href="#">
                        <div class="icon">
                            <div class="imgBx">
                                <!-- Display user's profile picture dynamically -->
                                <?php if(!empty($user['profile_pic'])): ?>
                                    <img src="<?php echo htmlspecialchars($user['profile_pic'], ENT_QUOTES, 'UTF-8'); ?>" width="100" height="100" alt="Profile Picture" style="border-radius: 50%; object-fit: cover;">
                                <?php else: ?>
                                    <img src="default_profile_picture.jpg" width="100" height="100" style="border-radius: 50%; object-fit: cover;">
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-wrapper">
                        <div class="text-name">
                            <?php echo $user['name']; ?>
                        </div>
                    </div>
                </a>
            </li>

                </li>
                <li>
                    <a href="logout.php">
                        <div class="icon"><ion-icon name="log-out"></ion-icon></div>
                        <div class="text-nav">Logout</div>
                    </a>
                </li>
            </div>
        </ul>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
