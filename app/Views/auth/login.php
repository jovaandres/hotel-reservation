<!-- app/Views/auth/login.php -->
<?= $this->extend('templates/auth') ?>

<?= $this->section('content') ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow">
            <div class="card-body p-5">
                <h2 class="card-title text-center mb-4">Login</h2>
                <form action="/login" method="POST">
                    <div class="form-group">
                        <label for="email" class="small">Username or Email</label>
                        <input type="text" name="email" id="email" class="form-control custom-text-size" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-grad btn btn-block mt-3 w-100">Login</button>
                </form>
                <p class="text-center mt-3 small">Don't have an account? <b><a href="/register" class="a-color text-decoration-none">Register</a></b></p>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
