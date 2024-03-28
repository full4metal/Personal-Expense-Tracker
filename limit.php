
<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
if (strlen($_SESSION['petuid']==0)) {
  header('location:logout.php');
  } else{

  $message = ""; // Initialize the message variable

  if (isset($_POST['submit'])) {
      $userid = $_SESSION['petuid'];
      $limit = $_POST['limits'];
      $category = $_POST['category']; // Added line to get the selected category
      $category_name = ''; // Assign the correct category name based on the selected category ID

      // Fetch category name based on category ID
      $getCategoryNameQuery = "SELECT categoryname FROM tblcategory WHERE categoryid = '$category'";
      $resultCategoryName = mysqli_query($con, $getCategoryNameQuery);
      
      if ($rowCategoryName = mysqli_fetch_assoc($resultCategoryName)) {
          $category_name = $rowCategoryName['categoryname'];
      }

      // Update the category limit in the database
      $updateCategoryLimitQuery = "UPDATE tblcategory SET limits = '$limit' WHERE userid='$userid' AND categoryname = '$category_name'";
      $resultUpdate = mysqli_query($con, $updateCategoryLimitQuery);

      if ($resultUpdate) {

          // Check if the expenses exceed the category limit
          $checkExpensesQuery = "SELECT SUM(expensecost) AS total_expense FROM tblexpense WHERE categoryid = '$category'";
          $resultExpense = mysqli_query($con, $checkExpensesQuery);
          $rowExpense = mysqli_fetch_assoc($resultExpense);
          $totalExpense = $rowExpense['total_expense'];

          // Fetch the category limit
          $getCategoryLimitQuery = "SELECT limits FROM tblcategory WHERE categoryid = '$category'";
          $resultCategoryLimit = mysqli_query($con, $getCategoryLimitQuery);
          $rowCategoryLimit = mysqli_fetch_assoc($resultCategoryLimit);
          $categoryLimit = $rowCategoryLimit['limits'];

          // Display message
          if ($totalExpense >  0.5 * $categoryLimit) {
              $message = "Expense Exceeded Limit ";
          } else {
              $message = "Limit set";
          }
      } else {
          //echo "Error updating limit: " 
      }
  }
  if(isset($_GET['delid']))
      {
      $rowid=intval($_GET['delid']);
      $query=mysqli_query($con,"delete from tblincome where id='$rowid'");
      if($query){
      echo "<script>alert('Record successfully deleted');</script>";
      echo "<script>window.location.href='limit.php'</script>";
      } else {
      echo "<script>alert('Something went wrong. Please try again');</script>";

      }

      }

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

    <script src="chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     
   </head>
<body>
  <div class="sidebar">
  <div class="logo-details">
      <i class='bx bx-album'></i>
      <span class="logo_name">Expense Tracker</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="main.php">
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
          <a href="add_income.php">
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
          <a href="report.php">
          <i class="bx bx-file"></i>
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
          <a href="#" class="active">
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
        <span class="dashboard">Set Limit</span>
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

 <div class="home-content">
                                                      <!-- NEW CODE FOR Monthly income -->
<div class="card1"> 
    <div class="card-header">
        <h5 class="card-title">Monthly Income</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id="expense-table-body"></tbody> 
            <?php
            $userid=$_SESSION['petuid'];
            $currentMonth = date('m');
            $query6 = "SELECT id,incomedate, description, incomeamount AS total_income  FROM tblincome WHERE userid = $userid AND MONTH(incomedate) = $currentMonth";
            $result6 = $con->query($query6);
            if ($result6->num_rows > 0) {
                while ($row = $result6->fetch_assoc()) {
                    $incomedate = $row['incomedate'];
                    $total_amount = $row['total_income'];
                    $description = $row['description'];
                    $selectid= $row['id'];
                ?>
                    <tr>
                        <td><?php echo $incomedate; ?></td>
                        <td><?php echo $total_amount; ?></td>
                        <td><?php echo $description; ?></td>
                        <td>
                            <a href="limit.php?delid=<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    
                <?php 
                } 
            } 
            ?>
        </table>
    </div>
</div>
 <div class="overview-boxes">




<div class="col-md-12">
    <div class="card">
    <div class="card-header">
             
    <?php

  include('include/dbconnection.php');

  if (isset($_POST['submit_income'])) {
      $firstDayOfMonth = date("Y-m-01");
      $currentDate = date("Y-m-d");

      $incomeAmount = $_POST['income_amount'];
      $incomeDate = $_POST['income_date'];
      $userid = $_SESSION['petuid'];
      $queryMonthlyIncome = "SELECT SUM(incomeamount) AS totalIncome FROM tblincome WHERE userid='$userid' AND incomedate BETWEEN '$firstDayOfMonth' AND '$currentDate'";
      $resultMonthlyIncome = mysqli_query($con, $queryMonthlyIncome);
      $rowMonthlyIncome = mysqli_fetch_array($resultMonthlyIncome);
      $totalMonthlyIncome = $rowMonthlyIncome['totalIncome'];

      $existingIncomeQuery = "SELECT * FROM tblincome WHERE userid = '$userid' AND incomedate BETWEEN '$firstDayOfMonth' AND '$currentDate'";
      $existingIncomeResult = mysqli_query($con, $existingIncomeQuery);
      if (mysqli_num_rows($existingIncomeResult) > 0) {
        // Update the existing income record
        $updateIncomeQuery = "UPDATE tblincome SET incomeamount = '$incomeAmount'+'$totalMonthlyIncome', incomedate = '$incomeDate' WHERE userid = '$userid' AND incomedate BETWEEN '$firstDayOfMonth' AND '$currentDate'";
        $updateResult = mysqli_query($con, $updateIncomeQuery);
        
        if ($updateResult) {
          echo "Income record updated successfully.";
      } else {
          echo "Error updating income record: " . mysqli_error($con);
      }
  } else {
      // Insert a new income record
      $insertIncomeQuery = "INSERT INTO tblincome (userid, incomeamount, incomedate) VALUES ('$userid', '$incomeAmount', '$incomeDate')";
      $insertResult = mysqli_query($con, $insertIncomeQuery);

      if ($insertResult) {
          echo "Income record inserted successfully.";
      } else {
          echo "Error inserting income record: " . mysqli_error($con);
      }
  }
} 
 
if (isset($_POST['reset_income'])) {
  $userid = $_SESSION['petuid'];

  // Reset the income for the user
  $resetIncomeQuery = "DELETE FROM tblincome WHERE userid = '$userid'";
  $resetIncomeResult = mysqli_query($con, $resetIncomeQuery);

  if ($resetIncomeResult) {
      echo "Income reset successfully.";
  } else {
      echo "Error resetting income: " . mysqli_error($con);
  }
}

?>
<!-- Display total monthly income -->

<?php 
// Calculate total monthly income
$userid = $_SESSION['petuid'];
$firstDayOfMonth = date("Y-m-01");
$currentDate = date("Y-m-d");
$queryMonthlyIncome = "SELECT SUM(incomeamount) AS totalIncome FROM tblincome WHERE userid='$userid' AND incomedate BETWEEN '$firstDayOfMonth' AND '$currentDate'";
$resultMonthlyIncome = mysqli_query($con, $queryMonthlyIncome);
$rowMonthlyIncome = mysqli_fetch_array($resultMonthlyIncome);
$totalMonthlyIncome = $rowMonthlyIncome['totalIncome'];
?>
<div class="income-box">
    <h2>Monthly Income</h2>
    <div class="income-details">
        <p>Total Income: <?php 
            if ($totalMonthlyIncome == "") {
                echo "0";
            } else {
                echo $totalMonthlyIncome;
            } 
        ?> </p>           
    </div>
</div>

          </div>

    </div>
</div>

 <!-- SET LIMIT -->

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
    <h5 class="card-title">Set Category Limits</h5>
    
    <form method="post" action="">
        <label for="category">Select a Category:</label>
        <select name="category" id="category">
            <?php
            include('include/dbconnection.php');
            $userid = $_SESSION['petuid'];
            $query = "SELECT categoryid, categoryname FROM tblcategory where userid='$userid' ";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['categoryid'] . '">' . $row['categoryname'] . '</option>';
            }
           
            ?>
        </select>

        
        <input type="number" name="limits" id="limits" required>

        <input type="submit" name="submit" value="Set Limit">
    </form>
    <div id="messageContainer"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    // $message
    var message = "<?php echo $message; ?>";

    // 
    $('#messageContainer').html(message);

    // F
    $('#messageContainer').addClass('red-text').fadeIn('fast').delay(3000).fadeOut('fast');
    </script>

    </div>
    
</div>
</div>

   

          


</div>
</div>





<style>
#messageContainer {
    color: red;
}

.chart-container {
  position: relative;
  width: 70%;
  height: 400px;
  margin-right: 20px;

  
}

.chart-legend {
    position: absolute;
    top: 224px;
    right: 68px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.chart-legend-item {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}

.chart-legend-color-box {
  width: 10px;
  height: 10px;
  margin-right: 5px;
}

.chart-legend-label {
  font-size: 12px;
}

.expense-details {
  width: 30%;
}

.expense-details h3 {
  font-size: 24px;
  margin-top: 0;
}

#expense-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

#expense-list li {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

#expense-list li span:first-child {
  font-weight: bold;
  margin-right: 10px;
}

#total-expense {
  font-size: 24px;
  font-weight: bold;
  margin-top: 20px;
}

</style>








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

</body>
</html>

  <?php }?>