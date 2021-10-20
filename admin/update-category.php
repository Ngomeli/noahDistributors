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
                                <span>Update Category</span>
                                <hr id="indicator">
                                <?php
                                //check if id id set or not
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM category WHERE id=$id";
                                    $res = mysqli_query($conn,$sql);
                                    //count the rows to if id is valid
                                    $count = mysqli_num_rows($res);
                                    if($count==1){
                                        $row = mysqli_fetch_assoc($res);
                                        $title = $row['title'];
                                        $current_image = $row['image_name'];
                                        $featured = $row['featured'];
                                        $active = $row['active'];
                                    }else{
                                        $_SESSION['no-category-found']="<div class='error'>Category not found.</div>";
                                        header("Location:manage-category.php");
                                    }
                                }else{
                                    header("Location:manage-catogory.php");
                                }
                                // if(isset($_SESSION['add'])){
                                //     echo $_SESSION['add'];
                                //     unset($_SESSION['add']);
                                // }
                                
                                ?>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                            
                                <input type="text" name="title" value="<?php echo $title;?>">
                                <label>Current Image:</label>
                                <?php
                                if($current_image != ""){
                                    //display image
                                    ?>
                                    <img src="../images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php

                                }else{
                                    echo "<div class='error'>Image Not Added.</div>";
                                }
                                ?>
                                <label>New Image:</label>
                                <input type="file" name="image">
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
                                <button type="submit" name="submit" class="btn">Update Category</button>
                                   
                             </form>
                             <?php
                            if(isset($_POST['submit'])){
                                //get all the data
                                $id = $_POST['id'];
                                $title = $_POST['title'];
                                $current_image = $_POST['current_image'];
                                $featured = $_POST['featured'];
                                $active = $_POST['active'];

                                //update new image
                                if(isset($_FILES['image']['name'])){
                                    //get image details
                                    $image_name = $_FILES['image']['name'];
                                    if($image_name!= ""){
                                            //upload new image
                                            $source_path = $_FILES['image']['tmp_name'];
                                    $destination_path = "../images/category/".$image_name;
                                   
                                    $upload = move_uploaded_file($source_path, $destination_path);

                                    if($upload==false){
                                        $_SESSION['upload'] = "<div class= 'error'>Failed to Upload Image.</div>";
                                        header("Location:add-category.php");
                                        die();
                                    }
                                    //remove current image
                                    if($current_image!=""){
                                        $remove_path = "../images/category/".$current_image;
                                        $remove = unlink($remove_path);
                                        //check if image is removed
                                        if($remove==false){
                                            $_SESSION['failed-remove'] = "<div class='error>Failed to remove Current Image.</div>";
                                            header("Location:manage-category.php");
                                            die();
                                    }
                                    
                                    }
                                    }else{
                                        $image_name = $current_image;  
                                    }
                                }else{
                                    $image_name = $current_image;
                                }
                                //update the database
                                $sql2 = "UPDATE category SET
                                title = '$title',
                                image_name = '$image_name',
                                featured = '$featured',
                                active = '$active'
                                WHERE id = $id
                                ";
                                //execute query
                                $res2 = mysqli_query($conn,$sql2);

                                if($res2==true){
                                    $_SESSION['update']= "<div class='success'>Category Updated Successfully.</div>";
                                    header("Location:manage-category.php");
                                }else{
                                    $_SESSION['update']= "<div class='error'>Failed to Update Category.</div>";
                                    header("Location:manage-category.php");
                                }
                            }
                             ?>
 </main>
<?php include('partials/footer.php');?>