<?php include("shared/settings/operations.php"); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['name'] ?> | Settings</title>
  <link rel="icon" href="shared/assets/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="shared/css/style.css">
</head>

<body class="montserrat-regular">
  <!-- Navbar -->
  <?php include('shared/assets/navbar.php') ?>

  <!-- Information Section -->
  <div class="container px-3">
    <div class="row d-flex justify-content-center mt-5 pt-3">
      <div class="col-12 col-lg-9">
        <h3 class="montserrat-regular mb-3">Your Information</h3>
        <!-- User Info -->
        <?php include('shared/assets/user_info.php') ?>
        <!-- Edit Information Button -->
        <a class="my-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#editInfoModal">
          Edit Information
        </a>
      </div>
    </div>
  </div>

  <!-- Deletion Section -->
  <div class="container px-3">
    <div class="row d-flex justify-content-center mt-4">
      <div class="col-12 col-lg-9">
        <h3 class="montserrat-regular">Account Deletion</h3>
        <p>
          Warning: Deleting your account is permanent and cannot be undone. All your data will be removed from fakebook.
        </p>
        <!-- Delete Account Button -->
        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
          Delete My Account
        </a>
      </div>
    </div>
  </div>

  <!-- Delete Account Modal -->
  <?php include("shared/settings/delete_account.php"); ?>

  <!-- Edit Info modal -->
  <?php include("shared/settings/edit_info.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>