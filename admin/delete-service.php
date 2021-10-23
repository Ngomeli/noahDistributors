<?php 
session_start();
include('../dbConnection.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){
     //Get value and delete
     $id = $_GET['id'];
     $image_name = $_GET['image_name'];
 
     //remove the physical image if avaibale
      if($image_name != ""){
          $path = "../images/service/".$image_name;
          //remove image using the unlink function
          $remove = unlink($path);
         //if failed to remove image 
          if($remove==false){
            $_SESSION['remove'] = "<div class='error'>Failed to remove service image.</div>";
            header("Location:manage-services.php");
            //stop the proces
            die();  
          }
      }
     //delete data from database
     //sql query to delete data
      $sql = "DELETE FROM services WHERE id=$id";
      //execute the query
      $res = mysqli_query($conn,$sql);
      //check whether the data is deleted
      if($res==true){
         $_SESSION['delete'] = "<div class='success'>Service Deleted Successfully.</div>";
         header("Location:manage-services.php");
      }else{
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Service.</div>";
         header("Location:manage-services.php");
      }
}else{
    header("Location:manage-services.php");
}


?>