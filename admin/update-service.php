    <?php
        session_start();
        include('../dbConnection.php');
        include('partials/header.php');
        ?>
<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM services WHERE id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Service
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    } else{
        header("Location:manage-services.php");
    }
    ?>
    <main>
    <div class="container">
                    <div class="row">
                        <div class="col-2">
                <div class="formContainerAdd">
                                <div class="formBtn">
                                    <span>Update Service</span>
                                    <hr id="indicator">
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                
                                    <input type="text" name="title" value="<?php echo $title;?>">
                                    <textarea name="description" cols="35" rows="5"<?php echo $description; ?> ></textarea>
                                    <input type="number" name="price" value="<?php echo $price;?>">
                                    <label>Current Image:</label>
                                    <?php
                                    if($current_image != ""){
                                        //display image
                                        ?>
                                        <img src="../images/service/<?php echo $current_image; ?>" width="150px">
                                        <?php

                                    }else{
                                        echo "<div class='error'>Image Not Added.</div>";
                                    }
                                    ?>
                                    <label>New Image:</label>
                                    <input type="file" name="image">
                                    <select name="category">
                                    <?php 
                                    //Create PHP Code to display categories from Database
                                    $sql = "SELECT * FROM category WHERE active='Yes'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    //IF count is greater than zero, we have categories else we donot have categories
                                    if($count>0)
                                    {
                                        //WE have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the details of categories
                                            $category_id = $row['id'];
                                            $category_title = $row['title'];

                                            ?>

                                         <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //WE do not have category
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                

                                    // Display on Drpopdown
                                ?>
                                </select> <br>
                                    <label>Featured:
                                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                                        <input <?php if($featured=="Np"){echo "checked";}?> type="radio" name="featured" value="No">No
                                        </label>                           
                                <label>Active:
                                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                                    </label>
                                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <button type="submit" name="submit" class="btn">Update Service</button>
                                    
                                </form>
    <?php
            if(isset($_POST['submit'])){
            //get all the data
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

              //update new image
              if(isset($_FILES['image']['name'])){
              //get image details
              $image_name = $_FILES['image']['name'];
              if($image_name!= ""){
              //upload new image
              $source_path = $_FILES['image']['tmp_name'];
              $destination_path = "../images/service/".$image_name;
               //uploads the image    
              $upload = move_uploaded_file($source_path, $destination_path);

               if($upload==false){
               $_SESSION['upload'] = "<div class= 'error'>Failed to Upload Image.</div>";
               header("Location:manage-services.php");
               die();
                }
              //remove current image
                if($current_image!=""){
                $remove_path = "../images/service/".$current_image;
                $remove = unlink($remove_path);
                //check if image is removed
                if($remove==false){
                $_SESSION['failed-remove'] = "<div class='error>Failed to remove Current Image.</div>";
                 header("Location:manage-services.php");
                  die();
                  }
                                        
                }
                 }else{
                 $image_name = $current_image;  
                }
                }else{
                $image_name = $current_image;
                }
                    //update the services database
                    $sql3 = "UPDATE services SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";
                //execute query
                    $res3 = mysqli_query($conn,$sql3);
                    if($res3==true){
                    $_SESSION['update']= "<div class='success'>Service Updated Successfully.</div>";
                    header("Location:manage-services.php");
                    }else{
                    $_SESSION['update']= "<div class='error'>Failed to Update Service.</div>";
                    header("Location:manage-services.php");
                    }
                                }
    ?>
    </main>



    <?php include('partials/footer.php');?>