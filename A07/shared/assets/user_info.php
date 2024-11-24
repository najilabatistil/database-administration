<?php
// Query for getting user info
$infoQuery = "SELECT userInfo.firstName, userInfo.lastName, userInfo.birthDay, userInfo.addressID, cities.name AS cityName, provinces.name AS provinceName FROM userInfo LEFT JOIN addresses ON userInfo.addressID = addresses.addressID LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID WHERE userInfo.userID = '{$_SESSION['userID']}'";
$infoResult = executeQuery($infoQuery);

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<div class="card shadow-sm rounded-4 about-card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-borderless table-responsive p-0 m-0">
        <tbody>
          <?php
          if (mysqli_num_rows($infoResult) > 0) {
            while ($info = mysqli_fetch_assoc($infoResult)) {

              $userAddress = $info['cityName'] . ", " . $info['provinceName'];
              $birthday = date('j F Y', strtotime($info['birthDay']));

              if($currentPage == 'settings.php') { ?>
              <tr>
                <td>Name</td>
                <td><?php echo $_SESSION['name'] ?></td>
              </tr>
              <tr>
                <td>Username</td>
                <td><?php echo $_SESSION['username'] ?></td>
              </tr>
              <tr>
                <td>Phone Number</td>
                <td><?php echo $_SESSION['phoneNumber'] ?></td>
              </tr>
            <?php
              }
            ?>
              <tr>
                <td>Email Address</td>
                <td><?php echo $_SESSION['email'] ?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $userAddress ?></td>
              </tr>
              <tr>
                <td>Birthday</td>
                <td><?php echo $birthday ?></td>
              </tr>
              <?php
            }
          }
          ?>  
        </tbody>
      </table>
    </div>
  </div>
</div>