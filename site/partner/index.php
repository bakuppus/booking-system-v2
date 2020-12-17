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

    <title>Join · GA Booking Systems</title>


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
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <a href="../index.html"><img class="" src="../img/Booking-Systems-Logo.svg" alt="" width="200" height="72"></a>
    <p class="lead">Please fill out the form below. We will use particulars from this <br>will be as display information for your Pub/Bar.</p>
  </div>

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Pay</span>
        <span class="badge badge-secondary badge-pill">1</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Annual Subscription</h6>
            <small class="text-muted">24/7 Online Listing & Booking Management</small>
          </div>
          <span class="text-muted">$12</span>
        </li>

        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>GABSYEARFREE</small>
          </div>
          <span class="text-success">-$12</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>$0</strong>
        </li>
      </ul>

      <form class="card p-2">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Create Account</h4>
      <form class="needs-validation" method="post" action="../php/insert.php" enctype="multipart/form-data" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Company Name</label>
            <input type="text" class="form-control" name="company_name" id="firstName" required>
            <div class="invalid-feedback">
              Valid company name is required.
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="venue">Venue</label>
            <select class="custom-select d-block w-100" name="venue_type" id="venue" required>
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
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            <div class="invalid-feedback" style="width: 100%;">
              A username is required.
            </div>
          </div>
          <small class="text-muted">This will be used to enter your admin portal</small>
        </div>


        <div class="mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <div class="invalid-feedback" style="width: 100%;">
            A password is required.
          </div>
        </div>
      

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address_one" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter the business address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" name="address_two" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="country" id="country" required>
              <option value="">Choose...</option>
              <option>United Kingdom</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">Town/City</label>
            <input type="text" class="form-control" name="city" id="state" required>
            </select>
            <div class="invalid-feedback">
              Please provide a town/city.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Postcode</label>
            <input type="text" class="form-control" name="post_code" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              This is not a valid entry.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="booking_available" id="list-available">
          <label class="custom-control-label" for="list-available">List my business available for bookings</label>
        </div>
        <hr class="mb-4">


        <!-- Details Section -->
        <h4 class="mb-3">Business Details</h4>
        <div class="mb-3">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="image[]" id="image" onChange="validatedCustomFile()" multiple="multiple" accept="image/jpg, image/jpeg, image/png" required>
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
          <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
        </div>
        <hr class="mb-4">


        <!-- Opening Hours Section -->
        <h4 class="mb-3">Opening Hours</h4>

        <!-- Monday Opening Hours-->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="monday">Monday</label>
            <select class="custom-select" name="mon_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="mon_to" required>
                <option value="">Closing time</option>
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
            <select class="custom-select" name="tue_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="tue_to" required>
                <option value="">Closing time</option>
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
            <select class="custom-select" name="wed_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="wed_to" required>
                <option value="">Closing time</option>
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
            <select class="custom-select" name="thu_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="thu_to" required>
                <option value="">Closing time</option>
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
            <select class="custom-select" name="fri_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="fri_to" required>
                <option value="">Closing time</option>
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
            <select class="custom-select" name="sat_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="sat_to" required>
                <option value="">Closing time</option>
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
            <select class="custom-select" name="sun_from" required>
                <option value="">Opening time</option>
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
            <select class="custom-select" name="sun_to" required>
                <option value="">Closing time</option>
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
        
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" required>
            <label class="form-check-label" for="invalidCheck3">
              Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
              You must agree before submitting.
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; GA Booking Systems 2020</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="../index.html">Home</a></li>
      <li class="list-inline-item"><a href="../partner-login.html">Log In</a></li>
    </ul>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="form-validation.js"></script></body>
</html>
