<?php
    session_start();
    include('../dbConnection.php');
    include('partials/header.php');
    ?>
<main>
<div class="container">
                <div class="row">
                    <div class="col-2">
            <div class="formContainerAdd">
                            <div class="formBtn">
                                <span>Update Booking</span>
                                <hr id="indicator">
                                <?php
                                //check if id id set or not
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM service_booking WHERE id=$id";
                                    $res = mysqli_query($conn,$sql);
                                    //count the rows to if id is valid
                                    $count = mysqli_num_rows($res);
                                    if($count==1){
                                        $row = mysqli_fetch_assoc($res);
                                        $service = $row['service'];
                                        $price = $row['price'];
                                        $qty = $row['qty'];
                                        $status = $row['status'];
                                        $customer_name = $row['customer_name'];
                                        $customer_contact = $row['customer_contact'];
                                        $customer_email = $row['customer_email'];
                                        $customer_address= $row['customer_address'];
                                    }else{
                                        $_SESSION['no-booking-found']="<div class='error'>Booking not found.</div>";
                                        header("Location:manage-services-booking.php");
                                    }
                                }else{
                                    header("Location:manage-services-booking.php");
                                }
                                // if(isset($_SESSION['add'])){
                                //     echo $_SESSION['add'];
                                //     unset($_SESSION['add']);
                                // }
                                
                                ?>
                            </div>
                            <form action="" method="POST">
                            <label>Service Name:</label>
                           <b> <?php echo $service; ?><br></b>
                                <label>Price:</label>
                               <b>Ksh <?php echo $price; ?></b><br>
                               <label>Quantity</label>
                               <input type="number" name="qty" value="<?php echo $qty; ?>">
                                <label>Status:
                                    <select name="status">
                                    <option <?php if($status=="Booked"){echo "selected";}?> value="Booked">Booked</option>
                                    <option <?php if($status=="Available"){echo "selected";}?> value="Available">Availabe</option>
                                    <option <?php if($status=="Booking Recieved"){echo "selected";}?> value="Booking Recieved">Booking Received</option>
                                    <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                                    </select>
                                    </label> <br>                          
                                    <label>Customer Name:</label>
                               <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                               <label>Customer Contact:</label>
                               <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                               <label>Customer Email:</label>
                               <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                               <label>Customer Address:</label>
                               <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                                
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="hidden" name="price" value="<?php echo $price;?>">
                                <button type="submit" name="submit" class="btn">Update Booking</button>
                                   
                             </form>
                             <?php
                            if(isset($_POST['submit'])){
                                //get all the data
                                $id = $_POST['id'];
                                $price = $_POST['price'];
                                $qty = $_POST['qty'];
                
                                $total = $price * $qty;
                
                                $status = $_POST['status'];
                
                                $customer_name = $_POST['customer_name'];
                                $customer_contact = $_POST['customer_contact'];
                                $customer_email = $_POST['customer_email'];
                                $customer_address = $_POST['customer_address'];

                               
                                //update the database
                                $sql2 = "UPDATE service_booking SET
                                qty = $qty,
                                total = $total,
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                                WHERE id=$id
                                ";
                                //execute query
                                $res2 = mysqli_query($conn,$sql2);

                                if($res2==true){
                                    $_SESSION['update']= "<div class='success'>Booking Updated Successfully.</div>";
                                    header("Location:manage-services-booking.php");
                                }else{
                                    $_SESSION['update']= "<div class='error'>Failed to Update Booking.</div>";
                                    header("Location:manage-services-booking.php");
                                }
                            }
                             ?>
            </div>
                    </div>
                </div>
</div>
 </main>


<?php include('partials/footer.php');?>