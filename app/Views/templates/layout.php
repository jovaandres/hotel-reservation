<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('hotel.ico') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/home.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/navbar.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://kit.fontawesome.com/84f8c13245.js" crossorigin="anonymous"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Include the navbar -->
    <?= view('templates/navbar') ?>
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
    <!-- Page content -->
    <?= $this->renderSection('content') ?>

    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 0);
        });
    </script>
</body>

</html>
