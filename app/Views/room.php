<!-- Views/room.php -->
<?php
    $authenticator = auth('session')->getAuthenticator();
    $isLoggedIn = $authenticator->loggedIn();
?>

<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1><?= $hotel['name'] ?></h1>
    <div class="row my-4">
        <div class="col-md-8">
            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= $hotel['first_image'] ?>" class="d-block w-100" alt="Room Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= $hotel['second_image'] ?>" class="d-block w-100" alt="Room Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= $hotel['third_image'] ?>" class="d-block w-100" alt="Room Image 3">
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
                    <p class="card-text description"><?= $hotel['description'] ?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Available Rooms</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Tipe Kamar</th>
                                <th scope="row">Harga per malam</th>
                            </tr>
                        <?php foreach ($rooms as $room) : ?>
                            <tr>
                                <td><?= $room['room_type'] ?></td>
                                <td>Rp <?= number_format($room['price_per_night'], 0, '.', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if ($isLoggedIn && !$authenticator->getUser()->is_admin) : ?>
                <div class="text-center my-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">Make a Reservation</button>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <div class="card card-review p-3">
                <div class="card-body">
                    <h5 class="card-title mb-4">User Reviews and Ratings</h5>
                    <?php if (empty($reviews)) : ?>
                        <p>No reviews available.</p>
                    <?php else : ?>
                        <?php foreach ($reviews as $review) : ?>
                            <div class="card mb-3 card-review-section">
                                <div class="card-body">
                                    <div class="rating-stars">
                                        <?php
                                        $rating = $review['rating'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fas fa-star"></i>'; // Filled star icon
                                            } else {
                                                echo '<i class="far fa-star"></i>'; // Empty star icon
                                            }
                                        }
                                        ?>
                                    </div>
                                    <p class="card-text"><?= $review['comment'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($isLoggedIn && !$authenticator->getUser()->is_admin) : ?>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#reviewModal">Write a Review</button>
                        </div>
                    <?php endif; ?>
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
                <form action="<?= base_url('review') ?>" method="POST">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating:</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Select rating</option>
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Fair</option>
                            <option value="3">3 - Average</option>
                            <option value="4">4 - Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea name="comment" id="comment" class="form-control" required></textarea>
                    </div>
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


<!-- Datepicker -->
<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Make a Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Reservation form -->
                <form action="<?= base_url('reservation/create') ?>" method="POST">
                    <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                    <div class="mb-3">
                        <label for="check-in-date" class="form-label">Check-in Date:</label>
                        <input type="date" class="form-control" id="check-in-date" name="check_in_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="check-out-date" class="form-label">Check-out Date:</label>
                        <input type="date" class="form-control" id="check-out-date" name="check_out_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Pilih Kamar:</label>
                        <select name="room_id" id="room_id" class="form-select" required>
                            <?php foreach ($rooms as $room) : ?>
                                <option value="<?= $room['id'] ?>"><?= $room['room_type'] . ' @Rp' . number_format($room['price_per_night'], 0, '.', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Make Reservation</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the date inputs
    var checkInDateInput = document.getElementById("check-in-date");
    var checkOutDateInput = document.getElementById("check-out-date");

    // Set the minimum check-in date as tomorrow
    var minCheckInDate = new Date();
    minCheckInDate.setDate(minCheckInDate.getDate() + 1);
    var minCheckInDateString = minCheckInDate.toISOString().split('T')[0];
    checkInDateInput.min = minCheckInDateString;

    // Function to calculate the minimum check-out date based on the selected check-in date
    function setMinCheckOutDate() {
        var selectedCheckInDate = new Date(checkInDateInput.value);
        var minCheckOutDate = new Date(selectedCheckInDate);
        minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
        var minCheckOutDateString = minCheckOutDate.toISOString().split('T')[0];
        checkOutDateInput.min = minCheckOutDateString;
        checkOutDateInput.value = minCheckOutDateString;
    }

    // Add event listener to check-in date input
    checkInDateInput.addEventListener("change", setMinCheckOutDate);
</script>

<?= $this->endSection() ?>