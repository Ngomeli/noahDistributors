<?php 
session_start();
include('../dbConnection.php');
include('partials/header.php');

?>
<main>
    <div class="wrapper">
    <h1>Manage Services</h1>
    <br>
        <a href="add-service.php" class="btn-primary">Add Service</a>
        <br><br>
        <?php
            if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
                }
            if(isset($_SESSION['upload'])){
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
                } 
            if(isset($_SESSION['failed-remove'])){
               echo $_SESSION['failed-remove'];
               unset($_SESSION['failed-remove']);
                } 
          if(isset($_SESSION['update'])){
             echo $_SESSION['update'];
            unset($_SESSION['update']);
            } 
            ?>
       <table class="tbl-full">
           <tr>
               <th>S.N</th>
               <th>Title</th>
                <th>Price@hour</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
           </tr>
           <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM services";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>
                                    <td>Ksh<?php echo $price; ?></td>
                                    
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="../images/service/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
          
                  <a href="update-service.php?id=<?php echo $id; ?>" class="btn-secondary">Update Service</a> 
                  <a href="delete-service.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Service</a> 
               </td>
           </tr>
           <?php
        }
           
        }
        else
        {
            //Food not Added in Database
            echo "<tr> <td colspan='7' class='error'> Service not Added Yet. </td> </tr>";
        }

    ?>
       </table>
    </div>
</main>

<?php include('partials/footer.php');?>