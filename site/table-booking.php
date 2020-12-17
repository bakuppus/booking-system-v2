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

    <title>Book Table · GA Booking Systems</title>


    <!-- Bootstrap core CSS and JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

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
    <link href="partner/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
  </div>

  <?php 

  include('php/database/connection.php');

  $pub_id = $_GET['id'];
  $sql = "SELECT * from pubs where id = '$pub_id'";
  $result = $conn->query($sql);
  $pub = $result->fetch_assoc();

  date_default_timezone_set("Europe/London");
  $current_time = date("g:i a");
  $current_time = date("H:i:s", strtotime($current_time));

  $timestamp = strtotime(date("Y-m-d"));
  $day = date('D', $timestamp);

  $pub_id = $pub['id'];
  $sql = "SELECT * FROM opening_hours WHERE pub_id = '$pub_id' and day = '$day'";
  $query = $conn->query($sql);
  $time = $query->fetch_assoc();

  $sql = "SELECT * from images where pub_id = '$pub_id'";
  $query = $conn->query($sql);
  $image = $query->fetch_assoc();

  if ($current_time >= $time['from_time'] && $current_time <= $time['to_time']) {
            
    $check_open = 'open';
    
    $ct = explode(":", $current_time);
    $tt = explode(":", $time['to_time']);
    $diff = $tt[0] - $ct[0];
    
    if($diff <= 2) {
      $check_open = 'closes_soon';
    }

  } else {
    $check_open = 'closed';
  }

  $isFloor = 0;
  $sql = "SELECT * from tables_list where pub_id = '$pub_id'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    if($row['floor_plan'] != '') {
      $isFloor = 1;
    }
  }

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
      array_push($errors, ''.$pub['venue_type'].' will be closed in the selected time.');
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

  

  <div class="row">
    
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><image href="uploads/<?php echo $image['image'];?>" width="100%" height="100%" /></svg>
        <div class="card-body">
          <h3 class="mb-0"><?php echo $pub['company_name']; ?></h3>
          <p class="card-text"><?php echo $pub['description']; ?></p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <?php 
                
                if($isFloor == 0) {
                  echo 'Company has not uploaded any floor plan.';
                } else {
                  echo '<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".bs-example-modal-lg">View Floorplan</button>';  
                }

              ?>
              
            </div>
            <?php

              if($check_open == 'open') {
                echo '<strong class="d-inline-block mb-2 text-success">Open</strong>';
              } elseif($check_open == 'closes_soon') {
                echo '<strong class="d-inline-block mb-2 text-closes-soon">Closes Soon</strong>';
              } else {
                echo '<strong class="d-inline-block mb-2 text-closed">Closed</strong>';
              }

            ?>
          </div>
          <div class="row" style="margin-top: 25px;">
            <?php
              $sql = "SELECT * from images where pub_id = '$pub_id'";
              $query = $conn->query($sql); 
              while($img = $query->fetch_assoc()) {
            ?>
            <div class="col">
              <a href="uploads/<?php echo $img['image']; ?>">
                <img src="uploads/<?php echo $img['image']; ?>" style="height: 50px; width: 50px;">
              </a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ul>
            
            <!-- The slideshow -->
            <div class="carousel-inner">
              <?php 
                $check = 0; 
                while($row = $result->fetch_assoc()) {
              ?>
              <div class="carousel-item <?php if($check == 0) { echo 'active'; } ?>">
                <img src="uploads/<?php echo $row['floor_plan']; ?>" alt="Img" style="width: 100%; height: auto;">
              </div>
              <?php $check = 1; } ?>
            </div>
            
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Book Information Form -->

    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Book Table</h4>
      <form class="needs-validation" method="post" action="table-booking.php?id=<?php echo $_GET['id']; ?>" novalidate>

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
                <option value="12.00">12.00 AM</option>
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
          <?php 
            
            $sql = "SELECT * from tables_list where pub_id = '$pub_id'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {

          ?>
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

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; GA Booking Systems 2020</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="index.html">Home</a></li>
      <li class="list-inline-item"><a href="partner-login.html">Log In</a></li>
    </ul>
  </footer>
</div>
<script src="partner/form-validation.js"></script>

</body>
</html>