<!-- app/Views/auth/login.php -->
<?= $this->extend('templates/auth') ?>

<?= $this->section('content') ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow">
            <div class="card-body p-5">
                <?php if (session('success') !== null) : ?>
                    <div class="alert alert-success" role="alert"><?= session('success') ?></div>
                <?php endif ?>
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
                <h2 class="card-title text-center mb-4">Login</h2>
                <form action="/login" method="POST">
                    <div class="form-group">
                        <label for="email" class="small">Email</label>
                        <input type="email" name="email" id="email" class="form-control custom-text-size" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Auth.password') ?>" required>
                    </div>
                    <div class="form-group mt-2 small forget-password">
                        <a href="/forget" class="a-color text-decoration-none">Forget Password?</a>
                    </div>
                    <button type="submit" class="btn-grad btn btn-block mt-3 w-100">Login</button>
                </form>
                <p class="text-center mt-3 small">Don't have an account? <b><a href="/register" class="a-color text-decoration-none">Register</a></b></p>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
