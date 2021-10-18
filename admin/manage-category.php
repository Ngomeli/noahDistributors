<?php
session_start();
include('../dbConnection.php'); 
include('partials/header.php');

?>
<main>
    <div class="wrapper">
    <h1>Manage Category</h1>
    <br>
    <?php
    if(isset($_SESSION['add'])){
     echo $_SESSION['add'];
     unset($_SESSION['add']);
     }
     if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
      ?>
                            <br><br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br>
       <table class="tbl-full">
           <tr>
           <th>S.N</th>
           <th>Title</th>
           <th>Image</th>
           <th>Featured</th>
           <th>Active</th>
           <th>Actions</th>
           </tr>
        <?php
        $sql = "SELECT * FROM category";
        $res= mysqli_query($conn,$sql);
        $count= mysqli_fetch_row($res);
        $sn=1;

        if($count>0){
            //get data and display
            while($row=mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

                ?>
            <tr>
               <td><?php echo $sn++; ?></td>
               <td><?php echo $title; ?></td>
               <td>

<?php  
    //Chcek whether image name is available or not
    if($image_name!="")
    {
        //Display the Image
        ?>
        
        <img src="../images/category/<?php echo $image_name; ?>" width="100px" >
        
        <?php
    }
    else
    {
        //DIsplay the MEssage
        echo "<div class='error'>Image not Added.</div>";
    }
?>

</td>
               
               <td><?php echo $featured; ?></td>
               <td><?php echo $active; ?></td>
               <td></td>
               <td>
                  <a href="update-category.php" class="btn-secondary">Update Category</a> 
                  <a href="delete-category.php" class="btn-danger">Delete Category</a> 
               </td>
           </tr>


            <?php
            }

        }else{
            //when do not have data
            ?>
            
            <tr>
                <td colspan="6"><div class="error">No Category Added.</div></td>
            </tr>
            <?php
        }

        ?>
           
       </table>
    </div>
</main>

<?php include('partials/footer.php');?>