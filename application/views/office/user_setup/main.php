<section class="content">
<div class="box container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">User Setup</h2>
      </div>

      <div class="col-lg-12">

        <?php echo $this->session->flashdata('message'); ?>

        <div class="d-flex justify-content-between mb-3">
          <h4>Manage Users</h4>
          <a href="<?= base_url('office/user_create') ?>" class="btn btn-success" style="margin-bottom: 10px;"> <i class="fas fa-plus"></i> Add New User</a>
        </div>

        <table class="table table-bordered table-default">

          <thead class="thead-light">
            <tr>
              <th width="2%">#</th>
              <th width="18%">Name</th>
              <th width="20%">Full Name</th>
              <th width="20%">Email</th>
              <th width="15%">Active?</th>
              <th width="5%">Type</th>
            </tr>
          </thead>

          <tbody>

            <?php $i = 1; foreach ($data as $users) { ?>

              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $users->name; ?></td>
                <td><?php echo $users->fullname; ?></td>
                <td><?php echo $users->email; ?></td>
                <td></td>
                <td><?php echo $users->rank; ?></td>

                <td>
                  <a href="<?= base_url('office/user_edit/' . $users->id) ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="<?= base_url('office/user_delete/' . $users->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fas fa-trash"></i> Delete </a>
                  <a href="<?= base_url('office/user_pass_reset/' . $users->id) ?>" class="btn btn-warning" onclick="return confirm('Are you sure you want to reset your password?')"> <i class="fas fa-trash"></i> Reset Password </a>
                </td>

              </tr>

            <?php $i++; } ?>

          </tbody>

        </table>

      </div>
    </div>
  </div>
</section>