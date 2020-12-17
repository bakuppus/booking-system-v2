<?php

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
$pub_id = $row['id'];

$sql = "SELECT * from bookings where pub_id = '$pub_id'";
$result = $conn->query($sql);

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

    <title>Bookings - GA Systems</title>

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
        <h1 class="h2">Bookings</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a class="btn btn-sm btn-outline-primary" href="add-booking.php" role="button">Add Manual Booking</a>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>


      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Booking No.</th>
              <th>Table No.</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>No. of People</th>
              <th>Date</th>
              <th>From</th>
              <th>Till</th>
              <th>Cancel Booking</th>
            </tr>
          </thead>
          <?php
          
            while($row = $result->fetch_assoc()) {
              $table_id = $row['table_id'];
              $sql = "SELECT * from tables_list where id = '$table_id'";
              $query = $conn->query($sql);
              $table = $query->fetch_assoc();

          ?>
          <tbody>
            <tr>
              <td><?php echo $row['booking_no']; ?></td>
              <td><?php echo $table['table_no']; ?></td>
              <td><?php echo $row['first_name']; ?></td>
              <td><?php echo $row['last_name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['no_of_people']; ?></td>
              <td><?php echo $row['date']; ?></td>
              <td><?php echo $row['from_time']; ?></td>
              <td><?php echo $row['to_time']; ?></td>
              <td>&nbsp;<a href="cancel-booking.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-outline-danger btn-sm">Cancel booking</button></a></td>
            </tr>
          </tbody>
          <?php } ?>
        </table>
      </div>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
