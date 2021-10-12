    <?php 
        session_start();
        include('../dbConnection.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/6153223a38.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <title>Noah Distributors</title>
    </head>
    <body>
        <main>
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <div class="formContainer">
                                <div class="formBtn">
                                    <span>Login</span>
                                    <hr id="indicator">
                                    <?php
                                    if(isset($_SESSION['login'])){
                                        echo $_SESSION['login'];
                                        unset ($_SESSION['login']);
                                    }
                                    ?>
                                    <br><br>
                                </div>
                                <form action="" method="POST">
                                    <input type="text" name="user_name" placeholder="Username">
                                    <input type="password" name="password" placeholder="password">
                                    <button type="submit" name="submit" class="btn">Login</button>
                                   <p>Created By <a href="https://github.com/Ngomeli" target="_blank">Joshua Ngomeli</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        </html>
<?php

if(isset($_POST['submit'])){

    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE user_name='$user_name' AND password='$password'";
    
    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);

    if($count==1){
        $_SESSION['login']="<div class='success'>Login Successful.</div>";
        header("Location:index.php");
    }else{
        $_SESSION['login']="<div class='error'>Username or Password did not match.</div>";
        header("Location:login.php");
    }
}
?>