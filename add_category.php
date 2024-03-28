<?php
session_start();
include('include/dbconnection.php');

if (isset($_POST['add-category-submit'])) {
  $CategoryName = mysqli_real_escape_string($con, $_POST['category-name']);
  $userId = $_SESSION['petuid'];

  // Use prepared statement to prevent SQL injection
  $stmt = $con->prepare("INSERT INTO tblcategory (categoryname, userid) VALUES (?, ?)");
  $stmt->bind_param("si", $CategoryName, $userId);
  $result = $stmt->execute();

  if ($result) {
    $message = "Category added successfully!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo " <script type='text/javascript'>window.location.href = 'add_expense.php';</script>";
    exit();
  } else {
    // Error adding category
    echo "Error: " . mysqli_error($con);
  }
}
?>
