<section class="content-header">
<div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">User Setup</h2>
      </div>

      <div class="col-lg-12">

        <?php echo $this->session->flashdata('message'); ?>

        <div class="d-flex justify-content-between mb-3">
          <h4>Manage Users</h4>
          <a href="<?= base_url('office/user_create') ?>" class="btn btn-success"> <i class="fas fa-plus"></i> Add New User</a>
        </div>

        <table class="table table-bordered table-default">

          <thead class="thead-light">
            <tr>
              <th width="2%">#</th>
              <th width="25%">Title</th>
              <th width="53%">Description</th>
              <th width="20%">Action</th>
            </tr>
          </thead>

          <tbody>

            <?php $i = 1; foreach ($data as $post) { ?>

              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $room->room_name; ?></td>
                <td><?php echo $room->room_department; ?></td>
                <td><?php echo $room->room_capacity; ?></td>

                <td>
                  <a href="<?= base_url('office/user_edit/' . $post->id) ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="<?= base_url('office/user_delete/' . $post->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fas fa-trash"></i> Delete </a>
                </td>

              </tr>

            <?php $i++; } ?>

          </tbody>

        </table>

      </div>
    </div>
  </div>
</section>