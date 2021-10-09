<?php 

session_start();

	include("dbConnection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6153223a38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Noah Distributors</title>
</head>
<body>
<section class="accountPage">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <!-- <img src="images/image1.png" width="100%"> -->
                </div>
                <div class="col-2">
                    <div class="formContainer">
                        <div class="formBtn">
                            <span>Login</span>
                            <hr id="indicator">
                        </div>
                        <form action="" method="POST">
                            <input type="text" name="user_name" placeholder="Username">
                            <input type="password" name="password" placeholder="password">
                            <button type="submit" class="btn">Login</button>
                            <a href="register.php">Click to Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>