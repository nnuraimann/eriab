<ul class="sidebar-menu">
    <li class="nav-item">
        <a href="<?php echo base_url('office/dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('office/room'); ?>"><i class="fa fa-home"></i> <span>Rooms</span></a>
    </li>
    <?php if($this->session->userdata('rank') == 'Admin'): ?>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fa fa-link"></i> <span>Setup</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('office/user_setup'); ?>">User Setup</a></li>
            <li><a href="<?php echo base_url('office/room_setup'); ?>">Room Setup</a></li>
        </ul>
    </li>
    <?php endif; ?>
</ul>
