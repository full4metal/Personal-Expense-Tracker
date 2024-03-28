<?php  
session_start();
error_reporting(0);
include('include/dbconnection.php');
if (strlen($_SESSION['petuid']==0)) {
  header('location:logout.php');
  } else{


//Expense deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblexpense where id='$rowid'");
if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage_expense.php'</script>";
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script src="js/scripts.js"></script> 

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-+SyhYdFyoOSvQxk89F0KTIJzWCEBmZwq3s0we3sNQ8WYt0Nv/b0+HkcgCZtqwWZzTJwR95G6Hrx0mEnm7MfXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!--new added might delete 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
 --> 

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
          <a href="add_income.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Income</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
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
        <span class="dashboard">Manage Expense</span>
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



   <div class="home-content">
    <div class="overview-boxes">
    <div class="col-sm-10 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Manage Expense</h4>
                            </div>
    


                        </div>
                    </div>
                    <div class="panel-body">
                        <p style="font-size:16px; color:red" align="center"><?php if($msg){ echo $msg; } ?></p>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Expense Cost</th>
                                            <th>Description</th>
                                            <th>Expense Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $userid=$_SESSION['petuid'];
                                        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $offset = ($page - 1) * $limit;
                                        $ret = mysqli_query($con, "SELECT * FROM tblexpense WHERE userid='$userid' ORDER BY notedate DESC LIMIT $limit OFFSET $offset");
                                        $cnt = $offset + 1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                        
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td>
                                                <span class="badge badge-danger"><?php echo $row['category'];?></span>
                                              </td>
                                                <td><?php echo $row['expensecost'];?></td>
                                                <td><?php echo $row['description'];?></td>
                                                <td><?php echo $row['expensedate'];?></td>
                                              <td>

      <!-- Dropdown menu -->

        <div class="dropdown">
          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item edit-btn" href="" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#editExpenseModal-<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
          <a class="dropdown-item" href="manage_expense.php?delid=<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i> Delete</a>
          </div>
        </div>


   <!-- MODAL FOR EDIT -->
    <div class="modal fade" id="editExpenseModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" name="submit" action="update_expense.php">
                <div class="modal-body">
                              <?php
                              if (isset($_POST['id'])) {
                                  $expenseid = $_POST['id'];
                                  $query = mysqli_query($con, "SELECT * FROM tblexpense WHERE id='$expenseid'");
                                  $row = mysqli_fetch_array($query);
                                  $userid=$_SESSION['petuid'];
                                  $category = $row['category'];
                              }
                              ?>
                    <div class="form-group">
                        <label for="edit-expense-date">Date:</label>
                        <input type="date" class="form-control" id="edit-expense-date" name="dateexpense" value="<?php echo $row['expensedate']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="edit-expense-category">Category:</label>
                        <select class="form-control" id="edit-expense-category" name="category">
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM tblcategory where userid = $userid");
                            while ($row_category = mysqli_fetch_array($query)) {
                                if ($row_category['categoryid'] == $row['categoryid']) {
                                    echo '<option value="' . $row_category['categoryid'] . '" selected>' . $row_category['categoryname'] . '</option>';
                                } else {
                                    echo '<option value="' . $row_category['categoryid'] . '">' . $row_category['categoryname'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-expense-cost">Cost:</label>
                        <input type="number" class="form-control" id="edit-expense-cost" name="cost" value="<?php echo $row['expensecost']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="edit-expense-description">Description:</label>
                        <textarea class="form-control" id="edit-expense-description" name="description"><?php echo isset($row) ? $row['description'] : ''; ?></textarea>
                    </div>
                    <input type="hidden" name="expenseid" value="<?php echo isset($row) ? $row['id'] : ''; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
                   </td>

                    </tr>
                    <?php 
                    $cnt++;
                    }?>
                        </tbody>
                        </table>
                        </div>  
                            <?php
                            $result = mysqli_query($con, "SELECT COUNT(id) as total FROM tblexpense WHERE userid='$userid'");
                            $data = mysqli_fetch_assoc($result);
                            $total_pages = ceil($data['total'] / $limit);
                            ?>

                            <ul class="pagination justify-content-end">
                                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                                              <a class="page-link"
                          href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1)."&limit=$limit"; } ?>"
                          >Previous</a>
                          </li>
                          <?php for($i = 1; $i <= $total_pages; $i++): ?>
                          <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                          <a class="page-link" href="<?php echo "?page=$i&limit=$limit"; ?>"><?php echo $i; ?></a>
                          </li>
                          <?php endfor; ?>
                          <li class="page-item <?php if($page >= $total_pages) echo 'disabled'; ?>">
                          <a class="page-link"
                          href="<?php if($page >= $total_pages) { echo '#'; } else { echo "?page=".($page + 1)."&limit=$limit"; } ?>"
                          >Next</a>
                          </li>
                          </ul>
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>
<style>

  

.dropdown-item .fa-edit {
  color: #007bff;
}

.dropdown-item .fa-trash-alt {
  color: red;
}

  /* Custom styles for the table */
  .table th, .table td {
    vertical-align: middle;
  }
  .table th {
    background-color: #f5f5f5;
    border-color: #ddd;
    font-weight: bold;
    text-transform: uppercase;
  }
  .table td {
    border-color: #ddd;
  }
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
  }
  .table-hover tbody tr:hover {
    background-color: #f5f5f5;
  }
  .btn-danger {
    background-color: #d9534f;
    border-color: #d43f3a;
  }
  .btn-danger:hover {
    background-color: #c9302c;
    border-color: #ac2925;
  }
  .btn-sm {
    font-size: 12px;
    padding: 4px 10px;
  }
</style>

      </div>
    </div>
  </section>


<script> 
// Wait for the DOM to be ready
$(document).ready(function() {

// Attach Bootstrap validation to the expense form
$('#expense-form').validate({
  rules: {
    dateexpense: {
      required: true
    },
    item: {
      required: true
    },
    costitem: {
      required: true,
      number: true
    }
  },
  messages: {
    dateexpense: {
      required: "Please provide a valid date."
    },
    item: {
      required: "Please provide an item name."
    },
    costitem: {
      required: "Please provide a valid cost.",
      number: "Please enter numbers only."
    }
  },
  highlight: function(element) {
    $(element).closest('.form-group').addClass('has-error');
  },
  unhighlight: function(element) {
    $(element).closest('.form-group').removeClass('has-error');
  },
  errorElement: 'div',
  errorClass: 'invalid-feedback',
  errorPlacement: function(error, element) {
    if (element.parent('.input-group').length) {
      error.insertAfter(element.parent());
    } else {
      error.insertAfter(element);
    }
  }
});

// Submit the form via AJAX
$('#expense-form').submit(function(e) {
  e.preventDefault(); // Prevent the default form submit
  if ($(this).valid()) { // If the form is valid, submit via AJAX
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(response) {
        $('#success-message').show(); // Show the success message
        $('#expense-form')[0].reset(); // Reset the form
        $("#expense-form").removeClass('was-validated');
            setTimeout(function() {
                $("#success-message").hide();
            }, 3000);
        
      }
    });
  }
});

});

</script>

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