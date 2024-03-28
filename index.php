<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
if(isset($_POST['login']))
  {
    $fname=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select id from tbluser where username='$fname' && password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['petuid']=$ret['id'];
     header('location:main.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Expense Tracker</title>
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
    <div class="container">
        <h1>Personal Expense Tracker</h1>
        <?php 
        if($msg)
        {
         echo $msg;
         echo "<script type='text/javascript'>alert('$msg');</script>";
         echo " <script type='text/javascript'>window.location.href = 'index.php';</script>";
        }  
         ?> 
        <form role="form" action="" method="post" id="" name="login">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="btns">
            <button type="submit" name="login">Login</button>
            <a href="registration.php"><button type="button" id="sign-up">Sign Up</button></a>
            </div>        
        </form>
    </div>
</body>
</html>
