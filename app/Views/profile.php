<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

  <div class="container mt-4">
      <h2>Profile</h2>
      <div class="col profile">
          <div class="col-md-6 p-4 border shadow">
              <h5>User Information</h5>
              <form>
                  <div class="mb-3">
                      <label for="username" class="form-label small">Username</label>
                      <input type="text" class="form-control" id="username" value="JohnDoe" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label small">Email</label>
                      <input type="email" class="form-control" id="email" value="johndoe@example.com" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="joinDate" class="form-label small">Join Date</label>
                      <input type="text" class="form-control" id="joinDate" value="June 1, 2023" readonly>
                  </div>
                  <button type="button" class="btn-profile btn btn-primary" id="editProfileBtn">Edit Profile</button>
              </form>
          </div>
          <div class="col-md-6 mt-5 p-4 border shadow">
              <h5>Change Password</h5>
              <form action="/change-password" method="POST">
                  <div class="mb-3">
                      <label for="currentPassword" class="form-label small">Current Password</label>
                      <input type="password" class="form-control" id="currentPassword" required>
                  </div>
                  <div class="mb-3">
                      <label for="newPassword" class="form-label small">New Password</label>
                      <input type="password" class="form-control" id="newPassword" required>
                  </div>
                  <div class="mb-3">
                      <label for="confirmPassword" class="form-label small">Confirm New Password</label>
                      <input type="password" class="form-control" id="confirmPassword" required>
                  </div>
                  <button type="button" class="btn-profile btn btn-primary" id="changePasswordBtn">Change Password</button>
              </form>
          </div>
      </div>
  </div>

<?= $this->endSection() ?>