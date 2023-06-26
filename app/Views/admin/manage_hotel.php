<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Hotel</h5>
      </div>
      <div class="modal-body">
        <form action="hotel/edit" method="POST">
          <input type="hidden" name="id" id="editHotelId">
          <div class="form-group">
            <label for="editHotelName">Hotel Name</label>
            <input type="text" name="name" class="form-control" id="editHotelName">
          </div>
          <div class="form-group">
            <label for="editHotelAddress">Address</label>
            <input type="text" name="address" class="form-control" id="editHotelAddress">
          </div>
          <div class="form-group">
            <label for="editHotelPhone">Phone</label>
            <input type="text" name="phone" class="form-control" id="editHotelPhone">
          </div>
          <div class="form-group">
            <label for="editHotelEmail">Email</label>
            <input type="text" name="email" class="form-control" id="editHotelEmail">
          </div>
          <div class="form-group">
            <label for="editHotelDescription">Description</label>
            <textarea name="description" class="form-control" id="editHotelDescription" rows="3"></textarea>
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
        <p>Are you sure you want to delete this hotel?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="hotel/delete" method="POST">
          <input type="hidden" name="id" id="deleteHotelId">
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
        <h5 class="modal-title" id="createModalLabel">Create Hotel</h5>
      </div>
      <div class="modal-body">
        <form action="hotel/add" method="POST">
          <div class="form-group">
            <label for="createHotelName">Hotel Name</label>
            <input type="text" name="name" class="form-control" id="createHotelName" required>
          </div>
          <div class="form-group">
            <label for="createHotelDescription">Description</label>
            <input type="text" name="description" class="form-control" id="createHotelDescription" required>
          </div>
          <div class="form-group">
            <label for="createHotelAddress">Address</label>
            <input type="text" name="address" class="form-control" id="createHotelAddress" required>
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
  <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">New Hotel</button>
</div>

<table class="table mt-4 border shadow">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Address</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($hotels as $key => $hotel) : ?>
      <tr>
        <th scope="row"><?= $key + 1 ?></th>
        <td><?= $hotel['name'] ?></td>
        <td><?= $hotel['address'] ?></td>
        <td>
          <!-- Actions buttons -->
          <!-- Edit button -->
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $hotel['id'] ?>" data-name="<?= $hotel['name'] ?>" data-description="<?= $hotel['description'] ?>" data-address="<?= $hotel['address'] ?>" data-phone="<?= $hotel['phone'] ?>" data-email="<?= $hotel['email'] ?>">
            Edit
          </button>
          <!-- Delete button -->
          <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $hotel['id'] ?>" data-name="<?= $hotel['name'] ?>">
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
        var name = button.getAttribute('data-name');
        var description = button.getAttribute('data-description');
        var address = button.getAttribute('data-address');
        var phone = button.getAttribute('data-phone');
        var email = button.getAttribute('data-email');

        var editHotelId = editModal.querySelector('#editHotelId');
        var editHotelName = editModal.querySelector('#editHotelName');
        var editHotelDescription = editModal.querySelector('#editHotelDescription');
        var editHotelAddress = editModal.querySelector('#editHotelAddress');
        var editHotelPhone = editModal.querySelector('#editHotelPhone');
        var editHotelEmail = editModal.querySelector('#editHotelEmail');

        // Set the values in the modal inputs
        editHotelId.value = id;
        editHotelName.value = name;
        editHotelDescription.value = description;
        editHotelAddress.value = address;
        editHotelPhone.value = phone;
        editHotelEmail.value = email;
    }

    function handleDeleteModalShow(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var deleteHotelId = deleteModal.querySelector('#deleteHotelId');

        // Set the values in the modal inputs
        deleteHotelId.value = id;
    }

    // Attach event listener to the editModal show event
    editModal.addEventListener('show.bs.modal', handleEditModalShow);
    deleteModal.addEventListener('show.bs.modal', handleDeleteModalShow);
</script>
<?= $this->endSection() ?>
