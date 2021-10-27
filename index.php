<?php
session_start();

include("dbConnection.php");
include("functions.php");

$user_data = check_login($conn);

?>
<?php include("header.php");?>
<section class="categories">
        <div class="containerF">
            <h2 class="text-center">Explore Services</h2>
            <?php 
            //SQl query to display categories from database
            $sql = "SELECT * FROM category";
            //Execute the query
            $res = mysqli_query($conn,$sql);
            //coutnrows to check category is available or not
            $count = mysqli_num_rows($res);

            if($count>0){

                while($row=mysqli_fetch_assoc($res)){
                    //Get the values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                   <a href="category-service.php">
                       <div class="box-3 float-container">
                           <?php
                           if($image_name==""){
                              echo"<div class='error'>Image not Available</div>"; 
                           }else{

                            ?>
                            <img src="images/category/<?php echo $image_name; ?>" class="img-responsive">
                            <?php
                           }

                           ?>
                           

                           <h3 class="float-text text-white"><?php echo $title; ?></h3></h3>
                       </div>
                   </a> 
                   <?php

                }
            }else{
                echo "<div class='error'>Category not Added</div>";
            }
            ?>
        </div>
</section>
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