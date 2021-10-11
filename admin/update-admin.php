    <?php
    session_start();
    include('../dbConnection.php');
    include('partials/header.php');
    ?>
    <main>
    <div class="container">
                <div class="row">
                
                        <?php 
                        //get id of Admin
                        $id=$_GET['id'];
                        //sql query to get details
                        $sql="SELECT * FROM admin WHERE id=$id";
                        //execute query
                        $res=mysqli_query($conn,$sql);
                        //check query is executed or not
                        if($res==TRUE){
                            //check if data is available or not
                            $count= mysqli_num_rows($res);
                            if($count==1){
                                //get the details
                                $row= mysqli_fetch_assoc($res);
                                $full_name = $row['full_name'];
                                $user_name = $row['user_name'];
                            }else{
                                //redirect to manage admin page
                                header("Location:manage-admin.php");
                            }

                        }
                        ?>

                    
                    <div class="col-2">
            <div class="formContainer">
                            <div class="formBtn">
                                <span>Update Admin</span>
                                <hr id="indicator">
                            </div>
                            <form action="" method="POST">
                                <input type="text" name="full_name" value="<?php echo $full_name;?>">
                                <input type="text" name="user_name" value="<?php echo $user_name;?>">
                                <!-- hidden hides the id -->
                                <input type="hidden" name="id" value="<?php echo $id;?>"> 
                                <button type="submit" name="submit" class="btn">Update Admin</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </main>
    <?php
    //check if submit is clicked

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name']; 

        //SQL query to update Admin
        $sql = "UPDATE admin SET
        full_name = '$full_name',
        user_name = '$user_name'
        WHERE id = '$id'";

        //excute query
        $res = mysqli_query($conn,$sql);

        //check if wxecuted successfully
        if($res==TRUE){
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            header("Location: manage-admin.php");
        }else{
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            header("Location: manage-admin.php");
        }

    }

    include('partials/footer.php');
    ?>