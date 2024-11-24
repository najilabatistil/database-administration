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
              <!-- Location Options -->
              <div class="col-12 col-md-6">
                <div class="input-group pt-2">
                  <span class="input-group-text">Location:</span>
                  <select class="form-select" name="address" aria-label="Post City">
                    <option selected value="NULL">---</option>
                    <?php 
                    if (mysqli_num_rows($addressResult) > 0) {
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