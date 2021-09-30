<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6153223a38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
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
                        <li><?php echo $user_data['user_name']; ?> <a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
                <a href="cart.html" target="_blank"><img src="images/cart.png" alt="Cart image" class="cart" width="30px" height="30px"></a>
                <div id="menuBtn">
                <img src="images/menu.png" alt="" class="menuBtn" id="menu" onclick="menutoggle()">
            </div>
            </div>
        </div>
    </header>