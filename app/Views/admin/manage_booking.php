<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>
    <!-- Payment Images -->
    <div class="modal fade" id="transferEvidenceModal" tabindex="-1" role="dialog" aria-labelledby="transferEvidenceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transferEvidenceModalLabel">Transfer Evidence</h5>
                </div>
                <div class="modal-body">
                    <img id="transferEvidenceImage" src="" class="img-fluid" alt="Transfer Evidence">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptBookingModal" tabindex="-1" role="dialog" aria-labelledby="acceptBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptBookingModalLabel">Accept Booking</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to accept this booking?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="<?= base_url('admin/booking/accept') ?>" method="POST">
                <input type="hidden" name="code" id="acceptBookingCode">
                <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="rejectBookingModal" tabindex="-1" role="dialog" aria-labelledby="rejectBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectBookingModalLabel">Reject Booking</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject this booking?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="<?= base_url('admin/booking/reject') ?>" method="POST">
                <input type="hidden" name="code" id="rejectBookingCode">
                <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h1>Booking Management</h1>
        <div class="book-table table-responsive my-4 p-4 border shadow">
        <table class="table">
                <tbody>
                    <?php foreach ($bookingGroup as $bookings) : ?>
                        <?php $lastBookingKey = array_key_last($bookings); ?>
                        <?php foreach ($bookings as $key => $booking) : ?>
                            <tr class="<?= ($key !== $lastBookingKey) ? 'no-border' : '' ?>">
                                <td>
                                    <img src="<?= $booking['hotel_image'] ?>" class="img-thumbnail" alt="Hotel Image" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td>
                                    <p><b><?= $booking['hotel_name'] ?></b></p>
                                    <p><?= date("M d, Y", strtotime($booking['check_in_date'])) . " - " . date("M d, Y", strtotime($booking['check_out_date'])) ?></p>
                                    <p><?= $booking['room_type'] ?></p>
                                </td>
                                <td>
                                    <p><?= strtoupper($booking['booking_code']) ?></p>
                                    <p><?= strtoupper($booking['status']) ?></p>
                                    <?php if ($booking['status'] == "transferred"): ?>
                                        <p>via <?= $booking['payment'] ?></p>
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?= number_format($booking['total_price'], 0, '.', '.') ?></td>
                                <td>
                                    <?php if ($key === $lastBookingKey && $booking['status'] == "transferred"): ?>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#acceptBookingModal" data-code="<?= $booking['booking_code'] ?>">
                                            Accept
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($key === $lastBookingKey && $booking['status'] == "transferred"): ?>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectBookingModal" data-code="<?= $booking['booking_code'] ?>">
                                            Reject
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($key === $lastBookingKey): ?>
                                        <button class="btn btn-sm btn-primary btn-payment-check" data-bs-toggle="modal" data-bs-target="#transferEvidenceModal" data-transfer-evidence-url="<?= base_url("uploads/payment/" . $booking['transfer_evidence']) ?>">
                                            Check Payment
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
<script>
    var acceptBookingModal = document.getElementById('acceptBookingModal');
    var rejectBookingModal = document.getElementById('rejectBookingModal');

    // Function to handle the modal show event
    function handleAcceptBooking(event) {
        var button = event.relatedTarget;
        var code = button.getAttribute('data-code');

        var acceptBookingCode = acceptBookingModal.querySelector('#acceptBookingCode');

        // Set the values in the modal inputs
        acceptBookingCode.value = code;
    }

    function handleRejectBooking(event) {
        var button = event.relatedTarget;
        var code = button.getAttribute('data-code');

        var rejectBookingCode = rejectBookingModal.querySelector('#rejectBookingCode');

        // Set the values in the modal inputs
        rejectBookingCode.value = code;
    }

    // Attach event listener to the Modal show event
    acceptBookingModal.addEventListener('show.bs.modal', handleAcceptBooking);
    rejectBookingModal.addEventListener('show.bs.modal', handleRejectBooking);

    var buttons = document.querySelectorAll('.btn-payment-check');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            var imageUrl = button.dataset.transferEvidenceUrl;
            var imageElement = document.getElementById('transferEvidenceImage');
            imageElement.src = imageUrl;
        });
    });
</script>
<?= $this->endSection() ?>