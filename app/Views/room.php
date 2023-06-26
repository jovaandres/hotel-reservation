<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <h1>Room Detail</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="card-img-top" alt="Hotel Image">
                    <div class="card-body">
                        <h5 class="card-title">Room Information</h5>
                        <p class="card-text"><b>Room Type:</b> <?= $rooms['room_type'] ?></p>
                        <p class="card-text"><b>Price per Night:</b> $<?= $rooms['price_per_night'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Reviews and Ratings</h5>
                        <?php if (empty($reviews)) : ?>
                            <p>No reviews available.</p>
                        <?php else : ?>
                            <?php foreach ($reviews as $review) : ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Rating: <?= $review['rating'] ?></h6>
                                        <p class="card-text"><?= $review['comment'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <a href="/reviews/create" class="btn btn-primary">Write a Review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>