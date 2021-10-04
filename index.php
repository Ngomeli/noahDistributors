<?php
session_start();

include("dbConnection.php");
include("functions.php");

$user_data = check_login($conn);

?>
<?php include("header.php");?>
<section class="accountPage">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <!-- <img src="images/image1.png" width="100%"> -->
                </div>
                <div class="col-2">
                    <div class="formContainer">
                        <div class="formBtn">
                            <span onclick="services()">Services</span>
                            <span onclick="products()">Products</span>
                            <hr id="indicator">
                        </div>
                        <form action="" method="POST" id="servicesForm">
                            <label for="">Book for a Service</label>
                            <select name="services">
                                <option value="">--Select--</option>
                                <option value="pickUp">Moving Service</option>
                                <option value="bike">Bike Hiring</option>
                                <option value="skates">skates Hiring</option>
                            </select><br>
                            <label for="">Date and Time</label>
                            <input type="datetime-local"name="bookings">
                            <button type="submit" class="btn">Book Service</button>
                            <a href="logout.php">Click to Cancel Booking</a>
                        </form>
                        <form action="" method="POST" id="productsForm">
                            <label for="">Buy Product</label>
                            <select name="products">
                                <option value="">--Buy--</option>
                                <option value="achari">Achari</option>
                                <option value="hoodie">Hoodie</option>
                                <option value="tshirt">T-shirt</option>
                            </select>
                            <button type="submit" class="btn">But Product</button>
                            <a href="logout.php">Click to Cancel Purchase</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <?php include("footer.php");?>
    <script src="main.js"></script>
</body>
</html>