<?php 

session_start();
include('../php/database/connection.php');

if (!isset($_SESSION["user"])) {
    header('Location: ../partner-login.php');
} else {
  $user_id = $_SESSION['user'];
}

$sql = "SELECT * from users where id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$sql = "SELECT * from pubs where user_id = '$user_id'";
$result = $conn->query($sql);
$pub = $result->fetch_assoc();
$company_name = $pub['company_name'];
$pub_id = $pub['id'];

$sql = "SELECT * from opening_hours where pub_id = '$pub_id'";
$result = $conn->query($sql);
$timming = [];

while ($row = $result->fetch_assoc()) {
  array_push($timming, $row);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $error = 0;
  $company_name = $_POST['company_name'];
  $venue_type = $_POST['venue_type'];
  $password = $_POST['password'];
  
  if(isset($_POST['email'])) {
    $email = $_POST['email']; 
  } else {
    $email = null;
  }
  
  $address_one = $_POST['address_one'];
  
  if(isset($_POST['address_two'])) {
    $address_two = $_POST['address_two'];
  } else {
    $address_two = null;
  }
  
  $country = $_POST['country'];
  $city = $_POST['city'];
  $post_code = $_POST['post_code'];
  
  if(isset($_POST['booking_available'])) {
    $booking_available = 1;
  } else {
    $booking_available = 0;
  }

  if(isset($_FILES['image'])) {
    
    $sql = "DELETE from images where pub_id = '$pub_id'";
    $conn->query($sql);

    $countfiles = count($_FILES['image']['name']);
     
    for($i = 0; $i < $countfiles; $i++) {
      
      $filename = $_FILES['image']['name'][$i];
      move_uploaded_file($_FILES['image']['tmp_name'][$i], '../uploads/'.$filename);
      $sql = "INSERT INTO images(pub_id, image) VALUES ('$pub_id', '$filename')";
      $conn->query($sql);
    }

  }
      
  $description = $_POST['description'];

  $sql = "UPDATE users SET email = '$email', password = '$password' where id = '$user_id'";  
  
  if($conn->query($sql)) {

    $sql = "UPDATE pubs SET company_name = '$company_name', venue_type = '$venue_type', address_one = '$address_one', address_two = '$address_two', country = '$country', city = '$city', post_code = '$post_code', description = '$description', booking_available = '$booking_available' where id = '$pub_id'";

    $conn->query($sql);
    
    $sql = "DELETE FROM opening_hours where pub_id = '$pub_id'";
    $conn->query($sql);

    if($conn->query($sql)) {

      $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Mon', '" . $_POST['mon_from'] . "', '" . $_POST['mon_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Tue', '" . $_POST['tue_from'] . "', '" . $_POST['tue_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Wed', '" . $_POST['wed_from'] . "', '" . $_POST['wed_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Thu', '" . $_POST['thu_from'] . "', '" . $_POST['thu_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Fri', '" . $_POST['fri_from'] . "', '" . $_POST['fri_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Sat', '" . $_POST['sat_from'] . "', '" . $_POST['sat_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Sun', '" . $_POST['sun_from'] . "', '" . $_POST['sun_to'] . "')";
        if(!$conn->query($sql)) {
          $error = 1;
        }

    } else {
      $error = 1;
    }

  } else {
    $error = 1;
  }

  if($error == 0) {
    echo "<script> alert('Data updated successfully.'); </script>";
    echo "<script> window.location = 'index.php'; </script>";
  } else {
    echo "<script> alert('An error has occurred.'); </script>";
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

    <title>Company Details - GA Systems</title>

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
            <a class="nav-link" href="bookings.php">
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
            <a class="nav-link active" href="details.php">
              <span data-feather="settings"></span>
              Company Details
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Company Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>


      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Edit Company Details</h4>
        <form class="needs-validation" method="post" action="details.php" enctype="multipart/form-data" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Company Name</label>
              <input type="text" class="form-control" id="firstName" name="company_name" value="<?php echo $pub['company_name']; ?>" required>
              <div class="invalid-feedback">
                Valid company name is required.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="venue">Venue</label>
              <select class="custom-select d-block w-100" name="venue_type" id="venue" required>
                <option value="">Choose type of venue...</option>
                <option <?php if($pub['venue_type'] == 'Pub') { echo "selected"; } ?>>Pub</option>
                <option <?php if($pub['venue_type'] == 'Cocktail Bar') { echo "selected"; } ?>>Cocktail Bar</option>
                <option <?php if($pub['venue_type'] == 'Bar') { echo "selected"; } ?>>Bar</option>
                <option <?php if($pub['venue_type'] == 'Sports Bar') { echo "selected"; } ?>>Sports Bar</option>
                <option <?php if($pub['venue_type'] == 'Gastropub') { echo "selected"; } ?>>Gastropub</option>
                <option <?php if($pub['venue_type'] == 'Other') { echo "selected"; } ?>>Other</option>
              </select>
              <div class="invalid-feedback">
                Please provide a venue type.
              </div>
            </div>
          </div>
  
          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $user['password']; ?>" required>
            <div class="invalid-feedback" style="width: 100%;">
              A password is required.
            </div>
          </div>
        
  
          <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email']; ?>">
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
          </div>
  
          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address_one" id="address" value="<?php echo $pub['address_one']; ?>" required>
            <div class="invalid-feedback">
              Please enter the business address.
            </div>
          </div>
  
          <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" name="address_two" id="address2" value="<?php echo $pub['address_two']; ?>">
          </div>
  
          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" name="country" id="country" required>
                <option value="">Choose...</option>
                <option <?php if($pub['country'] == 'United Kingdom') { echo "selected"; } ?>>United Kingdom</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">Town/City</label>
              <input type="text" class="form-control" name="city" value="<?php echo $pub['city']; ?>" id="state" required>
              </select>
              <div class="invalid-feedback">
                Please provide a town/city.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Postcode</label>
              <input type="text" class="form-control" id="zip" name="post_code" value="<?php echo $pub['post_code']; ?>" required>
              <div class="invalid-feedback">
                This is not a valid entry.
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="booking_available" id="list-available" <?php if($pub['booking_available'] == 1) { echo 'checked'; } ?>>
            <label class="custom-control-label" for="list-available">List my business available for bookings</label>
          </div>
          <hr class="mb-4">
  
  
          <!-- Details Section -->
          <h4 class="mb-3">Business Details</h4>
            
            <div style="float:left; width:100%;">
            <?php
			
			$sqlImg = "SELECT * from images where pub_id = '$pub_id'";
			$resultImg = $conn->query($sqlImg);
			while($userImg = $resultImg->fetch_assoc()){

			?>
            <a href="../uploads/<?php echo $userImg['image']; ?>" target="_blank"><img src="../uploads/<?php echo $userImg['image']; ?>" style="height:80px; margin:10px;"></a>
            <?php } ?>
            </div>
            
          <div class="mb-3">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="image[]" id="image" onChange="validatedCustomFile()" multiple="multiple" accept="image/jpg, image/jpeg, image/png">
            <label class="custom-file-label" for="validatedCustomFile">Choose photo files...</label>
           
            
            <div class="invalid-feedback">Please upload at least one photo of the business space.</div>
          </div>
          </div>

          <script>
          
            function validatedCustomFile() {
              var files = document.getElementById('image');
              if(files.files.length > 3) {
                alert('You are only allowed to upload 3 images max.');
                files.value = files.defaultValue;
              }
            }

          </script>
  
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Description</span>
            </div>
            <textarea class="form-control" name="description" aria-label="With textarea"><?php echo $pub['description']; ?></textarea>
          </div>
          <hr class="mb-4">
  
  
          <!-- Opening Hours Section -->
          <h4 class="mb-3">Opening Hours</h4>
  
          <!-- Monday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="monday">Monday</label>
              <select class="custom-select" name="mon_from">
                  <option selected hidden><?php echo $timming[0]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Monday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="monday">&nbsp;</label>
              <select class="custom-select" name="mon_to">
                  <option selected hidden><?php echo $timming[0]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Monday.
              </div>
            </div>
          </div>
  
          <!-- Tuesday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tuesday">Tuesday</label>
              <select class="custom-select" name="tue_from">
                  <option selected hidden><?php echo $timming[1]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Tuesday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="tuesday">&nbsp;</label>
              <select class="custom-select" name="tue_to">
                  <option selected hidden><?php echo $timming[1]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Tuesday.
              </div>
            </div>
          </div>
  
          <!-- Wednesday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="wednesday">Wednesday</label>
              <select class="custom-select" name="wed_from">
                  <option selected hidden><?php echo $timming[2]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Wednesday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="wednesday">&nbsp;</label>
              <select class="custom-select" name="wed_to">
                  <option selected hidden><?php echo $timming[2]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Wednesday.
              </div>
            </div>
          </div>
  
          <!-- Thursday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="thursday">Thursday</label>
              <select class="custom-select" name="thu_from">
                  <option selected hidden><?php echo $timming[3]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Thursday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="thursday">&nbsp;</label>
              <select class="custom-select" name="thu_to">
                  <option selected hidden><?php echo $timming[3]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Thursday.
              </div>
            </div>
          </div>
  
          <!-- Friday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="friday">Friday</label>
              <select class="custom-select" name="fri_from">
                  <option selected hidden><?php echo $timming[4]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Friday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="friday">&nbsp;</label>
              <select class="custom-select" name="fri_to">
                  <option selected hidden><?php echo $timming[4]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Friday.
              </div>
            </div>
          </div>
  
          <!-- Saturday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="saturday">Saturday</label>
              <select class="custom-select" name="sat_from">
                  <option selected hidden><?php echo $timming[5]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Saturday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="saturday">&nbsp;</label>
              <select class="custom-select" name="sat_to">
                  <option selected hidden><?php echo $timming[5]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Saturday.
              </div>
            </div>
          </div>
  
          <!-- Sunday Opening Hours-->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="sunday">Sunday</label>
              <select class="custom-select" name="sun_from">
                  <option selected hidden><?php echo $timming[6]['from_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select an opening time for Sunday.
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="sunday">&nbsp;</label>
              <select class="custom-select" name="sun_to">
                  <option selected hidden><?php echo $timming[6]['to_time']; ?></option>
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
                  <option value="Closed">Closed</option>
              </select>
              <div class="invalid-feedback">
                Please select a closing time for Sunday.
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Update Details</button>
          <br>
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
        <script src="dashboard.js"></script><script src="../partner/form-validation.js"></script></body>
</html>
