<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.css">


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Booking Form</h4>
        </div>
        <div class="modal-body">
        <form role="form">
            <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Date</label>
                <input type="text" class="form-control" id="date-current">
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Time picker:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker">

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
                <input type="text" class="form-control" id="notes">
            </div>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- FullCalendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>


<script>
$(document).ready(function(){
    
    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:"<?php echo base_url(); ?>fullcalendar/load",
        selectable:true,
        selectHelper:true,
        select:function(start, end, allDay)
        {
            $('#modal-default').modal('show');
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            $('#date-current').val(start);
            $('.timepicker').timepicker({
            showInputs: false
            });

            // var title = prompt("Enter Event Title");
            // if(title)
            // {
            //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            //     $.ajax({
            //         url:"<?php echo base_url(); ?>fullcalendar/insert",
            //         type:"POST",
            //         data:{title:title, start:start, end:end},
            //         success:function()
            //         {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Added Successfully");
            //         }
            //     })
            // }
        },
        eventResize:function(event)
        {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

            var title = event.title;

            var id = event.id;

$.ajax({
                url:"<?php echo base_url(); ?>fullcalendar/update",
                type:"POST",
                data:{title:title, start:start, end:end, id:id},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Update");
                }
            })
        },
        eventDrop:function(event)
        {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            //alert(start);
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            //alert(end);
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"<?php echo base_url(); ?>fullcalendar/update",
                type:"POST",
                data:{title:title, start:start, end:end, id:id},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated");
                }
            })
        },
        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"<?php echo base_url(); ?>fullcalendar/delete",
                    type:"POST",
                    data:{id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert('Event Removed');
                    }
                })
            }
        }
    });
});
</script>