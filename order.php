<?php 
session_start();
include("header.php");
?>

<?php 
        //CHeck whether service id is set or not
        if(isset($_GET['service_id']))
        {
            //Get the service id and details of the selected food
            $service_id = $_GET['service_id'];

            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM services WHERE id=$service_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //service not Availabe
                //REdirect to Home Page
                header("Location:index.php");
            }
        }
        else
        {
            //Redirect to homepage
            header("Location:index.php");
        }
    ?>

    <!-- service sEARCH Section Starts Here -->
    <section class="service-search">
        <div class="containerF">
            
            <h2 class="text-center text-white">Fill this form to confirm your booking.</h2>

            <form action="" method="POST" class="service">
                <fieldset>
                    <legend>Selected Service</legend>

                    <div class="service-menu-img">
<?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
?>
                                <img src="images/service/<?php echo $image_name; ?>"class="img-responsive img-curve">
<?php
                            }
?>
                        
                    </div>
    
                    <div class="service-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="service" value="<?php echo $title; ?>">

                        <p class="service-price">Ksh<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="book-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <input type="hidden" name="book_date" class="hidden">
                        <div class="book-label">Request Date and Time</div>
                        <input type="datetime-local" name="service_date" class="input-responsive">
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Booking Details</legend>
                    <div class="book-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Joshua Ngomeli" class="input-responsive" required>

                    <div class="book-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +254xxxxxx" class="input-responsive" required>

                    <div class="book-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. joshuangomeli@gmail.com" class="input-responsive" required>

                    <div class="book-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, County" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Booking" class="btn btn-primary">
                </fieldset>

            </form>

<?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $service = $_POST['service'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $book_date = $_POST['book_date'];
                    $total = $price * $qty; // total = price x qty 
                    $book_date = date("Y-m-d h:i:sa"); //booking DAte


                    $status = "Booked";  // booked, alreardyy,Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $service_date = $_POST['service_date'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO service_booking SET 
                        service = '$service',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        book_date = '$book_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        service_date = '$service_date'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);
                    //Check whether query executed successfully or not
                    
                    if($res2==true)
                    {
                        //Query Executed 
                        $_SESSION['service_book'] = "<div class='success text-center'>Service Booked Successfully.</div>";
                        if(!headers_sent()){
                            header("location:index.php");
                        }else{
                            echo '<script type="text/javascript">windows.location.href="index.php";</script>';
                        }
                        
                       
                    }
                    else
                    {
                        //Failed to Save booking
                        $_SESSION['service_book'] = "<div class='error text-center'>Failed to Book Service.</div>";
                        header("Location:index.php");
                    }

                }
?>

        </div>
    </section>




<?php include("footer.php"); ?>