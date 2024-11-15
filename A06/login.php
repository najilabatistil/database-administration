<?php 
include('connect.php');

session_start();
session_destroy();
session_start();

$invalid = "";

if (isset($_POST['btnLogin'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $userQuery = "SELECT users.userID, users.username, users.email, users.phoneNumber, userInfo.profilePicture, userInfo.firstName, userInfo.lastName, userInfo.birthDay, cities.name AS cityName, provinces.name AS provinceName FROM users LEFT JOIN userInfo ON users.userID = userInfo.userID LEFT JOIN addresses ON userInfo.addressID = addresses.addressID LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID WHERE users.email = '$email' AND users.password = '$password'";
  $userResult = executeQuery($userQuery);

  if (mysqli_num_rows($userResult) > 0) {
    while ($user = mysqli_fetch_assoc($userResult)) {
      $_SESSION['userID'] = $user['userID'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['phoneNumber'] = $user['phoneNumber'];
      $_SESSION['profilePicture'] = $user['profilePicture'];
      $_SESSION['name'] = $user['firstName'] . " " . $user['lastName'];
      $_SESSION['lastName'] = $user['lastName'];
      $_SESSION['birthDay'] = date('F j, Y', strtotime($user['birthDay']));
      $_SESSION['address'] = $user['cityName'] . ", " . $user['provinceName'];
    }
    header("Location: index.php");
    $invalid = "";
  } else {
    $invalid = "True";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login to fakebook</title>
  <link rel="icon" href="shared/assets/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="shared/css/style.css">
</head>

<body class="montserrat-regular" style="background-color: #D6E8F5;">
  <!-- Navbar -->
  <?php include('shared/assets/navbar.php') ?>

  <div class="container">
    <div class="row text-center pt-5 mt-5 mb-2">
      <h1 class="display-6 questrial-regular">Welcome to fakebook.</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 text-center">
          <div class="card shadow-sm rounded-4">
            <div class="card-body">
              <h5 class="card-title text-start">Log In</h5>
              <form method="POST">
                <input class="my-3 form-control" placeholder="Email" name="email" type="email">
                <input class="my-3 form-control" placeholder="Password" name="password" type="password">
                <button class="my-3 btn btn-primary" name="btnLogin">Log In</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row text-center my-3">
      <?php 
      if ($invalid == "True") {
        echo "<h5 class='montserrat-regular'>Invalid email or password.</h5>";
      }
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>