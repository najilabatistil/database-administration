<?php
include('connect.php');

$query = "SELECT users.username, users.email, userInfo.firstName, userInfo.lastName, userInfo.birthDay, cities.name AS cityName, provinces.name AS provinceName FROM users LEFT JOIN userInfo ON users.userID = userInfo.userID LEFT JOIN addresses ON userInfo.addressID = addresses.addressID LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID WHERE users.userID = 1";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1 questrial-regular">fakebook</span>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col text-center pt-5">
        <img src="https://avatar.iran.liara.run/public/47" class="img-fluid shadow-sm rounded-circle" style="width: 175px;">
      </div>
    </div>
    <div class="row">
    
    <?php
      if (mysqli_num_rows($result)) {
        while ($user = mysqli_fetch_assoc($result)) {
          ?>

          <div class="col text-center pt-3">
            <h4 class="montserrat-semibold">
              <?php echo $user["firstName"] . " " . $user["lastName"] ?>
            </h4>
            <h6>
              <?php echo $user["username"] ?>
            </h6>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card shadow-sm rounded-4">
              <div class="card-body">
                <h5 class="card-title">About</h5>
                <table class="table table-borderless p-0">
                  <tbody>
                    <tr>
                      <td>Location</td>
                      <td><?php echo $user["cityName"] . ", " . $user["provinceName"] ?></td>
                    </tr>
                    <tr>
                      <td>Birthday</td>
                      <td><?php echo $user["birthDay"] ?></td>
                    </tr>
                    <tr>
                      <td>Email Address</td>
                      <td><?php echo $user["email"] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <?php
        }
      }
      ?>
      
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>