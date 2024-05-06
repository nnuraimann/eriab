<div class="modal-body">
    <form role="form" id="frm-booking">
        <div class="box-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Date</label>
            <input type="text" name="date" class="form-control" id="date-current" value="<?php echo $data->start_dt; ?>">
        </div>

        <div class="bootstrap-timepicker">
            <div class="form-group">
                <label>Start time:</label>

                <div class="input-group">
                <input type="text" name="startTime" class="form-control timepicker">

                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label>End time:</label>

                <div class="input-group">
                <input type="text" name="endTime" class="form-control timepicker">

                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
            </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Notes</label>
            <input type="text" name="notes" class="form-control" id="notes">
        </div>
    </form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary btn-submit-booking">Submit</button>
</div>