<!doctype html>
<html lang="en">

<head>

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="icon" type="image/png" href="favicon.png" />
  <link rel="icon" type="image/png" href="img/favicon/favicon.png" />
  <link rel="shortcut icon" href="img/favicon/favicon.ico" />
  <link rel="manifest" href="/site.webmanifest">

  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="The UK's number one website for booking tables in pubs and bars">
  <meta name="author" content="GA">

  <title><?php if(isset($_GET['city'])) { echo $_GET['city']; } ?> 🍹 - GA Booking Systems</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

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
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/main.css" rel="stylesheet">

</head>

<body>

  <div id="app" class="container">
    <?php 
      if(isset($_GET['city'])) {
        $city = strtolower($_GET['city']);
        $city = "img/Booking-Systems-".$city.".svg";
      } else {
        $city = "img/Booking-Systems-Logo.svg";
      }
    ?>
    <header>
      <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <a class="navbar-brand" href="index.php"><img src="<?php echo $city; ?>" alt="logo"
            width="128"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard/index.php">Partner Portal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="partner/index.php">List Pub/Bar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cancel.php">Cancel Booking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <br>
    <br>
    <br>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'London') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=London">London</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Manchester') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Manchester">Manchester</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Nottingham') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Nottingham">Nottingham</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Reading') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Reading">Reading</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Newcastle') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Newcastle">Newcastle</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Durham') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Durham">Durham</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Birmingham') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Birmingham">Birmingham</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'York') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=York">York</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Kent') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Kent">Kent</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Liverpool') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Liverpool">Liverpool</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Bristol') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Bristol">Bristol</a>
        <a class="p-2 <?php 

          if(isset($_GET['city'])) {
            if($_GET['city'] == 'Cardiff') {
              echo 'text-primary';
            } else {
              echo 'text-muted';
            }
          } else {
            echo 'text-muted';
          }

        ?>" href="index.php?city=Cardiff">Cardiff</a>
      </nav>
    </div>

    <div class="jumbotron p-4 p-md-5 text-white rounded bg-image">
      <div class="image-overlay"></div>
      <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic">2 for 1 all weekend!</h1>
        <p class="lead my-3">Treat yourself to our 2 for 1 deals on cocktails, mocktails, beers and ciders at selected
          venue across the UK!</p>
        <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Find out more...</a></p>
      </div>
    </div>

    <form method="post" action="index.php<?php 

      if(isset($_GET['city'])) {
        $city = $_GET['city'];
        echo '?city='.$city.'';
      }

    ?>">

    <div class="row">
      <div class="col">
        <label for="nameOfPub">Name</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span data-feather="home"></span>
          </div>
          <input type="text" name="company_name" class="form-control" id="nameOfPub" placeholder="Enter the name of a pub/bar...">
        </div>
      </div>


      <div class="col">

        <label for="location">Location</label>
        <input type="text" name="location" class="form-control" id="location" placeholder="Location" value="">
        <div class="invalid-feedback">
          Valid company name is required.
        </div>
      </div>


      <div class="col">
        <label for="venue">Venue</label>
        <select name="venue_type" class="custom-select d-block w-100" id="venue">
          <option value="">Choose type of venue...</option>
          <option>Pub</option>
          <option>Cocktail Bar</option>
          <option>Bar</option>
          <option>Sports Bar</option>
          <option>Gastropub</option>
          <option>Other</option>
        </select>
        <div class="invalid-feedback">
          Please provide a venue type.
        </div>
      </div>

      <div class="col text-center">
        <br>
        <button type="submit" class="btn btn-primary" @click="search">Search!</button>
      </div>
    </div>

    </form>

    <hr class="mb-4">



    <!-- List of bars -->
    <div class="row mb-2">
      <?php 
        
        include('php/database/connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

          $conditions = [];
          $fields = array('company_name', 'location', 'venue_type');
          
          foreach($fields as $field){
              if(isset($_POST[$field]) && $_POST[$field] != '') {
                  if($field == 'location') {
                    
                    $find[] = "INSTR(address_one, '".$_POST[$field]."') > 0";
                    $find[] = "INSTR(address_two, '".$_POST[$field]."') > 0";
                    $find[] = "INSTR(country, '".$_POST[$field]."') > 0";
                    $find[] = "INSTR(city, '".$_POST[$field]."') > 0";

                    $conditions[] = "(".implode(' OR ', $find).")";
                  } else {
                    $conditions[] = "INSTR(".$field.", '".$_POST[$field]."') > 0";  
                  }                  
              }
          }

          $sql = "SELECT * FROM pubs";
          if(count($conditions) > 0) {
              $sql .= " WHERE " . implode (' AND ', $conditions);
          }

          if(isset($_GET['city']) && count($conditions) > 0) {
            $city = $_GET['city'];
            $sql .= " AND city = '$city'";
          }

          if(isset($_GET['city']) && count($conditions) == 0) {
            $city = $_GET['city'];
            $sql .= " WHERE city = '$city'";
          }

        } else {
          $sql = "SELECT * from pubs";
          if(isset($_GET['city'])) {
            $city = $_GET['city'];
            $sql .= " WHERE city = '$city'";
          }
        }

        date_default_timezone_set("Europe/London");
        $current_time = date("g:i a");
        $current_time = date("H:i:s", strtotime($current_time));

        $timestamp = strtotime(date("Y-m-d"));
        $day = date('D', $timestamp);
        
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {

          $pub_id = $row['id'];
          $sql = "SELECT * FROM opening_hours WHERE pub_id = '$pub_id' and day = '$day'";
          $query = $conn->query($sql);
          $time = $query->fetch_assoc();

          if ($current_time >= $time['from_time'] && $current_time <= $time['to_time']) {
            
            $open = 'open';
            
            $ct = explode(":", $current_time);
            $tt = explode(":", $time['to_time']);
            $diff = $tt[0] - $ct[0];
            
            if($diff <= 2) {
              $open = 'closes_soon';
            }

          } else {
            $open = 'closed';
          }

          $sql = "SELECT * from images where pub_id = '$pub_id'";
          $query = $conn->query($sql);
          $image = $query->fetch_assoc();

      ?>
      <div class="col-md-6" v-for="pub in pubs">
        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <?php

              if($open == 'open') {
                echo '<strong class="d-inline-block mb-2 text-success">Open</strong>';
              } elseif($open == 'closes_soon') {
                echo '<strong class="d-inline-block mb-2 text-closes-soon">Closes Soon</strong>';
              } else {
                echo '<strong class="d-inline-block mb-2 text-closed">Closed</strong>';
              }

            ?>
            <h3 class="mb-0"><?php echo $row['company_name']; ?></h3>
            <div class="mb-1 text-muted"><?php echo $row['venue_type']; ?></div>
            <p class="card-text mb-auto"><?php echo $row['description']; ?></p>
            <a class="stretched-link" href="table-booking.php?id=<?php echo $row['id']; ?>">Book Now</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
              preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
              <title>Placeholder</title>
              <image href="uploads/<?php echo $image['image']; ?>" width="100%" height="100%" />
            </svg>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <footer class="blog-footer">
    <p>&copy; GA Booking Systems 2020</p>
    <p>
      <a href="#">Back to top</a> &nbsp; <a href="partner-login.php">Partner Portal</a>
    </p>
  </footer>

</body>

</html>