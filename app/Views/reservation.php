<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
    <!-- Edit Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Upload Payment</h5>
            </div>
            <div class="modal-body">
                <form action="reservation/pay" method="POST">
                <input type="hidden" name="id" id="bookingId">
                <h6>Booking Code: <span id="bookingCode"></span></h6>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="cancelBookingModal" tabindex="-1" role="dialog" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelBookingModalLabel">Cancel Booking</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this booking?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="reservation/cancel" method="POST">
                <input type="hidden" name="id" id="cancelBookingId">
                <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
            </div>
        </div>
    </div>

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
                            <td>Rp <?= number_format($booking['total_price'], 0, '.', '.') ?></td>
                            <td>
                                <?php if ($booking['status'] == "pending"): ?>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" data-id="<?= $booking['id'] ?>" data-code="<?= $booking['booking_code'] ?>">
                                        Pay
                                    </button>
                                <?php endif; ?>
                                <?php if ($booking['status'] == "pending"): ?>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelBookingModal" data-id="<?= $booking['id'] ?>">
                                        Cancel
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
<script>
    var paymentModal = document.getElementById('paymentModal');
    var cancelBookingModal = document.getElementById('cancelBookingModal');

    // Function to handle the modal show event
    function handeCreatePayment(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var code = button.getAttribute('data-code');

        var bookingId = paymentModal.querySelector('#bookingId');
        var bookingCode = paymentModal.querySelector('#bookingCode');

        // Set the values in the modal inputs
        bookingId.value = id;
        bookingCode.innerHTML = code;
    }

    function handleCancelBooking(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var cancelBookingId = cancelBookingModal.querySelector('#cancelBookingId');

        // Set the values in the modal inputs
        cancelBookingId.value = id;
    }

    // Attach event listener to the paymentModal show event
    paymentModal.addEventListener('show.bs.modal', handeCreatePayment);
    cancelBookingModal.addEventListener('show.bs.modal', handleCancelBooking);
</script>
<?= $this->endSection() ?>
