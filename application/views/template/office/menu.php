<ul class="sidebar-menu">
    <li class="nav-item">
        <a href="<?php echo base_url('office/dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
    </li>
    </ul>      
    <ul class="sidebar-menu" data-widget="tree">
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Booking</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="<?php echo base_url('office/booking'); ?>">Current Booking</a></li>
        </ul>
    </li>
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Reservation</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="<?php echo base_url('office/room'); ?>">Rooms</a></li>
        <li><a href="<?php echo base_url('office/classroom'); ?>">Classroom</a></li>
        </ul>
    </li>
</ul>