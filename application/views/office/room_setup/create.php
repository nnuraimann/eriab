<div class="container">
  <div class="row">

    <div class="col-lg-12 my-5">
      <h2 class="text-center mb-3">Codeigniter 3 CRUD (Create-Read-Update-Delete) Application</h2>
    </div>

    <div class="col-lg-12">

      <div class="d-flex justify-content-between ">
        <h4>Add New Room</h4>
        <a class="btn btn-warning" href="<?php echo base_url('office/room_setup'); ?>"> <i class="fas fa-angle-left"></i> Back</a>
      </div>

      <form method="post" action="<?php echo base_url('office/room_store'); ?>">

        <div class="form-group">
          <label>Room Name</label>
          <input class="form-control" type="text" name="Name">
        </div>

        <div class="form-group">
          <label>Room Department</label>
          <input class="form-control" type="text" name="Department">
        </div>

        <div class="form-group">
          <label>Room Capacity</label>
          <input class="form-control" type="text" name="Capacity">
        </div>

        <div class="form-group">
          <label>Room Type</label>
          <input class="form-control" type="text" name="Type">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Submit </button>
        </div>

      </form>


    </div>
  </div>
</div>