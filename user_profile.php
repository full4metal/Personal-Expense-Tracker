
<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
if (strlen($_SESSION['petuid']==0)) {
  header('location:logout.php');
  } else{
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
      <span class="logo_name">Expenditure</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="main.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="add_expenses.php">
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
          <a href="limit.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Set Limit</span>
          </a>
        </li>
       
       <li>
          <a href="#"  class="active">
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
        <span class="dashboard">user profile</span>
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
    <li><a href="#"><i class="fas fa-user-circle"></i> User Profile</a></li>
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

$userid = $_SESSION['petuid'];

// retrieve user data from the database
$sql = "SELECT * FROM tbluser WHERE id = $userid";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // set input field values to user data
    $first_name = $row['username'];
    $email = $row['email'];
}
?>


<br>
<br>
<br>
<br>
<br>

	<div class="container mx-auto">
					<div class="bg-white shadow rounded-lg d-block d-sm-flex">
					<div class="profile-tab-nav border-right">
  <div class="p-4">
	<center>
    <label for="profile-image-input">
      <div class="img-circle text-center mb-3">
        <img id="profile-image-preview" src="img/rupee.jpg" alt="Image" class="shadow">
        <div class="overlay">
		<i class="fas fa-camera fa-lg text" style="color: white;"></i>
        </div>
      </div>
    </label>
	</center>
    <input type="" id="profile-image-input" style="display: none;">
    <h4 class="text-center"><?php echo $name; ?></h4>
  </div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a> 
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>
						<form method="POST" action="update_user.php">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Username</label>
								  	<input type="text" class="form-control" name = "name"  value="<?php echo $first_name; ?> "readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Email</label>
								  	<input type="text" class="form-control" name = "email" value="<?php echo $email; ?>"required>
								</div>
							</div>
						

							<div class="col-md-6">
								<div class="form-group">
								  	<label>Registered Date</label>
									  <input type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime($row['regdate'])); ?>" readonly>
								</div>
							</div>

							
						</div>
						<div>
						<button type="submit" class="btn btn-primary" name="update_user">Update</button>
       				    <button type="button" class="btn btn-light" onclick="location.href='user_profile.php'">Cancel</button>
						</div>
					</div>
					</form>

					<?php
   // Initialize variables with default values
$old_password = "";
$new_password = "";
$confirm_password = "";
$errors = array();

// Check if form has been submitted
if (isset($_POST['submit'])) {
    // Get form data
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Validate form data
    if (empty($old_password)) {
        $errors[] = "Please enter your old password";
    }

    if (empty($new_password)) {
        $errors[] = "Please enter a new password";
    } elseif (strlen($new_password) < 4) {
        $errors[] = "Your new password must be at least 4 characters long";
    }

    if (empty($confirm_password)) {
        $errors[] = "Please confirm your new password";
    } elseif ($new_password != $confirm_password) {
        $errors[] = "Your new passwords do not match";
    }

    // Check if old password matches current password
    $userid = $_SESSION['petuid'];
    $query = "select password from tbluser where id = $userid";
    $result = mysqli_query($con, $query);


    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $stored_password = $row['password'];
      
  
      if ($old_password !== $stored_password) {
          $errors[] = "Your old password is incorrect";
      }
  } else {
      // Handle the error case
      echo "Error fetching user information: " . mysqli_error($con);
  }
  
    // Update password in database
    if (empty($errors)) {
  
        $update_query = "UPDATE tbluser SET password = '$new_password' WHERE id=$userid";

        // Execute the query using your database connection object
        $result = mysqli_query($con, $update_query);

        if ($result) {
            $message = "Password updated successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo " <script type='text/javascript'>window.location.href = 'user_profile.php';</script>";
            exit();
        } else {
            
            echo "Error updating user information: " . mysqli_error($con);
        }
    }
}

?>

<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
    <h3 class="mb-4">Password Settings</h3>
    <form method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Old password</label>
                    <input type="password" class="form-control" name="old_password" value="<?php echo htmlspecialchars($old_password); ?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>New password</label>
                    <input type="password" class="form-control" name="new_password" value="<?php echo htmlspecialchars($new_password); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm new password</label>
                    <input type="password" class="form-control" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>" required>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" name="submit">Update</button>
            <button class="btn btn-light" type="reset">Cancel</button>
        </div>
    </form>
</div>

		</div>
					
		<style> 
		@import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");
		body {
			background: #f9f9f9;
			font-family: "Roboto", sans-serif;
		}
		.container {
	max-width: 1200px;
	margin: 0 auto;
	padding: 20px;
}

		.shadow {
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
		}

		.profile-tab-nav {
			min-width: 250px;
		}

		.tab-content {
			flex: 1;
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		.nav-pills a.nav-link {
			padding: 15px 20px;
			border-bottom: 1px solid #ddd;
			border-radius: 0;
			color: #333;
		}

		.nav-pills a.nav-link i {
			width: 20px;
		}
		.mb-4, .my-4 {
    margin-bottom: 3.5rem!important;
}
		.img-circle img {
			height: 100px;
			width: 100px;
			border-radius: 100%;
			border: 5px solid #fff;
		}

		/* Define variables for colors */
		:root {
			--primary: #007bff;
			--success: #28a745;
			--danger: #dc3545;
			--warning: #ffc107;
		}
		.shadow {
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
		}

		.profile-tab-nav {
			min-width: 250px;
		}

		.tab-content {
			flex: 1;
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		.nav-pills a.nav-link {
			padding: 15px 20px;
			border-bottom: 1px solid #ddd;
			border-radius: 0;
			color: #333;
		}
		.nav-pills a.nav-link i {
			width: 20px;
		}

		
 .img-circle {
  position: relative;

  justify-content: center;
  align-items: center;
}



#profile-image-preview {
  height: 100px;
  width: 100px;
  border-radius: 100%;
  border: 5px solid #fff;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  opacity: 0;
  transition: .5s ease;
  background-color: rgba(0,0,0,0.7);
  border-radius: 50%;
}

.img-circle:hover .overlay {
  opacity: 1;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}


		</style>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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