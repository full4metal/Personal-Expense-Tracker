<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');

if (strlen($_SESSION['petuid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $userid = $_SESSION['petuid'];
    $dateincome = $_POST['dateincome'];
    $Description = $_POST['category-description'];
    $income = $_POST['incomeamnt'];
    $query = mysqli_query($con, "INSERT INTO tblincome(userid, incomedate, incomeamount ,description) VALUES ('$userid', '$dateincome','$income' ,'$Description ')");

 
      //
      if ($query) {
        $mes = "Income added successfully";
        //echo "<script type='text/javascript'>alert('$mes');</script>";
        if ($totalExpense > 0.5 * $categoryLimit) {
          // Set the message in JavaScript variable
          $message = "Category expenses exceed 50% of the limit.";
          echo "<script type='text/javascript'>alert('$message');</script>";
          //echo "<script type='text/javascript'>window.location.href = 'add_expense.php';</script>";
      } else {
        echo "<script type='text/javascript'>alert('$mes');</script>";
          //echo "<script type='text/javascript'>window.location.href = 'add_expense.php';</script>";
      }
        //echo " <script type='text/javascript'>window.location.href = 'add_expense.php';</script>";
        
      } else {
        $mes = "Income could not be added";
        echo "<script type='text/javascript'>alert('$mes');</script>";
      }
    //
    
  
      
    }
    if (isset($_POST['reset_income'])) {
      $userid = $_SESSION['petuid'];
  
      // Reset the income for the user
      $resetIncomeQuery = "DELETE FROM tblincome WHERE userid = '$userid'";
      $resetIncomeResult = mysqli_query($con, $resetIncomeQuery);
  
      if ($resetIncomeResult) {
        $mes = "Income Reset Succesfully";
        echo "<script type='text/javascript'>alert('$mes');</script>";
      } else {
          $mes = "Error resetting income";
          echo "<script type='text/javascript'>alert('$mes');</script>";
      }
  }

  
?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Admin Dashboard  </title>-->
    <link rel="stylesheet" href="css/styleMain.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="js/scripts.js"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

     <style> 
.container {
  background-color: #f2f2f2;
  border-radius: 5px;
  box-shadow: 0px 0px 10px #aaa;
  padding: 20px;
  margin-top: 20px;
}

.form-group label {
  font-weight: bold;
}

.form-control {
  border-radius: 3px;
  border: 1px solid #ccc;
}

.invalid-feedback {
  color: red;
  font-size: 12px;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

     </style>
   </head>
<body>
  <div class="sidebar">
  <div class="logo-details">
      <i class='bx bx-album'></i>
      <span class="logo_name">Expense Tracker</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="main.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="add_expense.php" >
            <i class='bx bx-box' ></i>
            <span class="links_name">Expenses</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Income</span>
          </a>
        </li>
        <li>
          <a href="manage_expense.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Manage Expense</span>
          </a>
        </li>
        <li>
          <a href="Report.php">
            <i class='bx bx-file' ></i>
            <span class="links_name">Report</span>
          </a>
        </li>
        <li>
          <a href="analytics.php">
            <i class='bx bx-pie-chart-alt-2' ></i>
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
        <span class="dashboard">Income</span>
      </div>
   
      <?php
$uid=$_SESSION['petuid'];
$ret=mysqli_query($con,"select username from tbluser where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['username'];

?>

      <div class="profile-details">
  <img src="img/rupee.jpg" alt="">
  <span class="admin_name"><?php echo $name; ?></span>
  <i class='bx bx-chevron-down' id='profile-options-toggle'></i>
  <ul class="profile-options" id='profile-options'>
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
$uid=$_SESSION['petuid'];
$ret=mysqli_query($con,"select username  from tbluser where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['username'];

?>

    <div class="home-content">
      <div class="overview-boxes">

     
    <div class="col-md-12">
        <br>
        
        <div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6">
        <h4 class="card-title">Add Income</h4>
      </div>
      <div class="col-md-6 text-right">
  <div class="ml-auto">
  
  </div>
</div>


<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="add-category-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

    </div>
  </div>
</div>



    </div>
  </div>
  <div class="card-body">
    <form id="expense-form" role="form" method="post" action="" class="needs-validation">
    <div class="form-group">
  <label for="dateexpense">Date of Income</label>
  <input class="form-control" type="date" id="dateincome" name="dateincome" value="<?php echo date('Y-m-d'); ?>" >
</div>



      <div class="form-group">
        <label for="costitem">Amount</label>
        <input class="form-control" type="number" id="incomeamnt" name="incomeamnt" required>
         </div>

        <div class="form-group">
            <label for="category-description">Description</label>
            <textarea class="form-control" id="category-description" name="category-description" required></textarea>
          </div>

    
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="submit">Add</button>
        <button type="submit" class="btn btn-primary" name="reset_income" formnovalidate>Reset </button>
      </div>

    </form>
    <div id="success-message" class="alert alert-success" style="display:none;">
      Income added successfully.
    </div>
  </div>
</div>





      </div>
    </div>
    
  </section>
  
<!--  script for pop up  -->






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

 <?php }?>

 <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- Bootstrap Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
