<?php
include('connect.php');

session_start();

// Query for getting user info
$userQuery = "SELECT users.userID, users.username, users.email, users.phoneNumber, userInfo.profilePicture, userInfo.firstName, userInfo.lastName, userInfo.birthDay, cities.name AS cityName, provinces.name AS provinceName FROM users LEFT JOIN userInfo ON users.userID = userInfo.userID LEFT JOIN addresses ON userInfo.addressID = addresses.addressID LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID WHERE users.userID = 1";
$userResult = executeQuery($userQuery);

// Store user info in session variables
if (mysqli_num_rows($userResult) > 0) {
  while ($user = mysqli_fetch_assoc($userResult)) {
    $_SESSION['userID'] = $user['userID'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['phoneNumber'] = $user['phoneNumber'];
    $_SESSION['profilePicture'] = $user['profilePicture'];
    $_SESSION['name'] = $user['firstName'] . " " . $user['lastName'];
    $_SESSION['lastName'] = $user['lastName'];
    $_SESSION['birthDay'] = $user['birthDay'];
    $_SESSION['address'] = $user['cityName'] . ", " . $user['provinceName'];
  }
}

// Get post content
if (isset($_POST['btnPost'])) {
  $content = $_POST['content'];
  $privacy = $_POST['privacy'];

  $insertQuery = "INSERT INTO posts (userID, content, privacy, isDeleted) VALUES ('{$_SESSION['userID']}', '$content', '$privacy', 'no')";
  executeQuery($insertQuery);
}

// Query for getting post info
$postQuery = "SELECT userID, content, privacy FROM posts";
$postResult = executeQuery($postQuery);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>
  <link rel="icon" href="shared/assets/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="shared/css/style.css">
</head>

<body class="montserrat-regular">
  <?php include('shared/assets/navbar.php') ?>

  <!-- Profile Section -->
  <div class="container-fluid profile-bg pb-5 mb-5">

    <!-- User -->
    <div class="row">
      <div class="col text-center pt-3">
        <img src=<?php echo $_SESSION["profilePicture"] ?> class="img-fluid shadow-sm rounded-circle" style="width: 175px;">
      </div>
    </div>

    <div class="row">
      <div class="col text-center pt-3">
        <h4 class="montserrat-semibold">
          <?php echo $_SESSION['name'] ?>
        </h4>
        <h6>
          <?php echo $_SESSION['username'] ?>
        </h6>
      </div>
    </div>

    <!-- About -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-lg-9 py-3">
        <div class="card shadow-sm rounded-4 about-card">
          <div class="card-body">
            <table class="table table-borderless p-0">
              <tbody>
                <tr>
                  <td>Location</td>
                  <td><?php echo $_SESSION['address'] ?></td>
                </tr>
                <tr>
                  <td>Birthday</td>
                  <td><?php echo $_SESSION['birthDay'] ?></td>
                </tr>
                <tr>
                  <td>Email Address</td>
                  <td><?php echo $_SESSION['email'] ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- POST FORM -->
  <div class="container pt-5">

    <div class="row text-center pt-5">
      <h2 class="montserrat-regular">Posts</h2>
    </div>

    <div class="row justify-content-center p-2 mb-2">
      <div class="col-12 col-lg-9 text-center">
        <div class="card shadow-sm rounded-4">
          <div class="card-body">
            <h6 class="card-title mb-2 ms-1">Create a new post</h6>
            <form method="post">
              <textarea class="form-control rounded-4" name="content" placeholder="Write a post..." required></textarea>
              <div class="input-group pt-2 mw-100  mx-auto my-2" style="width: fit-content;">
                <span class="input-group-text">Share to:</span>
                <select class="form-select" name="privacy" aria-label="Post Privacy">
                  <option selected value="Public">Public</option>
                  <option value="Friends">Friends</option>
                  <option value="Only Me">Only Me</option>
                </select>
              </div>
              <button class="mt-1 btn btn-primary" type="submit" name="btnPost">Post</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Posts Section -->
  <div class="container py-4">

    <?php
    if (mysqli_num_rows($postResult)) {
      while ($post = mysqli_fetch_assoc($postResult)) { ?>

        <div class="row justify-content-center p-2">
          <div class="col-12 col-lg-9">
            <div class="card shadow-sm rounded-4">
              <div class="card-body">

                <!-- User -->
                <div class="row d-flex flex-row justify-content-center align-items-center p-3">
                  <div class="col-auto pe-0 mb-1">
                    <a href="#"><img src="<?php echo $_SESSION['profilePicture']; ?>" class="rounded-circle" style="width: 50px;"></a>
                  </div>
                  <div class="col">
                    <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
                    <h6 class="mb-1 fw-light"><?php echo $_SESSION['username']; ?></h6>
                  </div>
                </div>

                <!-- Content -->
                <div class="row px-3 pb-1 pt-2">
                  <div class="col">
                    <p><?php echo $post['content']; ?></p>
                  </div>
                </div>

                <!-- Post Info -->
                <div class="row px-3">
                  <div class="col">
                    <hr>
                    <h6 class="fw-light text-end"><i>Shared with: <?php echo $post['privacy']; ?></i></h6>
                  </div>
                </div>

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