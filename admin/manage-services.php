<?php 
include('partials/header.php');
include('../dbConnection.php');
?>
<main>
    <div class="wrapper">
    <h1>Manage Services</h1>
    <br>
        <a href="#" class="btn-primary">Add Service</a>
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