<?php
session_start();

include("dbConnection.php");
include("functions.php");

$user_data = check_login($conn);

?>
<?php include("header.php");?>
<section class="service-search text-center">
        <div class="containerF">
            
            <form action="service-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Service.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
<?php
    if(isset($_SESSION['service_book'])){
        echo $_SESSION['service_book'];
        unset($_SESSION['service_book']);
    }
?>
<section class="categories">
        <div class="containerF">
            <h2 class="text-center">Explore Services</h2>
            <?php 
            //SQl query to display categories from database
            $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
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
                   <a href="category-service.php?category_id=<?php echo $id; ?>">
                       <div class="box-3 float-container">
                           <?php
                           if($image_name==""){
                              echo"<div class='error'>Image not Available</div>"; 
                           }else{

                            ?>
                            <img src="images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
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
            <div class="clearfix"></div>
        </div>
</section>
<section class="service-menu">
        <div class="containerF">
            <h2 class="text-center">Services</h2>

            <?php 
            
            //Getting services from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM services WHERE active='Yes' AND featured='Yes' LIMIT 4";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food available or not
            if($count2>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="service-menu-box">
                        <div class="service-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="images/service/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="service-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="service-price">Ksh<?php echo $price; ?></p>
                            <p class="service-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="order.php?service_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Service Not Available 
                echo "<div class='error'>Service not available.</div>";
            }
            
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="services.php">See All Services</a>
        </p>
    </section>


<!-- <section class="accountPage">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <!-- <img src="images/image1.png" width="100%"> -->
                <!-- </div>
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
        </div> -->
    </section>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <?php include("footer.php");?>
    <script src="main.js"></script>
</body>
</html>