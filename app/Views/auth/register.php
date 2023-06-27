<!-- app/Views/auth/register.php -->
<?= $this->extend('templates/auth') ?>

<?= $this->section('content') ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow">
            <div class="card-body p-5">
                <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
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
                <h2 class="card-title text-center mb-4">Register</h2>
                <form action="/register" method="POST">
                    <div class="form-group">
                        <label for="username" class="small">Username</label>
                        <input type="username" name="username" id="username" class="form-control" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="email" class="small">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Auth.password') ?>" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password_confirm" class="small">Confirm Password</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-grad btn-block mt-3 w-100">Register</button>
                </form>
                <p class="text-center mt-3 small">Already have an account? <b><a href="/login" class="a-color text-decoration-none">Login</a></b></p>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
