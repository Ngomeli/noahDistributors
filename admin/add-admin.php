
<?php
 include('partials/header.php');
 include('../dbConnection.php');

if(isset($_POST['submit'])){
    //Get data from the form
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);//md5 encrypts the password

    //sql query to save the data in the database
    $sql = "INSERT INTO admin SET 
          full_name='$full_name',
          user_name='$user_name',
          password='$password'";

    //execute query and save data in database
    $res = mysqli_query($conn,$sql);

}



?>
<main>
        <div class="container">
            <div class="row">
                <div class="col-2">
        <div class="formContainer">
                        <div class="formBtn">
                            <span>Add Admin</span>
                            <hr id="indicator">
                        </div>
                        <form action="" method="POST">
                            <input type="text" name="full_name" placeholder="Enter Full Name">
                            <input type="text" name="user_name" placeholder="Enter Username">
                            <input type="password" name="password" placeholder="Your Password">
                            <button type="submit" name="submit" class="btn">Add Admin</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
</main>
<?php include('partials/footer.php');?>