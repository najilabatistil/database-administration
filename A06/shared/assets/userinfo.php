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
  </div>
</div>