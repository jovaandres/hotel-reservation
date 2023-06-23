<!-- app/Views/bookings.php -->
<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <h1>Booking Management</h1>
        <div class="table-responsive my-4 p-4 border shadow">
            <table class="table">
                <tbody>
                    <?php foreach ($bookings as $booking) : ?>
                        <tr>
                            <td>
                                <img src="https://static.theprint.in/wp-content/uploads/2022/10/Hotel.jpg" class="img-thumbnail" alt="Hotel Image" style="width: 100px; height: 100px;object-fit: cover;">
                            </td>
                            <td>
                                <p><b><?= $booking['hotel_name'] ?></b></p>
                                <p><?= date("M d, Y", strtotime($booking['check_in_date'])) . " - " . date("M d, Y", strtotime($booking['check_out_date'])) ?></p>
                                <p><?= $booking['room_type'] ?></p>
                            </td>
                            <td>
                                <p><?= strtoupper($booking['booking_code']) ?></p>
                                <p><?= strtoupper($booking['status']) ?></p>
                            </td>
                            <td>$<?= $booking['total_price'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>
