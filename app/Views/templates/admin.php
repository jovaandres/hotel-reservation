<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/admin.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row vh-100">
        <div class="col-md-3 col-lg-2 sidebar">
            <div class="sidebar-heading ps-3">
                <a class="active" href="<?= base_url('admin') ?>"><h3>Dashboard</h3></a>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item <?= (current_url() == base_url('admin/hotel')) ? 'selected' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/hotel') ?>">Manage Hotel</a>
                </li>
                <li class="nav-item <?= (current_url() == base_url('admin/room')) ? 'selected' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/room') ?>">Manage Room</a>
                </li>
                <li class="nav-item <?= (current_url() == base_url('admin/booking')) ? 'selected' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/booking') ?>">Manage Booking</a>
                </li>
                <li class="nav-item <?= (current_url() == base_url('admin/user')) ? 'selected' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/user') ?>">Manage User</a>
                </li>
            </ul>
            <div class="extra ps-3">
                <a class="nav-link home mb-2" href="<?= base_url() ?>">Home</a>
                <a class="nav-link logout" href="<?= base_url('logout') ?>">Logout</a>
            </div>
        </div>


        <!-- Content -->
        <div class="col-md-9 col-lg-10 content p-0">
            <nav class="navbar p-2">
                <div class="dashboard-title">
                    <div class="hidden"></div>
                    <h6>Welcome, Admin</h6>
                    <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                        aria-label="Toggle Sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <div class="p-4">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->renderSection('script') ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var sidebarToggleBtn = document.querySelector(".navbar-toggler");
        var sidebar = document.querySelector(".sidebar");

        sidebarToggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
        });
    });
</script>

</body>

</html>
