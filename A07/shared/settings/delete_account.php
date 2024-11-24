<div class="modal" tabindex="-1" id="deleteAccountModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Account?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="container">
          <div class="row">
            <p class="text-danger">
              Deleting your account is permanent and cannot be undone. All your data will be removed from fakebook. Are you sure you want to proceed?
            </p>
          </div>
          <div class="row align-items-center">
            <div class="col-auto pe-0">
              <img src="<?php echo $_SESSION['profilePicture']; ?>" class="rounded-circle" style="width: 50px;">
            </div>
            <div class="col">
              <h6 class="mb-0"><?php echo $_SESSION['name'] ?></h6>
              <h6 class="fw-light"><?php echo "@" . $_SESSION['username']; ?></h6>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="POST">
          <button type="submit" class="btn btn-danger" name="btnDeleteAccount">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>