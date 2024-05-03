<section class = "content">
<div class="box container">
  <div class="row">

    <div class="col-lg-12 my-5">
      <h2 class="text-center mb-3">Edit Room</h2>
    </div>

    <div class="col-lg-12">

      <div class="d-flex justify-content-between ">
        <h4>Add New Room</h4>
        <a class="btn btn-warning" href="<?php echo base_url('office/user_setup'); ?>"> <i class="fas fa-angle-left"></i> Back</a>
      </div>

      <form method="post" action="<?php echo base_url('office/update_user/' . $data->id); ?>">

        <div class="form-group">
          <label>User Name</label>
          <input class="form-control" type="text" name="Name" value="<?php echo $data->name; ?>">
        </div>

        <div class="form-group">
          <label>User Full Name</label>
          <input class="form-control" type="text" name="FullName" value="<?php echo $data->fullname; ?>">
        </div>

        <div class="form-group">
          <label>User Email</label>
          <input class="form-control" type="text" name="Email" value="<?php echo $data->email; ?>">
        </div>

        <div class="form-group">
          <label>User Password</label>
          <input class="form-control" type="text" name="Password" value="<?php echo $data->password; ?>">
        </div>

        <div class="form-group">
          <label for="usertype">User Type</label>
          <select class="form-control" id="usertype" name="Type">
            <?php 
              $user_type = $data->rank;
              foreach($usertype as $list) : 
              ?>
              <option value="<?php echo $list->value; ?>" <?php if($list->value == $user_type){echo "selected";} ?>><?php echo $list->description; ?></option>
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