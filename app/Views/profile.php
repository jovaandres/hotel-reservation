<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

  <div class="container mt-4">
      <h2>Profile</h2>
      <div class="col profile">
                <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger small" role="alert"><?= session('error') ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <?= $error ?>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= session('errors') ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>
          <div class="col-md-6 p-4 border shadow">
              <h5>User Information</h5>
                  <div class="mb-3">
                      <label for="username" class="form-label small">Username</label>
                      <input type="text" class="form-control" id="username" value="<?= $user->username ?>" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label small">Email</label>
                      <input type="email" class="form-control" id="email" value="<?= $user->email ?>" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="joinDate" class="form-label small">Join Date</label>
                      <input type="text" class="form-control" id="joinDate" value="<?= date("M d, Y", strtotime($user->created_at)) ?>" readonly>
                  </div>
          </div>
          <div class="col-md-6 mt-5 p-4 border shadow">
              <h5>Change Password</h5>
              <form action="/change-password" method="POST">
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
                  <button type="submit" class="btn-profile btn btn-primary" id="changePasswordBtn">Change Password</button>
              </form>
          </div>
      </div>
  </div>

<?= $this->endSection() ?>