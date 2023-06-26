<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container hotel-container mt-4">
    <div class="home-title">
        <h1>Hotel Reservation</h1>
        <p>Find your perfect room</p>
    </div>
    <div class="card-container mt-4">
        <?php foreach ($rooms as $room) : ?>
            <a href="/room/<?= $room['id'] ?>" class="text-decoration-none">
                <div class="card mb-4 border-0">
                    <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="card-img-top square-image" alt="Hotel Image">
                    <div class="card-body">
                        <p class="card-title"><b><?= $room['hotel_name'] ?></b></p>
                        <p class="card-text"><i><?= $room['room_type'] ?></i></p>
                        <p class="card-text"><b>Rp <?= number_format($room['price_per_night'], 0, '.', '.') ?> / malam</b></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
