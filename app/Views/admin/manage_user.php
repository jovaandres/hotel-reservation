<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="user/delete" method="POST">
          <input type="hidden" name="id" id="deleteUserId">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- User Table -->
<table class="table mt-4 border shadow">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Join Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $key => $user) : ?>
      <tr>
        <th scope="row"><?= $key + 1 ?></th>
        <td><?= $user->username ?></td>
        <td><?= $user->email ?></td>
        <td><?= $user->is_admin ? 'Admin' : 'User' ?></td>
        <td><?= date("M d, Y", strtotime($user->created_at)) ?></td>
        <td>
          <!-- Actions buttons -->
          <!-- Delete button -->
          <?php if (!$user->is_admin): ?>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $user->id ?>">
              Delete
            </button>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    function handleDeleteModalShow(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var deleteUserId = deleteModal.querySelector('#deleteUserId');

        // Set the values in the modal inputs
        deleteUserId.value = id;
    }

    deleteModal.addEventListener('show.bs.modal', handleDeleteModalShow);
</script>
<?= $this->endSection() ?>