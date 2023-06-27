<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>
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
                <form action="booking/accept" method="POST">
                <input type="hidden" name="id" id="acceptBookingId">
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
                <form action="booking/reject" method="POST">
                <input type="hidden" name="id" id="rejectBookingId">
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
                                <img src="<?= $booking['hotel_image'] ?>" class="img-thumbnail" alt="Hotel Image" style="width: 100px; height: 100px;object-fit: cover;">
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
                                <?php if ($booking['status'] == "transferred"): ?>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#acceptBookingModal" data-id="<?= $booking['id'] ?>">
                                        Accept
                                    </button>
                                <?php endif; ?>
                                <?php if ($booking['status'] == "transferred"): ?>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectBookingModal" data-id="<?= $booking['id'] ?>">
                                        Reject
                                    </button>
                                <?php endif; ?>
                                <?php if ($booking['status'] == "transferred"): ?>
                                    <button class="btn btn-sm btn-primary btn-payment-check" data-bs-toggle="modal" data-bs-target="#transferEvidenceModal" data-transfer-evidence-url="<?= base_url("uploads/payment/" . $booking['transfer_evidence']) ?>">
                                        Check Payment
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
    var acceptBookingModal = document.getElementById('acceptBookingModal');
    var rejectBookingModal = document.getElementById('rejectBookingModal');

    // Function to handle the modal show event
    function handleAcceptBooking(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var acceptBookingId = acceptBookingModal.querySelector('#acceptBookingId');

        // Set the values in the modal inputs
        acceptBookingId.value = id;
    }

    function handleRejectBooking(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var rejectBookingId = rejectBookingModal.querySelector('#rejectBookingId');

        // Set the values in the modal inputs
        rejectBookingId.value = id;
    }

    // Attach event listener to the Modal show event
    acceptBookingModal.addEventListener('show.bs.modal', handleAcceptBooking);
    rejectBookingModal.addEventListener('show.bs.modal', handleRejectBooking);

    document.addEventListener('DOMContentLoaded', function() {
        var button = document.querySelector('.btn-payment-check');
    });
</script>
<?= $this->endSection() ?>