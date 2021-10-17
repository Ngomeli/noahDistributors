<?php
session_start();
include('../dbConnection.php'); 
include('partials/header.php');

?>
<main>
    <div class="wrapper">
    <h1>Manage Category</h1>
    <br>
    <?php
    if(isset($_SESSION['add'])){
     echo $_SESSION['add'];
     unset($_SESSION['add']);
     }
      ?>
                            <br><br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br>
       <table class="tbl-full">
           <tr>
               <th>S.N</th>
               <th>Full Name</th>
               <th>Username</th>
               <th>Actions</th>
           </tr>

           <tr>
               <td>1.</td>
               <td>Joshua Ngomeli</td>
               <td>Ngomeli</td>
               <td>
                  <a href="#" class="btn-secondary">Update Admin</a> 
                  <a href="#" class="btn-danger">Delete Admin</a> 
               </td>
           </tr>
       </table>
    </div>
</main>

<?php include('partials/footer.php');?>