    <?php 
    session_start();
    include('../dbConnection.php');
    include('partials/header.php');
    ?>
    <main>
    <div class="container">
                <div class="row">
                    <?php 
                    if(isset($_GET['id'])){
                        $id=$_GET['id'];
                    }


                    ?>
                    <div class="col-2">
                        <div class="formContainer">
                            <div class="formBtn">
                                <span>Change Password</span>
                                <hr id="indicator">
                            </div>
                            <form action="" method="POST">
                                <input type="password" name="current_password" placeholder="Current Password">
                                <input type="password" name="new_password" placeholder="New Password">
                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                <input type="hidden" name="id" value="<?php echo $id;?>"> 
                                <button type="submit" name="submit" class="btn">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php 
    //check if submit is clicked

    if(isset($_POST['submit'])){
    //get the data from form
    $id= $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check whether the user with current id and current password exists or not
    $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";

    //execute the query
    $res = mysqli_query($conn,$sql);

    if($res==TRUE){
        $count = mysqli_num_rows($res);

        if($count==1){
            //check whether the new password matches
            if($new_password==$confirm_password){
                //update the password
                $sql2 = "UPDATE admin SET
                password= '$new_password' 
                WHERE id=$id ";

                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                if($res2==TRUE){
                    $_SESSION['change-pwd'] = "<div class= 'error'>Password Changed Successfully.</div>";
                    header("Location:manage-admin.php"); 
                }
                else{
                    $_SESSION['change-pwd'] = "<div class= 'error'>Failed to Change Password.</div>";
                    header("Location:manage-admin.php"); 
                }

            }else{
                $_SESSION['pwd-not-match'] = "<div class= 'error'>Password Don't Match.</div>";
                header("Location:manage-admin.php"); 
            }

        }else{
            $_SESSION['user-not-found'] = "<div class= 'error'>User Not Found.</div>";
            header("Location:manage-admin.php");
        }
    }
}
    include('partials/footer.php');
    ?>