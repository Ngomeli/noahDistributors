    <?php 
    session_start();
    include('partials/header.php');
    include('../dbConnection.php');
    ?>
        <main>
            <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <?php
            if(isset($_SESSION['login'])){
              echo $_SESSION['login'];
              unset ($_SESSION['login']);
            }
          ?>
         <br><br>
            <div class="col-4 text-center">
                <h1>The</h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>The</h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>The</h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <h1>The</h1>
                <br>
                Categories
            </div>
            <div class="clearfix"></div>
            </div>
        </main>
    <?php include('partials/footer.php');?>