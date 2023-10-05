<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php if ($_SESSION['user_type'] == 'admin') { ?>
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/dashboard'); ?>" href="<?php echo site_url('admin/dashboard'); ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/appointments'); ?>" href="<?php echo site_url('admin/appointments'); ?>">
                    <i class="bi bi-calendar2-week"></i>
                    <span>Appointments</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/timeslot'); ?>" href="<?php echo site_url('admin/timeslot'); ?>">
                    <i class="bi bi-clock-history"></i>
                    <span>Time Slot</span>
                </a>
            </li><!-- End Time Slot Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/sector'); ?>" href="<?php echo site_url('admin/sector'); ?>">
                    <i class="bi bi-people"></i>
                    <span>Vulnerable Sector</span>
                </a>
            </li><!-- End Position Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/gender'); ?>" href="<?php echo site_url('admin/gender'); ?>">
                    <i class="bi bi-gender-ambiguous"></i>
                    <span>Gender</span>
                </a>
            </li><!-- End Position Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/level'); ?>" href="<?php echo site_url('admin/level'); ?>">
                    <i class="bi bi-list-nested"></i>
                    <span>Level</span>
                </a>
            </li><!-- End Position Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/district'); ?>" href="<?php echo site_url('admin/district'); ?>">
                    <i class="bi bi-map"></i>
                    <span>District</span>
                </a>
            </li><!-- End District Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/school'); ?>" href="<?php echo site_url('admin/school'); ?>">
                    <i class="bi bi-buildings"></i>
                    <span>School</span>
                </a>
            </li><!-- End Schools Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/position'); ?>" href="<?php echo site_url('admin/position'); ?>">
                    <i class="bi bi-person-check"></i>
                    <span>Position</span>
                </a>
            </li><!-- End Position Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/division'); ?>" href="<?php echo site_url('admin/division'); ?>">
                    <i class="bi bi-diagram-3"></i>
                    <span>Functional Division</span>
                </a>
            </li><!-- End Functional Division Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('admin/usov'); ?>" href="<?php echo site_url('admin/usov'); ?>">
                    <i class="bi bi-briefcase"></i>
                    <span>Unit, Section, Office, to Visit</span>
                </a>
            </li><!-- End USOV Nav -->
        <?php } ?>

        <?php if ($_SESSION['user_type'] == 'user') { ?>
            <li class="nav-item">
                <a class="nav-link <?php active_link('user'); ?>" href="<?php echo site_url('user'); ?>">
                    <i class="bi bi-calendar-week"></i>
                    <span>My Appointments</span>
                </a>
            </li><!-- End My Appointments Nav -->
            <li class="nav-item">
                <a class="nav-link <?php active_link('user/profile'); ?>" href="<?php echo site_url('user/profile'); ?>">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Nav -->

        <?php } ?>
        <li class="nav-item">
            <a class="nav-link <?php active_link('user/setting'); ?>" href="<?php echo site_url('user/setting'); ?>">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li><!-- End Profile Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo site_url('logout'); ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </a>
        </li><!-- End Logout Nav -->
    </ul>

</aside><!-- End Sidebar-->