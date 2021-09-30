<?php
session_start();

include("dbConnection.php");
include("functions.php");

$user_data = check_login($conn);

?>
<?php include("header.php");?>
    
 
 <?php include("footer.php");?>
    <script src="main.js"></script>
</body>
</html>