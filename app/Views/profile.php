<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

  <div class="container my-4">
      <h2>Profile</h2>
      <div class="col profile">
                <div class="col-md-6 p-4 border shadow">
                    <h5>User Information</h5>
                    <form action="<?= base_url('update-profile') ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label small">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?= $user->name ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label small">Username</label>
                            <input type="text" class="form-control" id="username" value="<?= $user->username ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label small">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?= $user->email ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label small">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" value="<?= $user->phone ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="joinDate" class="form-label small">Join Date</label>
                            <input type="text" class="form-control" id="joinDate" value="<?= date("M d, Y", strtotime($user->created_at)) ?>" readonly>
                        </div>
                        <div class="mb-3 text-end">
                            <button id="editProfileBtn" type="button" class="btn-profile btn btn-primary">Edit Profile</button>
                            <button id="cancelEditBtn" type="button" class="btn-profile btn btn-secondary" style="display: none;">Cancel</button>
                            <button id="submitEditBtn" type="submit" class="btn-profile btn btn-primary" style="display: none;">Submit</button>
                        </div>
                    </form>
                </div>
          <div class="col-md-6 mt-5 p-4 border shadow">
              <h5>Change Password</h5>
              <form action="<?= base_url('change-password') ?>" method="POST">
                  <div class="mb-3">
                      <label for="currentPassword" class="form-label small">Current Password</label>
                      <input type="password" name="currentPassword" class="form-control" id="currentPassword" required>
                  </div>
                  <div class="mb-3">
                      <label for="newPassword" class="form-label small">New Password</label>
                      <input type="password" name="newPassword" class="form-control" id="newPassword" required>
                  </div>
                  <div class="mb-3">
                      <label for="confirmPassword" class="form-label small">Confirm New Password</label>
                      <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required>
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn-profile btn btn-primary" id="changePasswordBtn">Change Password</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <script>
        const editProfileBtn = document.getElementById('editProfileBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const submitEditBtn = document.getElementById('submitEditBtn');
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('phone');

        editProfileBtn.addEventListener('click', () => {
            editProfileBtn.style.display = 'none';
            cancelEditBtn.style.display = 'inline-block';
            submitEditBtn.style.display = 'inline-block';
            nameInput.removeAttribute('readonly');
            phoneInput.removeAttribute('readonly');
        });

        cancelEditBtn.addEventListener('click', () => {
            editProfileBtn.style.display = 'inline-block';
            cancelEditBtn.style.display = 'none';
            submitEditBtn.style.display = 'none';
            nameInput.setAttribute('readonly', 'readonly');
            phoneInput.setAttribute('readonly', 'readonly');
        });
    </script>
  
<?= $this->endSection() ?>