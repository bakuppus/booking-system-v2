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
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" method="post" action="php/cancel-booking.php">
  <div class="text-center mb-4">
    <a href="index.html"><img class="" src="img/Booking-Systems-Logo.svg" alt="" width="200" height="72"></a>
    <br>
    <p>Subterranean cocktail bar with explorer-style decor and live music, for cocktails and rare spirits.</a></p>
  </div>

  <div class="form-label-group">
    <input maxlength="6" type="text" name="booking_no" id="bookingNumber" class="form-control" placeholder="Booking number" required>
    <label for="inputPassword">Booking number</label>
  </div>

  <div class="form-label-group">
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputEmail">Email address</label>
  </div>

  <button class="btn btn-lg btn-danger btn-block" type="submit">Cancel</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; GA Booking Systems 2020</p>
</form>
</body>
</html>
