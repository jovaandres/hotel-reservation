<!-- app/Views/auth/register.php -->
<?= $this->extend('templates/auth') ?>

<?= $this->section('content') ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow">
            <div class="card-body p-5">
                <h2 class="card-title text-center mb-4">Register</h2>
                <form action="/register" method="POST">
                    <div class="form-group">
                        <label for="email" class="small">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="confirm_password" class="small">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-grad btn-block mt-3 w-100">Register</button>
                </form>
                <p class="text-center mt-3 small">Already have an account? <b><a href="/login" class="a-color text-decoration-none">Login</a></b></p>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
