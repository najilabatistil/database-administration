<div class="container-fluid profile-bg pb-5 mb-5 mt-4">
  <!-- User -->
  <div class="row">
    <div class="col text-center pt-3 mt-4">
      <img src=<?php echo $_SESSION['profilePicture'] ?> class="img-fluid shadow-sm rounded-circle" style="width: 175px;">
    </div>
  </div>
  <!-- Name -->
  <div class="row">
    <div class="col text-center pt-3">
      <h4 class="montserrat-semibold mb-0">
        <?php echo $_SESSION['name'] ?>
      </h4>
      <h6 class="fw-normal">
        <?php echo "@" . $_SESSION['username'] ?>
      </h6>
    </div>
  </div>
  <!-- User Info -->
  <div class="row d-flex justify-content-center">
    <div class="col-12 col-lg-9 py-3">
      <?php include('shared/assets/user_info.php') ?>
    </div>
  </div>
</div>