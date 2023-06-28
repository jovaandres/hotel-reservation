<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container hotel-container mt-4">
    <div class="home-title">
        <h1>Hotel Reservation</h1>
        <p>Find your perfect room</p>
    </div>
    <div class="card-container mt-4">
        <?php foreach ($hotels as $hotel) : ?>
            <a href="<?= base_url('hotel/' . $hotel['id'])  ?>" class="text-decoration-none">
                <div class="card mb-4 border-0">
                    <div class="image-wrapper">
                        <img src="<?= $hotel['hotel_image'] ?>" class="card-img-top square-image" alt="Hotel Image">
                    </div>
                    <div class="card-body">
                        <p class="card-title"><b><?= $hotel['name'] ?></b></p>
                        <p class="card-text"><i>Mulai dari</i></p>
                        <p class="card-text"><b>Rp <?= number_format($hotel['price_per_night'], 0, '.', '.') ?> / malam</b></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
