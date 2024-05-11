<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "./css/navigation.css">
</head>
<body>
    <div class="menuToggle"></div>
    <div class= "sidebar">
        <ul>
            <li class= "logo">
                <a href="#">
                    <img src= "./assets/img/BNHS Logo.png" width= 70 height=70>
                    <div class= "text"><b>Bingao National<br>High School</b></div>
                </a>
            </li>
            <div class="menulist">
                <li class="active">
                    <a href="#"> 
                        <div class="icon"><ion-icon name="home"></ion-icon></div>
                        <div class="text">Home</div>
                    </a>    
                </li>
                <li>
                    <a href="#"> 
                        <div class="icon"><ion-icon name="document"></ion-icon></div>
                        <div class="text">Files</div>
                    </a>    
                </li>
                <li>
                    <a href="#"> 
                        <div class="icon"><ion-icon name="people"></ion-icon></div>
                        <div class="text">Users</div>
                    </a>    
                </li>
                <li>
                    <a href="#"> 
                        <div class="icon"><ion-icon name="share"></ion-icon></div>
                        <div class="text">Shared Files</div>
                    </a>    
                </li>
            </div>
            <div class="bottom">
                <li>
                    <a href="#">
                        <div class="icon">
                            <div class="imgBx">
                                <img src= "./assets/img/Catiwa, Kenric.jpeg" width= 100 height=100>
                            </div>
                        </div>
                        <div class="text">Kenric Catiwa</div>
                    </a>
                </li>
                <li>
                    <a href="#"> 
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