<?php
include('connect.php');

session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

if (isset($_POST['btnDeleteAccount'])) {
  $deleteQuery = "DELETE FROM users WHERE userID = '{$_SESSION['userID']}'";
  executeQuery($deleteQuery);

  header("Location: login.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['name'] ?> | Settings</title>
  <link rel="icon" href="shared/assets/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="shared/css/style.css">
</head>

<body class="montserrat-regular">
  <!-- Navbar -->
  <?php include('shared/assets/navbar.php') ?>

  <!-- Information Section -->
  <div class="container px-3">
    <div class="row d-flex justify-content-center mt-5">
      <div class="col-12 col-lg-9">
        <h3 class="montserrat-regular mb-3">Your Information</h3>
        <?php include('shared/assets/userinfo.php') ?>
        <form method="post">
          <button class="my-3 btn btn-primary" type="submit" name="btnEditInfo">Edit Information</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Deletion Section -->
  <div class="container px-3">
    <div class="row d-flex justify-content-center mt-5">
      <div class="col-12 col-lg-9">
        <h3 class="montserrat-regular">Account Deletion</h3>
        <p>
          Warning: Deleting your account is permanent and cannot be undone. All your data will be removed from fakebook.
        </p>
        <button class="btn btn-danger" type="button" name="btnDeleteAccount" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
          Delete My Account
        </button>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal" tabindex="-1" id="deleteAccountModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <p class="text-danger">Warning: Deleting your account is permanent and cannot be undone. All your data will be removed from fakebook.</p>
            </div>
            <div class="row align-items-center">
              <div class="col-auto pe-0">
                <a href="#"><img src="<?php echo $_SESSION['profilePicture']; ?>" class="rounded-circle" style="width: 50px;"></a>
              </div>
              <div class="col">
                <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form method="POST">
            <button class="btn btn-danger" name="btnDeleteAccount">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>