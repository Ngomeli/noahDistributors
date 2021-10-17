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
                                <span>Add Admin</span>
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
                                <table>
                                <input type="text" name="title" placeholder="Category Title">
                                <input type="file" name="image">
                                <label>Featured:
                                    <input type="radio" name="featured" value="Yes">Yes
                                    <input type="radio" name="featured" value="No">No
                                </label>
                               
                            <label>Active:
                                    <input type="radio" name="active" value="Yes">Yes
                                    <input type="radio" name="active" value="No">No
                                    </label>                                
                                <tr>
                                    <td colspan="6">
                                    <button type="submit" name="submit" class="btn">Add Category</button>
                                    </td>
                                </tr>
                                <!-- <input type="password" name="password" placeholder="Your Password">
                                -->
                                </table>
                            </form>
                            <?php
                            //check if submit button is clicked
                            if(isset($_POST['submit'])){
                            $title = $_POST['title'];
                            //we need check if radio button is selected or not
                            if(isset($_POST['featured'])){
                                //Get value from
                                $featured = $_POST['featured'];
                            } else{
                                    //set the default value
                                    $featured = "No";
                            }
                            if(isset($_POST['active'])){
                                $active = $_POST['active'];
                            }else{
                                $active = "No";
                            }
                            //check if image is selected or not
                            // print_r($_FILES['image']);

                            // die();//Breaks the code
                            if(isset($_FILES['image']['name'])){
                                //upload image
                                $image_name = $_FILES['image']['name'];
                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/category/".$image_name;
                                // $destination_path = "../images/category/".$image_name;

                                $upload = move_uploaded_file($source_path, $destination_path);

                                if($upload==false){
                                    $_SESSION['upload'] = "<div class= 'error'>Failed to Upload Image.</div>";
                                    header("Location:add-category.php");
                                    die();
                                }

                            }else{
                                //don't upload image
                                $image_name="";
                            }
                            //create sql query to insert category to database
                            $sql = "INSERT INTO category SET
                            title= '$title',
                            image_name= '$image_name',
                            featured= '$featured',
                            active = '$active'";
                            

                            //execute query and save in database
                            $res = mysqli_query($conn,$sql);
                            //check if the query us executed or not
                            if($res==true){
                                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                                header("Location:manage-category.php");
                            }else{
                                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                                header("Location:add-category.php");
                            }
                            }
                            
                            
                            
                            ?>
                        </div>
                    </div>

                </div>
            </div>
    </main>


    <?php include('partials/footer.php');?>