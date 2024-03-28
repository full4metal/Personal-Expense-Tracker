<?php
session_start();
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get updated data for the chart
$userid=$_SESSION['petuid'];
$query=mysqli_query($con,"SELECT expensedate, SUM(expensecost) as total_cost FROM tblexpense WHERE userid='$userid' AND expensedate > DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY expensedate");
$data = array();
while ($result = mysqli_fetch_array($query)) {
  $data[] = array(strtotime($result['expensedate']) * 1000, (float)$result['total_cost']);
}

// Return data as JSON
echo json_encode($data);
?>
