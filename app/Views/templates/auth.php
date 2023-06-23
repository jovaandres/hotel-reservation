<!-- app/Views/templates/base.php -->
<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/auth.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            background: rgb(255,90,95);
            background: linear-gradient(9deg, rgba(255,90,95,1) 0%, rgba(196,17,109,1) 50%, rgba(0,166,153,1) 100%);
        }
    </style>
</head>
<body>
    <header>
        <!-- Add your header content here -->
    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>
</html>