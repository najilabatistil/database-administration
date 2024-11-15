<?php
include('connect.php');

session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

// Get post form content for insertion
if (isset($_POST['btnPost'])) {
  $content = $_POST['content'];
  $privacy = $_POST['privacy'];
  $addressID = $_POST['address'];

  $insertQuery = "INSERT INTO posts (userID, content, privacy, isDeleted, addressID) VALUES ('{$_SESSION['userID']}', '$content', '$privacy', 'no', '$addressID')";
  executeQuery($insertQuery);
}

// Delete post
if(isset($_POST['btnDelete'])){
  $postID = $_POST['postID'];

  $deleteQuery = "UPDATE posts SET isDeleted = 'yes' WHERE postID = '$postID'";
  executeQuery($deleteQuery);
}

// Query for getting addresses
$addressQuery = "SELECT addressID, cities.name AS cityName, provinces.name AS provinceName FROM addresses LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID";
$addressResult = executeQuery($addressQuery);

// Query for displaying post info
$postQuery = "SELECT posts.postID, posts.content, posts.dateTime, posts.privacy, cities.name AS cityName, provinces.name AS provinceName FROM posts LEFT JOIN addresses on posts.addressID = addresses.addressID LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID WHERE userID = '{$_SESSION['userID']}' AND isDeleted = 'no' ORDER BY postID DESC" ;
$postResult = executeQuery($postQuery);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['name'] ?></title>
  <link rel="icon" href="shared/assets/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="shared/css/style.css">
</head>

<body class="montserrat-regular">
  <!-- Navbar -->
  <?php include('shared/assets/navbar.php') ?>

  <!-- Profile Section -->
  <div class="container-fluid profile-bg pb-5 mb-5">
    <!-- User -->
    <div class="row">
      <div class="col text-center pt-3">
        <img src=<?php echo $_SESSION['profilePicture'] ?> class="img-fluid shadow-sm rounded-circle" style="width: 175px;">
      </div>
    </div>
    <!-- Name -->
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
            <div class="table-responsive">
              <table class="table table-borderless table-responsive p-0 m-0">
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
            <div class="row mt-3">
              <div class="col d-flex justify-content-center">
                <a href="login.php"><button class="btn btn-danger">Log out</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- POST FORM -->
  <div class="container pt-5 mt-5">
    <div class="row text-center pt-5 mt-5">
      <h2 class="montserrat-regular">Posts</h2>
    </div>

    <div class="row justify-content-center p-2 mb-2">
      <div class="col-12 col-lg-9 text-center">
        <div class="card shadow-sm rounded-4">
          <div class="card-body">
            <h6 class="card-title mb-2 ms-1">Create a new post</h6>
            <form method="post">
              <!--  Text Area-->
              <textarea class="form-control rounded-4" name="content" placeholder="Write a post..." required></textarea>
              <div class="row mt-2">
                <!-- Privacy Options -->
                <div class="col-12 col-md-6">
                  <div class="input-group pt-2">
                    <span class="input-group-text">Share to:</span>
                    <select class="form-select" name="privacy" aria-label="Post Privacy">
                      <option selected value="Public">Public</option>
                      <option value="Friends">Friends</option>
                      <option value="Only Me">Only Me</option>
                    </select>
                  </div>
                </div>
                <!-- Location -->
                <div class="col-12 col-md-6">
                  <div class="input-group pt-2">
                    <span class="input-group-text">Location:</span>
                    <select class="form-select" name="address" aria-label="Post City">
                      <option selected value="NULL">---</option>
                      <?php 
                      if (mysqli_num_rows($addressResult)) {
                        while ($address = mysqli_fetch_assoc($addressResult)) {
                          $locationOption = $address['cityName'] . ", " . $address['provinceName'];

                          echo "<option value='" . $address['addressID'] . "'>$locationOption</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- Post Button -->
              <button class="mt-3 btn btn-primary" type="submit" name="btnPost">Post</button>
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
      while ($post = mysqli_fetch_assoc($postResult)) {

        $date = date('g:i A • d F Y', strtotime($post['dateTime']));
        $location = '';

        if (($post['cityName']) && ($post['provinceName'])) {
          $location = $post['cityName'] . ", " . $post['provinceName'];
        }
    ?>

        <!-- Posts -->
        <div class="row justify-content-center p-2">
          <div class="col-12 col-lg-9">
            <div class="card shadow-sm rounded-4">
              <div class="card-body">
                <!-- Top Section -->
                <div class="row d-flex flex-row justify-content-center align-items-center p-3">
                  <!-- User -->
                  <div class="col-auto pe-0 mb-1">
                    <a href="#"><img src="<?php echo $_SESSION['profilePicture']; ?>" class="rounded-circle" style="width: 50px;"></a>
                  </div>
                  <div class="col">
                    <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
                    <h6 class="mb-1 fw-light"><?php echo $_SESSION['username']; ?></h6>
                  </div>
                  <!-- Post Options -->
                  <div class="col-auto p-0">
                    <div class="dropdown">
                      <button class="btn options-btn p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <!-- Delete Button -->
                        <li>
                          <button class="btn option-dropdown w-100 text-start" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" style="color: red;">
                            <i class="bi bi-trash3 px-1"></i>
                            Delete
                          </button>
                        </li>
                        <!-- Edit Button -->
                        <li>
                          <button class="btn option-dropdown w-100 text-start" type="button">
                            <i class="bi bi-pencil-square px-1"></i>
                            Edit
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- Content -->
                <div class="row px-3 pb-1 pt-2">
                  <div class="col">
                    <p><?php echo $post['content']; ?></p>
                  </div>
                </div>
                <!-- Post Info -->
                <div class="row px-3 mt-2">
                  <div class="col">
                    <h6 class="fw-light text-start mb-0">
                      <?php echo $date ?> • <?php echo $post['privacy']; ?>
                      <?php  
                        if($location) {
                          echo "|<i class='bi bi-geo-alt px-1'> $location</i>";
                        }
                      ?> 
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal" tabindex="-1" id="deleteModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Delete Post?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p>This action cannot be undone.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form method="post">
                  <input type="hidden" value="<?php echo $post['postID']?>" name="postID">
                  <button class="btn btn-danger" name="btnDelete">Delete</button>
                </form>
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