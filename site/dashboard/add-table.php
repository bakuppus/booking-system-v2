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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $error = 0;
  $table_no = $_POST['table_no'];
  $table_name = $_POST['table_name'];
  $capacity = $_POST['capacity'];
  $table_location = $_POST['table_location'];
  $floor_plan = $_FILES['floor_plan']['name'];
  $description = $_POST['description'];

  $sql = "SELECT * from tables_list where pub_id = '$pub_id'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    if($row['table_no'] == $table_no) {
      echo "<script> alert('Table with same table number already exists'); </script>";
      $error = 1;
    }
  }

  if($error == 0) {
    
    $sql = "INSERT INTO tables_list(pub_id, table_no, table_name, table_location, capacity, floor_plan, description) VALUES ('$pub_id', '$table_no', '$table_name', '$table_location', '$capacity', '$floor_plan', '$description')";

    if ($conn->query($sql)) {
      move_uploaded_file($_FILES['floor_plan']['tmp_name'], '../uploads/'.$floor_plan);
      echo "<script> alert('Table added successfully.'); </script>";
      echo "<script> window.location = 'tables.php'; </script>";
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

    <title>Add New Table - GA Systems</title>

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
            <a class="nav-link active" href="tables.php">
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
        <h1 class="h2">Add Table</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">New Table for Listing</h4>
        <form class="needs-validation" method="post" action="add-table.php" enctype="multipart/form-data" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tableNo">Table No.</label>
              <input name="table_no" type="text" class="form-control" id="Table No." placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid table number is required.
              </div>
            </div>


            <div class="col-md-6 mb-3">
              <label for="tableName">Table Name</label>
              <input type="text" name="table_name" class="form-control" id="tableName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid table name is required.
              </div>
            </div>
            

            <div class="col-md-6 mb-3">
              <label for="capacity">Maximum Capacity</label>
              <input type="number" name="capacity" class="form-control" id="tableName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Please enter a maximum number of persons that can be seated at this table.
              </div>
            </div>
            



            <div class="col-md-6 mb-3">
              <label for="inOut">Inside or Outside?</label>
              <select class="custom-select d-block w-100" id="venue" name="table_location" required>
                <option value="">Choose...</option>
                <option>Inside</option>
                <option>Outside</option>
              </select>
              <div class="invalid-feedback">
                Please select whether the table is outside or outside the business premises.
              </div>
            </div>
          </div>


          <!-- Details Section -->
        <hr class="mb-4">
        <h4 class="mb-3">Additional Table Details</h4>
        <div class="form-row mb-3">
          <div class="form-group col">
            <label for="floorplan">Upload Floorplan Here</label>
            <input type="file" name="floor_plan" class="form-control-file" id="floorplan" accept="image/jpg, image/jpeg, image/png" required>
          </div>

        <div class="input-group col-7">
          <div class="input-group-prepend">
            <span class="input-group-text">Description</span>
          </div>
          <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
        </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Add Table</button>
      </form>

      
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script><script src="../partner/form-validation.js"></script></body>
</html>
