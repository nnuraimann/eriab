<section class="content-header">
    <h1>Booking Information</h1>
</section>
<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Your Current Booking Information</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Booking Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $booking): ?>
                                <?php
                                $date1 = $booking->end_dt;
                                $date2 = date('Y-m-d H:i:s');
                                $timestamp1 = strtotime($date1); 
                                $timestamp2 = strtotime($date2); 
                                if ($timestamp1 >= $timestamp2){
                                    // Current Booking
                                    ?>
                                    <tr>
                                        <td><?php echo $booking->create_dt; ?></td>
                                        <td><?php echo $booking->start_dt; ?></td>
                                        <td><?php echo $booking->end_dt; ?></td>
                                        <td><?php echo $booking->notes; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No current bookings found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
    
    <!-- Past Booking -->
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Your Past Booking Information</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Booking Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $booking): ?>
                                <?php
                                $date1 = $booking->end_dt;
                                $date2 = date('Y-m-d H:i:s');
                                $timestamp1 = strtotime($date1); 
                                $timestamp2 = strtotime($date2); 
                                if ($timestamp1 < $timestamp2){
                                    // Past Booking
                                    ?>
                                    <tr>
                                        <td><?php echo $booking->create_dt; ?></td>
                                        <td><?php echo $booking->start_dt; ?></td>
                                        <td><?php echo $booking->end_dt; ?></td>
                                        <td><?php echo $booking->notes; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No past bookings found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
</section>
