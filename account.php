<?php
session_start();

 include("dbConnection.php");
 include("functions.php");

 $user_data = check_login($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6153223a38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Noah Distributors</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.php"> <img src="images/NOAH DISTRIBUTORS PNG.png" alt="logo icon" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="account.php" target="_blank">Account</a></li>
                    </ul>
                </nav>
                <a href="cart.html" target="_blank"><img src="images/cart.png" alt="Cart image" class="cart" width="30px" height="30px"></a>
                <img src="images/menu.png" alt="" class="menuBtn" onclick="menutoggle()">
            </div>
        </div>
    </header>
    <section class="accountPage">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <!-- <img src="images/account.jpeg" width="100%"> -->
                </div>
                <div class="col-2">
                    <div class="formContainer">
                        <div class="formBtn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="indicator">
                        </div>
                        <form method="post" id="loginForm">
                            <input type="text" name="user_name" placeholder="Username">
                            <input type="password" name="password" placeholder="password">
                            <button type="submit" id="button" class="btn">Login</button>
                            
                        </form>
                        <form method="post" id="registerForm">
                            <input type="text" name="user_name" placeholder="Username">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="password">
                            <button type="submit" class="btn">Register</button>
                            <!-- <a href="login.php">Already have account?</a> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="main.js"></script>
</body>
</html>