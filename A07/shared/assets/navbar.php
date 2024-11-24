<nav class="navbar fixed-top justify-content-between py-0" style="background-color: #3253BE; border-bottom: 1px solid #000000;">
  <div class="container" style="position: relative;">
    <a class="navbar-brand questrial-reqular" href="./" style="color: #ffffff">fakebook</a>
    <div id="navbarNav">
      <ul class="navbar-items navbar-nav">
        <li class="nav-item">
          <?php
          if (isset($_SESSION['userID'])) { ?>

            <div class="dropdown">
              <button class="btn p-1 dropdown-toggle profile-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffffff; border: none !important;">
                <img src=<?php echo $_SESSION['profilePicture'] ?> class="img-fluid rounded-circle " style="height: 35px; border: none;">
              </button>
              <ul class="dropdown-menu dropdown-menu-end" style="position: absolute;">
                <!-- Profile Button -->
                <li>
                  <a class="dropdown-item option-dropdown" href="./" style="text-decoration: none;">
                    <i class="bi bi-person-circle px-1"></i> View Profile
                  </a>
                </li>
                <!-- Settings Button -->
                <li>
                  <a class="dropdown-item option-dropdown" href="settings.php" style="text-decoration: none;">
                    <i class="bi bi-gear px-1"></i> Settings
                  </a>
                </li>
                <!-- Log out Button -->
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item" href="login.php" style="color: red;">
                    <i class="bi bi-box-arrow-right px-1"></i> Log Out
                  </a>
                </li>
              </ul>
            </div>

          <?php
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>