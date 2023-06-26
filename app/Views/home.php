<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Welcome to Hotel Reservation</h2>
    <div class="card-container mt-4">
        <?php foreach ($rooms as $room) : ?>
            <a href="/room/<?= $room['id'] ?>" class="text-decoration-none">
                <div class="card mb-4 border-0">
                    <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="card-img-top square-image" alt="Hotel Image">
                    <div class="card-body">
                        <p class="card-title"><b><?= $room['hotel_name'] ?></b></p>
                        <p class="card-text"><?= $room['room_type'] ?></p>
                        <p class="card-text"><b>$<?= $room['price_per_night'] ?> / night</b></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
