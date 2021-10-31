<?php 
session_start();
include("dbConnection.php");
include("header.php");
?>
 <section class="service-search text-center">
        <div class="containerF">
            
            <form action="service-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Service.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Service sEARCH Section Ends Here -->



    <!-- Service Section Starts Here -->
    <section class="service-menu">
        <div class="container">
            <h2 class="text-center">Services</h2>

            <?php 
                //Display Services that are Active
                $sql = "SELECT * FROM services WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the service are availalable or not
                if($count>0)
                {
                    //Service Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="service-menu-box">
                            <div class="service-menu-img">
                                <?php 
                                    //CHeck whether image available or not
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
                    //Service not Available
                    echo "<div class='error'>Service not found.</div>";
                }
            ?>

            

            

            <div class="clearfix"></div>

            

        </div>

    </section>





<?php include("footer.php"); ?>