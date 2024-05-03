<section class = "content">
<div class="box container">
  <div class="row">

    <div class="col-lg-12 my-5">
      <h2 class="text-center mb-3">Edit Room</h2>
    </div>

    <div class="col-lg-12">

      <div class="d-flex justify-content-between ">
        <h4>Add New Room</h4>
        <a class="btn btn-warning" href="<?php echo base_url('office/room_setup'); ?>"> <i class="fas fa-angle-left"></i> Back</a>
      </div>

      <form method="post" action="<?php echo base_url('office/update_room/' . $data->id); ?>">

        <div class="form-group">
          <label>Room Name</label>
          <input class="form-control" type="text" name="Name" value="<?php echo $data->room_name; ?>">
        </div>

        <div class="form-group">
          <label for="department">Room Department</label>
          <select class="form-control" id="department" name="Department">
            <?php 
              $room_jabatan = $data->room_department;
              foreach($jabatan as $list) : 
              ?>
              <option value="<?php echo $list->value; ?>" <?php if($list->value == $room_jabatan){echo "selected";}?>><?php echo $list->description; ?></option>
            <?php endforeach;?> 
          </select>
        </div>

        <div class="form-group">
          <label>Room Capacity</label>
          <input class="form-control" type="text" name="Capacity" value="<?php echo $data->room_capacity; ?>">
        </div>

        <div class="form-group">
          <label for = "room">Room Type</label>
          <select class = "form-control" id ="room" name ="Type">
          <?php 
              $roomtype = $data->room_type;
              foreach($room as $list) : 
              ?>
              <option value="<?php echo $list->value; ?>" <?php if($list->value == $roomtype){echo "selected";}?>><?php echo $list->description; ?></option>
            <?php endforeach;?> 
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Save </button>
        </div>

      </form>


    </div>
  </div>
</div>
</section>