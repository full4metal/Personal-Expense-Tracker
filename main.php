<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
if (strlen($_SESSION['petuid']==0)) {
  header('location:logout.php');
  } else {
?>

  <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
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
      <span class="logo_name">Expense Tracker</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
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
        <span class="dashboard">Dashboard</span>
      </div>
      


<?php
$userid=$_SESSION['petuid'];
$ret=mysqli_query($con,"select username from tbluser where id='$userid'");
$row=mysqli_fetch_array($ret);
$name=$row['username'];
?>

  <div class="profile-details">
      <img src="img/rupee.jpg." alt="">
      <span class="admin_name"><?php echo $name; ?></span>
      <i class='bx bx-chevron-down' id='profile-options-toggle'></i>
      <ul class="profile-options" id='profile-options'>
          <li><a href="user_profile.php"><i class="fas fa-user-circle"></i> User Profile</a></li>
          <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
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
    <div class="overview-boxes">
    <div class="box">
    <div class="right-side">
    <div class="box-topic">Today's Expense</div>
    <?php
      //Today Expense
      $userid=$_SESSION['petuid'];
      $tdate=date('Y-m-d');
      $query=mysqli_query($con,"select sum(expensecost) as todaysexpense from tblexpense where (expensedate)='$tdate' && (userid='$userid');");
      $result=mysqli_fetch_array($query);
      $sum_today_expense=$result['todaysexpense'];
    ?> 
 <div class="number"  data-percent="<?php echo $sum_today_expense;?>">
      <?php if($sum_today_expense=="") {
        echo "0";
      } else {
        echo $sum_today_expense;
      } ?>
    </div>
    <div class="indicator">
      <i class='bx bx-up-arrow-alt'></i>
      <span class="text">Up from Today</span>
    </div>
  </div>
  <i class='fas fa-circle-plus cart'></i>
 
</div>
   
<!-- MONTHLY -->
      <div class="box">
          <div class="right-side">
            <div class="box-topic">Monthly Expense</div>
            <?php
            //Monthly Expense
            $userid=$_SESSION['petuid'];
            $monthdate=  date("Y-m-01"); 
            $crrntdte=date("Y-m-d");
            $query3=mysqli_query($con,"select sum(expensecost)  as monthlyexpense from tblexpense where ((expensedate) between '$monthdate' and '$crrntdte') && (userid='$userid');");
            $result3=mysqli_fetch_array($query3);
            $sum_monthly_expense=$result3['monthlyexpense'];
            ?>

            
<div class="number" data-percent="<?php echo $sum_monthly_expense;?>"><?php if($sum_monthly_expense==""){
          echo "0";
          } else {
          echo $sum_monthly_expense;
          }

            ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"> </span>
            </div>
          </div>
          <i class='fas fa-history cart three' ></i>
        </div>

<!--Monthly Income -->
<div class="box">
          <div class="right-side">
            <div class="box-topic">Monthly Income</div>
<?php
// Monthly Income
$userid = $_SESSION['petuid'];
$firstDayOfMonth = date("Y-m-01");
$currentDate = date("Y-m-d");

$queryMonthlyIncome = mysqli_query($con, "SELECT SUM(incomeamount) as totalmonthlyincome FROM tblincome WHERE incomedate BETWEEN '$firstDayOfMonth' AND '$currentDate' AND userid = '$userid'");
$resultMonthlyIncome = mysqli_fetch_array($queryMonthlyIncome);
$totalMonthlyIncome = $resultMonthlyIncome['totalmonthlyincome'];
?>

<div class="number" data-percent="<?php echo $totalMonthlyIncome;?>"><?php if($totalMonthlyIncome==""){
            echo "0";
            } else {
            echo $totalMonthlyIncome;
            }

              ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt up'></i>
              <span class="text">
                Remaining: <?php 
            if($sum_monthly_expense=="") {
              echo "0";
            } else {
              echo $totalMonthlyIncome - $sum_monthly_expense ;
            } 
      ?> </span>
            </div>
          </div>
          <i class='fas fa-piggy-bank cart four' ></i>
        </div>


<!-- MOST SPENT CATEGORY BOX --> 
<?php
      // Fetching the most spent category of the month
      $queryMostSpent = "SELECT category, SUM(expensecost) AS total_expense  
                          FROM tblexpense 
                          WHERE userid = $userid 
                          AND MONTH(expensedate) = MONTH(CURDATE())
                          GROUP BY category 
                          ORDER BY total_expense DESC 
                          LIMIT 1";
      $resultMostSpent = mysqli_query($con, $queryMostSpent);

      if (mysqli_num_rows($resultMostSpent) > 0) {
          $rowMostSpent = mysqli_fetch_assoc($resultMostSpent);
          $mostSpentCategory = $rowMostSpent['category'];
          $totalExpenseInCategory = $rowMostSpent['total_expense'];
    ?>
      
    <?php
      } else {
          
      }
    ?>

        <div class="box">
        <div class="right-side">
        <div class="box-topic">Most Spent Category</div>
        <div class="number" data-percent="<?php echo $mostSpentCategory;?>"><?php if($mostSpentCategory==""){
            echo "0";
            } else {
            echo $mostSpentCategory;
            }

              ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt up'></i>
              <span class="text">
                 <?php 
          echo $totalExpenseInCategory;
      ?> </span>
            </div>
          </div>
          <i class='fas fa-wallet cart two' ></i>
        </div>


        </div>
       
          
 

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<style>
canvas {
  width: 100%;
  height: auto;
}

.card {
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin: 20px;
  padding: 20px;
  background-color: #fff;
  height: 500px;
}
.card1 {
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin: 20px;
  padding: 20px;
  background-color: #fff;
}

.card-header {
  background-color: #f7f7f7;
  border-bottom: 1px solid #ddd;
  margin-bottom: 20px;
  padding: 10px;
}

.card-title {
  font-size: 24px;
  font-weight: bold;
  margin: 0;
}

.card-body {
  padding: 0;
}

@media (max-width: 768px) {
  .card {
    margin: 10px;
    padding: 10px;
  }

  .card-title {
    font-size: 20px;
  }

}
.message-box {
  background-color: #4CAF50;
  color: #fff;
  padding: 15px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  text-align: center;
}

.message-box p {
  margin: 0;
}

</style>

<div class="card1"> 
  <div class="card-header">
    <h5 class="card-title">Today's Expenses</h5>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>Category</th>
          <th>Amount</th>
          <th>Remaining</th>
        </tr>
      </thead>
      <tbody id="expense-table-body"></tbody> 

<!-- NEW CODE FOR todays expense -->
<?php
$userid=$_SESSION['petuid'];
//most spend category
$query7 = "SELECT category, SUM(expensecost) AS total_expense  FROM tblexpense WHERE userid = $userid AND DATE(expensedate) = CURDATE() GROUP BY category ORDER BY total_expense DESC LIMIT 1";
$result7 = mysqli_query($con, $query7);

if (mysqli_num_rows($result7) > 0) {
    $row = mysqli_fetch_assoc($result7);
    $mostSpentCategory = $row['category'];
    $mostSpentAmount = $row['total_expense'];
} else {
    $mostSpentCategory = "N/A"; // No categories found
    $mostSpentAmount = 0;
}

//category section 
$currentDate = date('Y-m-d');
$query6 = "SELECT category, SUM(expensecost) AS total_amount 
          FROM tblexpense 
          WHERE userid = $userid AND DATE(expensedate) = '$currentDate' 
          GROUP BY category";
$result6 = $con->query($query6);


if ($result6->num_rows > 0)
				{
          ?>
          <tr>
          <th></th>
          <th>Spend <span id="total-expense"></span></th>
          <th>Limit</th>
        </tr>
        <?php 
          while($row = $result6->fetch_assoc())
            {
              $category = $row['category'];
              $total_amount=$row['total_amount'];
              $limitQuery = "SELECT limits FROM tblcategory WHERE userid = $userid AND categoryname = '$category'";
              $limitResult = $con->query($limitQuery);
              $limitRow = $limitResult->fetch_assoc();
              $limit = $limitRow['limits'];
?>
      <tfoot>
        
        <tr>
          <td><?php echo $category ?></td>
          <td><?php echo $total_amount ?></td>   
          <td style="color: <?php echo ($limit - $total_amount < 0) ? 'red' : 'green'; ?>"><?php echo $limit - $total_amount ?></td> 
          <!-- <td><?php echo $limit - $total_amount  ?></td>     -->
        </tr>  

        <?php  } ?>        
      </tfoot>
      
    </table>
    <?php } ?>
   
    </div>
  </div>              
  
<!-- Code -->

<?php
      // Fetching the most spent category of the month
      $queryMostSpent = "SELECT category, SUM(expensecost) AS total_expense  
                          FROM tblexpense 
                          WHERE userid = $userid 
                          AND MONTH(expensedate) = MONTH(CURDATE())
                          GROUP BY category 
                          ORDER BY total_expense DESC 
                          LIMIT 1";
      $resultMostSpent = mysqli_query($con, $queryMostSpent);

      if (mysqli_num_rows($resultMostSpent) > 0) {
          $rowMostSpent = mysqli_fetch_assoc($resultMostSpent);
          $mostSpentCategory = $rowMostSpent['category'];
          $totalExpenseInCategory = $rowMostSpent['total_expense'];
    ?>
      
    <?php
      } else {
          echo "<p></p>";
      }
    ?>
    
<!--
  <div class="message-box">
  <?php //if ($mostSpentCategory !== "N/A") : ?>
        <p>You have spent the most in the category: <strong> <?php //echo $mostSpentCategory; ?></strong></p>
        <p>Total Amount Spent: <strong><?php //echo $totalExpenseInCategory; ?></strong></p>
    <?php //else : ?>
        <p>No spending data available.</p>
    <?php //endif; ?>
  </div>
-->
    
  
  

<style>
  .table {
    border-collapse: collapse;
    width: 100%;
    font-size: 16px;
    text-align: left;
  }

  .table th {
    background-color: #f2f2f2;
    font-weight: bold;
    padding: 10px 20px;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
  }

  .table td {
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
  }

  .badge {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 5px 10px;
  }
</style>
<!-- Add Font Awesome library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZfSLV7XKlgtWRkec6JzT6Kjgx6UHILee0zmHXJkQAdKbZ0YirYRLfFlIaJl7lN25wyX9N7Ib2QlyeV1qZh/3Jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!--Responsive side bar -->
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

<?php } ?>