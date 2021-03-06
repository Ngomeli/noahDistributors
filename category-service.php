<?php 
session_start();
include("header.php");
?>
 <?php 
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            //CAtegory not passed
            //Redirect to Home page
            header("Location:index.php");
        }
    ?>


    <!-- Service sEARCH Section Starts Here -->
    <section class="service-search text-center">
        <div class="container">
            
            <h2>Services on <a href="#" class="text-black">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- service sEARCH Section Ends Here -->



    <!-- service MEnu Section Starts Here -->
    <section class="service-menu">
        <div class="containerF">
            <h2 class="text-center">Services</h2>

            <?php 
            
                //Create SQL Query to Get Service based on Selected CAtegory
                $sql2 = "SELECT * FROM services WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

                //CHeck whether service is available or not
                if($count2>0)
                {
                    //Service is Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        
                        <div class="service-menu-box">
                            <div class="service-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="images/service/<?php echo $image_name; ?>"class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="service-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="service-price">$<?php echo $price; ?></p>
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
                    //Service not available
                    echo "<div class='error'>Service not Available.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>





<?php include("footer.php"); ?>