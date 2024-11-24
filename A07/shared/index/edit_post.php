<div class="modal" tabindex="-1" id="editModal<?php echo $post['postID']?>">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- User -->
        <div class="row align-items-center mb-2">
          <div class="col-auto pe-0 mb-1">
            <a href="#"><img src="<?php echo $_SESSION['profilePicture']; ?>" class="rounded-circle" style="width: 50px;"></a>
          </div>
          <div class="col">
            <h6 class="mb-0"><?php echo $_SESSION['name']; ?></h6>
            <h6 class="mb-1 fw-light"><?php echo "@" . $_SESSION['username']; ?></h6>
          </div>
        </div>

        <!-- Edit Form -->
        <form method="post">
          <input type="hidden" value="<?php echo $post['postID']?>" name="postID">

          <!--  Text Area-->
          <textarea class="form-control rounded-4" name="content" placeholder="Write a post..." required><?php echo $post['content']?></textarea>

          <div class="row mt-2">

            <!-- Privacy Options -->
            <div class="col-12 col-md-6">
              <div class="input-group pt-2">
                <span class="input-group-text">Share to:</span>
                <select class="form-select" name="privacy" aria-label="Post Privacy">
                  <option <?php echo ($post['privacy'] == 'Public') ? 'selected' : ''; ?> value="Public">Public</option>
                  <option <?php echo ($post['privacy'] == 'Friends') ? 'selected' : ''; ?> value="Friends">Friends</option>
                  <option <?php echo ($post['privacy'] == 'Only Me') ? 'selected' : ''; ?> value="Only Me">Only Me</option>
                </select>
              </div>
            </div>

            <!-- Location -->
            <div class="col-12 col-md-6">
              <div class="input-group pt-2">
                <span class="input-group-text">Location:</span>
                <select class="form-select dropdown-center" name="address">
                  <?php
                    // Show selected value
                    if ($postAddress) {
                      echo "
                      <option selected value='" . $post['addressID'] . "'>$postAddress</option>
                      <option value='NULL'>---</option>";
                    } else {
                      echo "<option selected value='NULL'>---</option>";
                    }

                    mysqli_data_seek($addressResult, 0); // Rewind result pointer for addressResult reuse

                    // Show other values
                    if (mysqli_num_rows($addressResult) > 0) {
                      while ($address = mysqli_fetch_assoc($addressResult)) {
                        $locationOption = $address['cityName'] . ", " . $address['provinceName'];

                        if ($postAddress != $locationOption) {
                          echo "<option value='" . $address['addressID'] . "'>$locationOption</option>";
                        }
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="btnEdit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>