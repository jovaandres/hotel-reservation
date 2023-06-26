<?php
    $authenticator = auth('session')->getAuthenticator();
    $isLoggedIn = $authenticator->loggedIn();
?>

<nav class="navbar navbar-expand-lg navbar-light border shadow">
    <div class="container">
        <a class="navbar-brand" href="/">Hotel Reservation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: white;"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact-information">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <?php if ($isLoggedIn): ?>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <?php if ($authenticator->getUser()->is_admin): ?>
                            <a class="dropdown-item" href="/admin">Admin Dashboard</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="/user">Profile</a>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                    <?php else: ?>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="/login">Login</a>
                    </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
