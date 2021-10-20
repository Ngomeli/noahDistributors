<?php

session_start();
include('../dbConnection.php');
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //Get value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image if avaibale
     if($image_name != ""){
         $path = "../images/category/".$image_name;
         //remove image using the unlink function
         $remove = unlink($path);
        //if failed to remove image 
         if($remove==false){
           $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
           header("Location:manage-category.php");
           //stop the proces
           die();  
         }
     }
    //delete data from database
    //sql query to delete data
     $sql = "DELETE FROM category WHERE id=$id";
     //execute the query
     $res = mysqli_query($conn,$sql);
     //check whether the data is deleted
     if($res==true){
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header("Location:manage-category.php");
     }else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        header("Location:manage-category.php");
     }
    //redirect with a message
}else{
    //redirect to manage category
    header("Location:manage-category.php");
}
?>