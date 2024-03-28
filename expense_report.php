
<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
if (strlen($_SESSION['petuid']==0)) {
  header('location:logout.php');
  } else{
?>
  
  <!DOCTYPE html>
<!--  -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Admin Dashboard  </title>-->
    <link rel="stylesheet" href="css/styleMain.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">



     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-album'></i>
      <span class="logo_name">Expenditure</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="main.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="add_expense.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Expenses</span>
          </a>
        </li>
        <li>
          <a href="manage_expense.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Manage List</span>
          </a>
        </li>
        
        
        <li>
          <a href="report.php" class="active">
          <i class="bx bx-file"></i>
            <span class="links_name">Report</span>
          </a>
        </li>
        <li>
          <a href="analytics.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Analytics</span>
          </a>
        </li>
        <li>
          <a href="limit.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Set Limit</span>
          </a>
        </li>
        <li>
          <a href="user_profile.php" >
            <i class='bx bx-cog' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
    <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Report</span>
      </div>
   

      <?php
$uid=$_SESSION['petuid'];
$ret=mysqli_query($con,"select username from tbluser where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['name'];

?>

      <div class="profile-details">
  <img src="img/rupee.jpg" alt="">
  <span class="admin_name"><?php echo $name; ?></span>
  <i class='bx bx-chevron-down' id='profile-options-toggle'></i>
  <ul class="profile-options" id='profile-options'>
  <li><a href="user_profile.php"><i class="fas fa-user-circle"></i> User Profile</a></li>
    <!-- <li><a href="#"><i class="fas fa-cog"></i> Account Settings</a></li> -->
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
</div>


<script>
  const toggleButton = document.getElementById('profile-options-toggle');
  const profileOptions = document.getElementById('profile-options');
  
  toggleButton.addEventListener('click', () => {
    profileOptions.classList.toggle('show');
  });
</script>


    </nav>

<?php
session_start();

$fdate = $_GET['startDate'];
$tdate = $_GET['endDate'];

?>
<div class="home-content">
  <div class="overview-boxes">
    <div class="col-md-12">
      <br>
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Expense Report</h4>
            </div>
          </div>
        </div>
        <div class="card-body" id="printable">
          <h5 align="center" style="color:blue">Datewise Expense Report from <span style="color:red"><?php echo $fdate ?></span> to <span style="color:red"><?php echo $tdate ?></span></h5>
          <hr />
          <?php
          $userid=$_SESSION['petuid'];
          $ret=mysqli_query($con,"SELECT expensedate,category,description,notedate,SUM(expensecost) as totaldaily FROM `tblexpense`  where (expensedate BETWEEN '$fdate' and '$tdate') && (userid='$userid') group by expensedate, category");
          if(mysqli_num_rows($ret) > 0) {
          ?>
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>S.NO</th>
                <th>Date</th>
                <th>Category</th>
                <th>Description</th>
                <th>Registered Date</th>
                <th>Expense Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $cnt=1;
              $totalsexp=0;
              while ($row=mysqli_fetch_array($ret)) {
              ?>
              <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['expensedate'];?></td>
                <td><?php  echo $row['category'];?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $row['notedate'];?></td>
                <td><?php  echo $ttlsl=$row['totaldaily'];?></td>
              </tr>
              <?php
              $totalsexp+=$ttlsl; 
              $cnt=$cnt+1;
              }?>
              <tr>
              <th colspan="5" style="text-align:center">Grand Total</th>
              <td><b><?php echo number_format($totalsexp, 2); ?></b></td>
            </tr>

            </tbody>
          </table>
          <?php
          } else {
            echo "<p style='text-align:center'><b>No data found</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>


    </section>

<script>
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
sidebar.classList.toggle("active");
if(sidebar.classList.contains("active")){
sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
</script>
<?php } ?>