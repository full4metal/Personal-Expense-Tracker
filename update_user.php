<?php
session_start(); // added session_start() to start session
include('include/dbconnection.php');

if (isset($_POST['update_user'])) {

    $userid = $_SESSION['petuid'];
    $username = $_POST['name'];
    $email = $_POST['email'];

    $ret=mysqli_query($con, "select email from tbluser where email='$email' ");
    $result=mysqli_fetch_array($ret);
    if($result>0)
    {
    $msg="This email is associated with another account";
    echo "<script type='text/javascript'>alert('$msg');</script>";
    echo " <script type='text/javascript'>window.location.href = 'user_profile.php';</script>";
    }
    else{
    $update_query = "UPDATE tbluser SET email='$email' WHERE id=$userid";
    $result = mysqli_query($con, $update_query);
    if ($result) {
        $message = "Profile updated successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo " <script type='text/javascript'>window.location.href = 'user_profile.php';</script>";
        exit();
    } else {
        // Handle the error case
        echo "Error updating user information: " . mysqli_error($con);
    }
}
}

?>