<?php
error_reporting(E_ALL);
session_start();
include('../php/database/connection.php');

if (!isset($_SESSION["user"])) {
    header('Location: ../partner-login.php');
} else {
  $user_id = $_SESSION['user'];
}

$sql = "SELECT * from pubs where user_id = '$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$company_name = $row['company_name'];
$venue_type = $row['venue_type'];
$pub_id = $row['id'];

$timestamp = strtotime(date("Y-m-d"));
$day = date('D', $timestamp);

$sql = "SELECT * FROM opening_hours WHERE pub_id = '$pub_id' and day = '$day'";
$query = $conn->query($sql);
$time = $query->fetch_assoc();

$sql = "SELECT * from tables_list where pub_id = '$pub_id'";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $errors = [];
  $table_id = $_POST['table_id'];
  $no_of_people = $_POST['no_of_people'];
  $date = $_POST['date'];
  $from_time = $_POST['from_time'];
  $to_time = $_POST['to_time'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $contact_number = $_POST['contact_number'];
  $additional_information = $_POST['additional_information'];
  $booking_no = rand(100000, 999999);

  $timestamp = strtotime($date);
  $day = date('D', $timestamp);

  if($to_time <= $from_time) {
    array_push($errors, 'Till time should be greater than from time.');
  }

  if ($from_time >= $time['from_time'] && $to_time <= $time['to_time']) {
    $open = true;
  } else {
    $open = false;
  }

  $sql = "SELECT * FROM tables_list WHERE id = '$table_id'";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();

  if ($open == true) {
      if ($row['capacity'] >= $no_of_people) {
        $sql = "SELECT * from bookings WHERE table_id = '$table_id' and date = '$date'";
        $data = $conn->query($sql);
        if ($data->num_rows > 0) {
          foreach ($data as $key) {
            $flag = 1;
            $f_time = $key['from_time'];
            $t_time = $key['to_time'];
            if (($from_time > $t_time && $to_time > $t_time) || ($from_time < $f_time && $to_time < $f_time)) {
              $flag = 1;
            } else {
              $flag = 0;
              array_push($errors, 'This table will be available after '.date("g:i a", strtotime($t_time)).'.');
            }
          }
        }
      } else {
          array_push($errors, 'No of people exceeded the total capacity of table.');   
      }
  } else {
    array_push($errors, ''.$venue_type.' will be closed in the selected time.');
  }

  if(empty($errors)) {

    $sql = "INSERT INTO bookings(pub_id, table_id, booking_no, first_name, last_name, email, contact_number, no_of_people, date, from_time, to_time, additional_information) VALUES ('$pub_id', '$table_id', '$booking_no', '$first_name', '$last_name', '$email', '$contact_number', '$no_of_people', '$date', '$from_time', '$to_time', '$additional_information')";

    if ($conn->query($sql)) {
        echo "<script> alert('Booking successfully. Your Booking number is: ".$booking_no.".'); </script>";
        echo "<script> window.location = 'index.php'; </script>";
    } else {
        echo "<script> alert('An error has occurred.'); </script>";
    }

  }   

}

?>

