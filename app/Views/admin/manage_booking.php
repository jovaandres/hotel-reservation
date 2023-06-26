<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Manage Bookings</h1>
    <div class="row">
        <div class="col-md-12">
            <h3>Booking Requests</h3>
            <?php if (empty($bookingRequests)) : ?>
                <p>No booking requests available.</p>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Reservation ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Room ID</th>
                            <th scope="col">Check-in Date</th>
                            <th scope="col">Check-out Date</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookingRequests as $booking) : ?>
                            <tr>
                                <td><?= $booking['reservation_id'] ?></td>
                                <td><?= $booking['user_id'] ?></td>
                                <td><?= $booking['room_id'] ?></td>
                                <td><?= $booking['check_in_date'] ?></td>
                                <td><?= $booking['check_out_date'] ?></td>
                                <td><?= $booking['total_price'] ?></td>
                                <td><?= $booking['status'] ?></td>
                                <td>
                                    <a href="/admin/approve_booking/<?= $booking['reservation_id'] ?>" class="btn btn-success btn-sm">Approve</a>
                                    <a href="/admin/reject_booking/<?= $booking['reservation_id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <h3>Manage Reservations</h3>
            <?php if (empty($reservations)) : ?>
                <p>No reservations available.</p>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Reservation ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Room ID</th>
                            <th scope="col">Check-in Date</th>
                            <th scope="col">Check-out Date</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation) : ?>
                            <tr>
                                <td><?= $reservation['reservation_id'] ?></td>
                                <td><?= $reservation['user_id'] ?></td>
                                <td><?= $reservation['room_id'] ?></td>
                                <td><?= $reservation['check_in_date'] ?></td>
                                <td><?= $reservation['check_out_date'] ?></td>
                                <td><?= $reservation['total_price'] ?></td>
                                <td><?= $reservation['status'] ?></td>
                                <td>
                                    <a href="/admin/edit_reservation/<?= $reservation['reservation_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="/admin/cancel_reservation/<?= $reservation['reservation_id'] ?>" class="btn btn-danger btn-sm">Cancel</a>
                                    <a href="/admin/refund_reservation/<?= $reservation['reservation_id'] ?>" class="btn btn-warning btn-sm">Refund</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>