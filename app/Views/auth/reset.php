<?= $this->extend('templates/auth') ?>

<?= $this->section('content') ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow">
            <div class="card-body p-5">
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
                <form action="<?= base_url('reset') ?>" method="POST">
                    <input type="hidden" name="email" value="<?= $user->email ?>">
                    <div class="form-group">
                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control custom-text-size" placeholder="New <?= lang('Auth.password') ?>" value="<?= old('password') ?>" required>
                    </div>
                    <button type="submit" class="btn-grad btn btn-block mt-3 w-100">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