<!doctype html>
<html lang="en">
  <head>
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" href="favicon.png"/>
    <link rel="icon" type="image/png" href="img/favicon/favicon.png"/>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" />
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The UK's number one website for booking tables in pubs and bars">
    <meta name="author" content="GA">

    <title>Add Manual Booking - GA Systems</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php"><?php echo $company_name; ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="sign-out.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="bookings.php">
              <span data-feather="calendar"></span>
              Bookings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tables.php">
              <span data-feather="grid"></span>
              Tables
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="details.php">
              <span data-feather="settings"></span>
              Company Details
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Manual Booking</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

      <!-- Book Information Form -->

    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Book Table
      <button class="btn btn-primary btn-lg btn-block" id="myBtn" style="float:right; width:170px;">View Floorplan</button>
      </h4>
      
      <div style="clear:both;"></div>
      
      <form class="needs-validation" method="post" action="add-booking.php" novalidate style="margin-bottom: 50px;">

        <?php 

        if(!empty($errors)) {
          echo "<h6 style='color: red'>Errors: </h6>";
          echo "<ul>";
          foreach ($errors as $error) {            
              echo "<li style='color: red'>".$error."</li>";            
          }
          echo "</ul><br>";
        }

        ?>

        <input type="hidden" name="table_id" id="table_id">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="numberOfPeople">Number of People</label>
            <input type="number" name="no_of_people" class="form-control" id="numberOfPeople" placeholder="1" required value="<?php if (isset($_POST['no_of_people'])) {
              echo $_POST['no_of_people'];
            }?>">
            <div class="invalid-feedback">
              Please enter a valid number of people.
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="venue">Date</label>
            <input type="date" name="date" class="form-control" id="date" placeholder="DD/MM/YYYY" required value="<?php if (isset($_POST['date'])) {
              echo $_POST['date'];
            }?>">
            <div class="invalid-feedback">
              Please key in a date for your booking.
            </div>
          </div>
        </div>

        <!-- Booking Time Selection-->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="from">From</label>
            <select name="from_time" class="custom-select" required>
                <option value="">--:--</option>
                <option value="00:00">12.00 AM</option>
                <option value="00:30">12.30 AM</option>
                <option value="01:00">01.00 AM</option>
                <option value="01:30">01.30 AM</option>
                <option value="02:00">02.00 AM</option>
                <option value="02:30">02.30 AM</option>
                <option value="03:00">03.00 AM</option>
                <option value="03:30">03.30 AM</option>
                <option value="04:00">04.00 AM</option>
                <option value="04:30">04.30 AM</option>
                <option value="05:00">05.00 AM</option>
                <option value="05:30">05.30 AM</option>
                <option value="06:00">06.00 AM</option>
                <option value="06:30">06.30 AM</option>
                <option value="07:00">07.00 AM</option>
                <option value="07:30">07.30 AM</option>
                <option value="08:00">08.00 AM</option>
                <option value="08:30">08.30 AM</option>
                <option value="09:00">09.00 AM</option>
                <option value="09:30">09.30 AM</option>
                <option value="10:00">10.00 AM</option>
                <option value="10:30">10.30 AM</option>
                <option value="11:00">11.00 AM</option>
                <option value="11:30">11.30 AM</option>
                <option value="12:00">12.00 PM</option>
                <option value="12:30">12.30 PM</option>
                <option value="13:00">01.00 PM</option>
                <option value="13:30">01.30 PM</option>
                <option value="14:00">02.00 PM</option>
                <option value="14:30">02.30 PM</option>
                <option value="15:00">03.00 PM</option>
                <option value="15:30">03.30 PM</option>
                <option value="16:00">04.00 PM</option>
                <option value="16:30">04.30 PM</option>
                <option value="17:00">05.00 PM</option>
                <option value="17:30">05.30 PM</option>
                <option value="18:00">06.00 PM</option>
                <option value="18:30">06.30 PM</option>
                <option value="19:00">07.00 PM</option>
                <option value="19:30">07.30 PM</option>
                <option value="20:00">08.00 PM</option>
                <option value="20:30">08.30 PM</option>
                <option value="21:00">09.00 PM</option>
                <option value="21:30">09.30 PM</option>
                <option value="22:00">10.00 PM</option>
                <option value="22:30">10.30 PM</option>
                <option value="23:00">11.00 PM</option>
                <option value="23:30">11.30 PM</option>
            </select>
            <div class="invalid-feedback">
              Please select a time.
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="till">Till</label>
            <select name="to_time" class="custom-select" required>
                <option value="">--:--</option>
                <option value="00:00">12.00 AM</option>
                <option value="00:30">12.30 AM</option>
                <option value="01:00">01.00 AM</option>
                <option value="01:30">01.30 AM</option>
                <option value="02:00">02.00 AM</option>
                <option value="02:30">02.30 AM</option>
                <option value="03:00">03.00 AM</option>
                <option value="03:30">03.30 AM</option>
                <option value="04:00">04.00 AM</option>
                <option value="04:30">04.30 AM</option>
                <option value="05:00">05.00 AM</option>
                <option value="05:30">05.30 AM</option>
                <option value="06:00">06.00 AM</option>
                <option value="06:30">06.30 AM</option>
                <option value="07:00">07.00 AM</option>
                <option value="07:30">07.30 AM</option>
                <option value="08:00">08.00 AM</option>
                <option value="08:30">08.30 AM</option>
                <option value="09:00">09.00 AM</option>
                <option value="09:30">09.30 AM</option>
                <option value="10:00">10.00 AM</option>
                <option value="10:30">10.30 AM</option>
                <option value="11:00">11.00 AM</option>
                <option value="11:30">11.30 AM</option>
                <option value="12:00">12.00 PM</option>
                <option value="12:30">12.30 PM</option>
                <option value="13:00">01.00 PM</option>
                <option value="13:30">01.30 PM</option>
                <option value="14:00">02.00 PM</option>
                <option value="14:30">02.30 PM</option>
                <option value="15:00">03.00 PM</option>
                <option value="15:30">03.30 PM</option>
                <option value="16:00">04.00 PM</option>
                <option value="16:30">04.30 PM</option>
                <option value="17:00">05.00 PM</option>
                <option value="17:30">05.30 PM</option>
                <option value="18:00">06.00 PM</option>
                <option value="18:30">06.30 PM</option>
                <option value="19:00">07.00 PM</option>
                <option value="19:30">07.30 PM</option>
                <option value="20:00">08.00 PM</option>
                <option value="20:30">08.30 PM</option>
                <option value="21:00">09.00 PM</option>
                <option value="21:30">09.30 PM</option>
                <option value="22:00">10.00 PM</option>
                <option value="22:30">10.30 PM</option>
                <option value="23:00">11.00 PM</option>
                <option value="23:30">11.30 PM</option>
            </select>
            <div class="invalid-feedback">
              Please select a time.
            </div>
          </div>
        </div>
        
        <hr class="mb-4">

        <!-- Available Tables Section -->
        <h4 class="mb-3">Available Tables</h4>


        <div class="list-group">
          <?php while($row = $result->fetch_assoc()) { ?>
          <a id="table_<?php echo $row['id']; ?>" class="list-group-item list-group-item-action flex-column align-items-start" onClick="reply_click(<?php echo $row['id']; ?>);" style="cursor: pointer;">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1"><?php echo $row['table_name']; ?></h6>
            </div>
            <p class="mb-1"><?php echo $row['description']; ?></p>
            <small>Sits a maximum number of <?php echo $row['capacity']; ?> people.</small>
          </a>
          <?php } ?>
        </div>

        <script>

          function reply_click(id) {

            $("#table_id").val(id);
            $(".list-group-item").removeClass("active");
            $("#table_" + id).addClass("active");
          }

        </script>

        <hr class="mb-4">


        <!-- Contact Information Section -->
        <h4 class="mb-3">Contact Information</h4>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstname">First Name</label>
              <input type="input" name="first_name" class="form-control" id="firstname" placeholder="First Name" required value="<?php if (isset($_POST['first_name'])) {
                echo $_POST['first_name'];
              }?>">
              <div class="invalid-feedback">
                Please enter a valid a valid firstname.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="firstname">Last Name</label>
              <input type="input" name="last_name" class="form-control" id="lastname" placeholder="Last Name" required value="<?php if (isset($_POST['last_name'])) {
                echo $_POST['last_name'];
              }?>">
              <div class="invalid-feedback">
                Please enter a valid lastname.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required value="<?php if (isset($_POST['email'])) {
              echo $_POST['email'];
            }?>">
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
          </div>

          <div class="mb-3">
            <label for="number">Contact Number</label>
            <input maxlength="11" name="contact_number" type="text" class="form-control" id="number" placeholder="Contact Number" required value="<?php if (isset($_POST['contact_number'])) {
              echo $_POST['contact_number'];
            }?>">
            <small class="text-muted">This will be used for any booking or track and trace related updates</small>
          </div>

        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Additional Information</span>
          </div>
          <textarea name="additional_information" class="form-control" aria-label="With textarea">
            <?php if (isset($_POST['additional_information'])) {
              echo $_POST['additional_information'];
            }?> 
          </textarea>
        </div>

        <hr class="mb-4">
        
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" required>
            <label class="form-check-label" for="invalidCheck3">
              Agree to terms and conditions
            </label>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Book Now</button>
      </form>

    </div>
  </div>

      
    </main>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script><script src="../partner/form-validation.js"></script>




