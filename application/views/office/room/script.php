<!-- FullCalendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

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
            var title = prompt("Enter Event Title");
            if(title)
            {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url:"<?php echo base_url(); ?>fullcalendar/insert",
                    type:"POST",
                    data:{title:title, start:start, end:end},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Added Successfully");
                    }
                })
            }
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