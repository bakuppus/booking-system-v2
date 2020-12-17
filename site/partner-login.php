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

    <title>Company Login - GA Booking Systems</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

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
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <form id="myForm" class="form-signin" method="post" action="php/login.php" onsubmit="return mySubmitFunction(event)">
  <a href="index.html"><img class="" src="img/Booking-Systems-Logo.svg" alt="" width="200" height="72"></a>
  <br><br>
  <label for="inputEmail" class="sr-only">Username</label>
  <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <br>
  <p class="text-muted">Not a partner? <a href="partner/index.php">Sign Up</a></p>
  <p class="mt-5 mb-3 text-muted">&copy; GA Booking Systems 2020</p>
</form>
</body>
</html>

<script>

  function mySubmitFunction(e) {
    e.preventDefault();
    document.getElementById("myForm").submit();
  }
  
</script>