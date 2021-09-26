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
                <section id="sideNav">
        <nav>
            <ul>

                <li> <a href="#banner">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li> <a href="#services">Services</a></li>
                <li><a href="#testimonial">Testimonials</a></li>
                <li><a href="#meetUs">Meet Us</a></li>

            </ul>
        </nav>
        <div id="menuBtn">
            <img src="images/menu.png" alt="menu png" id="menu">
        </div>
    </section>
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
                <img src="images/menu.png" alt="" class="menuBtn" id="menu">
            </div>
            </div>
        </div>
    </header>
    
 
    <footer>
        <section id="meetUs">
            <img src="images/NOAH DISTRIBUTORS PNG.png" class="footerImg">
            <div class="titleText">
                <p>CONTACT US</p>
                <h1>Visit Our Shop Today</h1>
            </div>
            <div class="footerRow">
                <div class="footerLeft">
                    <h1>Openning Hours</h1>
                    <p><i class="far fa-clock"> </i>Monday to Friday -7:00 AM to 7:00 PM </p>
                    <p><i class="far fa-clock"> </i>Saturday and Sunday - 9:00AM to 7:00PM</p>
                </div>
                <div class="footerRight">
                    <h1>Get In Touch</h1>
                    <p>Lukenya Bike Station <i class="fas fa-map-marker-alt"></i></p>
                    <p>noahdistributors@ac.ke <i class="fas fa-paper-plane"></i></p>
                    <p>+254705735315 <i class="fas fa-phone"></i></p>
                </div>
            </div>
            <div class="socialLinks">
            <a href="https://web.facebook.com/Noah-Distributors-111171030607198/ " target="_blank " class="icon-link "><i class="fab fa-facebook-square "></i></a>
            <a href="https://www.instagram.com/noahdistributors/ " target="_blank " class="icon-link "><i class="fab fa-instagram "></i></a>
            <a href="https://twitter.com/Noahdistributor" target="_blank"><i class="fab fa-twitter "></i></a>
            <a href="https://www.youtube.com/channel/UC1Iv18vLduprWj7RXv806dA" target="_blank"><i class="fab fa-youtube "></i></a>
                <p>2021 All Rights Reserved, Noah Distributors. Devloped by <a href="https://github.com/Ngomeli" target="_blank" >Joshua Ngomeli</a> </p>
            </div>
        </section>
    </footer> 
    <script src="main.js"></script>
</body>
</html>