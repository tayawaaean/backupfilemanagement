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
    <div class="menuToggle"></div>
    <div class="sidebar">
        <ul>
            <li class="logo">
                <a href="#">
                    <img src="./assets/img/BNHS Logo.png" width="70" height="70">
                    <div class="text"><b>Bingao National<br>High School</b></div>
                </a>
            </li>
            <div class="menulist">
                <?php if($login_type == 1): ?>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : ''; ?>">
                        <a href="index.php?page=home">
                            <div class="icon"><ion-icon name="home"></ion-icon></div>
                            <div class="text">Home</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'files' ? 'active' : ''; ?>">
                        <a href="index.php?page=files">
                            <div class="icon"><ion-icon name="document"></ion-icon></div>
                            <div class="text">Files</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'users' ? 'active' : ''; ?>">
                        <a href="index.php?page=users">
                            <div class="icon"><ion-icon name="people"></ion-icon></div>
                            <div class="text">Users</div>
                        </a>
                    </li>
                <?php elseif($login_type == 2): ?>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'employee' ? 'active' : ''; ?>">
                        <a href="index.php?page=home">
                            <div class="icon"><ion-icon name="home"></ion-icon></div>
                            <div class="text">Home</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'files' ? 'active' : ''; ?>">
                        <a href="index.php?page=files">
                            <div class="icon"><ion-icon name="document"></ion-icon></div>
                            <div class="text">Files</div>
                        </a>
                    </li>
                    <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'personal' ? 'active' : ''; ?>">
                        <a href="index.php?page=personal">
                            <div class="icon"><ion-icon name="people"></ion-icon></div>
                            <div class="text">Personal Information</div>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="<?php echo isset($_GET['page']) && $_GET['page'] == 'shared-files' ? 'active' : ''; ?>">
                    <a href="index.php?page=shared-files">
                        <div class="icon"><ion-icon name="share"></ion-icon></div>
                        <div class="text">Shared Files</div>
                    </a>
                </li>
            </div>
            <div class="bottom">
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
                                <img src="profile_pics/<?php echo $user['profile_pic']; ?>" width="100" height="100" alt="Profile Picture">
                            <?php else: ?>
                                <img src="profile_pics/.png" width="100" height="100" alt="Default Profile Picture">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text"><?php echo $user['name']; ?></div>
                </a>
            </li>

                </li>
                <li>
                    <a href="logout.php">
                        <div class="icon"><ion-icon name="log-out"></ion-icon></div>
                        <div class="text">Logout</div>
                    </a>
                </li>
            </div>
        </ul>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./js/navbar.js"></script>
</body>
</html>
