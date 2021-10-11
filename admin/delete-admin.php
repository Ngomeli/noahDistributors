<?php

session_start();
include('../dbConnection.php');
//get the id of admin
$id = $_GET['id'];

//sql query to delete admin
$sql = "DELETE FROM admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check query is is successfully executed
if($res==TRUE){
 $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
 header("Location:manage-admin.php");
}else{
$_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.Try Again Later.</div>";
header("Location:manage-admin.php"); 
}

?>