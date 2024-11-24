<div class="modal" tabindex="-1" id="editInfoModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="post">
          <div class="table-responsive">
            <table class="table table-borderless table-responsive p-0 m-0">
              <tbody>
                <?php
                mysqli_data_seek($infoResult, 0);

                if (mysqli_num_rows($infoResult) > 0) {
                  while ($info = mysqli_fetch_assoc($infoResult)) { ?>
                    <tr>
                      <td>First Name</td>
                      <td>
                        <input value="<?php echo $info['firstName'] ?>" class="form-control px-2 py-1" type="text" name="firstName" placeholder="First Name" required>
                      </td>
                    </tr>

                    <tr>
                      <td>Last Name</td>
                      <td>
                        <input value="<?php echo $info['lastName'] ?>" class="form-control px-2 py-1" type="text" name="lastName" placeholder="Last Name" required>
                      </td>
                    </tr>

                    <tr>
                      <td>Username</td>
                      <td>
                        <input value="<?php echo $_SESSION['username'] ?>" class="form-control px-2 py-1" type="text" name="username" placeholder="Username" required>
                      </td>
                    </tr>

                    <tr>
                      <td>Phone Number</td>
                      <td>
                        <input value="<?php echo $_SESSION['phoneNumber'] ?>" class="form-control px-2 py-1" type="text" name="phoneNumber" placeholder="Phone Number" required>
                      </td>
                    </tr>

                    <tr>
                      <td>Email Address</td>
                      <td>
                        <input value="<?php echo $_SESSION['email'] ?>" class="form-control px-2 py-1" type="text" name="email" placeholder="Email Address" required>
                      </td>
                    </tr>

                    <tr>
                      <td>Address</td>
                      <td>
                        <select class="form-select dropdown-center" name="address">
                          <option selected value="<?php echo $info['addressID'] ?>"><?php echo $userAddress ?></option>
                          <?php
                          if (mysqli_num_rows($addressResult) > 0) {
                            while ($address = mysqli_fetch_assoc($addressResult)) {
                              $locationOption = $address['cityName'] . ", " . $address['provinceName'];

                              if ($info['addressID'] != $address['addressID']) {
                                echo "<option value='" . $address['addressID'] . "'>$locationOption</option>";
                              }
                            }
                          }
                          ?>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td>Birthday</td>
                      <td>
                        <input value="<?php echo $info['birthDay'] ?>" class="form-control px-2 py-1" type="date" name="birthDay" placeholder="Birthday" required>
                      </td>
                    </tr>
                  <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>

          <div class="modal-footer mt-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="btnEditInfo">Save</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
</div>