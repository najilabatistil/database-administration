<?php
include("connect.php");
include("assets/php/flights_query.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Logs | PUP Airport</title>
  <link rel="icon" href="assets/img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand ps-1 ps-md-4" href="./">
        <img src="assets/img/logo.png" alt="PUP Airport Logo" width="25" class="align-text-top">
        PUP Airport
      </a>
    </div>
  </nav>

  <!-- Content -->
  <div class="container-fluid px-3 px-sm-4 px-md-5 py-4">

    <!-- Header -->
    <div class="row my-4">
      <div class="col text-center">
        <h1>
          Flight Logs
        </h1>
      </div>
    </div>

    <!-- Search, Filter, and Sort Section -->
    <?php include("assets/php/flights_form.php"); ?>

    <!-- TABLE -->
    <?php include("assets/php/flights_table.php"); ?>

  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>