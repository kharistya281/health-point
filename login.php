<?php
require 'function.php';

if (isset($_POST['submit'])) {
  $result = loginCust($_POST);
  if(is_numeric($result) && $result > 0) {
    echo "<script>
        alert ('Login Sukses');
        document.location.href= 'index.php';
        </script>";
  } else {
    echo $result;
  }
}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>HealthPoint</title>
  <link rel="icon" href="assets/img/logo.png" type="image/png">

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

  <!-- Fonts Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="assets/css/sign-in.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <main class="form-signin w-100 m-auto">
    <form method="post">
      <div class="d-flex header">
        <img class="mb-4 me-2" src="assets/img/logo.png" alt="" width="70">
        <h1 class="h3 mb-3 fw-normal">Selamat Datang di HealthPoint</h1>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
      </div>
      <hr>
      <div class="regis d-flex justify-content-center">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
      </div>
      <hr>
      <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Login</button>
      <p class="mt-3 mb-3 text-body-secondary">&copy;2024</p>
    </form>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>