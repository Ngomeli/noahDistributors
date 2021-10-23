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
                                <span>Add Service</span>
                                <hr id="indicator">
                                <?php
                                if(isset($_SESSION['add'])){
                                    echo $_SESSION['add'];
                                    unset($_SESSION['add']);
                                }
                                if(isset($_SESSION['upload'])){
                                    echo $_SESSION['upload'];
                                    unset($_SESSION['upload']);
                                }
                                ?>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                            
                            <input type="text" name="title" placeholder="Service Title">
                            <textarea name="description" cols="35" rows="5" placeholder="Description of service"></textarea>
                            <input type="number" name="price" placeholder="Price">  
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
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                                    <input type="radio" name="featured" value="Yes" width="10px">Yes
                                    <input type="radio" name="featured" value="No">No
                                    </label>                             
                            <label>Active:</label>
                                    <input  type="radio" name="active" value="Yes">Yes
                                    <input  type="radio" name="active" value="No">No               
                            <button type="submit" name="submit" class="btn">Add Service</button>
</form>
  <?php 

            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                
                
                // Get the Data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                // Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                      
                        // Upload the Image
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/service/".$image_name;

                        //Finally Uppload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header("location:add-service.php");
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //SEtting DEfault Value as blank
                }

                // Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO services SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Service Added Successfully.</div>";
                    header("location:manage-services.php");
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Service.</div>";
                    header("location:manage-services.php");
                }

                
            }

        ?>


    </div>
</div>

</main>
<?php include('partials/footer.php');?>