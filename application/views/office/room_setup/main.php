<section class="content">
<div class="box container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Room Setup</h2>
      </div>

      <div class="col-lg-12">

        <?php echo $this->session->flashdata('message'); ?>

        <div class="d-flex justify-content-between mb-5">
          <h4>Manage Rooms</h4>
          <a href="<?= base_url('office/room_create') ?>" class="btn btn-success" style="margin-bottom: 10px;"> 
          <i class="fas fa-plus"></i> Add New Post</a>
        </div>

        <table class="table table-bordered table-default">

          <thead class="thead-light">
            <tr>
              <th width="2%">No.</th>
              <th width="35%">Room Name</th>
              <th width="25%">Room Department</th>
              <th width="15%">Room Capacity</th>
              <th width="10%">Room Type</th>
              <th width="13%">Action</th>
            </tr>
          </thead>

          <tbody>

            <?php $i = 1; foreach ($data as $room) { ?>

              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $room->room_name; ?></td>
                <td><?php echo $room->room_department; ?></td>
                <td><?php echo $room->room_capacity; ?></td>
                <td><?php echo $room->room_type; ?></td>

                <td>
                  <a href="<?= base_url('office/room_edit/' . $room->id) ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="<?= base_url('office/room_delete/' . $room->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fas fa-trash"></i> Delete </a>
                </td>

              </tr>

            <?php $i++; } ?>

          </tbody>

        </table>

      </div>
    </div>
  </div>
</section>