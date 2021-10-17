<?php
//destroy the session
session_destroy(); //unset $_SESSION['user]
include('../dbConnection.php');

header("Location:login.php");
?>