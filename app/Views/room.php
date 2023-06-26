<!-- Views/room.php -->

<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Room Detail</h1>
    <div class="row">
        <div class="col-md-8">
            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="d-block w-100" alt="Room Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="d-block w-100" alt="Room Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="d-block w-100" alt="Room Image 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="card mb-4 w-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">Room Information</h5>
                    <p class="card-text hotel-name"><b>Hotel Name:</b> <?= $hotel['name'] ?></p>
                    <p class="card-text description"><b>Description:</b> <?= $hotel['description'] ?></p>
                    <p class="card-text room-type"><b>Room Type:</b> <?= $rooms['room_type'] ?></p>
                    <p class="card-text price-per-night"><b>Price per Night:</b> $<?= $rooms['price_per_night'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Write a Review</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Review form -->
                <form action="/review/" method="POST">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating:</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Select rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea name="comment" id="comment" class="form-control" required></textarea>
                    </div>
                    <input type="hidden" name="room_id" value="<?= $rooms['id'] ?>">
                    <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>