    <?php 
    session_start();
    include('partials/header.php');
    include('../dbConnection.php');



    ?>
        <main>
            <div class="wrapper">
            <h1>Manage Admin</h1>
            <?php 

            if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//dispays session message
            unset($_SESSION['add']);//removes session message
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if(isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
                ?>
            <br><br><br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //get data from admin table
                $sql = "SELECT * FROM admin";
                //execute query
                $res = mysqli_query($conn, $sql);

                if($res==TRUE){
                    //Count rows to check data
                    $count = mysqli_num_rows($res); //function to get all the rows in database

                    $sn=1; //variable to help in maintainig the numbers in order incase if deleted

                    if($count>0){
                        //fetct data from the databaes
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $user_name=$rows['user_name'];

                            //Display the values in the table
                            ?>
            <tr>
                <td><?php echo $sn++; ?>.</td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $user_name; ?></td>
                <td>
                    <a href="update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a> 
                    <a href="delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a> 
                    <a href="update-password.php?id=<?php echo $id;?>" class="btn-change">Change Password</a>
                </td>
            </tr>
    <?php
                        }

                    }else{

                    }
                }
                ?>
            
        </table>
            </div>
        </main>
        <?php include('partials/footer.php');?>