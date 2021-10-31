<?php 
session_start();
include('../dbConnection.php');
include('partials/header.php');

?>
<main>
    <div class="wrapper">
    <h1>Manage Services Booking</h1>
       <?php 
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
            }
            ?>
          <br>
          <table class="tbl-full">
       <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the bookings from database
                        $sql = "SELECT * FROM service_booking ORDER BY id DESC"; // DIsplay the Latest Booking at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $service = $row['service'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $book_date = $row['book_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $service; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $book_date; ?></td>
                                        <td>
                                            <?php 
                                                // Booked, Available, Make Booking, Cancelled

                                                if($status=="Booked")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="Available")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Booking Received")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="update-booking.php?id=<?php echo $id; ?>" class=" btn btn-secondary">Update Booking</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>Bookings not Available</td></tr>";
                        }
                    ?>

 
               
       </table>
    </div>
</main>

<?php include('partials/footer.php');?>