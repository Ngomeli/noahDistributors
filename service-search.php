<?php 
session_start();
include("dbConnection.php");
include("header.php");
?>

  <!-- Service sEARCH Section Starts Here -->
  <section class="food-search text-center">
        <div class="containerF">
            <?php 

                //Get the Search Keyword
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>


            <h2>Services on Your Search <a href="#" class="text-black">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Service sEARCH Section Ends Here -->



    <!-- Service Section Starts Here -->
    <section class="service-menu">
        <div class="containerF">
            <h2 class="text-center">Services</h2>

            <?php 

                //SQL Query to Get service based on search keyword
                //$search = bikes '; DROP database name;
                
                $sql = "SELECT * FROM services WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether service available or not
                if($count>0)
                {
                    //Service Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="service-menu-box">
                            <div class="service-menu-img">
                                <?php 
                                    // Check whether image name is available or not
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
                    echo "<div class='error'>Service not found.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>




<?php include("footer.php"); ?>