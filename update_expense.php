<?php
session_start(); 
include('include/dbconnection.php');

if (isset($_POST['submit'])) {
  $userid = $_SESSION['petuid'];
  $dateexpense = $_POST['dateexpense'];
  $category = $_POST['category'];
  $description = $_POST['description']; 
  $costitem = $_POST['cost'];
  $expenseid = $_POST['expenseid'];
  $query = mysqli_query($con, "UPDATE tblexpense SET expensedate='$dateexpense', category=(SELECT categoryname FROM tblcategory WHERE categoryid='$category'), expensecost='$costitem', description='$description' WHERE id='$expenseid' AND userid='$userid'");
  if ($query) {
    $message = "Expense updated successfully";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo " <script type='text/javascript'>window.location.href = 'manage_expense.php';</script>";
  } else {
    $message = "Expense could not be updated";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}

?>