<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
 
}

/* Modal Content */
.modal-content {
  position: fixed;
  bottom:50%;
  left:30%;
  background-color: #fefefe;
  width:50%;

}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #000000;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #000000;
  color: white;
}

/* Add Animation */
@-webkit-keyframes slideIn {
  from {bottom: -300px; opacity: 0} 
  to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
  from {bottom: -300px; opacity: 0}
  to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}

@keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}
</style>

<!-- Trigger/Open The Modal -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
    
		<?php
        $sqlFP = "SELECT * from tables_list where pub_id = '$pub_id'";
        $resultFP = $conn->query($sqlFP);
		
		if ($resultFP->num_rows > 0) {
			 
		while($rowFP = $resultFP->fetch_assoc()) { 
        ?>
       
      <p style=" float:left; width:100%;">
      <a href="../uploads/<?php echo $rowFP['floor_plan']; ?>" target="_blank">
      <img src="../uploads/<?php echo $rowFP['floor_plan']; ?>" style="height:150px;">
      </a>
      </p>
		
        <?php } } else { ?>
        
        <p style=" float:left; width:100%; font-size:18px; font-weight:bold; color:red; padding:10px;">
        This pub has not provided a floorplan
        </p>
		
		<?php } ?>
        
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


</body>
</html>
