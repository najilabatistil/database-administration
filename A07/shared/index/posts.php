<div class="container py-4">
  <?php
  if (mysqli_num_rows($postResult)) {
    while ($post = mysqli_fetch_assoc($postResult)) {

      $date = date('g:i A • d F Y', strtotime($post['dateTime']));
      $postAddress = '';

      if (($post['cityName']) && ($post['provinceName'])) {
        $postAddress = $post['cityName'] . ", " . $post['provinceName'];
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
                  <h6 class="mb-0">
                    <?php 
                    // Name
                    echo $_SESSION['name']; 

                    // Location
                    if($postAddress) {
                      echo "<span class='fw-light'> is in $postAddress</span>";
                    }
                    ?>
                  </h6>
                  <h6 class="mb-1 fw-light"><?php echo "@" . $_SESSION['username']; ?></h6>
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
                        <a class="dropdown-item option-dropdown" data-bs-toggle="modal" data-bs-target="#deleteModal" style="color: red; text-decoration: none;">
                          <i class="bi bi-trash3 px-1"></i> Delete
                        </a>
                      </li>
                      <!-- Edit Button -->
                      <li>
                        <a class="dropdown-item option-dropdown" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $post['postID']; ?>" style="text-decoration: none;">
                          <i class="bi bi-pencil-square px-1"></i> Edit
                        </a>
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
                    <?php 
                      echo $date . " • " . $post['privacy'];
                    ?> 
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Modal -->
      <?php include("shared/index/delete_post.php"); ?>

      <!-- Edit Modal -->
      <?php include("shared/index/edit_post.php"); ?>

  <?php
    }
  }
  ?>

</div>