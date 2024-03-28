<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
if(isset($_POST['submit']))
{
    $fname=$_POST['username'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $ret=mysqli_query($con, "select email from tbluser where email='$email' ");
    $usrname = mysqli_query($con, "select username from tbluser where username='$fname' ");
    $result=mysqli_fetch_array($ret);
    $result1=mysqli_fetch_array($usrname);
    if($result>0)
    {
    $msg="This email is associated with another account";
    }
    elseif($result1>0)
    {
        $msg = "This username is associated with another account";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(username, email, password) value('$fname', '$email', '$password' )");
    if ($query) {
    $msg="You have successfully registered";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Expense Tracker</title>
    <link rel="stylesheet" href="css/styleReg.css">
    <script type="text/javascript">
        
        function checkpass()
        {
            var password = document.signup.password.value;
            var confirmPassword = document.signup.confirmpass.value;
            
        // Check if the password meets the minimum length requirement
        if (password.length < 4) {
            alert('Password must be at least 4 characters long');
            document.signup.password.focus();
            return false;
        }
         // Check if the password and confirmation password match
        if(password !== confirmPassword)
        {
            alert('Password and confirm Password field does not match');
            document.signup.confirmpass.focus();
            return false;
        }
            return true;
        } 

    </script>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form role="form" action="" method="post" name="signup" onsubmit="return checkpass();">
        <?php if($msg)
         {
            echo $msg;
            echo "<script type='text/javascript'>alert('$msg');</script>";
            echo " <script type='text/javascript'>window.location.href = 'registration.php';</script>";
         }
         ?>  
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required oninvalid="this.setCustomValidity('Please enter a valid email address')" oninput="this.setCustomValidity('')">
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirmpass" required>
            </div>

          
            <div class="btns">
            <button type="submit" name="submit">Register</button>
            <a href="index.php"><button type="button" id="sign-up">Login</button></a>
            </div>  
        </form>
    </div>
</body>
</html>
