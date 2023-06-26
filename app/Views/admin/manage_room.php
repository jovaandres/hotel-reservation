<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Room</h5>
      </div>
      <div class="modal-body">
        <form action="room/edit" method="POST">
          <input type="hidden" name="id" id="editRoomId">
          <div class="form-group">
            <label for="editRoomType">Room Type</label>
            <textarea name="room_type" class="form-control" id="editRoomType" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="editRoomPricePerNight">Price Per Night</label>
            <input type="text" name="price_per_night" class="form-control" id="editRoomPricePerNight">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this room?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="room/delete" method="POST">
          <input type="hidden" name="id" id="deleteRoomId">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Create Room</h5>
      </div>
      <div class="modal-body">
        <form action="room/add" method="POST">
          <div class="form-group">
            <label for="createRoomType">Room Type</label>
            <input type="text" name="room_type" class="form-control" id="createRoomType" required>
          </div>
          <div class="form-group">
            <label for="createRoomPricePerNight">Price Per Night</label>
            <input type="text" name="price_per_night" class="form-control" id="createRoomPricePerNight" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Hotel Table -->
<div class="d-flex justify-content-end mb-3">
  <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">New Room</button>
</div>

<table class="table mt-4 border shadow">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Hotel Id</th>
      <th scope="col">Room Type</th>
      <th scope="col">Price Per Night</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rooms as $key => $room) : ?>
      <tr>
        <th scope="row"><?= $key + 1 ?></th>
        <td><?= $room['hotel_id'] ?></td>
        <td><?= $room['room_type'] ?></td>
        <td><?= $room['price_per_night'] ?></td>
        <td>
          <!-- Actions buttons -->
          <!-- Edit button -->
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $room['id'] ?>" data-hotel_id="<?= $room['hotel_id'] ?>" data-room_type="<?= $room['room_type'] ?>" data-price_per_night="<?= $room['price_per_night'] ?>">
            Edit
          </button>
          <!-- Delete button -->
          <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $room['id'] ?>" data-hotel_id="<?= $room['hotel_id'] ?>">
            Delete
          </button>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var editModal = document.getElementById('editModal');
    var deleteModal = document.getElementById('deleteModal');

    // Function to handle the modal show event
    function handleEditModalShow(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var hotel_id = button.getAttribute('data-hotel_id');
        var room_type = button.getAttribute('data-room_type');
        var price_per_night = button.getAttribute('data-price_per_night');

        var editRoomId = editModal.querySelector('#editRoomId');
        var editHotelId = editModal.querySelector('#editHotelId');
        var editRoomType = editModal.querySelector('#editRoomType');
        var editRoomPricePerNight = editModal.querySelector('#editRoomPricePerNight');

        // Set the values in the modal inputs
        editRoomId.value = id;
        editHotelId.value = hotel_id;
        editRoomType.value = room_type;
        editRoomPricePerNight = price_per_night;
    }

    function handleDeleteModalShow(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var deleteRoomId = deleteModal.querySelector('#deleteRoomId');

        // Set the values in the modal inputs
        deleteRoomId.value = id;
    }

    // Attach event listener to the editModal show event
    editModal.addEventListener('show.bs.modal', handleEditModalShow);
    deleteModal.addEventListener('show.bs.modal', handleDeleteModalShow);
</script>
<?= $this->endSection() ?>